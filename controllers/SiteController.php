<?php

namespace app\controllers;

use app\models\LoginForm;
use app\models\Records\Advertisement;
use app\models\Records\Producto;
use app\models\RegisterForm;
use Yii;
use yii\web\Controller;
use yii\web\Response;
use yii\filters\AccessControl;
use yii\filters\VerbFilter;
use yii\web\UploadedFile;

class SiteController extends Controller
{
    /**
     * {@inheritdoc}
     */
    public function actions(): array
    {
        return [
            'error' => [
                'class' => 'yii\web\ErrorAction',
            ]
        ];
    }

    public function actionIndex(): string
    {
        $ads = self::processAdvertisement(Advertisement::find()->all());
        $producto = Producto::find()->orderBy('RAND()')->limit(4)->all();
        $new_producto = Producto::find()->orderBy(['fecha_publicacion' => SORT_DESC])->limit(4)->all();

        return $this->render('index', ['ads' => $ads, 'producto' => $producto, 'new_producto' => $new_producto]);
    }

    public function actionLogin()
    {
        self::isGuest();

        $model = new LoginForm();

        if ($model->load(Yii::$app->request->post()) && $model->login()) {
            return $this->goBack();
        }

        return $this->render('login', [
            'model' => $model,
        ]);
    }

    public function actionRegister()
    {
        $model = new RegisterForm();
        $model->scenario = 'comprador';

        if($model->load(Yii::$app->request->post())){
            $model->fotografia = UploadedFile::getInstance($model, 'fotografia');
            $result = $model->execute();

            Yii::$app->session->setFlash(
                $result? 'success' : 'error',
                $result? 'Registro exitoso ya puedes ingresar' : 'No puedimos realizar el registro'
            );

            if($result){
                return $this->redirect('/login');
            }
        }

        return $this->render('register', ['model' => $model]);
    }

    public function actionRegisterVendedor()
    {
        $model = new RegisterForm();
        $model->scenario = 'vendedor';

        if($model->load(Yii::$app->request->post())){
            $model->fotografia = UploadedFile::getInstance($model, 'fotografia');
            $result = $model->execute();

            Yii::$app->session->setFlash(
                $result? 'success' : 'error',
                $result? 'Registro exitoso ya puedes ingresar' : 'No puedimos realizar el registro'
            );

            if($result){
                return $this->redirect('/login');
            }
        }

        return $this->render('register-vendedor', ['model' => $model]);
    }

    public function actionLogout(): Response
    {
        Yii::$app->user->logout();

        return $this->goHome();
    }

    private function processAdvertisement($advertisements): array
    {
        $carouselData = [];

        foreach ($advertisements as $advertisement) {
            $carouselData[] = [
                'image' => Yii::getAlias('@web/').$advertisement->imagen,
                'caption' => $advertisement->nombre,
            ];
        }

        return $carouselData;
    }

    private function isGuest(){
        if (!Yii::$app->user->isGuest) {
            return $this->goHome();
        }

        return true;
    }
}

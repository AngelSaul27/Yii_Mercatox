<?php

namespace app\controllers;

use app\models\LoginForm;
use app\models\ProductoSearch;
use app\models\Records\Advertisement;
use app\models\Records\Producto;
use app\models\RegisterForm;
use Yii;
use yii\web\Controller;
use yii\web\Response;
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
        $ads = self::processAdvertisement(
            Advertisement::find()
                ->where(['<=', 'fecha_habilitacion', date('Y-m-d')])
                ->andWhere(['>=', 'fecha_deshabilitacion', date('Y-m-d')])
                ->all()
        );
        $producto = Producto::find()
            ->where(['producto_oferta' => 'SI'])
            ->andWhere(['>','stock', 0])
            ->orderBy('RAND()')
            ->limit(4)
            ->all();
        $new_producto = Producto::find()
            ->where(['>','stock', 0])
            ->orderBy(['id' => SORT_DESC])
            ->limit(4)
            ->all();

        return $this->render('index',
            [
                'ads' => $ads,
                'producto' => $producto,
                'new_producto' => $new_producto
            ]
        );
    }

    public function actionSearch(): string
    {
        $searchModel = new ProductoSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('search', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
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

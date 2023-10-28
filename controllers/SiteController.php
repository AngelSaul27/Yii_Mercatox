<?php

namespace app\controllers;

use app\models\LoginForm;
use Yii;
use yii\web\Controller;
use yii\web\Response;
use yii\filters\AccessControl;
use yii\filters\VerbFilter;

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
        return $this->render('index');
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

    public function actionRegister(): string
    {
        return $this->render('register');
    }

    public function actionRegisterVendedor(): string
    {
        return $this->render('register-vendedor');
    }

    public function actionLogout(): Response
    {
        Yii::$app->user->logout();

        return $this->goHome();
    }

    private function isGuest(){
        if (!Yii::$app->user->isGuest) {
            return $this->goHome();
        }

        return true;
    }
}

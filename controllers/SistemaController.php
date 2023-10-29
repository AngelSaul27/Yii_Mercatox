<?php

namespace app\controllers;

use app\models\AdvertisementForm;
use app\models\Records\Advertisement;
use Yii;
use yii\web\Controller;
use yii\web\UploadedFile;

class SistemaController extends Controller
{

    public function behaviors()
    {
        return [
            'ghost-access'=> [
                'class' => 'webvimark\modules\UserManagement\components\GhostAccessControl',
            ],
        ];
    }

    public function actionAdvertisement(): string
    {
        $model = Advertisement::find()->all();

        return $this->render('/site/authentication/admin/advertisement', ['model' => $model]);
    }

    public function actionAdvertisementCreate(): string
    {
        $model = new AdvertisementForm();

        if($model->load(Yii::$app->request->post())){
            $model->imagen = UploadedFile::getInstance($model, 'imagen');
            $result = $model->execute();

            Yii::$app->session->setFlash(
                $result? 'success' : 'error',
                $result? 'Registro exitoso ya puedes ingresar' : 'No puedimos realizar el registro'
            );
        }

        return $this->render('/site/authentication/admin/_form_advertisement', ['model' => $model]);
    }

    public function actionPublication(){
        return $this->render('/site/authentication/admin/publication');
    }

    public function actionOrder(){
        return $this->render('/site/authentication/admin/order');
    }

    public function actionProduct(){
        return $this->render('/site/authentication/admin/product');
    }

}
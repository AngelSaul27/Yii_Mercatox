<?php

namespace app\controllers;

use app\models\AdvertisementForm;
use app\models\Records\Advertisement;
use Yii;
use yii\db\StaleObjectException;
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
        $model->scenario = 'create';

        if($model->load(Yii::$app->request->post())){
            $model->imagen = UploadedFile::getInstance($model, 'imagen');
            $result = $model->execute();

            Yii::$app->session->setFlash(
                $result? 'success' : 'error',
                $result? 'Anuncio creado exitosamente' : 'No puedimos crear el anuncio'
            );
        }

        return $this->render('/site/authentication/admin/_form_advertisement', ['model' => $model, 'title' => 'Crear Anuncio']);
    }

    /**
     * @throws StaleObjectException
     * @throws \Throwable
     */
    public function actionAdvertisementDelete($id): \yii\web\Response
    {
        $model = Advertisement::findOne(['id' => $id]);

        if($model !== null){
            $model->delete();
            Yii::$app->session->setFlash('success', 'Elemento eliminado exitosamente');
            return $this->redirect('/management/advertisements');
        }

        Yii::$app->session->setFlash('error', 'El elemento no pudo ser eliminado');
        return $this->redirect('/management/advertisements');
    }

    public function actionAdvertisementEdit($id){
        $current = Advertisement::findOne(['id' => $id]);

        if($current == null){
            Yii::$app->session->setFlash('error', 'El elemento no existe');
            return $this->redirect('/management/advertisements');
        }

        $model = new AdvertisementForm();
        $model->scenario = 'edit';
        $model->nombre = $current->nombre;
        $model->descripcion = $current->descripcion;
        $model->imagen = $current->imagen;
        $model->redireccion = $current->redireccion;
        $model->fecha_habilitacion = $current->fecha_habilitacion;
        $model->fecha_deshabilitacion = $current->fecha_deshabilitacion;
        $model->tipo = $current->tipo;
        $model->advertisement_type_id = $current->advertisement_type_id;

        if($model->load(Yii::$app->request->post())){
            $model->imagen = UploadedFile::getInstance($model, 'imagen');
            $result = $model->updated($id);

            Yii::$app->session->setFlash(
                $result? 'success' : 'error',
                $result? 'Actualización exitosa' : 'No pudimos actualizar la información'
            );
        }

        return $this->render('/site/authentication/admin/_form_advertisement', ['model' => $model, 'title' => 'Editar Anuncio']);
    }

}
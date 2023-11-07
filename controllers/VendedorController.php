<?php

namespace app\controllers;

use app\models\ProductoForm;
use app\models\Records\Producto;
use app\models\Records\ProductoCategoria;
use app\models\Records\Vendedor;
use Yii;
use yii\web\Controller;
use yii\web\UploadedFile;

class VendedorController extends Controller
{

    const URL = '/site/authentication/vendedor/';

    public function behaviors(): array
    {
        return [
            'ghost-access'=> [
                'class' => 'webvimark\modules\UserManagement\components\GhostAccessControl',
            ],
        ];
    }

    public function actionProductos(): string
    {
        $idVendedor = Vendedor::getIdVendedor();
        $model = Producto::findAll(['vendedor_id' => $idVendedor]);

        return $this->render(self::URL.'productos', ['model' => $model]);
    }

    public function actionProductoCreate(){
        $model = new ProductoForm();
        $categoria = ProductoCategoria::find()->all();

        if($model->load(Yii::$app->request->post())){
            $model->fotografia = UploadedFile::getInstance($model, 'fotografia');
            $result = $model->execute();

            Yii::$app->session->setFlash(
                $result? 'success' : 'error',
                $result? 'Producto registrado exitosamente' : 'No puedimos realizar el registro'
            );

            if($result){
                return $this->redirect('/vendedor/mis-productos');
            }
        }

        return $this->render(self::URL.'_form_producto', ['model' => $model, 'categoria' => $categoria]);
    }
}
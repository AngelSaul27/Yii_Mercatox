<?php

namespace app\controllers;

use app\models\ProductoForm;
use app\models\Records\Producto;
use app\models\Records\ProductoCategoria;
use app\models\Records\Vendedor;
use Yii;
use yii\db\StaleObjectException;
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
        $model->scenario = 'create';
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

        return $this->render(self::URL.'_form_producto', ['model' => $model, 'categoria' => $categoria, 'title' => 'Crear Producto']);
    }

    public function actionProductoEdit($id){
        $current = Producto::findOne(['id' => $id, 'vendedor_id' => (Vendedor::getIdVendedor())]);

        if($current === null){
            return $this->goBack();
        }

        $model = new ProductoForm();
        $model->scenario = 'edit';
        $model->nombre = $current->nombre;
        $model->descripcion = $current->descripcion;
        $model->precio = $current->precio;
        $model->stock = $current->stock;
        $model->estado = $current->estado;
        $model->categoria_id = $current->categoria_id;
        $model->fotografia = $current->fotografia;
        $model->fecha_publicacion = $current->fecha_publicacion;

        $categoria = ProductoCategoria::find()->all();

        if($model->load(Yii::$app->request->post())){
            $model->fotografia = UploadedFile::getInstance($model, 'fotografia');
            $result = $model->updated($id);

            Yii::$app->session->setFlash(
                $result? 'success' : 'error',
                $result? 'Producto registrado exitosamente' : 'No puedimos realizar el registro'
            );

            if($result){
                return $this->redirect('/vendedor/mis-productos');
            }
        }

        return $this->render(self::URL.'_form_producto', ['model' => $model, 'categoria' => $categoria, 'title' => 'Editar Producto']);
    }

    /**
     * @throws \Throwable
     * @throws StaleObjectException
     */
    public function actionProductoDelete($id): \yii\web\Response
    {
        $vendedor = Vendedor::getIdVendedor();
        $producto = Producto::findOne(['vendedor_id' => $vendedor, 'id' => $id]);

        if($producto){
            $producto->delete();
            Yii::$app->session->setFlash('success', 'Elemento elimnado exitosamente');
            return $this->redirect('/vendedor/mis-productos');
        }

        Yii::$app->session->setFlash('error', 'El elemento no existe');
        return $this->redirect('/vendedor/mis-productos');
    }

}
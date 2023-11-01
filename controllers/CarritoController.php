<?php

namespace app\controllers;

use app\models\Records\Carrito;
use app\models\Records\CarritoItem;
use yii\db\StaleObjectException;
use yii\web\Controller;

class CarritoController extends Controller
{
    public function behaviors()
    {
        return [
            'ghost-access'=> [
                'class' => 'webvimark\modules\UserManagement\components\GhostAccessControl',
            ],
        ];
    }

    public function actionView(){
        $carrito = Carrito::getProductoCarrito();

        if($carrito === null){
            return $this->render('/site/authentication/comprador/carrito');
        }

        return $this->render('/site/authentication/comprador/carrito',
            ['carrito' => $carrito['carrito'], 'productos' => $carrito['productos']]
        );
    }

    public function actionHistorial(): string
    {
        $historial = Carrito::getHistorialCarritos();

        if($historial === null){
            return $this->render('/site/authentication/comprador/compras');
        }

        return $this->render('/site/authentication/comprador/compras',
            ['historial' => $historial]
        );
    }

    public function actionProcesarCarrito(): \yii\web\Response
    {
        if(\Yii::$app->user->isGuest){
            return $this->goBack();
        }

        if(\Yii::$app->request->post()){
            $carrito = Carrito::getCarrito();
            if($carrito != null){
                $carrito->estado = Carrito::CARRITO_COMPRADO;
                $carrito->updated_at = date('Y-m-d h:m:s');

                if($carrito->save()){
                    \Yii::$app->session->setFlash('success', 'Producto comprado exitosamente');
                    return $this->redirect('/mi-carrito');
                }
            }
        }

        \Yii::$app->session->setFlash('error', 'No tienes permiso de realizar esta acción');

        return $this->goBack();
    }

    /**
     * @throws StaleObjectException
     * @throws \Throwable
     */
    public function actionRemoveProducto($id): \yii\web\Response
    {
        if(\Yii::$app->user->isGuest){
            return $this->goBack();
        }

        if(\Yii::$app->request->post()){
            $carrito = Carrito::getCarrito();

            if($carrito !== null){
                $carritoItem = CarritoItem::getCarritoItem($id, ($carrito->id));
                if($carritoItem !== null){
                    $carritoItem->delete();
                    Carrito::updateCarrito($carrito);

                    \Yii::$app->session->setFlash('success', 'Producto eliminado exitosamente');
                    return $this->redirect('/mi-carrito');
                }
            }
        }

        \Yii::$app->session->setFlash('error', 'No tienes permiso de realizar esta acción');

        return $this->goBack();
    }

}
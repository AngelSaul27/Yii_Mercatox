<?php

namespace app\controllers;

use app\models\Records\Carrito;
use app\models\Records\CarritoItem;
use app\models\Records\Producto;
use Yii;
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

    public function actionView(): string
    {
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
                $transaction = Yii::$app->db->beginTransaction();
                try {
                    $carrito->estado = Carrito::CARRITO_COMPRADO;
                    $carrito->updated_at = date('Y-m-d H:i:s');
                    $carrito->save();

                    // Obtener un array asociativo de producto_id y cantidad
                    $carritoItems = CarritoItem::find()
                        ->select(['producto_id', 'cantidad'])
                        ->where(['carrito_id' => $carrito->id])
                        ->asArray()
                        ->all();

                    // Crear un array asociativo de producto_id y cantidad a restar
                    $stocksToUpdate = [];
                    foreach ($carritoItems as $item)
                    {
                        $productoId = $item['producto_id'];
                        $cantidad = $item['cantidad'];
                        // Asegurarse de que el producto_id es único en el array final
                        if (!isset($stocksToUpdate[$productoId]))
                        {
                            $stocksToUpdate[$productoId] = $cantidad;
                        } else {
                            $stocksToUpdate[$productoId] += $cantidad;
                        }
                    }

                    // Actualizar el stock de productos
                    foreach ($stocksToUpdate as $productoId => $cantidad)
                    {
                        $result = Producto::updateAll(
                            ['stock' => new \yii\db\Expression("stock - $cantidad")],
                            ['id' => $productoId]
                        );
                    }

                    if($result)
                    {
                        $transaction->commit();

                        \Yii::$app->session->setFlash('success', 'Producto comprado exitosamente');
                        return $this->redirect('/mi-carrito');
                    }

                    var_dump($result);
                } catch (\Exception $e) { $transaction->rollBack();}
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
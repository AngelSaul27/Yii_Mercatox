<?php

namespace app\models;

use app\models\Records\Carrito;
use app\models\Records\CarritoItem;
use app\models\Records\CompradorDetalle;
use app\models\Records\Producto;
use Exception;
use Yii;

class CarritoForm
{
    public $producto_id;
    public $producto_precio;
    public $producto_stock;
    public $producto_cantidad = 1;
    public $producto_oferta;
    public $precio_con_oferta;

    public function saveCarrito(): ?bool
    {
        $getCarrito = Carrito::getCarrito();

        if($getCarrito == null){
            return $this->newCarrito();
        }else{
            return $this->oldCarrito($getCarrito);
        }
    }

    private function newCarrito(): bool
    {
        $transaction = Yii::$app->db->beginTransaction();
        try {
            $cart = new Carrito();
            $cart->total = 0;
            $cart->estado = 'ACTIVO';
            $cart->comprador_id = (CompradorDetalle::getId())->id;
            $cart->save();

            $cartItem = new CarritoItem();
            $cartItem->cantidad = $this->producto_cantidad;
            $cartItem->producto_id = $this->producto_id;
            $cartItem->carrito_id = $cart->id;

            if($this->producto_oferta === 'SI'){
                $cartItem->precio_cantidad = $this->precio_con_oferta;
            }else{
                $cartItem->precio_cantidad = $this->producto_precio;
            }

            $cartItem->save();

            if(Carrito::updateCarrito($cart)){
                $transaction->commit();
                return true;
            }

        }catch(Exception $E){
            $transaction->rollBack();

            Yii::warning($E->getMessage().':');
            return false;
        }

        return false;
    }

    private function oldCarrito($cart): bool
    {
        $transaction = Yii::$app->db->beginTransaction();
        try {
            $productoEnCarrito = CarritoItem::findOne(['producto_id' => $this->producto_id, 'carrito_id' => ($cart->id)]);

            if($productoEnCarrito !== null){ //Ya se encuentra en el carrito el producto

                $newCantidad = ($productoEnCarrito->cantidad) + 1;

                if($this->producto_oferta === 'SI'){
                    $newPrecio = ($newCantidad) * ($this->precio_con_oferta);
                }else{
                    $newPrecio = ($newCantidad) * ($this->producto_precio);
                }

                //===============[VALIDAR STOCK]===============//
                $stock = Producto::find()->select('stock')->where(['id' => $this->producto_id])->scalar();
                if($stock === 0 || ($stock <= ($productoEnCarrito->cantidad))){
                    $transaction->rollBack();
                    return false;
                }
                //=============================================//

                $productoEnCarrito->cantidad = $newCantidad;
                $productoEnCarrito->precio_cantidad = $newPrecio;

                $productoEnCarrito->save();
            }else{
                $model = new CarritoItem();
                $model->cantidad = $this->producto_cantidad;
                $model->producto_id = $this->producto_id;
                $model->carrito_id = ($cart->id);

                if($this->producto_oferta === 'SI'){
                    $model->precio_cantidad = $this->precio_con_oferta;
                }else{
                    $model->precio_cantidad = $this->producto_precio;
                }

                $model->save();
            }

            if(Carrito::updateCarrito($cart)){
                $transaction->commit();
                return true;
            }
        }catch (Exception $e){
            $transaction->rollBack();
            return false;
        }
        return false;
    }

}
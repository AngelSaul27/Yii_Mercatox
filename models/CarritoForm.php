<?php

namespace app\models;

use app\models\Records\Carrito;
use app\models\Records\CarritoItem;
use app\models\Records\CompradorDetalle;
use Yii;

class CarritoForm
{
    public $producto_id;
    public $producto_precio;
    public $producto_stock;
    public $producto_cantidad = 1;

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

            Yii::warning('Paso', 'chequeo');
            $cartItem = new CarritoItem();
            $cartItem->cantidad = $this->producto_cantidad;
            $cartItem->precio_cantidad = $this->producto_precio;
            $cartItem->producto_id = $this->producto_id;
            $cartItem->carrito_id = $cart->id;

            $cartItem->save();

            if(Carrito::updateCarrito($cart)){
                $transaction->commit();
                return true;
            }

        }catch(\Exception $E){
            $transaction->rollBack();
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
                $newPrecio = ($newCantidad) * ($this->producto_precio);

                $productoEnCarrito->cantidad = $newCantidad;
                $productoEnCarrito->precio_cantidad = $newPrecio;

                $productoEnCarrito->save();
            }else{
                $model = new CarritoItem();
                $model->cantidad = $this->producto_cantidad;
                $model->precio_cantidad = $this->producto_precio;
                $model->producto_id = $this->producto_id;
                $model->carrito_id = ($cart->id);

                $model->save();
            }

            if(Carrito::updateCarrito($cart)){
                $transaction->commit();
                return true;
            }
        }catch (\Exception $e){
            $transaction->rollBack();
            return false;
        }
        return false;
    }

}
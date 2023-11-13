<?php

namespace app\models;

use yii\base\Model;

class ProductoOfertaForm extends Model
{

    public $producto_valor_oferta;
    public $precio_con_oferta;

    public function rules()
    {
        return [
            [['producto_valor_oferta', 'precio_con_oferta'], 'required', 'message' => 'Complete este campo.'],
            [['producto_valor_oferta', 'precio_con_oferta'], 'number', 'message' => 'Solo se aceptan valores numericos.'],
            ['producto_valor_oferta', 'compare', 'compareValue' => 60, 'operator' => '<=', 'type' => 'number', 'message' => 'El valor no puede ser mayor que 60.'],
        ];
    }

    public function ofertar($producto): bool
    {
        if($this->validate()){
            if($this->producto_valor_oferta <= 0){
                $producto->producto_valor_oferta = 0.00;
                $producto->precio_con_oferta = null;
                $producto->producto_oferta = 'NO';
                $producto->save();
                return true;
            }

            $producto->producto_valor_oferta = $this->producto_valor_oferta;
            $producto->precio_con_oferta = $this->precio_con_oferta;
            $producto->producto_oferta = 'SI';

            if($producto->save()){
                return true;
            }
        }

        return false;
    }


}
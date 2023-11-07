<?php

namespace app\models;

use app\models\Records\Producto;
use app\models\Records\Vendedor;
use Yii;
use yii\base\Model;

class ProductoForm extends Model
{

    public $nombre;
    public $descripcion;
    public $precio;
    public $stock;
    public $estado;
    public $categoria_id;
    public $fotografia;
    public $fecha_publicacion;

    CONST STATUS_ACTIVE = "ACTIVO";
    CONST STATUS_PAUSE = "PAUSADO";

    public function rules(): array
    {
        return [
          [
              ['nombre', 'descripcion', 'precio', 'stock', 'estado', 'categoria_id', 'fotografia', 'fecha_publicacion'],
              'required', 'message' => 'Complete este campo'
          ],
            [
                ['fotografia'], 'file', 'skipOnEmpty' => false, 'extensions' => 'png, jpg, jpeg, webp',
                'message' => 'Solo archivos png, jpg y jpeg'
            ],
        ];
    }

    public function execute(): bool
    {
        if($this->validate())
        {
            $nameFile = self::generatedNameFile();

            $producto = new Producto();
            $producto->nombre = $this->nombre;
            $producto->descripcion = $this->descripcion;
            $producto->precio = $this->precio;
            $producto->stock = $this->stock;
            $producto->estado = $this->estado;
            $producto->categoria_id = $this->categoria_id;
            $producto->fotografia = $nameFile;
            $producto->vendedor_id = Vendedor::getIdVendedor();
            $producto->fecha_publicacion = $this->fecha_publicacion;

            if(strtotime($this->fecha_publicacion) >= strtotime(date('Y-m-d'))){
                $producto->estatus = self::STATUS_ACTIVE;
            }else{
                $producto->estatus = self::STATUS_PAUSE;
            }

            if($producto->save())
            {
                $this->fotografia->saveAs($nameFile);
                return true;
            }
        }
        return false;
    }

    private function generatedNameFile(): string
    {
        return 'storage/articles/' . $this->fotografia->baseName .'_'.(date("d_m_Y_h_i_s")). '.' . $this->fotografia->extension;
    }
}
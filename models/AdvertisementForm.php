<?php

namespace app\models;

use app\models\Records\Advertisement;
use yii\base\Model;

class AdvertisementForm extends Model
{
    public $nombre;
    public $descripcion;
    public $imagen;
    public $redireccion;
    public $fecha_habilitacion;
    public $fecha_desabilitacion;
    public $tipo;
    public $advertisement_type_id;

    public function rules(): array
    {
        return [
            [
                ['nombre','descripcion','imagen','redireccion', 'fecha_habilitacion', 'fecha_desabilitacion', 'tipo', 'advertisement_type_id']
                , 'required'
            ],
        ];
    }

    public function execute(): bool
    {
        if($this->validate()){
            $model = new Advertisement();
            $model->nombre = $this->nombre;
            $model->descripcion = $this->descripcion;
            $model->imagen = self::generatedNameFile();
            $model->redireccion = $this->redireccion;
            $model->fecha_habilitacion = $this->fecha_habilitacion;
            $model->fecha_deshabilitacion = $this->fecha_desabilitacion;
            $model->tipo = $this->tipo;
            $model->advertisement_type_id = $this->advertisement_type_id;

            if($model->save()){
                $this->imagen->saveAs(self::generatedNameFile());
                return true;
            }
        }
        return false;
    }

    private function generatedNameFile(): string
    {
        return 'storage/ads/' . $this->imagen->baseName .'_'.(date("d_m_Y_h_i_s")). '.' . $this->imagen->extension;
    }

}
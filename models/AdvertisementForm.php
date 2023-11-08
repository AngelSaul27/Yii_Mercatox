<?php

namespace app\models;

use app\models\Records\Advertisement;
use Yii;
use yii\base\Model;
use yii\validators\FileValidator;

class AdvertisementForm extends Model
{
    public $nombre;
    public $descripcion;
    public $imagen;
    public $redireccion;
    public $fecha_habilitacion;
    public $fecha_deshabilitacion;
    public $tipo;
    public $advertisement_type_id;

    public function rules(): array
    {
        return [
            [
                ['nombre','descripcion','imagen','redireccion', 'fecha_habilitacion', 'fecha_deshabilitacion', 'tipo', 'advertisement_type_id']
                , 'required', 'on' => 'create'
            ],
            [
                ['nombre','descripcion','redireccion', 'fecha_habilitacion', 'fecha_deshabilitacion', 'tipo', 'advertisement_type_id']
                , 'required', 'on' => 'edit'
            ],
            ['fecha_habilitacion', 'date', 'format' => 'php:Y-m-d', 'message' => 'Formato de fecha incorrecto','on' => 'create'],
            ['fecha_deshabilitacion', 'date', 'format' => 'php:Y-m-d', 'message' => 'Formato de fecha incorrecto', 'on' => 'create'],
            ['fecha_habilitacion', 'date', 'format' => 'php:Y-m-d', 'message' => 'Formato de fecha incorrecto', 'on' => 'edit'],
            ['fecha_deshabilitacion', 'date', 'format' => 'php:Y-m-d', 'message' => 'Formato de fecha incorrecto','on' => 'edit'],
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
            $model->fecha_deshabilitacion = $this->fecha_deshabilitacion;
            $model->tipo = $this->tipo;
            $model->advertisement_type_id = $this->advertisement_type_id;

            if($model->save()){
                $this->imagen->saveAs(self::generatedNameFile());
                return true;
            }
        }
        return false;
    }

    public function updated($id): bool
    {
        if($this->validate()){
            $rutaAntigua = null;

            $current = Advertisement::findOne(['id' => $id]);
            $current->nombre = $this->nombre;
            $current->descripcion = $this->descripcion;
            $current->redireccion = $this->redireccion;
            $current->fecha_habilitacion = $this->fecha_habilitacion;
            $current->fecha_deshabilitacion = $this->fecha_deshabilitacion;
            $current->tipo = $this->tipo;
            $current->advertisement_type_id = $this->advertisement_type_id;

            if($this->imagen !== null){
                $reglas = new FileValidator(
                    ['extensions' => 'png, jpg, jpeg, webp', 'skipOnEmpty' => false]
                );

                $apply = $reglas->validate($this->imagen, $error);

                if ($apply) {
                    if (!empty($current->imagen)) {
                        $rutaAntigua = Yii::getAlias('@webroot/') . $current->imagen;
                        if (file_exists($rutaAntigua)) {
                            $current->imagen = self::generatedNameFile();
                        }
                    }
                }
            }

            if($current->save()){
                if ($rutaAntigua !== null && file_exists($rutaAntigua)) {
                    unlink($rutaAntigua);
                    $this->imagen->saveAs($current->imagen);
                }

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
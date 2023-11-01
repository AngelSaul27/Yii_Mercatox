<?php

namespace app\models;

use app\models\Records\CompradorDetalle;
use app\models\Records\DireccionEntrega;
use app\models\Records\Vendedor;
use webvimark\modules\UserManagement\components\UserIdentity;
use webvimark\modules\UserManagement\models\User;
use Yii;
use yii\base\Model;

class RegisterForm extends Model
{
    public $username;
    public $email;
    public $password;
    public $fotografia;
    public $telefono;
    public $rfc;
    public $curp;
    public $calle;
    public $direccion;
    public $codigo_postal;
    public $n_exterior;
    public $telefono_contacto;
    public $tipo_ubicacion;
    public $indicaciones;

    public $direccion_envio;
    public $direccion_negocio;
    public $nombre_negocio;
    public $biografia_negocio;
    public $telefono_negocio;
    public $correo_negocio;
    public $servicio_id;

    public const ROLE_COMPRADOR = Usuario::ROLE_COMPRADOR;
    public const ROLE_VENDEDOR = Usuario::ROLE_VENDEDOR;

    public function rules(): array
    {
        return [
            [['username', 'email', 'password', 'fotografia'], 'required', 'message' => 'Campo requerido'],
            [['fotografia'], 'file', 'skipOnEmpty' => false, 'extensions' => 'png, jpg, jpeg', 'message' => 'Solo archivos png, jpg y jpeg'],
            [
                [
                    'telefono', 'rfc', 'curp', 'calle', 'direccion', 'codigo_postal',
                    'n_exterior', 'telefono_contacto', 'tipo_ubicacion', 'indicaciones'
                ], 'required', 'on' => 'comprador','message' => 'Campo requerido'
            ],
            [
                ['direccion_envio', 'direccion_negocio', 'nombre_negocio', 'biografia_negocio',
                    'telefono_negocio', 'correo_negocio', 'servicio_id', 'rfc'], 'required', 'on' => 'vendedor' ,'message' => 'Campo requerido'
            ],
            ['email', 'email']
        ];
    }

    public function execute(): bool
    {
        if($this->validate())
        {
            if($this->scenario === 'comprador')
            {
                return $this->createComprador();
            }else if($this->scenario === 'vendedor') {
                return $this->createVendedor();
            }
        }
        return false;
    }

    public function createComprador(): bool
    {
        $transaction = Yii::$app->db->beginTransaction();
        try {
            $foto = self::generatedNameFile();
            $usuarioId = $this->getUsuarioId($foto);

            $direccion = new DireccionEntrega();
            $direccion->calle = $this->calle;
            $direccion->codigo_postal = $this->codigo_postal;
            $direccion->direccion = $this->direccion;
            $direccion->n_exterior = $this->n_exterior;
            $direccion->tipo_ubicacion = $this->tipo_ubicacion;
            $direccion->telefono_contacto = $this->telefono_contacto;
            $direccion->indicaciones = $this->indicaciones;

            if ($direccion->save()) {
                $direccionId = $direccion->id;
            }

            $comprador = new CompradorDetalle();
            $comprador->nombre = $this->username;
            $comprador->telefono = $this->telefono;
            $comprador->RFC = $this->rfc;
            $comprador->CURP = $this->curp;
            $comprador->user_id = $usuarioId;
            $comprador->direccion_entrega_id = $direccionId;

            if($comprador->save()){
                User::assignRole($usuarioId, self::ROLE_COMPRADOR);
                $this->fotografia->saveAs($foto);
                $transaction->commit();
                return true;
            }
        }catch (\Exception $e){
            $transaction->rollBack();
        }
        return false;
    }

    public function createVendedor(): bool
    {
        $transaction = Yii::$app->db->beginTransaction();
        try{
            $foto = self::generatedNameFile();
            $usuarioId = $this->getUsuarioId($foto);

            $vendedor = new Vendedor();
            $vendedor->RFC = $this->rfc;
            $vendedor->direccion_envio = $this->direccion_envio;
            $vendedor->direccion_negocio = $this->direccion_negocio;
            $vendedor->nombre_negocio = $this->nombre_negocio;
            $vendedor->biografia_negocio = $this->biografia_negocio;
            $vendedor->telefono_negocio = $this->telefono_negocio;
            $vendedor->correo_negocio = $this->correo_negocio;
            $vendedor->user_id = $usuarioId;
            $vendedor->servicio_id = $this->servicio_id;

            if($vendedor->save()){
                User::assignRole($usuarioId, self::ROLE_VENDEDOR);
                $this->fotografia->saveAs($foto);
                $transaction->commit();
                return true;
            }

        }catch (\Exception $e){
            $transaction->rollBack();
        }
        return false;
    }

    private function generatedNameFile(): string
    {
        return 'storage/profile/' . $this->fotografia->baseName .'_'.(date("d_m_Y_h_i_s")). '.' . $this->fotografia->extension;
    }

    /**
     * @return int
     */
    public function getUsuarioId($foto): int
    {
        $usuario = new User();
        $usuario->scenario = 'newUser';
        $usuario->username = $this->username;
        $usuario->email = $this->email;
        $usuario->password = $this->password;
        $usuario->fotografia = $foto;

        if ($usuario->save()) {
            $usuarioId = $usuario->id;
        }
        return $usuarioId;
    }
}
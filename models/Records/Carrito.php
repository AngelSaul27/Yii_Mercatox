<?php

namespace app\models\Records;

use app\models\Usuario;
use Yii;
use yii\db\ActiveRecord;
use yii\db\Query;

class Carrito extends ActiveRecord
{
    public const CARRITO_COMPRADO = 'COMPRADO';
    public const CARRITO_ACTIVO = 'ACTIVO';
    public const CARRITO_CANCELADO = 'CANCELADO';
    public const CARRITO_FINALIZADO = 'FINALIZADO';

    public static function tableName()
    {
        return 'carrito';
    }

    public static function getCarrito()
    {
        if(!Yii::$app->user->isGuest && Usuario::getRoleName()=== Usuario::ROLE_COMPRADOR) {
            $id = CompradorDetalle::getId();
            return parent::find()->where(['comprador_id' => $id, 'estado' => self::CARRITO_ACTIVO])->one();
        }

        return null;
    }

    public static function updateCarrito($cart): bool
    {
        $newPrice = CarritoItem::find()
            ->where(['carrito_id' => ($cart->id)])
            ->sum('precio_cantidad');

        if($newPrice === null){
            $cart->delete();
            return true;
        }

        $cart->total = $newPrice;

        if($cart->save()){
            return true;
        }else{
            return false;
        }
    }

    public static function getProductoCarrito($limit = 10000000): ?array
    {
        $carrito = self::getCarrito();
        if($carrito !== null){
            $productos = (new Query())
                ->select(['carrito_item.*', 'producto.nombre as producto_nombre', 'producto.fotografia as producto_fotografia', 'producto.stock as producto_stock'])
                ->from('carrito_item')
                ->innerJoin('producto', 'carrito_item.producto_id = producto.id')
                ->where(['carrito_id' => ($carrito->id)])->limit($limit)->all();

            return ['carrito' => $carrito, 'productos' => $productos];
        }

        return null;
    }

    public static function getHistorialCarritos(): ?array
    {
        $historial = (new Query())
            ->select(
                ['carrito.*', 'carrito_item.cantidad', 'carrito_item.precio_cantidad',
                    'producto.nombre as producto_nombre', 'producto.fotografia as producto_fotografia',
                    'producto.descripcion as producto_descripcion'
                ]
            )
            ->from('carrito')
            ->innerJoin('carrito_item', 'carrito_item.carrito_id = carrito.id')
            ->innerJoin('producto', 'carrito_item.producto_id = producto.id')
            ->where(['carrito.comprador_id' => (CompradorDetalle::getId()), 'carrito.estado' => self::CARRITO_COMPRADO])
            ->orderBy(['updated_at' => SORT_ASC]) ->all();

        if($historial !== null){
            return self::estructurarCarrito($historial);
        }

        return null;
    }

    private static function estructurarCarrito($historial): array
    {
        $newEstructura = [];

        foreach ($historial as $row) {
            $idCarrito = $row['id'];

            // Si el carrito aún no existe en $newEstructura, crea una entrada para él
            if (!isset($newEstructura[$idCarrito])) {
                $newEstructura[$idCarrito] = [
                    'carrito' => [
                        'id' => $row['id'],
                        'total' => $row['total'],
                        'estado' => $row['estado'],
                        'comprador_id' => $row['comprador_id'],
                        'updated_at' => $row['updated_at'],
                        'created_at' => $row['created_at'],
                    ],
                    'productos' => [],
                ];
            }

            // Agrega los detalles del producto al carrito
            $newEstructura[$idCarrito]['productos'][] = [
                'cantidad' => $row['cantidad'],
                'precio_cantidad' => $row['precio_cantidad'],
                'producto_nombre' => $row['producto_nombre'],
                'producto_fotografia' => $row['producto_fotografia'],
                'producto_descripcion' => $row['producto_descripcion'],
            ];
        }

        return $newEstructura;
    }
}
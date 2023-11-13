<?php

namespace app\controllers;

use app\models\CarritoForm;
use app\models\Records\Advertisement;
use app\models\Records\Producto;
use app\models\Records\ProductoCategoria;
use app\models\Records\Vendedor;
use Yii;
use yii\web\Controller;

class ProductoController extends Controller
{
    public function behaviors()
    {
        return [
            'ghost-access'=> [
                'class' => 'webvimark\modules\UserManagement\components\GhostAccessControl',
            ],
        ];
    }

    public function actionView($id){
        $producto = Producto::findOne(['id' => $id]);

        if($producto == null){
            \Yii::$app->session->setFlash('error', 'Producto no encontrado');
            return $this->goBack();
        }

        if($producto->stock === 0){
            \Yii::$app->session->setFlash('warning', 'El producto no esta disponible ya');
            return $this->goBack();
        }

        $vendedorId = $producto->vendedor_id;
        $categoriaId = $producto->categoria_id;
        $moreProduct = Producto::find()
            ->where(['categoria_id' => $categoriaId])
            ->andwhere(['not', ['id' => $id]])
            ->andWhere(['>','stock', 0])
            ->limit(4)
            ->all();

        $categoria = ProductoCategoria::findOne(['id' => $categoriaId]);
        $vendedor = Vendedor::findOne(['id' => $vendedorId]);

        if(\Yii::$app->request->post()){
            if(Yii::$app->user->isGuest){
                return $this->redirect('/login');
            }

            $form = new CarritoForm();
            $form->producto_id = $id;
            $form->producto_precio = $producto->precio;
            $form->producto_stock = $producto->stock;
            $form->producto_oferta = $producto->producto_oferta;
            $form->precio_con_oferta = $producto->precio_con_oferta;

            $result = $form->saveCarrito();

            Yii::$app->session->setFlash(
                $result? 'success' : 'error',
                $result? 'Producto agreado a tu carrito' : 'Error no pudimos añadir tu producto a tu carrito, intentalo más tarde'
            );
        }


        return $this->render('/site/authentication/producto/producto',
            ['producto' => $producto, 'categoria' => $categoria, 'vendedor' => $vendedor, 'producto_similar' => $moreProduct]
        );
    }

    public function actionCategoria($categoria)
    {
        $categoria = ProductoCategoria::findOne(['categoria' => $categoria]);

        if($categoria === null){
            \Yii::$app->session->setFlash('warning', 'La categoria no exite');
            return $this->goBack();
        }

        $producto = Producto::find()->where(['categoria_id' => ($categoria->id)])->orderBy('RAND()')->all();

        if($producto === null){
            \Yii::$app->session->setFlash('warning', 'No hay más productos para esa categoria');
            return $this->goBack();
        }

        $ads = self::processAdvertisement(Advertisement::find()->all());

        return $this->render('/site/authentication/producto/producto-categoria', ['categoria' => $categoria, 'producto' => $producto, 'ads' => $ads]);
    }

    private function processAdvertisement($advertisements): array
    {
        $carouselData = [];

        foreach ($advertisements as $advertisement) {
            $carouselData[] = [
                'image' => Yii::getAlias('@web/').$advertisement->imagen,
                'caption' => $advertisement->nombre,
            ];
        }

        return $carouselData;
    }

}
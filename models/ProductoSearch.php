<?php

namespace app\models;

use app\models\Records\Producto;
use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;

class ProductoSearch extends Model
{

    public $nombre;

    public function rules(): array
    {
        return [
            [['nombre'], 'safe'],
        ];
    }

    public function search($params): ActiveDataProvider
    {
        $query = Producto::find();

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        $this->load($params);
        $this->nombre = $params['nombre'];

        if (!$this->validate()) {
            return $dataProvider;
        }

        // Utiliza directamente el valor de "nombre" de $params
        // Like para bucar las coincidencias
        $query->andFilterWhere(['like', 'LOWER(nombre)', strtolower($params['nombre'])]);
        //var_dump($query->createCommand()->rawSql);

        return $dataProvider;
    }


}
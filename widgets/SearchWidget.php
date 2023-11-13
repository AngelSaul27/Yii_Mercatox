<?php

namespace app\widgets;

use yii\base\Widget;
use yii\bootstrap5\ActiveForm;
use yii\bootstrap5\Html;

class SearchWidget extends Widget
{

    public function run(){
        ActiveForm::begin([
            'action' => ['producto/search'],
            'method' => 'get',
            'options' => ['class' => 'flex w-[70%] divide-x']
        ]);

        echo Html::textInput(
            'nombre', // Ajusta el nombre del campo según tu modelo
            '', // Valor inicial del campo (puedes proporcionar un valor predeterminado si lo deseas)
            [
                'class' => 'outline-none border-none rounded-l-md shadow-sm p-2 px-3 w-full text-gray-500',
                'placeholder' => 'Buscar productos, vendedores, etc'
            ]
        );

        echo Html::submitButton(
            '<svg class="w-4 h-4 text-neutral-900" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" d="M21 21l-5.197-5.197m0 0A7.5 7.5 0 105.196 5.196a7.5 7.5 0 0010.607 10.607z" /></svg>',
            [
                'type' => 'submit',
                'class' => 'rounded-r-md bg-white p-2 px-3'
            ]
        );

        ActiveForm::end();
    }

}
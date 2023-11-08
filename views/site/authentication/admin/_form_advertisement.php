<?php use app\models\Records\AdvertisementSitio;
use yii\bootstrap5\ActiveForm;
use yii\helpers\ArrayHelper;
use yii\jui\DatePicker;

$this->title = $title; ?>

<div class="px-10 py-5">
    <!-- Breadcrumb -->
    <nav class="flex py-3 text-gray-700 mb-2 w-max" aria-label="Breadcrumb">
        <ol class="inline-flex items-center space-x-1 md:space-x-3">
            <li class="inline-flex items-center">
                <a href="<?= Yii::getAlias('@web/')?>" class="inline-flex items-center text-sm font-light text-gray-700 hover:text-blue-600">
                    Volver
                </a>
            </li>
            <li>
                <div class="flex items-center">
                    <svg class="w-3 h-3 mx-1 text-gray-400" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 6 10">
                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="1" d="m1 9 4-4-4-4"/>
                    </svg>
                    <a href="<?= Yii::getAlias('@web/management/advertisements') ?>" class="ml-1 text-sm font-light text-gray-700 hover:text-blue-600 md:ml-2">Carousel</a>
                </div>
            </li>
            <li aria-current="page">
                <div class="flex items-center">
                    <svg class="w-3 h-3 mx-1 text-gray-400" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 6 10">
                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="1" d="m1 9 4-4-4-4"/>
                    </svg>
                    <span class="ml-1 text-sm font-medium text-gray-500 md:ml-2"><?= $title ?></span>
                </div>
            </li>
        </ol>
    </nav>

    <?php $form = ActiveForm::begin() ?>
        <div class="bg-white rounded-md shadow w-1/2 p-3">
            <div class="grid grid-cols-2 gap-4">
                <div>
                    <label class="text-gray-500 mb-1">Nombre del Advertisement</label>
                    <?= $form->field($model, 'nombre')
                        ->textInput(['class' => 'outline-none rounded-md border-gray-300 p-2 w-full shadow-sm -mb-1', 'placeholder' => 'Nombre'])
                        ->label(false) ?>

                    <label class="text-gray-500 mb-1">Descripcion del Advertisement</label>
                    <?= $form->field($model, 'descripcion')
                        ->textarea(['class' => 'outline-none rounded-md border-gray-300 p-2 w-full shadow-sm -mb-1 h-[121px]', 'placeholder' => 'Descripción'])
                        ->label(false) ?>

                    <label class="text-gray-500 mb-1">Imagen del Adverstisement</label>
                    <?= $form->field($model, 'imagen')
                        ->fileInput(['class' => 'outline-none rounded-md border-gray-300 p-2 w-full shadow-sm -mb-1', 'placeholder' => 'Imagen URL'])
                        ->label(false) ?>
                </div>
                <div>
                    <label class="text-gray-500 mb-1">URL de Redireccionamiento</label>
                    <?= $form->field($model, 'redireccion')
                        ->textInput(['class' => 'outline-none rounded-md border-gray-300 p-2 w-full shadow-sm -mb-1', 'placeholder' => 'URL'])
                        ->label(false) ?>

                    <div class="grid grid-cols-2 gap-2">
                        <label class="text-gray-500 mb-1 col-span-2">Inicio y Fin del Advertisement</label>
                        <?= $form->field($model, 'fecha_habilitacion')
                            ->widget(DatePicker::className(), [
                                'options' => ['class' => 'outline-none rounded-md border-gray-300 p-2 w-full shadow-sm -mb-1', 'placeholder' => '##-##-####'],
                                'dateFormat' => 'yyyy-MM-dd'
                            ])->label(false) ?>

                        <?= $form->field($model, 'fecha_deshabilitacion')
                            ->widget(DatePicker::className(), [
                                'options' => ['class' => 'outline-none rounded-md border-gray-300 p-2 w-full shadow-sm -mb-1', 'placeholder' => '##-##-####'],
                                'dateFormat' => 'yyyy-MM-dd'
                            ])->label(false) ?>
                    </div>

                    <label class="text-gray-500 mb-1">Tipo de Advertisement: </label>
                    <?= $form->field($model, 'tipo')
                        ->textInput(['class' => 'outline-none rounded-md border-gray-300 p-2 w-full shadow-sm -mb-1', 'placeholder' => 'Sitio donde se mostrara'])
                        ->label(false) ?>

                    <label class="text-gray-500 mb-1">Mostrar en: </label>
                    <?= $form->field($model, 'advertisement_type_id')
                        ->dropDownList(ArrayHelper::map(AdvertisementSitio::find()->all(), 'id', 'sitio'),['id'=> 'tipo_ubicacion','class' => 'outline-none rounded-md border-gray-300 p-2 w-full shadow-sm -mb-1'])
                        ->label(false) ?>
                </div>
            </div>

            <button class="w-full rounded-md px-3 py-2 text-xl font-light bg-blue-700 text-white mt-3 mb-2 text-center cursor-pointer">
                <?= $this->title ?>
            </button>
        </div>
    <?php ActiveForm::end() ?>
</div>

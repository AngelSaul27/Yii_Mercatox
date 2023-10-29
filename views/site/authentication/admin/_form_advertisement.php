<?php use app\models\Records\AdvertisementSitio;
use yii\bootstrap5\ActiveForm;
use yii\helpers\ArrayHelper;

$this->title = 'Create Adverstisements'; ?>

<div class="px-10 py-5">
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
                            ->input('date',['class' => 'outline-none rounded-md border-gray-300 p-2 w-full shadow-sm -mb-1'])
                            ->label(false) ?>
                        <?= $form->field($model, 'fecha_desabilitacion')
                            ->input('date',['class' => 'outline-none rounded-md border-gray-300 p-2 w-full shadow-sm -mb-1'])
                            ->label(false) ?>
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
                Registrar
            </button>
        </div>
    <?php ActiveForm::end() ?>
</div>

<?php
    use app\models\Records\ProductoCategoria;
    use yii\bootstrap5\ActiveForm;
    use yii\helpers\ArrayHelper;
    $this->title = 'Crear producto';
?>

<div class="px-10 py-5">

    <div class="bg-white rounded-md shadow w-1/2 p-3 mx-auto">
        <span class="font-bold text-2xl text-blue-900 block text-center">Añade un producto</span>
        <span class="text-gray-600 block text-center -mt-1">Complete todos los campos</span>
        <?php $form = ActiveForm::begin() ?>
            <div class="grid grid-cols-2 gap-4 mt-2">
                <div>
                    <label class="text-gray-500 mb-1">Nombre del producto</label>
                    <?= $form->field($model, 'nombre')
                        ->textInput(['class' => 'outline-none rounded-md border-gray-300 p-2 w-full shadow-sm -mb-1', 'placeholder' => 'Nombre del producto'])
                        ->label(false) ?>

                    <label class="text-gray-500 mb-1">Descripcion del producto</label>
                    <?= $form->field($model, 'descripcion')
                        ->textarea(['class' => 'h-[123px] outline-none rounded-md border-gray-300 p-2 w-full shadow-sm -mb-1', 'placeholder' => 'Descripción del producto'])
                        ->label(false) ?>

                    <label class="text-gray-500 mb-1">Precio del producto</label>
                    <?= $form->field($model, 'precio')
                        ->input('number',['class' => 'outline-none rounded-md border-gray-300 p-2 w-full shadow-sm -mb-1', 'placeholder' => '$0.00'])
                        ->label(false) ?>
                </div>
                <div>
                    <label class="text-gray-500 mb-1">Cantidad de producto disponible</label>
                    <?= $form->field($model, 'stock')
                        ->input('number',['class' => 'outline-none rounded-md border-gray-300 p-2 w-full shadow-sm -mb-1', 'placeholder' => '1 - 20'])
                        ->label(false) ?>

                    <label class="text-gray-500 mb-1">Estado del producto</label>
                    <?= $form->field($model, 'estado')
                        ->dropDownList(
                            ['NUEVO' => 'Producto nuevo','USADO' => 'Producto usado','RE ACONDICIONADO' => 'Producto reparado','SEMI NUEVO' => 'Semi nuevo'],
                            ['class' => 'outline-none rounded-md border-gray-300 p-2 w-full shadow-sm -mb-1', 'placeholder' => 'Nombre'])
                        ->label(false) ?>

                    <label class="text-gray-500 mb-1">Categoria del producto</label>
                    <?= $form->field($model, 'categoria_id')
                        ->dropDownList(
                            ArrayHelper::map($categoria ?? [], 'id', 'categoria'),
                            ['class' => 'outline-none rounded-md border-gray-300 p-2 w-full shadow-sm -mb-1', 'placeholder' => 'Nombre'])
                        ->label(false) ?>
                    <label class="text-gray-500 mb-1">Fotografia</label>
                    <?= $form->field($model, 'fotografia')
                        ->fileInput(['class' => 'outline-none rounded-md border-gray-300 p-2 w-full shadow-sm -mb-1', 'placeholder' => 'Nombre de usuario'])
                        ->label(false) ?>
                </div>
            </div>
            <label class="text-gray-500 mb-1">Fecha de Publicación</label>
            <?= $form->field($model, 'fecha_publicacion')
                ->input('date',['class' => 'outline-none rounded-md border-gray-300 p-2 w-full shadow-sm -mb-1', 'placeholder' => 'Nombre del producto'])
                ->label(false) ?>
            <button class="w-full col-span-2 rounded-md px-3 py-2 text-xl font-light bg-blue-700 text-white text-center cursor-pointer">
                Agregar Producto
            </button>
        <?php ActiveForm::end() ?>
    </div>

</div>


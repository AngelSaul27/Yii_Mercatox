<?php
use webvimark\modules\UserManagement\models\User;
use yii\widgets\ActiveForm;

$this->title = $producto->nombre; ?>

<div class="px-[80px] py-4">
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
                    <a href="<?= Yii::$app->urlManager->createAbsoluteUrl(['/producto/categoria', 'categoria' => $categoria->categoria]) ?>" class="ml-1 text-sm font-light text-gray-700 hover:text-blue-600 md:ml-2"><?= $categoria->categoria ?: 'Producto' ?></a>
                </div>
            </li>
            <li aria-current="page">
                <div class="flex items-center">
                    <svg class="w-3 h-3 mx-1 text-gray-400" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 6 10">
                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="1" d="m1 9 4-4-4-4"/>
                    </svg>
                    <span class="ml-1 text-sm font-medium text-gray-500 md:ml-2"><?= $producto->nombre ?></span>
                </div>
            </li>
        </ol>
    </nav>

    <div class="grid grid-cols-4 gap-x-4 bg-white rounded-md shadow-sm pt-3 px-3 pb-5">
        <div class="col-span-3 grid grid-cols-12 gap-x-4 pr-3">
            <div class="col-span-1 flex gap-y-2 flex-col max-h-72">
                <div class="bg-white rounded-md border-2 border-blue-500 flex items-center w-full h-[60px] p-1">
                    <img src="<?= Yii::getAlias('@web/').$producto->fotografia ?>" class="object-contain h-[40px] w-[40px] mx-auto" alt="">
                </div>
                <div class="bg-white rounded-md border border-gray-100 flex items-center w-full h-[60px] p-1">
                    <img src="<?= Yii::getAlias('@web/').$producto->fotografia ?>" class="object-contain h-[40px] w-[40px] mx-auto" alt="">
                </div>
                <div class="bg-white rounded-md border border-gray-100 flex items-center w-full h-[60px] p-1">
                    <img src="<?= Yii::getAlias('@web/').$producto->fotografia ?>" class="object-contain h-[40px] w-[40px] mx-auto" alt="">
                </div>
            </div>

            <div class="col-span-5 bg-white h-[350px]">
                <img src="<?= Yii::getAlias('@web/').$producto->fotografia ?>" class="object-contain h-full" alt="">
            </div>

            <div class="col-span-6 space-y-2 px-3 py-4">
                <span class="block text-gray-600 text-sm font-light"><?= $producto->estado ?></span>
                <h1 class="text-2xl text-neutral-800 font-semibold "><?= $producto->nombre?></h1>

                <div class="flex items-center my-2">
                    <svg class="w-4 h-4 text-blue-500 mr-1" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 22 20">
                        <path d="M20.924 7.625a1.523 1.523 0 0 0-1.238-1.044l-5.051-.734-2.259-4.577a1.534 1.534 0 0 0-2.752 0L7.365 5.847l-5.051.734A1.535 1.535 0 0 0 1.463 9.2l3.656 3.563-.863 5.031a1.532 1.532 0 0 0 2.226 1.616L11 17.033l4.518 2.375a1.534 1.534 0 0 0 2.226-1.617l-.863-5.03L20.537 9.2a1.523 1.523 0 0 0 .387-1.575Z"/>
                    </svg>
                    <p class="ml-2 text-sm font-light text-gray-900">4.95</p>
                    <span class="w-1 h-1 mx-1.5 bg-gray-500 rounded-full"></span>
                    <a href="<?= Yii::getAlias('@web/')?>" class="text-sm font-light text-gray-900 no-underline hover:underline">73 reviews</a>
                </div>

                <span class="block font-light text-4xl">$ <?= number_format($producto->precio, '2', '.', ',')?></span>
                <span class="block text-gray-600 text-sm font-light">IVA incluido</span>

                <h2 class="font-semibold my-3">Metodos de pago</h2>
                <div class="flex flex-wrap gap-3 mb-4">
                    <img src="<?= Yii::getAlias('@web/img/america_express.svg')?>" class="h-8 h-8">
                    <img src="<?= Yii::getAlias('@web/img/mastercard.svg')?>" class="h-8 h-8">
                    <img src="<?= Yii::getAlias('@web/img/visa.svg')?>" class="h-8 h-8">
                    <img src="<?= Yii::getAlias('@web/img/paycash.svg')?>" class="h-8 h-8">
                    <img src="<?= Yii::getAlias('@web/img/red.svg')?>" class="h-8 h-8">
                    <img src="<?= Yii::getAlias('@web/img/sivale.svg')?>" class="h-8 h-8">
                </div>
            </div>
        </div>

        <div class="col-span-1 p-3 border border-gray-400 rounded-md bg-white space-y-2 h-max">
            <div>
                <h1 class="font-semibold text-xl text-green-600">Envió gratis!</h1>
                <span class="text-sm font-light text-blue-500 block">Todas las entregas son seguras</span>
            </div>

            <div class="flex gap-x-2 my-3">
                <div class="bg-white-500 rounded-md w-[40px] h-[40px] p-1">
                    <img src="<?= Yii::getAlias('@web/').(User::find()->select(['fotografia'])->where(['id' => $vendedor->user_id])->scalar()) ?>" class="object-contain h-full" alt="">
                </div>
                <div class="flex flex-col text-sm text-gray-500">
                    <span>Vendedor <?= $vendedor->nombre_negocio?></span>
                    <span>0+ ventas</span>
                </div>
            </div>

            <div class="mb-2">
                <span class="block font-semibold text-lg">Stock disponible</span>
                <span class="text-sm font-light text-gray-500">Almacenado y enviado por <?= $vendedor->nombre_negocio ?></span>
            </div>

            <span class="font-light block mt-3">Cantidad: <span class="font-semibold">1 Unidad</span> <span class="font-light text-sm">(<?= $producto->stock?> disponibles)</span></span>
            <span class="text-sm font-light text-gray-500 my-3 block">Puedes compra solo 1 unidad</span>

            <?php $form = ActiveForm::begin() ?>
                <button class="text-white font-semibold text-lg w-full py-3 bg-blue-700 rounded-md mt-0 mb-3">
                    Comprar ahora
                </button>
            <?php ActiveForm::end()?>
        </div>

        <div class="col-span-3">
            <h1 class="text-semibold text-neutral-800 text-2xl">Sobre el producto</h1>
            <p class="font-light text-lg"><?= $producto->descripcion?></p>
        </div>

        <div class="col-span-1 p-3 mt-4 border border-gray-400 rounded-md bg-white space-y-2 h-max">
            <h2 class="font-semibold my-3">Otros medios de pago</h2>
            <div class="flex flex-wrap gap-3 mb-4">
                <img src="<?= Yii::getAlias('@web/img/visa_premier.svg')?>" class="h-8 h-8">
                <img src="<?= Yii::getAlias('@web/img/stp.svg')?>" class="h-8 h-8">
                <img src="<?= Yii::getAlias('@web/img/stander.svg')?>" class="h-8 h-8">
                <img src="<?= Yii::getAlias('@web/img/citibanamex.svg')?>" class="h-8 h-8">
                <img src="<?= Yii::getAlias('@web/img/bancomer.svg')?>" class="h-8 h-8">
                <img src="<?= Yii::getAlias('@web/img/visa_debit.svg')?>" class="h-8 h-8">
                <img src="<?= Yii::getAlias('@web/img/mastercard_debit.svg')?>" class="h-8 h-8">
            </div>

            <div class="text-sm font-light text-gray-500 space-y-3">
                <p>
                    <span class="text-blue-700">Devolución gratis.</span> <br>
                    Tienes 30 días desde que lo recibes.
                </p>

                <p><span class="text-blue-700">Compra Protegida</span>, Se abrirá en una nueva ventana, recibe el producto que esperabas o te devolvemos tu dinero.</p>
            </div>
        </div>
    </div>



    <?php if(isset($producto_similar) && count($producto_similar) > 0) : ?>
        <div class="mt-4">
            <h1 class="font-light text-xl text-neutral-800">Quienes compraron este producto también compraron</h1>
        </div>
        <div class="grid grid-cols-4 gap-4 my-4">
            <?php foreach ($producto_similar as $item) : ?>
                <a href="<?= Yii::getAlias('@web/producto/'.$item['id'])?>" class="rounded-md overflow-hidden">
                    <!-- FOTOGRAFIA -->
                    <div class="w-full h-[220px] bg-white">
                        <img class="object-contain h-full mx-auto" src="<?= Yii::getAlias('@web/').$item['fotografia']?>" height="220" alt="">
                    </div>
                    <div class="flex flex-col font-light text-gray-600 bg-white p-3">
                        <p><?= $item['nombre']?></p>
                        <!--PRICE-->
                        <p class="text-neutral-800 font-semibold text-2xl mt-1">$ <?= number_format($item['precio'],'2','.',',')?></p>
                        <!--Tipo-->
                        <p class="text-blue-600 font-semibold mt-2 text-sm">Producto <span class="lowercase"><?= $item['estado'] ?></span></p>
                    </div>
                </a>
            <?php endforeach; ?>
        </div>
    <?php endif; ?>


</div>

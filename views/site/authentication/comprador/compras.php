<?php $this->title = 'Mis compras' ?>

<div class="px-10 py-5">

    <h1 class="text-gray-700 text-2xl mb-3 font-semibold">Historial de compras</h1>

    <div class="flex flex-col gap-4">
        <?php if(isset($historial) && count($historial) > 0) : ?>
            <?php foreach ($historial as $element) : ?>
                <div class="rounded-md shadow-sm bg-white divide-y divide-gray-200">
                    <div class="flex justify-content-between px-4 py-2 select-none">
                        <div>
                            <?= date('d M Y', strtotime($element['carrito']['updated_at'])) ?>
                            <span class="text-xs text-gray-600">
                                <?= date('h:i a', strtotime($element['carrito']['updated_at'])) ?>
                            </span>
                        </div>
                        <span class="text-sm text-gray-600">Comprador por <span class="text-blue-600"><?= Yii::$app->user->username?></span></span>
                    </div>
                    <?php foreach ($element['productos'] as $producto) : ?>
                    <div class="flex items-center justify-content-between px-4 py-3">
                        <div class="px-2 mr-5 py-1 w-[100px] h-[60px] items-center justify-content-center border border-gray-100 rounded-md">
                            <img src="<?= $producto['producto_fotografia'] ?>" class="w-full h-full object-contain" alt="<?= $producto['producto_nombre']?>">
                        </div>
                        <div class="flex flex-col gap-y-2 w-full">
                            <h1><?= $producto['producto_nombre']?></h1>
                            <div>
                                <span class="text-sm text-gray-500"><?= strlen($producto['producto_descripcion']) > 40 ? substr($producto['producto_descripcion'], 0, 27).".." : $producto['producto_descripcion'] ?></span>
                            </div>
                        </div>
                        <div class="flex flex-col w-[200px] text-end">
                            <span>$<?= number_format($producto['precio_cantidad'], '2', '.', ',')?></span>
                            <span class="text-sm text-gray-500">Cantidad: <?= $producto['cantidad']?></span>
                        </div>
                        <div>

                        </div>
                    </div>
                    <?php endforeach; ?>
                </div>
            <?php endforeach;?>
        <?php else : ?>
            <div class="w-max px-3 py-2 bg-white rounded-md shadow-sm py-3 mx-auto">
                <span class="block text-3xl font-bold text-gray-700 text-center mb-1">Historial vacio</span>
                <span class="block text-xl font-light text-sm text-gray-500 w-[200px] text-center mx-auto">Aun no has comprado ningun producto</span>

                <a href="<?= Yii::getAlias('@web/')?>" class="block mx-auto w-max text-white font-light text-md w-full py-2 px-2 bg-blue-700 rounded-md mt-3">
                    Encuentra productos
                </a>
            </div>
        <?php endif; ?>

    </div>
</div>

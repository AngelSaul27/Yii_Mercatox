<?php $this->title = 'Mis compras' ?>

<div class="px-10 py-5">

    <h1 class="text-gray-700 text-2xl mb-3 font-semibold">Historial de compras</h1>

    <div class="flex flex-col gap-4">
        <?php if(isset($historial)) : ?>
            <?php foreach ($historial as $element) : ?>
                <div class="rounded-md shadow-sm bg-white divide-y divide-gray-200">
                    <div class="px-4 py-2">
                        <?= date('d M Y', strtotime($element['carrito']['updated_at'])) ?>
                    </div>
                    <?php foreach ($element['productos'] as $producto) : ?>
                    <div class="flex items-center justify-content-between px-4 py-3">
                        <div class="px-2 mr-5 py-1 w-[100px] h-[60px] items-center justify-content-center border border-gray-100 rounded-md">
                            <img src="<?= $producto['producto_fotografia'] ?>" class="w-full h-full object-contain" alt="<?= $producto['producto_nombre']?>">
                        </div>
                        <div class="flex flex-col gap-y-2 w-full">
                            <h1><?= $producto['producto_nombre']?></h1>
                            <span class="text-sm text-gray-500"><?= strlen($producto['producto_descripcion']) > 40 ? substr($producto['producto_descripcion'], 0, 27).".." : $producto['producto_descripcion'] ?></span>
                        </div>
                        <div class="flex flex-col w-[200px] text-end">
                            <span>$ <?= number_format($producto['precio_cantidad'], '2', '.', ',')?></span>
                        </div>
                    </div>
                    <?php endforeach; ?>
                </div>
            <?php endforeach;?>
        <?php endif; ?>

    </div>
</div>

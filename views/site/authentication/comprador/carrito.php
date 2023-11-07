<?php use yii\bootstrap5\ActiveForm;

$this->title = 'Mi carrito'; ?>

<div class="px-[80px] py-4">
    <div class="grid grid-cols-12 gap-[35px]">
        <div class="col-span-8 bg-white rounded-md shadow-sm h-max">
            <div class="px-4 py-2">
                <h1 class="font-semibold text-xl">Productos</h1>
            </div>
            <hr class="text-gray-400">
            <div class="flex flex-col gap-y-4 px-4 py-2 pb-4">
                <?php if(isset($productos)) : ?>
                    <?php foreach ($productos as $producto) : ?>
                        <div class="flex items-center justify-content-between">
                            <div class="px-2 mr-5 py-1 w-[100px] h-[60px] items-center justify-content-center">
                                <img src="<?= $producto['producto_fotografia'] ?>" class="w-full h-full object-contain" alt="<?= $producto['producto_nombre']?>">
                            </div>
                            <div class="flex flex-col gap-y-2 w-full">
                                <h1><?= $producto['producto_nombre']?></h1>
                                <div class="flex gap-3">
                                    <?php $form = ActiveForm::begin(['action' => ['mi-carrito/producto/'.$producto['id'].'/remove'], 'method' => 'post',]);?>
                                        <button type="submit" class="text-blue-700">Eliminar</button>
                                    <?php ActiveForm::end(); ?>
                                    <span class="text-blue-700">Guardar</span>
                                    <a href="<?= Yii::getAlias('@web/producto/'.$producto['producto_id'])?>" class="text-blue-700">Ver producto</a>
                                </div>
                            </div>
                            <div class="flex flex-col w-[200px] text-end">
                                <span>$ <?= number_format($producto['precio_cantidad'], '2', '.', ',')?></span>
                                <span class="text-sm text-gray-500"><?= $producto['producto_stock']?> disponibles</span>
                            </div>
                        </div>
                    <?php endforeach; ?>
                <?php else :?>
                    <div class="w-full px-3 py-2">
                        <span class="block text-xl font-bold text-gray-900 text-center">Carrito vacio</span>
                        <span class="block font-light text-sm text-gray-500 w-[180px] text-center mx-auto">Aun no has agregado ningun producto a tu carrito</span>

                        <a href="<?= Yii::getAlias('@web/')?>" class="block mx-auto w-max text-white font-light text-md w-full py-2 px-2 bg-blue-700 rounded-md mt-3">
                            Encuentra productos
                        </a>
                    </div>
                <?php endif; ?>
            </div>
        </div>
        <div class="col-span-4 bg-white rounded-md shadow-sm h-max">
            <div class="px-4 py-[13px]">
                <h1 class="font-semibold text-md">Resumen de compra</h1>
            </div>
            <hr class="text-gray-400">
            <?php if(isset($productos)) : ?>
                <div class="px-4 py-2 text-sm space-y-2">
                    <div class="flex items-center justify-content-between">
                        <span><?= count($productos) > 1 ? 'Productos ('.count($productos).')' : 'Producto ' ?></span>
                        <span>$ <?= number_format($carrito->total, 2, '.', ',') ?></span>
                    </div>
                    <div class="flex items-center justify-content-between">
                        <span>Envio</span>
                        <span class="text-green-600">Gratis</span>
                    </div>
                    <div class="flex items-center justify-content-between font-semibold">
                        <span class="text-lg">Total</span>
                        <span class="text-lg">$ <?= number_format($carrito->total, 2, '.', ',') ?></span>
                    </div>

                    <?php $form = ActiveForm::begin(['action' => ['mi-carrito/procesar/comprar'], 'method' => 'post',]);?>
                        <button type="submit" class="text-white font-semibold text-lg w-full py-3 bg-blue-700 rounded-md my-3">
                            Comprar ahora
                        </button>
                    <?php ActiveForm::end(); ?>
                </div>
            <?php else : ?>
                <span class="text-sm text-gray-500 font-light block px-3 py-2">Aquí verás los importes de tu compra una vez que agregues productos.</span>
            <?php endif; ?>
        </div>
    </div>
</div>

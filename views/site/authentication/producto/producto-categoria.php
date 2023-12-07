<?php $this->title = $categoria->categoria ?? 'Productos'; ?>
<div class="index_app mb-16">

    <!--CAROUSEL-->
    <?= app\widgets\CarouselWidget::widget([
        'items' => $ads
    ]) ?>

    <div class="px-[80px] py-3">
        <h1 class="text-3xl font-semibold text-neutral-800 my-4">
            Productos
        </h1>

        <!--PRODUCTOS-->
        <div class="grid grid-cols-4 gap-4">
            <?php if(isset($producto) && count($producto) > 0) : ?>
                <?php foreach ($producto as $item) : ?>
                    <a href="<?= Yii::getAlias('@web/producto/'.$item['id'])?>" class="rounded-md overflow-hidden">
                        <!-- FOTOGRAFIA -->
                        <?php if($item->producto_oferta === 'NO') :?>
                            <div class="w-full h-[220px] bg-white">
                                <img class="object-contain h-full mx-auto" src="<?= Yii::getAlias('@web/').$item['fotografia']?>" height="220" alt="">
                            </div>
                        <?php else : ?>
                            <div class="w-full h-[220px] bg-white relative">
                                <span class="bg-orange-500 text-white rounded-md p-1 font-normal text-sm absolute left-2 top-2">En descuento</span>
                                <img class="object-contain h-full mx-auto" src="<?= Yii::getAlias('@web/').$item['fotografia']?>" height="220" alt="">
                            </div>
                        <?php endif; ?>
                        <div class="flex flex-col font-light text-gray-600 bg-white p-3">
                            <?php if($item->producto_oferta === 'NO') :?>
                                <p><?= $item['nombre']?></p>
                                <!--PRICE-->
                                <p class="text-neutral-800 font-semibold text-2xl mt-1">$ <?= number_format($item['precio'],'2','.',',')?></p>
                                <!--Tipo-->
                                <p class="text-blue-600 font-semibold mt-2 text-sm">Producto <span class="lowercase"><?= $item['estado'] ?></span></p>
                            <?php else : ?>
                                <p><?= $item['nombre']?></p>
                                <!--PRICE-->
                                <p class="text-gray-600 font-semibold text-xs mt-1 line-through">$ <?= number_format($item['precio'],'2','.',',')?></p>
                                <div class="flex items-center justify-content-between gap-2">
                                    <p class="text-neutral-800 font-semibold text-2xl">$ <?= number_format($item['precio_con_oferta'],'2','.',',')?></p>
                                    <span class="bg-red-500 text-white rounded-md p-1 font-normal text-sm">-<?= $item['producto_valor_oferta']?>%</span>
                                </div>
                                <!--Tipo-->
                                <p class="text-blue-600 font-semibold mt-2 text-sm">Producto <span class="lowercase"><?= $item['estado'] ?></span></p>
                            <?php endif; ?>
                        </div>
                    </a>
                <?php endforeach; ?>
            <?php else :?>

                <div class="text-center col-span-4 my-5">
                    <h1 class="text-3xl font-semibold">Sin resultado</h1>
                    <p class="text-xl font-light">No encontramos ningun articulo con la categoria que buscas</p>
                </div>

            <?php endif; ?>
        </div>
    </div>
</div>

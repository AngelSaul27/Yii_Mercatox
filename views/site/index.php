<?php

/** @var yii\web\View $this */

$this->title = 'Mercatox';

?>
<div class="index_app mb-16">

    <!--CAROUSEL-->
    <?= app\widgets\CarouselWidget::widget([
        'items' => $ads
    ]) ?>

    <div class="px-[80px] py-3">
        <h1 class="text-3xl font-semibold text-neutral-800 my-4">
            Ofertas<a href="<?= Yii::getAlias('@web/producto/explorar') ?>" class="text-blue-500 text-[18px] font-light ml-2">ver todas</a>
        </h1>

        <!--PRODUCTOS-->
        <div class="grid grid-cols-4 gap-4">
            <?php if(isset($producto)) : ?>
                <?php foreach ($producto as $item) : ?>
                    <? //ITERACIÓN PARA LA IMPRESIÓN DE PRODUCTOS ?>
                    <a href="<?= Yii::getAlias('@web/producto/'.$item['id'])?>" class="rounded-md overflow-hidden">
                        <!-- FOTOGRAFIA -->
                        <div class="w-full h-[220px] bg-white relative">
                            <span class="bg-orange-500 text-white rounded-md p-1 font-normal text-sm absolute left-2 top-2">En descuento</span>
                            <img class="object-contain h-full mx-auto" src="<?= Yii::getAlias('@web/').$item['fotografia']?>" height="220" alt="">
                        </div>
                        <div class="flex flex-col font-light text-gray-600 bg-white p-3">
                            <p><?= $item['nombre']?></p>
                            <!--PRICE-->
                            <p class="text-gray-600 font-semibold text-xs mt-1 line-through">$ <?= number_format($item['precio'],'2','.',',')?></p>
                            <div class="flex items-center justify-content-between gap-2">
                                <p class="text-neutral-800 font-semibold text-2xl">$ <?= number_format($item['precio_con_oferta'],'2','.',',')?></p>
                                <span class="bg-red-500 text-white rounded-md p-1 font-normal text-sm">-<?= $item['producto_valor_oferta']?>%</span>
                            </div>
                            <!--Tipo-->
                            <p class="text-blue-600 font-semibold mt-2 text-sm">Producto <span class="lowercase"><?= $item['estado'] ?></span></p>
                        </div>
                    </a>
                <?php endforeach; ?>
            <?php endif; ?>
        </div>

        <!-- ANUNCIOS -->
        <div class="grid grid-cols-3 mt-5 mb-4 rounded-md overflow-hidden">
            <div class="col-span-2">
                <img src="<?= Yii::getAlias('@web/img/ads_clean.jpg')?>" alt="clean add">
            </div>
            <div class="flex align-items-center justify-content-center px-4 py-3 bg-amber-300">
                <div class="w-max h-max block mx-auto">
                    <p class="text-bold text-md uppercase">El experto</p>
                    <p class="text-bold text-3xl uppercase">En limpieza y</p>
                    <p class="text-bold text-3xl uppercase">desifeccion</p>
                    <p class="text-sm font-light">Saber más</p>
                </div>
            </div>
        </div>

        <h1 class="text-3xl font-semibold text-neutral-800 my-4">
            Ultimos productos<a href="<?= Yii::getAlias('@web/producto/explorar') ?>" class="text-blue-500 text-[18px] font-light ml-2">ver todas</a>
        </h1>

        <!--PRODUCTOS-->
        <div class="grid grid-cols-4 gap-4">
            <?php if(isset($new_producto)) : ?>
                <?php foreach ($new_producto as $item) : ?>
                    <? //ITERACIÓN PARA LA IMPRESIÓN DE PRODUCTOS ?>
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
            <?php endif; ?>
        </div>
    </div>

</div>

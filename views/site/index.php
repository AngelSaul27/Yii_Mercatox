<?php

/** @var yii\web\View $this */

$this->title = 'My Yii Application';

?>
<div class="index_app mb-16">

    <!--CAROUSEL-->
    <?= app\widgets\CarouselWidget::widget([
        'items' => [
            ['image' => Yii::getAlias('@web/img/pruebas_carousel_2.png'), 'caption' => 'Imagen 1'],
            ['image' => Yii::getAlias('@web/img/pruebas_carousel_1.png'), 'caption' => 'Imagen 2'],
        ]
    ]) ?>

    <div class="px-[80px] py-3">
        <h1 class="text-3xl font-semibold text-neutral-800 my-4">
            Ofertas<a href="" class="text-blue-500 text-[18px] font-light ml-2">ver todas</a>
        </h1>

        <!--PRODUCTOS-->
        <div class="grid grid-cols-4 gap-4">
            <?php for($i = 0; $i < 4; $i++) : ?> <? //ITERACIÓN PARA LA IMPRESIÓN DE PRODUCTOS ?>
            <div class="rounded-md overflow-hidden">
                <!-- FOTOGRAFIA -->
                <div class="w-full h-[220px]">
                    <img class="object-cover h-full" src="<?= Yii::getAlias('@web/img/pruebas_carousel_2.png')?>" height="220" alt="">
                </div>
                <div class="flex flex-col font-light text-gray-600 bg-white p-3">
                    <p>Nombre del producto</p>
                    <!--PRICE-->
                    <p class="text-neutral-800 font-semibold text-2xl mt-1">$ 2,179</p>
                    <!--Tipo-->
                    <p class="text-blue-600 font-semibold mt-2 text-sm">Producto nuevo</p>
                </div>
            </div>
            <?php endfor;?>
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
            Ultimos productos<a href="" class="text-blue-500 text-[18px] font-light ml-2">ver todas</a>
        </h1>

        <!--PRODUCTOS-->
        <div class="grid grid-cols-4 gap-4">
            <?php for($i = 0; $i < 4; $i++) : ?> <? //ITERACIÓN PARA LA IMPRESIÓN DE PRODUCTOS ?>
                <div class="rounded-md overflow-hidden">
                    <!-- FOTOGRAFIA -->
                    <div class="w-full h-[220px]">
                        <img class="object-cover h-full" src="<?= Yii::getAlias('@web/img/pruebas_carousel_2.png')?>" height="220" alt="">
                    </div>
                    <div class="flex flex-col font-light text-gray-600 bg-white p-3">
                        <p>Nombre del producto</p>
                        <!--PRICE-->
                        <p class="text-neutral-800 font-semibold text-2xl mt-1">$ 2,179</p>
                        <!--Tipo-->
                        <p class="text-blue-600 font-semibold mt-2 text-sm">Producto usado</p>
                    </div>
                </div>
            <?php endfor;?>
        </div>
    </div>

</div>

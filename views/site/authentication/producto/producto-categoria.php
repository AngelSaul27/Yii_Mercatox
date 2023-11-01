<?php $this->title = $categoria->categoria; ?>
<div class="index_app mb-16">

    <!--CAROUSEL-->
    <?= app\widgets\CarouselWidget::widget([
        'items' => $ads
    ]) ?>

    <div class="px-[80px] py-3">
        <h1 class="text-3xl font-semibold text-neutral-800 my-4">
            Ofertas
        </h1>

        <!--PRODUCTOS-->
        <div class="grid grid-cols-4 gap-4">
            <?php if(isset($producto)) : ?>
                <?php foreach ($producto as $item) : ?>
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
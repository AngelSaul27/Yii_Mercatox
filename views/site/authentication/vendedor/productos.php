<?php
use app\models\Records\ProductoCategoria;
use yii\bootstrap5\ActiveForm;

$this->title = 'Mis productos';
?>

<div class="px-10 py-5">
    <a class="bg-green-700 text-white rounded-md px-3 py-2 shadow mb-3 block w-max"
       href="<?= Yii::getAlias('@web/vendedor/mis-productos/create')?>">
        Crear
    </a>
    <table class="table table-striped table-bordered">
        <thead>
        <tr>
            <th scope="col">#</th>
            <th scope="col">Nombre</th>
            <th scope="col">Descripcion</th>
            <th scope="col">Precio</th>
            <th scope="col">
                <span class="min-w-max block">Oferta %</span>
            </th>
            <th scope="col">
                <span class="min-w-max block">Precio con oferta</span>
            </th>
            <th scope="col">Stock</th>
            <th scope="col">Estado</th>
            <th scope="col">Categoria</th>
            <th scope="col">Imagen</th>
            <th scope="col">Opciones</th>
        </tr>
        </thead>
        <tbody>
        <?php if(isset($model) && count($model) > 0) : ?>
            <?php foreach ($model as $item) : ?>
                <tr>
                    <th>
                        <span class="font-light"><?= $item['id']; ?></span>
                    </th>
                    <th>
                        <span class="font-light"><?= $item['nombre']; ?></span>
                    </th>
                    <th>
                        <div class="max-h-[200px] overflow-y-auto">
                            <span class="font-light"><?= $item['descripcion']; ?></span>
                        </div>
                    </th>
                    <th>
                        <span class="font-light">$<?= number_format($item['precio'], 2, '.', ','); ?></span>
                    </th>
                    <th>
                        <span class="font-light"><?= $item['producto_valor_oferta']; ?>%</span>
                    </th>
                    <th>
                        <span class="font-light">$<?= number_format($item['precio_con_oferta'] ?? $item['precio'], 2, '.', ','); ?></span>
                    </th>
                    <th>
                        <span class="font-light"><?= $item['stock']; ?></span>
                    </th>
                    <th>
                        <span class="font-light"><?= $item['estado']; ?></span>
                    </th>
                    <th>
                        <span class="font-light">
                            <?= ProductoCategoria::find()->select('categoria')->where(['id' => $item['categoria_id']])->scalar() ?>
                        </span>
                    </th>
                    <th>
                        <div class="w-[100px] h-[100px]">
                            <img class="w-full h-full object-contain mx-auto" src="<?= Yii::getAlias('@web/').$item['fotografia']; ?>" alt="<?= $item['nombre'] ?>">
                        </div>
                    </th>
                    <th>
                        <div class="flex gap-2">
                            <a class="hover:text-green-700" target="_blank" href="<?= Yii::getAlias('@web/producto/'.$item['id'])?>">
                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-5 h-5">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M2.036 12.322a1.012 1.012 0 010-.639C3.423 7.51 7.36 4.5 12 4.5c4.638 0 8.573 3.007 9.963 7.178.07.207.07.431 0 .639C20.577 16.49 16.64 19.5 12 19.5c-4.638 0-8.573-3.007-9.963-7.178z" />
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                                </svg>
                            </a>
                            <a class="hover:text-blue-700" href="<?= Yii::getAlias('@web/vendedor/mi-producto/'.$item['id'].'/edit')?>">
                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-5 h-5">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M16.862 4.487l1.687-1.688a1.875 1.875 0 112.652 2.652L10.582 16.07a4.5 4.5 0 01-1.897 1.13L6 18l.8-2.685a4.5 4.5 0 011.13-1.897l8.932-8.931zm0 0L19.5 7.125M18 14v4.75A2.25 2.25 0 0115.75 21H5.25A2.25 2.25 0 013 18.75V8.25A2.25 2.25 0 015.25 6H10" />
                                </svg>
                            </a>
                            <?php $form = ActiveForm::begin(['action' => '/vendedor/mi-producto/'.$item['id'].'/delete']) ?>
                                <button type="submit" class="hover:text-red-700">
                                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-5 h-5">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M14.74 9l-.346 9m-4.788 0L9.26 9m9.968-3.21c.342.052.682.107 1.022.166m-1.022-.165L18.16 19.673a2.25 2.25 0 01-2.244 2.077H8.084a2.25 2.25 0 01-2.244-2.077L4.772 5.79m14.456 0a48.108 48.108 0 00-3.478-.397m-12 .562c.34-.059.68-.114 1.022-.165m0 0a48.11 48.11 0 013.478-.397m7.5 0v-.916c0-1.18-.91-2.164-2.09-2.201a51.964 51.964 0 00-3.32 0c-1.18.037-2.09 1.022-2.09 2.201v.916m7.5 0a48.667 48.667 0 00-7.5 0" />
                                    </svg>
                                </button>
                            <?php ActiveForm::end() ?>
                            <a href="<?= Yii::getAlias('@web/vendedor/mi-producto/'.$item['id'].'/oferta')?>" class="hover:text-orange-700">
                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-5 h-5">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M9 14.25l6-6m4.5-3.493V21.75l-3.75-1.5-3.75 1.5-3.75-1.5-3.75 1.5V4.757c0-1.108.806-2.057 1.907-2.185a48.507 48.507 0 0111.186 0c1.1.128 1.907 1.077 1.907 2.185zM9.75 9h.008v.008H9.75V9zm.375 0a.375.375 0 11-.75 0 .375.375 0 01.75 0zm4.125 4.5h.008v.008h-.008V13.5zm.375 0a.375.375 0 11-.75 0 .375.375 0 01.75 0z" />
                                </svg>
                            </a>
                        </div>
                    </th>
                </tr>
            <?php endforeach; ?>
        <?php else : ?>
            <tr>
                <th colspan="9" class="py-5 text-center">
                    <p class="text-slate-800 font-bold">Sin informacion</p>
                    <p class="text-gray-700 font-light">No se encontraron registros disponibles</p>
                </th>
            </tr>
        <?php endif; ?>
        </tbody>
    </table>
</div>

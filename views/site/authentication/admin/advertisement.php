<?php use app\models\Records\AdvertisementSitio;

$this->title = 'Advertisement'; ?>

<div class="px-10 py-5">

    <a class="bg-green-700 text-white rounded-md px-3 py-2 shadow mb-3 block w-max" href="<?= Yii::getAlias('@web/management/advertisements/create')?>">
        Crear
    </a>

    <table class="table table-striped table-bordered">
        <thead>
            <tr>
                <th scope="col">#</th>
                <th scope="col">Nombre</th>
                <th scope="col">Descripcion</th>
                <th scope="col">Redireccion</th>
                <th scope="col">Tipo</th>
                <th scope="col">Sitio</th>
                <th scope="col">Fotografia</th>
                <th scope="col">Fecha de Inicio</th>
                <th scope="col">Fecha de Pausa</th>
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
                            <span class="font-light"><?= $item['descripcion']; ?></span>
                        </th>
                        <th>
                            <span class="font-light"><?= $item['redireccion']; ?></span>
                        </th>
                        <th>
                            <span class="font-light"><?= $item['tipo']; ?></span>
                        </th>
                        <th>
                            <span class="font-light">
                                <?= AdvertisementSitio::find()->select('sitio')->where(['id' => $item['advertisement_type_id']])->scalar() ?>
                            </span>
                        </th>
                        <th>
                            <span class="font-light">
                                <a href="<?= Yii::getAlias('@web/').$item['imagen']; ?>" class="text-blue-800" target="_blank">Ver imagen</a>
                            </span>
                        </th>
                        <th>
                            <span class="font-light"><?= $item['fecha_habilitacion']; ?></span>
                        </th>
                        <th>
                            <span class="font-light"><?= $item['fecha_deshabilitacion']; ?></span>
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

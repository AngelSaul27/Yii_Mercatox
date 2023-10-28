<?php
    use yii\bootstrap5\ActiveForm;
    use yii\bootstrap5\Html;

    $this->title = 'Login';
?>
<div class="w-full h-full flex flex-col align-items-center justify-content-center pb-5">

    <a href="<?=Yii::getAlias('@web/register')?>" class="flex justify-content-between gap-2 text-gray-500 rounded-md bg-white shadow my-4 w-[400px] px-4 py-3">
        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1" stroke="currentColor" class="w-6 h-6 min-w-max">
            <path stroke-linecap="round" stroke-linejoin="round" d="M13.5 21v-7.5a.75.75 0 01.75-.75h3a.75.75 0 01.75.75V21m-4.5 0H2.36m11.14 0H18m0 0h3.64m-1.39 0V9.349m-16.5 11.65V9.35m0 0a3.001 3.001 0 003.75-.615A2.993 2.993 0 009.75 9.75c.896 0 1.7-.393 2.25-1.016a2.993 2.993 0 002.25 1.016c.896 0 1.7-.393 2.25-1.016a3.001 3.001 0 003.75.614m-16.5 0a3.004 3.004 0 01-.621-4.72L4.318 3.44A1.5 1.5 0 015.378 3h13.243a1.5 1.5 0 011.06.44l1.19 1.189a3 3 0 01-.621 4.72m-13.5 8.65h3.75a.75.75 0 00.75-.75V13.5a.75.75 0 00-.75-.75H6.75a.75.75 0 00-.75.75v3.75c0 .415.336.75.75.75z" />
        </svg>
        <span class="w-full">No tienes una cuenta, registrate aquí</span>

        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1" stroke="currentColor" class="w-6 h-6">
            <path stroke-linecap="round" stroke-linejoin="round" d="M17.25 8.25L21 12m0 0l-3.75 3.75M21 12H3" />
        </svg>
    </a>

    <?php $form = ActiveForm::begin() ?>
    <div class="rounded-md bg-white shadow px-4 w-[400px] px-3 py-3">
        <h1 class="font-bold text-2xl"><?= Html::encode($this->title) ?></h1>
        <p class="font-light text-sm mt-1 mb-2">Completa todos los campos por favor.</p>

        <div class="space-y-2">
            <label class="text-gray-500">Correo</label>
            <?= $form->field($model, 'email')->input('email', ['class' => 'outline-none rounded-md border-gray-300 p-2 w-full shadow-sm', 'placeholder' => 'Correo electronico'])->label(false) ?>
            <label class="text-gray-500 -mt-10 block">Contraseña</label>
            <?= $form->field($model, 'password')->input('password', ['class' => 'outline-none rounded-md border-gray-300 p-2 w-full shadow-sm', 'placeholder' => 'Contraseña'])->label(false) ?>
        </div>

        <button class="w-full rounded-md px-3 py-2 text-xl font-light bg-blue-700 text-white mt-3 mb-2">
            Iniciar sesión
        </button>
    </div>
    <?php ActiveForm::end() ?>

</div>

<?php
use yii\bootstrap5\ActiveForm;
use yii\bootstrap5\Html;

$this->title = 'Registro Vendedor';
?>
<div class="w-full h-full flex flex-col align-items-center justify-content-center pb-5">

    <a href="<?=Yii::getAlias('@web/login')?>" class="flex justify-content-between gap-2 text-gray-500 rounded-md bg-white shadow my-4 w-[400px] px-4 py-3">
        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6 min-wmax">
            <path stroke-linecap="round" stroke-linejoin="round" d="M17.982 18.725A7.488 7.488 0 0012 15.75a7.488 7.488 0 00-5.982 2.975m11.963 0a9 9 0 10-11.963 0m11.963 0A8.966 8.966 0 0112 21a8.966 8.966 0 01-5.982-2.275M15 9.75a3 3 0 11-6 0 3 3 0 016 0z" />
        </svg>
        <span class="w-full">Ya tienes una cuenta ingresa aquí</span>

        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1" stroke="currentColor" class="w-6 h-6">
            <path stroke-linecap="round" stroke-linejoin="round" d="M17.25 8.25L21 12m0 0l-3.75 3.75M21 12H3" />
        </svg>
    </a>

    <div class="rounded-md bg-white shadow px-4 w-[400px] px-3 py-3">
        <h1 class="font-bold text-2xl"><?= Html::encode($this->title) ?></h1>
        <p class="font-light text-sm mt-1">Completa todos los campos por favor.</p>

        <ol class="flex items-center w-full my-3">
            <li class="flex w-full items-center after:content-[''] after:w-full after:h-1 after:border-b after:border-gray-100 after:border-4 after:inline-block">
                <span class="flex items-center justify-center w-10 h-10 bg-gray-100 rounded-full shrink-0">
                    <svg id="step_1" class="w-4 h-4 text-gray-600" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 18 20">
                        <path d="M16 1h-3.278A1.992 1.992 0 0 0 11 0H7a1.993 1.993 0 0 0-1.722 1H2a2 2 0 0 0-2 2v15a2 2 0 0 0 2 2h14a2 2 0 0 0 2-2V3a2 2 0 0 0-2-2ZM7 2h4v3H7V2Zm5.7 8.289-3.975 3.857a1 1 0 0 1-1.393 0L5.3 12.182a1.002 1.002 0 1 1 1.4-1.436l1.328 1.289 3.28-3.181a1 1 0 1 1 1.392 1.435Z"/>
                    </svg>
                </span>
            </li>
            <li class="flex items-center w-max">
                <span class="flex items-center justify-center w-10 h-10 bg-gray-100 rounded-full shrink-0">
                    <svg id="step_2" class="w-4 h-4 text-gray-600" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 20 16">
                        <path d="M18 0H2a2 2 0 0 0-2 2v12a2 2 0 0 0 2 2h16a2 2 0 0 0 2-2V2a2 2 0 0 0-2-2ZM6.5 3a2.5 2.5 0 1 1 0 5 2.5 2.5 0 0 1 0-5ZM3.014 13.021l.157-.625A3.427 3.427 0 0 1 6.5 9.571a3.426 3.426 0 0 1 3.322 2.805l.159.622-6.967.023ZM16 12h-3a1 1 0 0 1 0-2h3a1 1 0 0 1 0 2Zm0-3h-3a1 1 0 1 1 0-2h3a1 1 0 1 1 0 2Zm0-3h-3a1 1 0 1 1 0-2h3a1 1 0 1 1 0 2Z"/>
                    </svg>
                </span>
            </li>
        </ol>

        <div class="space-y-2">
            <label class="text-gray-500">Usuario</label>
            <input name="name" type="text" placeholder="Nombre de usuario" class="outline-none rounded-md border-gray-300 p-2 w-full shadow-sm">
            <label class="text-gray-500">Correo</label>
            <input name="email" type="email" placeholder="Correo electronico" class="outline-none rounded-md border-gray-300 p-2 w-full shadow-sm">
            <label class="text-gray-500">Contraseña</label>
            <input name="password" type="password" placeholder="Contraseña" class="outline-none rounded-md border-gray-300 p-2 w-full shadow-sm">
        </div>

        <button class="w-full rounded-md px-3 py-2 text-xl font-light bg-blue-700 text-white mt-3 mb-2">
            Siguiente
        </button>

    </div>

</div>

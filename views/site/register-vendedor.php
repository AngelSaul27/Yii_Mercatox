<?php

use app\models\Records\Servicio;
use yii\bootstrap5\ActiveForm;
use yii\bootstrap5\Html;
use yii\helpers\ArrayHelper;

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
            <li id="step_1_btn" class="flex w-full items-center after:content-[''] after:w-full after:h-1 after:border-b after:border-gray-100 after:border-4 after:inline-block">
                <span class="flex items-center justify-center w-10 h-10 bg-gray-100 rounded-full shrink-0">
                    <svg id="step_1" class="w-4 h-4 text-gray-600" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 18 20">
                        <path d="M16 1h-3.278A1.992 1.992 0 0 0 11 0H7a1.993 1.993 0 0 0-1.722 1H2a2 2 0 0 0-2 2v15a2 2 0 0 0 2 2h14a2 2 0 0 0 2-2V3a2 2 0 0 0-2-2ZM7 2h4v3H7V2Zm5.7 8.289-3.975 3.857a1 1 0 0 1-1.393 0L5.3 12.182a1.002 1.002 0 1 1 1.4-1.436l1.328 1.289 3.28-3.181a1 1 0 1 1 1.392 1.435Z"/>
                    </svg>
                </span>
            </li>
            <li id="step_2_btn" class="flex items-center after:content-[''] after:w-full after:h-1 after:border-b after:border-gray-100 after:border-4 after:inline-block w-full">
                <span class="flex items-center justify-center w-10 h-10 bg-gray-100 rounded-full shrink-0">
                    <svg id="step_2" class="w-4 h-4 text-gray-600" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 20 16">
                        <path d="M18 0H2a2 2 0 0 0-2 2v12a2 2 0 0 0 2 2h16a2 2 0 0 0 2-2V2a2 2 0 0 0-2-2ZM6.5 3a2.5 2.5 0 1 1 0 5 2.5 2.5 0 0 1 0-5ZM3.014 13.021l.157-.625A3.427 3.427 0 0 1 6.5 9.571a3.426 3.426 0 0 1 3.322 2.805l.159.622-6.967.023ZM16 12h-3a1 1 0 0 1 0-2h3a1 1 0 0 1 0 2Zm0-3h-3a1 1 0 1 1 0-2h3a1 1 0 1 1 0 2Zm0-3h-3a1 1 0 1 1 0-2h3a1 1 0 1 1 0 2Z"/>
                    </svg>
                </span>
            </li>
            <li id="step_3_btn" class="flex items-center w-max">
                <span class="flex items-center justify-center w-10 h-10 bg-gray-100 rounded-full shrink-0">
                    <svg id="step_2" class="w-4 h-4 text-gray-600" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 20 16">
                        <path d="M18 0H2a2 2 0 0 0-2 2v12a2 2 0 0 0 2 2h16a2 2 0 0 0 2-2V2a2 2 0 0 0-2-2ZM6.5 3a2.5 2.5 0 1 1 0 5 2.5 2.5 0 0 1 0-5ZM3.014 13.021l.157-.625A3.427 3.427 0 0 1 6.5 9.571a3.426 3.426 0 0 1 3.322 2.805l.159.622-6.967.023ZM16 12h-3a1 1 0 0 1 0-2h3a1 1 0 0 1 0 2Zm0-3h-3a1 1 0 1 1 0-2h3a1 1 0 1 1 0 2Zm0-3h-3a1 1 0 1 1 0-2h3a1 1 0 1 1 0 2Z"/>
                    </svg>
                </span>
            </li>
        </ol>

        <?php $form = ActiveForm::begin() ?>

        <div id="step_1_form" style="display: block">
            <label class="text-gray-500 mb-1">Usuario</label>
            <?= $form->field($model, 'username')
                ->textInput(['id'=> 'username','class' => 'outline-none rounded-md border-gray-300 p-2 w-full shadow-sm -mb-1', 'placeholder' => 'Nombre de usuario'])
                ->label(false) ?>
            <label class="text-gray-500 mb-1">Correo</label>
            <?= $form->field($model, 'email')
                ->input('email', ['id'=> 'email','class' => 'outline-none rounded-md border-gray-300 p-2 w-full shadow-sm -mb-1', 'placeholder' => 'Correo electronico'])
                ->label(false) ?>
            <label class="text-gray-500 mb-1">Contraseña</label>
            <?= $form->field($model, 'password')
                ->input('password', ['id'=> 'password','class' => 'outline-none rounded-md border-gray-300 p-2 w-full shadow-sm -mb-1', 'placeholder' => 'Contraseña'])
                ->label(false) ?>
        </div>

        <div id="step_2_form" style="display: none">
            <label class="text-gray-500 mb-1">Fotografia</label>
            <?= $form->field($model, 'fotografia')
                ->fileInput(['id'=> 'fotografia','class' => 'outline-none rounded-md border-gray-300 p-2 w-full shadow-sm -mb-1', 'placeholder' => 'Fotografia'])
                ->label(false) ?>
            <label class="text-gray-500 mb-1">RFC</label>
            <?= $form->field($model, 'rfc')
                ->textInput(['id'=> 'rfc','class' => 'outline-none rounded-md border-gray-300 p-2 w-full shadow-sm -mb-1', 'placeholder' => 'Razón social'])
                ->label(false) ?>
            <label class="text-gray-500 mb-1">Dirección de envios</label>
            <?= $form->field($model, 'direccion_envio')
                ->textInput(['id'=> 'direccion_envio','class' => 'outline-none rounded-md border-gray-300 p-2 w-full shadow-sm -mb-1', 'placeholder' => 'Dirección de envio'])
                ->label(false) ?>
            <label class="text-gray-500 mb-1">Dirección del negocio</label>
            <?= $form->field($model, 'direccion_negocio')
                ->textInput(['id'=> 'direccion_negocio','class' => 'outline-none rounded-md border-gray-300 p-2 w-full shadow-sm -mb-1', 'placeholder' => 'Dirección de la empresa'])
                ->label(false) ?>
        </div>

        <div id="step_3_form" style="display: none">
            <label class="text-gray-500 mb-1">Nombre del Negocio</label>
            <?= $form->field($model, 'nombre_negocio')
                ->textInput(['id'=> 'nombre_negocio','class' => 'outline-none rounded-md border-gray-300 p-2 w-full shadow-sm -mb-1', 'placeholder' => 'Nombre de la empresa'])
                ->label(false) ?>
            <label class="text-gray-500 mb-1">Biografia del negocio</label>
            <?= $form->field($model, 'biografia_negocio')
                ->textInput(['id'=> 'biografia_negocio','class' => 'outline-none rounded-md border-gray-300 p-2 w-full shadow-sm -mb-1', 'placeholder' => 'Biografia del negocio'])
                ->label(false) ?>
            <label class="text-gray-500 mb-1">Correo del negocio</label>
            <?= $form->field($model, 'correo_negocio')
                ->textInput(['id'=> 'correo_negocio','class' => 'outline-none rounded-md border-gray-300 p-2 w-full shadow-sm -mb-1', 'placeholder' => 'Correo del negocio'])
                ->label(false) ?>
            <div class="grid grid-cols-2 gap-x-2">
                <label class="text-gray-500 mb-1">Telefono del negocio</label>
                <label class="text-gray-500 mb-1">Tipo de Servicio</label>
                <?= $form->field($model, 'telefono_negocio')
                    ->textInput(['id'=> 'telefono_negocio','class' => 'outline-none rounded-md border-gray-300 p-2 w-full shadow-sm -mb-1', 'placeholder' => 'Telefono del negocio'])
                    ->label(false) ?>
                <?= $form->field($model, 'servicio_id')
                    ->dropDownList(ArrayHelper::map(Servicio::find()->all(), 'id', 'servicio'),['id'=> 'tipo_ubicacion','class' => 'outline-none rounded-md border-gray-300 p-2 w-full shadow-sm -mb-1'])
                    ->label(false) ?>
            </div>
        </div>

        <div id="step_next" class="w-full rounded-md px-3 py-2 text-xl font-light bg-blue-700 text-white mt-4 mb-2 text-center cursor-pointer">
            Siguiente
        </div>

        <button id="end_step" style="display: none" class="w-full rounded-md px-3 py-2 text-xl font-light bg-blue-700 text-white mt-3 mb-2 text-center cursor-pointer">
            Registrarse
        </button>
        <?php ActiveForm::end() ?>
    </div>

</div>

<script>
    let countStep = 0;

    document.getElementById('step_next').addEventListener('click', () => {
        const form = document.getElementsByTagName('form')[0];

        if(form){
            const username = document.getElementById('username');
            const email = document.getElementById('email');
            const password = document.getElementById('password');

            const rf = document.getElementById('rfc');
            const fotografia = document.getElementById('fotografia');
            const direccion_envio = document.getElementById('direccion_envio');
            const direccion_negocio = document.getElementById('direccion_negocio');

            if(countStep === 0){
                if(username.value.trim() !== '' && email.value.trim() !== '' && password.value.trim() !== ''){
                    document.getElementById('step_1_form').style.display = 'none';
                    document.getElementById('step_2_form').style.display = 'block';
                    countStep++;
                }
            }

            if(countStep === 1){
                if(fotografia.value.trim() !== '' && rf.value.trim() !== '' && direccion_envio.value.trim() !== '' && direccion_negocio.value.trim() !== ''){
                    document.getElementById('step_2_form').style.display = 'none';
                    document.getElementById('step_3_form').style.display = 'block';
                    document.getElementById('end_step').style.display = 'block';
                    document.getElementById('step_next').style.display = 'none';
                    countStep++;
                }
            }
        }
    })

    document.getElementById('step_1_btn').addEventListener('click', () => {
        document.getElementById('step_1_form').style.display = 'block';
        document.getElementById('step_2_form').style.display = 'none';
        document.getElementById('step_3_form').style.display = 'none';

        document.getElementById('end_step').style.display = 'none';
        document.getElementById('step_next').style.display = 'block';
        countStep = 0;
    })

    document.getElementById('step_2_btn').addEventListener('click', () => {
        document.getElementById('step_1_form').style.display = 'none';
        document.getElementById('step_2_form').style.display = 'block';
        document.getElementById('step_3_form').style.display = 'none';

        document.getElementById('end_step').style.display = 'none';
        document.getElementById('step_next').style.display = 'block';
        countStep = 1;
    })

    document.getElementById('step_3_btn').addEventListener('click', () => {
        document.getElementById('step_1_form').style.display = 'none';
        document.getElementById('step_2_form').style.display = 'none';
        document.getElementById('step_3_form').style.display = 'block';

        document.getElementById('end_step').style.display = 'block';
        document.getElementById('step_next').style.display = 'none';
        countStep = 2;
    })
</script>
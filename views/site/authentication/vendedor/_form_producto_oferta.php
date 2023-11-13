<?php use yii\bootstrap5\ActiveForm;

$this->title = 'Añadir oferta'; ?>

<div class="px-10 py-5">
    <div class="rounded-md bg-white shadow-sm p-4">
        <?php $form = ActiveForm::begin(['options' => ['class' => 'flex justify-between items-center', 'id' => 'master']]) ?>
            <div class="flex items-center gap-2">
                <?= $form->field($producto, 'precio')->input('number',['id' => 'precio_actual', 'disabled' => 'true'])->label('Precio Actual') ?>
                <?= $form->field($model, 'producto_valor_oferta')->input('number', ['id' => 'valor_oferta'])->label('Añadir oferta %') ?>
                <div>
                    <?= $form->field($model, 'precio_con_oferta')->input('text', ['id' => 'precio_con_oferta', 'class' => 'block outline-none border-none', 'disabled' => 'true', 'placeholder' => '$0.0']) ?>
                </div>
            </div>
            <button class="bg-green-700 text-white rounded-md px-3 py-3 flex gap-2 items-center font-light shadow-sm">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-5 h-5">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M9 14.25l6-6m4.5-3.493V21.75l-3.75-1.5-3.75 1.5-3.75-1.5-3.75 1.5V4.757c0-1.108.806-2.057 1.907-2.185a48.507 48.507 0 0111.186 0c1.1.128 1.907 1.077 1.907 2.185zM9.75 9h.008v.008H9.75V9zm.375 0a.375.375 0 11-.75 0 .375.375 0 01.75 0zm4.125 4.5h.008v.008h-.008V13.5zm.375 0a.375.375 0 11-.75 0 .375.375 0 01.75 0z" />
                </svg>
                <span>Aplicar Oferta</span>
            </button>
        <?php ActiveForm::end() ?>
    </div>
</div>
<script>
    const precio_actual = document.getElementById('precio_actual');
    const valor_oferta = document.getElementById('valor_oferta');
    const precio_con_oferta= document.getElementById('precio_con_oferta');
    const form = document.getElementById('master'); // Reemplaza 'tu-form-id' con el ID real de tu formulario

    if(precio_actual !== null && valor_oferta !== null && precio_con_oferta !== null){
        valor_oferta.addEventListener('change', function () {
            // Verificar si el valor de oferta es numérico
            const valorOferta = parseFloat(valor_oferta.value);
            if (!isNaN(valorOferta)) {
                // Calcular el precio con la oferta
                const precioConOferta = parseFloat(precio_actual.value) - ((precio_actual.value) * (valorOferta / 100));

                // Asignar el resultado al elemento precio_con_oferta
                precio_con_oferta.value = precioConOferta.toFixed(2); // Puedes ajustar el número de decimales según tus necesidades
            } else {
                // Manejar el caso en el que el valor de oferta no es numérico
                console.error('El valor de oferta no es numérico');
                // También puedes mostrar un mensaje de error al usuario si lo prefieres
            }
        });

        // Habilita el campo antes de enviar el formulario
        form.addEventListener('submit', function () {
            precio_con_oferta.disabled = false;
        });
    }
</script>

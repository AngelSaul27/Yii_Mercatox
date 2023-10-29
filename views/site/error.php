<?php

/** @var yii\web\View $this */
/** @var string $name */
/** @var string $message */
/** @var Exception$exception */

use yii\helpers\Html;

$this->title = $name;
?>
<div class="site-error px-10 py-5 text-center">

    <div class="mt-5">
        <h1 class="text-3xl font-bold"><?= Html::encode($this->title) ?></h1>

        <div class="bg-red-500 text-white w-max p-2 rounded-md my-2 mx-auto select-none">
            <?= nl2br(Html::encode($message)) ?>
        </div>

        <p class="text-gray-600 font-light text-xl">
            The above error occurred while the Web server was processing your request.
        </p>
        <p class="text-gray-600 font-light text-xl">
            Please contact us if you think this is a server error. Thank you.
        </p>
    </div>

</div>

<?php
namespace app\widgets;

use yii\base\Widget;

class CarouselWidget extends Widget
{
    public $items = [];

    public function run()
    {
        return $this->render('carousel', ['items' => $this->items]);
    }
}
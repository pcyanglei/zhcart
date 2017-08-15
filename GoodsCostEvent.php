<?php
namespace zh\cart;
use yii\base\Event;

class GoodsCostEvent extends Event
{
    public $price;
    
    public $discountValue = 0;
    
}
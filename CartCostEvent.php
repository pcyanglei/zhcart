<?php
namespace zh\cart;
use yii\base\Event;

class CartCostEvent extends Event
{
    public $baseCost;
    
    public $withCartDiscountCost;
    
    public $withOutCartDiscountCost;
    
    public $discountValue = 0;
    
}
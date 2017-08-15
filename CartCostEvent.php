<?php
namespace zh\cart;
use yii\base\Event;
/**
 * @author yanghu <127802495@qq.com>
 */
class CartCostEvent extends Event
{
    public $baseCost;
    
    public $withCartDiscountCost;
    
    public $withOutCartDiscountCost;
    
    public $discountValue = 0;
    
}
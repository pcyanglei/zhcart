<?php
namespace zh\cart;

use yii\base\Behavior;

class GoodsDiscountBehavior extends Behavior
{
    public function events()
    {
        return [
            Cart::EVENT_COST_CALC_CART => 'costCalcCart',
            CartGoodsInterface::EVENT_COST_CALC_GOODS => 'costCalcGoods',
        ];
    }
    public function costCalcCart($event)
    {
        
    }
    
    public function costCalcGoods($event)
    {
        
    }
}
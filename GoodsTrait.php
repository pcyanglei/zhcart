<?php
namespace zh\cart;

use yii\base\Component;
/**
 * @author yanghu <127802495@qq.com>
 */
trait GoodsTrait 
{
    protected $quantity;
    
    //是否参与购物车优惠
    public $withCartDiscount = true;

    
    public function getQuantity()
    {
        return $this->quantity;
    }
    
    public function setQuantity($quantity)
    {
        $this->quantity = $quantity;
    }
    
    public function getCost($withGoodsDiscount = true)
    {
        $cost = $this->getQuantity() * $this->getPrice();
        $costEvent = new GoodsCostEvent([
            'price' => $this->getPrice()
        ]);
        if($this instanceof  Component) {
            $this->trigger(CartGoodsInterface::EVENT_COST_CALC_GOODS,$costEvent);
        }
        if ($withGoodsDiscount) {
            $cost = $cost - ($costEvent->discountValue) * $this->getQuantity();
        }
        return max(0, $cost);
    }
}
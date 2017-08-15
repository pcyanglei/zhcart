<?php
namespace zh\cart;
interface CartGoodsInterface
{
    const EVENT_COST_CALC_GOODS = 'costCalcGoods';

    /**
     * 获取商品存储购物车的索引key
     */
    public function getKey();
    
    /**
     * 设置商品购买个数
     */
    public function setQuantity($quantity);
    
    /**
     * 得到商品购买个数
     */
    public function getQuantity();
    
    /**
     * 得到商品总价格
     */
    public function getCost($withGoodsDiscount = true);
    
    /**
     * 得到商品单价
     */
    public function getPrice();
}
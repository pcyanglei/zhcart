<?php
namespace zh\cart;
use yii\base\Event;
/**
 * @author yanghu <127802495@qq.com>
 */
class GoodsCostEvent extends Event
{
    public $price;
    
    public $discountValue = 0;
    
}
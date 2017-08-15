<?php
namespace zh\cart;
use yii\base\Component;
/**
 * @author yanghu <127802495@qq.com>
 */
class Cart extends Component
{
    public $goodsClass;
    /** 购物车计算价格 */
    const EVENT_COST_CALC_CART = 'costCalcCart';
    
    /**
     * 不参与任何购物车和商品优惠的原价
     * @var int
     */
    private $_baseCost;
    /**
     * @var CartGoodsInterface[]
     */
    protected $goods = [];
    
    /**
     * 获取购物车商品
     */
    public function getGoods()
    {
        return $this->goods;
    }
    
    /**
     * @param CartGoodsInterface $goods
     * @param int $quantity
     */
    public function add($goods, $quantity = 1)
    {
        $this->_baseCost += $goods->getPrice() * $quantity;
        $key = $goods->getKey();
        if (isset($this->goods[$key])) {
            $this->goods[$key]->setQuantity($quantity + $this->goods[$key]->getQuantity());
        } else {
            $goods->setQuantity($quantity);
            $this->goods[$key] = $goods;
        }
    }
    
    /**
     * 得到购物车总价
     * @param bool $withCartDiscount
     * @param bool $withGoodsDiscount
     * @return int
     */
    public function getCost($withCartDiscount = true, $withGoodsDiscount = true)
    {
        $cost = 0;
        $withCartDiscountCost = 0;
        $withOutCartDiscountCost = 0;
        foreach ($this->goods as $goods) {
            if ($goods->withCartDiscount) {
                $withCartDiscountCost += $goods->getCost($withGoodsDiscount);
            } else {
                $withOutCartDiscountCost += $goods->getCost($withGoodsDiscount);
            }
        }
        $cartCostEvent = new CartCostEvent([
            'baseCost' => $this->getBaseCost(),
            'withCartDiscountCost' => $withCartDiscountCost,
            'withOutCartDiscountCost' => $withOutCartDiscountCost
        ]);
        $this->trigger(self::EVENT_COST_CALC_CART,$cartCostEvent);
        $cost = $withCartDiscountCost + $withOutCartDiscountCost;
        if ($withCartDiscount) {
            $cost -= $cartCostEvent->discountValue;
        }
        return round(max(0, $cost));
    }
    
    /**
     * 原始价
     * @return int
     */
    public function getBaseCost()
    {
        return $this->_baseCost;
    }
    
    /**
     * 通过下标返回一个商品
     * @param string $key
     */
    public function getGoodsById($key)
    {
        return $this->hasGoods($key) ? $this->goods[$key] : null;
    }
    
    /**
     * 通过下标判断是否存在商品
     * @param string $key
     */
    public function hasGoods($key)
    {
        return isset($this->goods[$key]);
    }
    
    
    
    
    
    
    
    
    
    
    
    
}
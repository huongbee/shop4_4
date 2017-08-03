<?php

namespace App;

/*$oldCart = $_SESSION['cart']?$_SESSION['cart']:null;
$cart = new Cart($oldCart);
*/

class Cart
{
	public $items = null;
	public $totalQty = 0;
	public $totalPrice = 0;

	public function __construct($oldCart){
		if($oldCart){
			$this->items = $oldCart->items;
			$this->totalQty = $oldCart->totalQty;
			$this->totalPrice = $oldCart->totalPrice;
		}
	}

	public function add($item, $id, $qty=1){
		$sanpham = ['qty'=>0, 'price' => 0, 'item' => $item];
		if($this->items){
			if(array_key_exists($id, $this->items)){
				$sanpham = $this->items[$id];
			}
		}
		$sanpham['qty'] = $sanpham['qty'] + $qty;
		$sanpham['price'] = $item->promotion_price * $sanpham['qty'];
		$this->items[$id] = $sanpham;
		$this->totalQty = $this->totalQty + $qty;
		$this->totalPrice = ($this->totalPrice + ($sanpham['item']->promotion_price*$qty));
		
	}
	//xóa 1
	public function reduceByOne($id){ 
		$this->items[$id]['qty']--;
		$this->items[$id]['price'] -= $this->items[$id]['item']['promotion_price'];
		$this->totalQty--;
		$this->totalPrice = ($this->totalPrice - $this->items[$id]['item']['promotion_price']);
		if($this->items[$id]['qty']<=0){
			unset($this->items[$id]);
		}
	}
	//tăng 1
	public function increByOne($id){ 
		$this->items[$id]['qty']++;
		$this->items[$id]['price'] += $this->items[$id]['item']['promotion_price'];
		$this->totalQty++;
		$this->totalPrice = ($this->totalPrice + $this->items[$id]['item']['promotion_price']);
		
	}
	//xóa nhiều
	public function removeItem($id){
		$this->totalQty -= $this->items[$id]['qty'];
		$this->totalPrice -= $this->items[$id]['price'];
		unset($this->items[$id]);
	}

}

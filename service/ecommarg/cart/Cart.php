<?php 
namespace ecommarg\cart;

use ecommarg\cart\SaveAdapterInterface as SaveAdapter;
use ecommarg\cart\ProductInterface as Product;

Class Cart implements CartInterface{
	
	private	$adapter;
	//private $addAdapters;

	public function __construct (SaveAdapter $adapter){
		$this->adapter=$adapter;
	}

	public function add(Product $product, $quantity = 1){
		$quantity = (int) $quantity;
		if($quantity <= 0)
		{
			throw new \Exception("Cantidad invalida");
		}
		$this->adapter->set(
			$product->getId(),
			json_encode([
					'quantity'=>$quantity,
					'product'=>$product
				])
		);
	}

	public function get($id){
		return $this->adapter->get($id);
	}

	public function getAll(){
		$data = $this->adapter->getAll();
		foreach ($data as &$value) {
			$value = json_decode($value);
		}
		return $data;
	}

	//mas de un adaptarodr
	// public function addAdapter(SaveAdapter $adapter)
	// {
	// 	$this->addAdapters[]=$adapter;

	// }
	// public function addProductAdapter(Product $product)
	// {
	// 	foreach ($this->adapters as $adapter) {
	// 		$adapter->set($product->getId(),json_encode($product));
	// 	}
	// }

}

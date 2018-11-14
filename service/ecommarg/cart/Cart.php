<?php 
namespace ecommarg\cart;

use ecommarg\cart\SaveAdapterInterface as SaveAdapter;
use ecommarg\cart\ProductInterface as Product;

Class Cart implements CartInterface{
	
	private	$adapter;

	public function __construct (SaveAdapter $adapter){
		$this->adapter=$adapter;
	}

	public function add(Product $producto){
		// $this->adapter->set('ecommarg_cart_session',[json_encode($producto)]);
		;
		$list=$this->adapter->all();
		array_push($list,json_encode($producto));
		// var_dump($listç);
		$this->adapter->replace($list);
	}

	public function get($id){
		return $this->adapter->get($id);
	}

	public function all(){
		return $this->adapter->all();
	}

	public function replace($array){
		return $this->adapter->replace($array);
	}

}

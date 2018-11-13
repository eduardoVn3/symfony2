<?php 
	
	namespace ecommarg\cart;

	use ecommarg\cart\ProductInterface as Product;

	interface CartInterface
	{
		public function add(Product $poduct);
		public function get($id);
	}

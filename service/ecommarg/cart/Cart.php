<?php
	
	namespace ecommarg\cart;

	use ecommarg\cart\SaveAdapterInterface as SaveAdapter;
	use ecommarg\cart\ProductInterface as Product;

	class Cart implements CartInterface
	{
		private $adapter;

		public function __construct(SaveAdapter $adapter)
		{
			$this->adapter = $adapter;
		}

		public function add(Product $Product)
		{
			$this->adapter->set($Product->getId(),json_encode($Product));
		}

		public function get($id)
		{
			return $this->get($id);
		}
	}

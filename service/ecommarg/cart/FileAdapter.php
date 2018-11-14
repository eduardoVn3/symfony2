<?php 
	//adaptador
	namespace ecommarg\cart;

	use ecommarg\cart\SaveAdapterInterface as SaveAdapter;
	use ecommarg\cart\ProductInterface as Product;

	class FileAdapter implements SaveAdapter
	{
		const FILE = 'ecommarg_cart_list.txt';
		private $file = null ;

		public function __construct($path,$file = null)
		{	
			//en ves de usar puntos se concatena con esto
			$this->file = sprintf('%s/%s',$path,null === $file ? self::FILE : $file);
		}

		public function set($key, $value)
		{
			return file_put_contents($this->file, "$key=>$value"."\n",\FILE_APPEND);
		}

		public function get($key)
		{
			return file_get_contents($this->file);
		}

		public function getAll()
		{
			return $this->get('');
		}
	}


<?php 

namespace ecommarg\cart;

Interface SaveAdapterInterface{

	public function set($key,$value);

	public function get($key);
}
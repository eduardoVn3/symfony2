<?php 

namespace ecommarg\cart;

use symfony\component\HttpFoundation\Session\SessionInterface;

Class SessionAdapter implements SaveAdapterInterface{

	private $session;

	public function __construct(SessionInterface $session){
		$this->session=$session;
	}

	public function set($key,$value)
	{

		$this->session->set($key,$value);
	}

	public function get($key)
	{
		return $this->session->get($key);
	}

	public function all()
	{
		return $this->session->all();
	}
}
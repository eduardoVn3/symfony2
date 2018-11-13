<?php 

	namespace ecommarg\cart;

	use Symfony\component\httpFoundation\Session\SessionInterface;

	class SessionAdapter implements SaveAdapterInterface
	{
		private $session;
		public function __construct(SessionInterface $session)
		{
			$this->session = $session;
		}

		public function set($key, $value)
		{
			$this->session->set($key, $value);
		}

		public function get($key)
		{
			$this->session->get($key, $value);
		}
	}


<?php

namespace AppBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;

class TestController extends Controller
{
	//controlador forma recomendada
	/**
	*@Route("/test" , name="AppBundle:testController:index")
	*/
	public function indexAction()
	{
		//enviar renderizacion
		//toma dos parametros el template y los datos enviados
		return $this->render(
				//'AppBundle:Test/index.html.twig' para cuado se usa otro bundle
				'test/index.html.twig',
				[
					'nombre'=>'Juan Manuel',
					'apellido'=>'Ramon velez',
					'productos'=>[
						[
							'nombre'=>'televisor',
							'precio'=>'19000'
						],
						[
							'nombre'=>'telefono',
							'precio'=>'4000'
						]
					]
				]
			);
	}
}

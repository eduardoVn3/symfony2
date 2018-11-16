<?php

namespace ProductoBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\HttpFoundation\Response;

class ProductoApiController extends Controller
{
	/**
	*@Route("/api/product/list" , name="Product_list")
	*/
    public function indexAction()
    {
    	$productos = $this->getDoctrine()->getRepository('ProductoBundle:Producto')->findAll();
    	$response = new Response();
            $response->headers->add([
                    'Content-Type'=>'application/json'
            ]);
            $response->setContent(json_encode($productos));
            return $response;
    }
}

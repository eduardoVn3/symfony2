<?php

namespace ProductoBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;

class DefaultController extends Controller
{
    /**
	*@Route("/product/list" , name="Product_list")
	*/
    public function indexAction()
    {
    	$request = $this->getRequest()->get('name');
    	if(!isset($request))
    	{
    		$productos = $this->getDoctrine()->getRepository('ProductoBundle:Producto')->findAll();
    		return $this->render('ProductoBundle:Default:index.html.twig',['productos'=> $productos]);
    	}
    	$productos = $this->getDoctrine()->getRepository('ProductoBundle:Producto')->createQueryBuilder('o')
    								 ->where('o.name LIKE :name')
    								 ->setParameter('name', '%'.$request.'%')
    								 ->getQuery()
    								 ->getResult();
    	return $this->render('ProductoBundle:Default:index.html.twig',['productos'=> $productos]);
    	//traer todos de la base de datos
    	// $productos = $this->getDoctrine()->getRepository('ProductoBundle:Producto')->findAll();
    	// return $this->render('ProductoBundle:Default:index.html.twig',['productos'=> $productos]);
    }
}

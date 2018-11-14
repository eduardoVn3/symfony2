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
    	// $request = $this->getRequest()->get('name');
        
    	// if(!isset($request))
    	// {
    		$productos = $this->getDoctrine()->getRepository('ProductoBundle:Producto')->findAll();
    	// }

    	// $productos = $this->getDoctrine()->getRepository('ProductoBundle:Producto')->createQueryBuilder('o')
    	// 							 ->where('o.name LIKE :name')
    	// 							 ->setParameter('name', '%'.$request.'%')
    	// 							 ->getQuery()
    	// 							 ->getResult();
    	return $this->render('ProductoBundle:Default:index.html.twig',['productos'=> $productos]);
    }

    /**
    *@Route("/product/cart/add/{id}/quantity/{quantity}" , name="Product_add_cart")
    */
    public function addToCartAction($id,$quantity){
        $producto= $this->getDoctrine()
        ->getRepository('ProductoBundle:Producto')
        ->find($id);

        if(null===$producto){
            throw new \Exception("Product not found");
        }

        $this->get('app.cart')->add($producto);
        die();
    }

    /**
    *@Route("/product/cart/view/one" , name="Product_view_one_cart")
    */
    public function viewCartAction(){
        var_dump($this->get('app.cart')
        ->get('ecommarg_cart_session')
        );
        die();
    }

    /**
    *@Route("/product/cart/view/all" , name="Product_view_all_cart")
    */
    public function viewAllCartAction(){
        var_dump($this->get('app.cart')
        ->all('ecommarg_cart_session')
        );
        die();
    }
}

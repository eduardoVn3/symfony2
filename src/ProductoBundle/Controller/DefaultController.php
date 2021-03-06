<?php

namespace ProductoBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

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
    *@Route("/cart/add" , name="product_add_cart" , methods="POST")
    */
    public function addToCartAction(Request $r)
    {
        $id = $r->get('id');
        $quantity = $r->get('quantity');

        $requestType = strtolower($r->headers->get('X-Requested-With'));
        $isAjax = 'xmlhttprequest' === $requestType;

        $producto= $this->getDoctrine()
        ->getRepository('ProductoBundle:Producto')
        ->find($id);

        if(null === $producto){
            throw new \Exception("Product not found");
        }

        $cartService = $this->get('app.cart');
        $cartService->add($producto);

        if(true === $isAjax){
            $response = new Response();
            $response->headers->add([
                    'Content-Type'=>'application/json'
            ]);
            $response->setContent(json_encode($cartService->getAll()));
            return $response;
        }

        return $this->redirect($this->generateUrl('product_view_cart'));
    }

    /**
    *@Route("/cart/view" , name="product_view_cart")
    */
    public function viewCartAction()
    {
        $cartService = $this->get('app.cart');
        $productos = $cartService->getAll();
        // var_dump($productos);
        // die();
        return $this->render('ProductoBundle:Producto:cartList.html.twig',['cart'=> $productos]);
    }
}

<?php

namespace ProductoBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\HttpFoundation\Response;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Symfony\Component\HttpFoundation\Request;
use ProductoBundle\Entity\Producto;

class ProductoApiController extends Controller
{
    /**
     *@Route("/product/api/add", name="product_api_add")
     *@Method("POST")
     */
    public function addAction(Request $r){
        $product = new Producto();
        $form = $this->createForm(
            'ProductoBundle\Form\ProductoApiType',
            $product,
            [
                'csrf_protection' => false
            ]
        );
        $form->bind($r);
        $valid = $form->isValid();
        $response = new Response();
        if(false === $valid){
            $response->setStatusCode(400);
            $response->setContent(json_encode($this->getFormErrors($form)));
            return $response;
        }
        if (true === $valid) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($product);
            $em->flush();
            $response->setContent(json_encode($product));
        }
        return $response;
    }

    public function getFormErrors($form){
        $errors = [];
        if (0 === $form->count()){
            return $errors;
        }
        foreach ($form->all() as $child) {
            if (!$child->isValid()) {
                $errors[$child->getName()] = (string) $form[$child->getName()]->getErrors();
            }
        }
        return $errors;
    }



	/**
	*@Route("/api/product/list" , name="Product_list_api")
	*/
    // public function indexAction()
    // {
    // 	// $dql = "SELECT * FROM producto";
    // 	// $productos = $entityManager->createQuery($dql)
    //                    // ->setFirstResult(0)
    //                    // ->setMaxResults(1);
    // 	$productos = $this->getDoctrine()->getRepository('ProductoBundle:Producto')->findAll();
    // 	$response = new Response();
    //         $response->headers->add([
    //                 'Content-Type'=>'application/json'
    //         ]);
    //         $response->setContent(json_encode($productos));
    //         return $response;
    // }

    /**
     * Lists all producto entities.
     *
     * @Route("/api/product/list", name="producto_index_api")
     * @Method("GET")
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $productos = $em->getRepository('ProductoBundle:Producto')->findAll();

        return $this->jsonRender($productos);
    }

    /**
     * Creates a new producto entity.
     *
     * @Route("/api/product/new", name="producto_new_api")
     * @Method("POST")
     */
    public function newAction(Request $request)
    {
        $producto = new Producto();
        $form = $this->createForm('ProductoBundle\Form\ProductoApiType', $producto);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($producto);
            $em->flush();

            return $this->jsonRender($producto);
            // return $this->redirectToRoute('prod ucto_show', array('id' => $producto->getId()));
        }
        return $this->jsonRender('error');
        // return $this->jsonRender();
        // return $this->render('producto/new.html.twig', array(
        //     'producto' => $producto,
        //     'form' => $form->createView(),
        // ));
    }

    public function jsonRender($data)
    {
    	$response = new Response();
            $response->headers->add([
                    'Content-Type'=>'application/json'
            ]);
            $response->setContent(json_encode($data));
            return $response;
    }
}

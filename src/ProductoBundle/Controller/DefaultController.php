<?php

namespace ProductoBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;

class DefaultController extends Controller
{
    /**
	*@Route("/product/list" , name="ProductoBundle:DefaultController:index")
	*/
    public function indexAction()
    {
        return $this->render('ProductoBundle:Default:index.html.twig');
    }
}

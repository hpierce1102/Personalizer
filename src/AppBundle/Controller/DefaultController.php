<?php

namespace AppBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

class DefaultController extends Controller
{
    public function indexAction(Request $request)
    {
    	$session = $request->getSession();

    	if($session->get('displayName')){
    		$user = array();
    		$user['displayName'] = $session->get('displayName');
    		$user['image_url'] = $session->get('image_url');
    	} else {
    		$user =  null;
    	}

        return $this->render('AppBundle:Default:index.html.twig', array(
        	    'user' => $user,
                'HTTP_HOST' => $_SERVER['HTTP_HOST']
        	));
    }
}

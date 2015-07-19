<?php

namespace AppBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
//use Symfony\Component\HttpFoundation\Response;

class BrowseController extends Controller
{
    public function indexAction(Request $request)
    {
    	$session = $request->getSession();

        //get user info
    	if($session->get('displayName')){
    		$user = array();
    		$user['displayName'] = $session->get('displayName');
    		$user['image_url'] = $session->get('image_url');
    	} else {
    		$user =  null;
    	}

        //get current ebooks records
        $em = $this->getDoctrine()->getManager();

        $eBooks = $em
                    ->getRepository('AppBundle:eBook')
                    ->findAll();   

        //return new Response(var_dump($Ebooks)); 
        return $this->render('AppBundle:Default:browse.html.twig', array(
        	    'user' => $user,
                'eBooks' => $eBooks,
                'HTTP_HOST' => $_SERVER['HTTP_HOST']
        	));
    }
}

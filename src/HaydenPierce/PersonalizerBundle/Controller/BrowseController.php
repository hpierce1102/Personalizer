<?php

namespace HaydenPierce\PersonalizerBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

class BrowseController extends Controller
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
        return $this->render('HaydenPiercePersonalizerBundle:Default:browse.html.twig', array(
        	    'user' => $user
        	));
    }
}

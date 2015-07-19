<?php
/**
* gets info for a specific book. 
*/
namespace HaydenPierce\PersonalizerBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use HaydenPierce\PersonalizerBundle\Entity\userProfile;
use Symfony\Component\HttpFoundation\Request;

class InfoController extends Controller
{
    public function indexAction($id, Request $request)
    {
    	$session = $request->getSession();
    	$em = $this->getDoctrine()->getManager();

    	//find the book by the id in the URL.
    	$eBook = $em
    		->getRepository('HaydenPierce\PersonalizerBundle\Entity\eBook')
    		->find($id);

    	//get user info
    	if($session->get('displayName')){
    		$user = array();
    		$user['displayName'] = $session->get('displayName');
    		$user['image_url'] = $session->get('image_url');
    	} else {
    		$user =  null;
    	}

		//return new Response(var_dump($user));
        return $this->render('HaydenPiercePersonalizerBundle:Default:info.html.twig', array(
	        	'user' => $user,
	        	'eBook' => $eBook,
	        	'HTTP_HOST' => $_SERVER['HTTP_HOST']
        	));
    }
}
<?php

namespace HaydenPierce\PersonalizerBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use HaydenPierce\PersonalizerBundle\Entity\userProfile;
use Symfony\Component\HttpFoundation\Response;

class DebugController extends Controller
{
    public function indexAction()
    {
    	$em = $this->getDoctrine()->getManager();

    	$user_profile = new userProfile();

    	$user_profile->setGoogleId(99);
		$user_profile->setName('Hayden');
		$user_profile->setImageUrl('image_url');
		$user_profile->setRefreshToken('refresh');
		
		$em->persist($user_profile);
		$em->flush();

    	$user = $em
		->getRepository('HaydenPierce\PersonalizerBundle\Entity\userProfile')
		->findByGoogleId(99);

		return new Response(var_dump($user));
        //return $this->render('HaydenPiercePersonalizerBundle:Default:index.html.twig');
    }
}

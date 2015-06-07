<?php

namespace HaydenPierce\PersonalizerBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Session\Session;
use Symfony\Component\HttpFoundation\Request;

class SandboxController extends Controller
{
    public function indexAction(Request $request)
    {
    	$session = $request->getSession();

		$client = new \Google_Client;
		$app_root = $this->get('kernel')->getRootDir();
		$client->setAuthConfigFile($app_root . '/config/client_secrets.json');
		$client->addScope(\Google_Service_Plus::USERINFO_PROFILE);

		if ($session->get('access_token')) {
		  $client->setAccessToken($session->get('access_token'));
		  $plus_service = new \Google_Service_Plus($client);
		  $profile = $plus_service->people->get('me');
		  return $this->render('HaydenPiercePersonalizerBundle:Default:sandbox.html.twig', array(
	          'id' => $profile['id'],
	          'name' => $profile['displayName'],
	          'image_url' => $profile['image']['url']
	      ));
		} else {
			//return new Response(isset($session->get('access_token')). ' ' . $session->get('access_token'));
		  return $this->redirectToRoute('hayden_pierce_personalizer_OAuthCallback');
		}


    }
}

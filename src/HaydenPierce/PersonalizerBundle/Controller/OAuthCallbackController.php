<?php

namespace HaydenPierce\PersonalizerBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Session\Session;
use Symfony\Component\HttpFoundation\Request;

class OAuthCallbackController extends Controller
{
    public function indexAction(Request $request)
    {
    	$session = $request->getSession();

		$client = new \Google_Client();
		$app_root = $this->get('kernel')->getRootDir();
		$client->setAuthConfigFile($app_root . '/config/client_secrets.json');
		$client->setRedirectUri('http://' . $_SERVER['HTTP_HOST'] . '/OAuthCallback');
		$client->addScope(\Google_Service_Plus::USERINFO_PROFILE);

		if (! isset($_GET['code'])) {
		  $auth_url = $client->createAuthUrl();
		  return $this->redirect(filter_var($auth_url, FILTER_SANITIZE_URL));
		  //header('Location: ' . filter_var($auth_url, FILTER_SANITIZE_URL));
		} else {
		  $client->authenticate($_GET['code']);
		  $session->set('access_token', $client->getAccessToken());
		  //return new Response("Access_Token: " . $_SESSION['access_token']);
		  return $this->redirectToRoute('hayden_pierce_personalizer_sandbox');
		}
    }
}

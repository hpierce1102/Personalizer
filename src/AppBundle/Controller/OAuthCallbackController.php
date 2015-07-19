<?php
/**
*Handles getting authentication from google and stores info the the db.
*/

namespace HaydenPierce\PersonalizerBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Session\Session;
use Symfony\Component\HttpFoundation\Request;
use HaydenPierce\PersonalizerBundle\Entity\userProfile;

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
		$client->setAccessType('offline');

		if (! isset($_GET['code'])) {
		  //First time here, send 'em to google to get authenticated.
		  $auth_url = $client->createAuthUrl();
		  return $this->redirect(filter_var($auth_url, FILTER_SANITIZE_URL));
		} else {
		  //They've authenticated with google.
		  $client->authenticate($_GET['code']);

		  //get the user's profile info from Google. 
		  $access_token = $client->getAccessToken();
		  $client->setAccessToken($access_token);
		  $plus_service = new \Google_Service_Plus($client);
		  $google_profile = $plus_service->people->get('me');

		  if ($this->find_user($google_profile)) {
		  	//returning user, we should have a refresh token already
		  	$refresh_token = null;

		  } else {
		  	//first time user, a refresh token will be provided.
		  	$authJson = json_decode($access_token);
		    $refresh_token = $authJson->{'refresh_token'};
		    $session->set('refresh_token', $refresh_token);
		  }
		  
		  $session->set('access_token', $access_token);
		  $this->insert_user_record($google_profile, $access_token, $refresh_token);

		  return $this->redirectToRoute('hayden_pierce_personalizer_login');
		}
    }

    //Determine if a user exists in the db.
    private function find_user($google_profile){
    	$em = $this->getDoctrine()->getManager();

    	$user_profile = $em
		->getRepository('HaydenPierce\PersonalizerBundle\Entity\userProfile')
		->findOneByGoogleId($google_profile['id']);

		if($user_profile){
			return $user_profile;
		} else {
			return false;
		}
    }

    //insert or update a user record in the db.
    private function insert_user_record($google_profile, $access_token = null, $refresh_token = null){
    	$em = $this->getDoctrine()->getManager();

		$user_profile = $em
		->getRepository('HaydenPierce\PersonalizerBundle\Entity\userProfile')
		->findOneByGoogleId($google_profile['id']);

		if(!$user_profile){
			//No user_profile found, lets create a new one.
			//exit();
			$user_profile = new userProfile();
		}
  
		$user_profile->setGoogleId($google_profile['id']);
		$user_profile->setName($google_profile['displayName']);
		$user_profile->setImageUrl($google_profile['image']['url']);
		$user_profile->setAccessToken($access_token);

		if($refresh_token) {
			$user_profile->setRefreshToken($refresh_token);
		}
		
		$em->persist($user_profile);
		$em->flush();

		return true;
    }
}

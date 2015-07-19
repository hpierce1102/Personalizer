<?php
/*
*Takes care of logging people in after they have first authenticated with Google.
*If they have not, this script will send them to OAuthCallback for first time
*authorization.
*/

namespace AppBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Session\Session;
use Symfony\Component\HttpFoundation\Request;
use HaydenPierce\PersonalizerBundle\Entity\userProfile;

class LoginController extends Controller
{
    public function indexAction(Request $request)
    {
    	$session = $request->getSession();
		$client = new \Google_Client;

		//Find the client private key and whatnot 
		$app_root = $this->get('kernel')->getRootDir();
		$client->setAuthConfigFile($app_root . '/config/client_secrets.json');
		$client->addScope(\Google_Service_Plus::USERINFO_PROFILE);

		if ($session->get('access_token')) {
			$client->setAccessToken($session->get('access_token'));
			$em = $this->getDoctrine()->getManager();

			//Access tokens expire after ~1 hour, get a new one if it expired. 
			if($client->isAccessTokenExpired()){

				//Since the access token expired, we can't query using the google_id,
				//we can instead use the current access token to get their refresh token
				//from the db.
				$user_profile = $em
					->getRepository('HaydenPierce\PersonalizerBundle\Entity\userProfile')
					->findOneByAccessToken($session->get('access_token'));

				//reterive the new access token from google.
				$client->refreshToken($user_profile->getAccessToken());
				$new_access_token = $client->getAccessToken();
				$session->set('access_token', $new_access_token);

				//commit the new access token in the db for next time this process runs.
				$user_profile->setAccessToken($new_access_token);
				$em->persist($user_profile);
				$em->flush();

				//finally, provide the client with the newest access token.
				$client->setAccessToken($new_access_token);
			}

			$plus_service = new \Google_Service_Plus($client);
			$google_profile = $plus_service->people->get('me');

			$user_profile = $em
				->getRepository('AppBundle:userProfile')
				->findOneByGoogleId($google_profile['id']);

			$session->set('id', $user_profile->getId());
			$session->set('profile_id', $google_profile['id']);
			$session->set('displayName', $google_profile['displayName']);
			$session->set('image_url', $google_profile['image']['url']);

			return $this->redirectToRoute('hayden_pierce_personalizer_browse_page');
		} else {
			//No access token found. Let's get one.
			return $this->redirectToRoute('hayden_pierce_personalizer_OAuthCallback');
		}

    }
}

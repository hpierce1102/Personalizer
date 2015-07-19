<?php

namespace AppBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

class LogoutController extends Controller
{
    public function indexAction(Request $request)
    {
    	$session = $request->getSession();
        $session->invalidate();

        return $this->redirectToRoute('hayden_pierce_personalizer_browse_page');
    }
}
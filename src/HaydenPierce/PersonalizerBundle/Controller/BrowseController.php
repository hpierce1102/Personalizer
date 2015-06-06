<?php

namespace HaydenPierce\PersonalizerBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class BrowseController extends Controller
{
    public function indexAction()
    {
        return $this->render('HaydenPiercePersonalizerBundle:Default:browse.html.twig');
    }
}

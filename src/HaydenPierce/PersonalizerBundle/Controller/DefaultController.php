<?php

namespace HaydenPierce\PersonalizerBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class DefaultController extends Controller
{
    public function indexAction()
    {
        return $this->render('HaydenPiercePersonalizerBundle:Default:index.html.twig');
    }
}

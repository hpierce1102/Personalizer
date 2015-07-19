<?php

/*
*Places some dummy data into eBooks table in the db.
*To delete after creating a process to upload new books
*/

namespace HaydenPierce\PersonalizerBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use HaydenPierce\PersonalizerBundle\Entity\eBook;

class EBookSetupController extends Controller
{
    public function indexAction(Request $request)
    {
    	$session = $request->getSession();

        $em = $this->getDoctrine()->getManager();

        $EBook = new Ebook();
        $EBook->setCoverImageUrl('images/cover225x225.jpeg');
        $EBook->setTitle('Reddex');
        $EBook->setDescription('Reddex magazine published fall fo 2014');
        $em->persist($EBook);

        $EBook = new Ebook();
        $EBook->setCoverImageUrl('images/cover225x225_blue.jpg');
        $EBook->setTitle('Reddex Blue');
        $EBook->setDescription('Blue Reddex magazine published fall fo 2014');
        $em->persist($EBook);

        $EBook = new Ebook();
        $EBook->setCoverImageUrl('images/cover225x225_green.jpg');
        $EBook->setTitle('Reddex Green');
        $EBook->setDescription('Green Reddex magazine published fall fo 2014');
        $em->persist($EBook);

        $EBook = new Ebook();
        $EBook->setCoverImageUrl('images/cover225x225_orange.jpg');
        $EBook->setTitle('Reddex Orange');
        $EBook->setDescription('Orange Reddex magazine published fall fo 2014');
        $em->persist($EBook);

        $EBook = new Ebook();
        $EBook->setCoverImageUrl('images/cover225x225_pink.jpg');
        $EBook->setTitle('Reddex Pink');
        $EBook->setDescription('Pink Reddex magazine published fall fo 2014');
        $em->persist($EBook);

        $EBook = new Ebook();
        $EBook->setCoverImageUrl('images/cover225x225_purple.jpg');
        $EBook->setTitle('Reddex Purple');
        $EBook->setDescription('Purple Reddex magazine published fall fo 2014');
        $em->persist($EBook);

        $EBook = new Ebook();
        $EBook->setCoverImageUrl('images/cover225x225_red.jpeg');
        $EBook->setTitle('Reddex Red');
        $EBook->setDescription('Red Reddex magazine published fall fo 2014');
        $em->persist($EBook);

        $EBook = new Ebook();
        $EBook->setCoverImageUrl('images/cover225x225_teal.jpg');
        $EBook->setTitle('Reddex Teal');
        $EBook->setDescription('Teal Reddex magazine published fall fo 2014');
        $em->persist($EBook);

        $EBook = new Ebook();
        $EBook->setCoverImageUrl('images/cover225x225_yellow.jpg');
        $EBook->setTitle('Reddex Yellow');
        $EBook->setDescription('Yellow Reddex magazine published fall fo 2014');
        $em->persist($EBook);

        $em->flush();

        return new Response("Commited!");
    }
}
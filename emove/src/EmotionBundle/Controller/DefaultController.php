<?php

namespace EmotionBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class DefaultController extends Controller
{
    public function indexAction()
    {
        return $this->render('EmotionBundle:Default:index.html.twig');
    }

    public function contactAction()
    {
        return $this->render('EmotionBundle:Default:contact.html.twig');
    }
}

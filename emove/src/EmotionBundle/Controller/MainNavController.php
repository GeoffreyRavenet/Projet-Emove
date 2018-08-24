<?php

namespace EmotionBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class MainNavController extends Controller
{
    public function getMainNavAction()
    {
        $repository = $this->getDoctrine()
            ->getManager()
            ->getRepository('EmotionBundle:Brand');

        $brand = $repository->findAll();

        $repositoryProductCategory = $this->getDoctrine()
            ->getManager()
            ->getRepository('EmotionBundle:ProductCategory');

        $category = $repositoryProductCategory->findAll();

        $user = $this->get('security.token_storage')->getToken()->getUser();
        /*$usertest = $this->getUser();*/

        return $this->render('EmotionBundle:Default:mainNav.html.twig', [
            'brand' => $brand,
            'category' => $category,
            'id' => $user
        ]);
    }
}
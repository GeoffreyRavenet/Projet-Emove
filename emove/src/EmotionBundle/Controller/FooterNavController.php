<?php

namespace EmotionBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class FooterNavController extends Controller
{
    public function getFooterNavAction()
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

        return $this->render('EmotionBundle:Default:footer.html.twig', [
            'brand' => $brand,
            'category' => $category,
            'id' => $user
        ]);
    }
}
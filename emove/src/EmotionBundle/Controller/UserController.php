<?php

namespace EmotionBundle\Controller;
use EmotionBundle\Form\RegistrationFormType;
use EmotionBundle\Form\UpdateUserType;
use FOS\UserBundle\Form\Type\ProfileFormType;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class UserController extends Controller
{
    public function getProfilAction($id)
    {
        $repository = $this->getDoctrine()
            ->getManager()
            ->getRepository('EmotionBundle:User');

        $profil = $repository->find($id);
		
		$repository = $this->getDoctrine()
            ->getManager()
            ->getRepository('EmotionBundle:Rent');

		$query = $repository->createQueryBuilder('r')
			->where('r.user = :user')
			->setParameter('user', $this->getUser()->getId())
			->orderBy('r.user', 'DESC')
			->getQuery();
		$rent = $query->getResult();		

        return $this->render('EmotionBundle:Admin:profil.html.twig', [
            'user' => $profil,
            'rent'=> $rent
        ]);
    }

    public function updateProfilAction(Request $request, $id) {

        $repository = $this->getDoctrine()->getRepository('EmotionBundle:User');

        $profil = $repository->find($id);

        $form =$this->createForm(UpdateUserType::class, $profil);

        if($request->isMethod('POST')) {

            $form->handleRequest($request);

            $em = $this->getDoctrine()->getManager();

            $em->persist($profil);

            $em->flush();

            return $this->redirectToRoute('emotion_profil', ['id' => $profil->getId()]);
        }

        return $this->render('EmotionBundle:Admin:updateProfil.html.twig', ['form' => $form->createView()]);
    }

    public function deleteUserAction($id) {

        $em = $this->getDoctrine()->getManager();

        $repository = $this->getDoctrine()->getRepository('EmotionBundle:User');

        $user = $repository->find($id);

        $em->remove($user);

        $em->flush();

        return $this->redirectToRoute('emotion_homepage');
    }
}

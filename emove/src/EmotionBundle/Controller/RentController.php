<?php

namespace EmotionBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class RentController extends Controller
{
    public function rentAction()
    {
        $repository = $this->getDoctrine()
            ->getManager()
            ->getRepository('EmotionBundle:Rent');
		$count = $repository->createQueryBuilder('r')
			->select('count(r.id)')
			->where('r.user = :user')
			->setParameter('user', $this->getUser()->getId())
			->orderBy('r.user', 'DESC')
			->getQuery();
		$countid = $count->getResult()[0][1];
		$query = $repository->createQueryBuilder('r')
			->where('r.user = :user')
			->setParameter('user', $this->getUser()->getId())
			->orderBy('r.user', 'DESC')
			->getQuery();
		$id = $query->setFirstResult($countid-1)->getResult();
		$rent = $repository->find($id[0]);

        return $this->render("EmotionBundle:Rent:rentConfirm.html.twig", [
            'rent'=> $rent
        ]);
    }

    public function succesAction()
    {
        $repository = $this->getDoctrine()
            ->getManager()
            ->getRepository('EmotionBundle:Rent');
		$count = $repository->createQueryBuilder('r')
			->select('count(r.id)')
			->where('r.user = :user')
			->setParameter('user', $this->getUser()->getId())
			->orderBy('r.user', 'DESC')
			->getQuery();
		$countid = $count->getResult()[0][1];
		$query = $repository->createQueryBuilder('r')
			->where('r.user = :user')
			->setParameter('user', $this->getUser()->getId())
			->orderBy('r.user', 'DESC')
			->getQuery();
		$id = $query->setFirstResult($countid-1)->getResult();
		$rent = $repository->find($id[0]);

        return $this->render("EmotionBundle:Rent:rentSucces.html.twig", [
            'rent'=> $rent
        ]);
    }

    public function checkoutAction()
    {
        \Stripe\Stripe::setApiKey("sk_test_uHMvfEAghthAEk4tDsDvKNhm");

        $token = $_POST['stripeToken'];

        try {
            $charge = \Stripe\Charge::create(array(
                "amount" => 1000,
                "currency" => "eur",
                "source" => $token,
                "description" => "Paiement Stripe"
            ));
            $this->addFlash("succes","paiement reussi");
            return $this->redirectToRoute("emotion_succes");
        } catch(\Stripe\Error\Card $e) {

            $this->addFlash("erreur", "paiement échoué ");
            return $this->redirectToRoute("EmotionBundle:Rent:rent.html.twig");
        }
    }
}
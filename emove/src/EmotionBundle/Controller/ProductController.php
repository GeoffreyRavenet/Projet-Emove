<?php

namespace EmotionBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

use EmotionBundle\Entity\Rent;
use EmotionBundle\Form\RentType;

class ProductController extends Controller
{
    public function getProductsAction()
    {
        $repository = $this->getDoctrine()
            ->getManager()
            ->getRepository('EmotionBundle:Product');

        $product = $repository->findAll();

        return $this->render('EmotionBundle:Product:products.html.twig', [
            'product' => $product,
        ]);
    }

    public function getProductAction($id, Request $request)
    {
        $repository = $this->getDoctrine()
            ->getManager()
            ->getRepository('EmotionBundle:Product');

        $product = $repository->find($id);

        $rent = new Rent;
        $formBuilder = $this->get('form.factory')->createBuilder(RentType::class, $rent);
        $form = $this->createForm(RentType::class, $rent);

        if($request->isMethod('POST')) {

            if($request->request->get("emotionbundle_rent") != null) {
            $form->handleRequest($request);
            $em = $this->getDoctrine()->getManager();
			$rent->setUser($this->getUser());
			$rent->setProduct($product);
			$rent->setInvoice('facture-'.$this->getUser()->getId().'-'.date('y-m-d-H:i:s').'.pdf');
            $em->persist($rent);
            $em->flush();
            }
            return $this->redirectToRoute('emotion_rent');
        }

        return $this->render('EmotionBundle:Product:product.html.twig', [
            'product' => $product,
            'form' => $form->createView()
        ]);
    }
    public function getBrandProductAction($id)
    {
        $repository = $this
            ->getDoctrine()
            ->getManager()
            ->getRepository('EmotionBundle:Product')
        ;

        $brandProduct = $repository->findAllProductByBrand($id);

//        die(dump($brandProduct));
        return $this->render('EmotionBundle:Product:products.html.twig', [
            'product' => $brandProduct
        ]);
    }
    public function getCategoryProductAction($id)
    {
        $repository = $this
            ->getDoctrine()
            ->getManager()
            ->getRepository('EmotionBundle:Product')
        ;

        $categoryProduct = $repository->findAllProductByCategory($id);

        return $this->render('EmotionBundle:Product:products.html.twig', [
            'product' => $categoryProduct
        ]);
    }
}

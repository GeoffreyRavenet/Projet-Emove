<?php

namespace EmotionBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

use EmotionBundle\Entity\Brand;
use EmotionBundle\Form\BrandType;

use EmotionBundle\Form\ModelType;
use EmotionBundle\Entity\Model;

use EmotionBundle\Entity\ProductCategory;
use EmotionBundle\Form\ProductCategoryType;

use EmotionBundle\Entity\Product;
use EmotionBundle\Form\ProductType;

use EmotionBundle\Entity\Agency;
use EmotionBundle\Form\AgencyType;

use EmotionBundle\Form\RegistrationFormType;
use EmotionBundle\Form\UpdateUserType;
use EmotionBundle\Entity\User;

class AdminController extends Controller
{
    public function getAdminAction(Request $request) {

        /******************************** FORMS ********************************/
        $brand = new Brand;
        $productCategory = new ProductCategory;
        $product = new Product;
        $model = new Model;
        $agency = new Agency;

        $formBuilder = $this->get('form.factory')->createBuilder(BrandType::class, $brand);
        $formBuilderProductCategory = $this->get('form.factory')->createBuilder(ProductCategoryType::class, $productCategory);
        $formBuilderProduct = $this->get('form.factory')->createBuilder(ProductType::class, $product);
        $formBuilderModel = $this->get('form.factory')->createBuilder(ModelType::class, $model);
        $formBuilderAgency = $this->get('form.factory')->createBuilder(AgencyType::class, $agency);

        $form = $this->createForm(BrandType::class, $brand);
        $formProductCategory = $this->createForm(ProductCategoryType::class, $productCategory);
        $formProduct = $this->createForm(ProductType::class, $product);
        $formModel = $this->createForm(ModelType::class, $model);
        $formAgency = $this->createForm(AgencyType::class, $agency);

        if($request->isMethod('POST')) {

            //die(dump($request->request->all()));

            if($request->request->get("emotionbundle_brand") != null) {
                $form->handleRequest($request);
                $em = $this->getDoctrine()->getManager();
                $em->persist($brand);
                $em->flush();
            }
            if($request->request->get("emotionbundle_productcategory") != null) {
                $formProductCategory->handleRequest($request);
                $emProductCategory = $this->getDoctrine()->getManager();
                $emProductCategory->persist($productCategory);
                $emProductCategory->flush();
            }
            if($request->request->get("emotionbundle_product") != null) {
                $formProduct->handleRequest($request);
                $emProduct = $this->getDoctrine()->getManager();
                $emProduct->persist($product);
                $emProduct->flush();
            }
            if($request->request->get("emotionbundle_model") != null) {
                $formModel->handleRequest($request);
                $emModel = $this->getDoctrine()->getManager();
                $emModel->persist($model);
                $emModel->flush();
            }
            if($request->request->get("emotionbundle_agency") != null) {
                $formModel->handleRequest($request);
                $emModel = $this->getDoctrine()->getManager();
                $emModel->persist($agency);
                $emModel->flush();
            }
            return $this->redirectToRoute('emotion_admin');
        }

        /******************************** LISTS ********************************/
        $repository = $this->getDoctrine()
            ->getManager()
            ->getRepository('EmotionBundle:User');

        $user = $repository->findAll();

        $repositoryProduct = $this->getDoctrine()
            ->getManager()
            ->getRepository('EmotionBundle:Product');

        $product = $repositoryProduct->findAll();

        $repositoryCategoryProduct = $this->getDoctrine()
            ->getManager()
            ->getRepository('EmotionBundle:ProductCategory');

        $productCategory = $repositoryCategoryProduct->findAll();

        $repositoryModel = $this->getDoctrine()
            ->getManager()
            ->getRepository('EmotionBundle:Model');

        $model = $repositoryModel->findAll();

        $repositoryBrand = $this->getDoctrine()
            ->getManager()
            ->getRepository('EmotionBundle:Brand');

        $brand = $repositoryBrand->findAll();

        return $this->render('EmotionBundle:Admin:admin.html.twig', [
            'form' => $form->createView(),
            'formProductCategory' => $formProductCategory->createView(),
            'formProduct' => $formProduct->createView(),
            'formModel' => $formModel->createView(),
            'formAgency' => $formAgency->createView(),
            'user' => $user,
            'product' => $product,
            'productCategory' => $productCategory,
            'model' => $model,
            'brand' => $brand
        ]);
    }
    public function getUsersAction()
    {
        $repository = $this->getDoctrine()
            ->getManager()
            ->getRepository('EmotionBundle:User');

        $user = $repository->findAll();

        return $this->render('EmotionBundle:Admin:users.html.twig', [
            'user' => $user
        ]);
    }
    /****************
    ACTION USER
     ****************/
    public function updateUserAction(Request $request, $id)
    {

        $repository = $this->getDoctrine()->getRepository('EmotionBundle:User');
        $user = $repository->find($id);
        $form = $this->createForm(UpdateUserType::class, $user);
        if($request->isMethod('POST'))
        {

            $form->handleRequest($request);
            $em = $this->getDoctrine()->getManager();
            $em->persist($user);
            $em->flush();

            return $this->redirectToRoute('emotion_admin');
        }
        return $this->render('EmotionBundle:Admin:update.html.twig', array(
            'form' => $form->createView()
        ));
    }

    public function deleteUserAction($id){

        $em = $this->getDoctrine()->getManager();

        $repository = $this->getDoctrine()->getRepository('EmotionBundle:User');

        $user = $repository->find($id);

        $em->remove($user);
        $em->flush();

        return $this->redirectToRoute('emotion_admin');
    }
    /********************
    ACTION PRODUIT
     ********************/

    public function updateProductAction(Request $request, $id)
    {

        $repository = $this->getDoctrine()->getRepository('EmotionBundle:Product');
        $product = $repository->find($id);
        $form = $this->createForm(ProductType::class, $product);
        if($request->isMethod('POST'))
        {

            $form->handleRequest($request);
            $em = $this->getDoctrine()->getManager();
            $em->persist($product);
            $em->flush();

            return $this->redirectToRoute('emotion_admin');
        }
        return $this->render('EmotionBundle:Admin:update.html.twig', array(
            'form' => $form->createView()
        ));
    }

    public function deleteProductAction($id){

        $em = $this->getDoctrine()->getManager();

        $repository = $this->getDoctrine()->getRepository('EmotionBundle:Product');

        $product = $repository->find($id);

        $em->remove($product);
        $em->flush();

        return $this->redirectToRoute('emotion_admin');
    }
    /********************
    ACTION CATEGORY
     ********************/

    public function updateCategoryAction(Request $request, $id)
    {

        $repository = $this->getDoctrine()->getRepository('EmotionBundle:ProductCategory');
        $category = $repository->find($id);
        $form = $this->createForm(ProductCategoryType::class, $category);
        if($request->isMethod('POST'))
        {

            $form->handleRequest($request);
            $em = $this->getDoctrine()->getManager();
            $em->persist($category);
            $em->flush();

            return $this->redirectToRoute('emotion_admin');
        }
        return $this->render('EmotionBundle:Admin:update.html.twig', array(
            'form' => $form->createView()
        ));
    }

    public function deleteCategoryAction($id){

        $em = $this->getDoctrine()->getManager();

        $repository = $this->getDoctrine()->getRepository('EmotionBundle:ProductCategory');

        $category = $repository->find($id);

        $em->remove($category);
        $em->flush();

        return $this->redirectToRoute('emotion_admin');
    }

    public function updateBrandAction(Request $request, $id)
    {

        $repository = $this->getDoctrine()->getRepository('EmotionBundle:Brand');
        $brand = $repository->find($id);
        $form = $this->createForm(BrandType::class, $brand);
        if($request->isMethod('POST'))
        {

            $form->handleRequest($request);
            $em = $this->getDoctrine()->getManager();
            $em->persist($brand);
            $em->flush();

            return $this->redirectToRoute('emotion_admin');
        }
        return $this->render('EmotionBundle:Admin:update.html.twig', array(
            'form' => $form->createView()
        ));
    }


    public function deleteBrandAction($id){

        $em = $this->getDoctrine()->getManager();

        $repository = $this->getDoctrine()->getRepository('EmotionBundle:Brand');

        $brand = $repository->find($id);

        $em->remove($brand);
        $em->flush();

        return $this->redirectToRoute('emotion_admin');
    }

    public function updateModelAction(Request $request, $id)
    {

        $repository = $this->getDoctrine()->getRepository('EmotionBundle:Model');
        $model = $repository->find($id);
        $form = $this->createForm(ModelType::class, $model);
        if($request->isMethod('POST'))
        {

            $form->handleRequest($request);
            $em = $this->getDoctrine()->getManager();
            $em->persist($model);
            $em->flush();

            return $this->redirectToRoute('emotion_admin');
        }
        return $this->render('EmotionBundle:Admin:update.html.twig', array(
            'form' => $form->createView()
        ));
    }


    public function deleteModelAction($id){

        $em = $this->getDoctrine()->getManager();

        $repository = $this->getDoctrine()->getRepository('EmotionBundle:Model');

        $model = $repository->find($id);

        $em->remove($model);
        $em->flush();

        return $this->redirectToRoute('emotion_admin');
    }
}
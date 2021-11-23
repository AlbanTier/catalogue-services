<?php

namespace App\Controller;
use App\Entity\Tabs;
use App\Entity\Produit;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class TabsController extends AbstractController
{
    /**
     * @Route("/", name="app_tabs")
     */
    public function index(EntityManagerInterface $em): Response
    {
        $repo = $em->getRepository('App\Entity\Tabs');
        $tabs = $repo->findAll();
        return $this->render('tabs/index.html.twig', [
        'controller_name' => 'TabsController', 'tabs' => $tabs
    ]);

    }
    /**
     * @Route("/tabs/{id}", name="app_tabs_show")
     */
    public function show(Tabs $tabs, EntityManagerInterface $em, Request $request): Response
    {
        $id =  $request->get('_route_params');
        foreach( $id as $value )
            $idR = $value;
        $repoProduit = $em->getRepository('App\Entity\Produit');
        $prod = $repoProduit->findby(array('idTabs' => $idR));
        return $this->render('produit/show.html.twig',compact('tabs', 'prod'));
    }

    /**
     * @Route ("/createTabs", name="app_new_tabs")
     */
    public function create(Request $request, EntityManagerInterface $em): Response
    {
        //Déclaration de mon formulaire de création du tableau
        $tabs = new Tabs();
        $form = $this->createFormBuilder($tabs)
            ->add('libelle', null, ['attr' => ['autofocus' => true]])
            ->add('description', null)
            ->getForm()
            ;

        $form->handleRequest($request);

        if($form->isSubmitted() && $form->isValid()){
            $em->persist($tabs);
            $em->flush();
            $repo = $em->getRepository('App\Entity\Tabs');
            $tabs = $repo->findAll();
            return $this->render('tabs/index.html.twig', ['tabs' => $tabs]);
        }

        return $this->render('tabs/create.html.twig', ['form' => $form->createView()]);
    }


}

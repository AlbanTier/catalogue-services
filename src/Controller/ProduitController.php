<?php

namespace App\Controller;

use App\Entity\Produit;
use App\Form\ProduitType;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Form\FormTypeInterface;

class ProduitController extends AbstractController
{
    /**
     * @Route("/produit", name="produit")
     */
    public function index(): Response
    {
        return $this->render('produit/index.html.twig', [
            'controller_name' => 'ProduitController',
        ]);
    }

    /**
     * @Route ("/addProduit/{id}", name="app_new_produit")
     */
    public function create(Request $request, EntityManagerInterface $em): Response
    {
        //Déclaration de mon formulaire de création du tableau
        $id =  $request->get('_route_params');
        foreach( $id as $value )
            $idR = $value;
        $produit = new Produit();
        $form = $this->createFormBuilder($produit)
            ->add('designation', null)
            ->add('marque', null)
            ->add('reference', null)
            ->add('quantite', null)
            ->add('garantie', null)
            ->add('prixTTC', null)
            ->add('numImmo', null)
            ->add('typeGarantie', null)
            ->add('commentaire', null)
            ->add('caracteristique', null)
            ->add('pack', null)

            ->getForm();
        ;

        $form->handleRequest($request);

        if($form->isSubmitted() && $form->isValid()){
            $produit->setIdTabs($idR);
            $em->persist($produit);
            $em->flush();
            $repo = $em->getRepository('App\Entity\Tabs');
            $produit = $repo->findAll();
        }

        return $this->render('produit/form.produit.html.twig', ['form' => $form->createView()]);
    }
    /**
     * @Route ("/deleteProduit/{idTabs}/{id}", name="app_delete_produit")
     */
    public function deleteProduit(EntityManagerInterface $em, $id, $idTabs)
    {
        $produit = $em->getRepository('App\Entity\Produit');
        $produit = $produit->find($id);

        $em->remove($produit);
        $em->flush();

        return $this->redirectToRoute('app_tabs_show', ['id' => $idTabs]);
    }

    /**
     * @Route ("/updateProduit/{id}", name="app_update_produit")
     */
    public function update(EntityManagerInterface $em, $id, Request $request)
    {
        $produit = $em->getRepository('App\Entity\Produit');
        $produit = $produit->find($id);
        $form = $this->createForm(ProduitType::class, $produit);
        $form->handleRequest($request);

        if($form->isSubmitted() && $form->isValid()){
            $em->flush();
            $repo = $em->getRepository('App\Entity\Tabs');
            $produit = $repo->findAll();
        }
        return $this->render('produit/edit.html.twig',  ['form' =>$form->createView()]);
    }


}

<?php

namespace App\Controller;

use App\Entity\Tabs;
use App\Entity\User;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Session\Session;
use Symfony\Component\Routing\Annotation\Route;


class TabsController extends AbstractController
{
    //Fonction appeler a l'index du projet
    /**
     * @Route("/", name="app_tabs")
     */
    public function index(EntityManagerInterface $em): Response
    {
        $session = new Session; //Création de la variable de session
        $nom = $session->get('_security.last_username'); //Récupération de la variable session qui contient l'username
        $repo = $em->getRepository('App\Entity\Tabs');  //Récupération du Repo de l'entité Tabs
        $tabs = $repo->findBy(['idUserCreate' => $nom]);    //Utilisation de findBy pour retrouver toute les données en base crée par l'utilisateur connecté
        $isGranted = $this->isGranted('ROLE_ADMIN');
        if ($isGranted == true)
        {
        $tabs = $repo->findAll();
        }
        return $this->render('tabs/index.html.twig', [ //Création de la vue qui reçois les tableau
            'controller_name' => 'TabsController', 'tabs' => $tabs
        ]);

    }

    //Fonction SHOW

    /**
     * @Route("/tabs/{id}", name="app_tabs_show")
     */
    public function show(Tabs $tabs, EntityManagerInterface $em, Request $request): Response
    {
        //récupération de l'id contenu dans "_route_params"
        $id = $request->get('_route_params'); //récuperation du paramètre route qui contient l'id du tableau
        foreach ($id as $value) //Boucle pour la Récupération de la valeur du paramètre
            $idR = $value;
        $repoProduit = $em->getRepository('App\Entity\Produit');
        $prod = $repoProduit->findby(array('idTabs' => $idR)); //recherche de tout les produit ayant comme iD le tableau recherché
        return $this->render('produit/show.html.twig', compact('tabs', 'prod'));
    }

    //Fonction pour la création des tableau

    /**
     * @Route ("/createTabs", name="app_new_tabs")
     */
    public function create(Request $request, EntityManagerInterface $em): Response
    {
        //Déclaration de mon formulaire de création du tableau
        $tabs = new Tabs();
        $form = $this->createFormBuilder($tabs) //Création du formulaire correspondant à l'entité tabs
        ->add('libelle', null, ['attr' => ['autofocus' => true]])
            ->add('description')
            ->getForm();
        //Récupération des saisie
        $form->handleRequest($request);

        //Si le form est envoyé et valide alors on envoie en base de donnée et on affiche la vue des tableau
        if ($form->isSubmitted() && $form->isValid()) {
            $session = new Session;
            $nom = $session->get('_security.last_username');//Récupération de la variable session qui contient l'username
            $tabs->setIdUserCreate($nom); //Utilisation du setteur afin de mettre l'username avec le tableau
            $em->persist($tabs); //Utilisation du EntityManager afin de persister le $tabs
            $em->flush(); //Flush sers à envoyer en base de donnée

            $repo = $em->getRepository('App\Entity\Tabs');
            $tabs = $repo->findBy(['idUserCreate' => $nom]);
            return $this->render('tabs/index.html.twig', ['tabs' => $tabs]);
        }
        //Sinon on renvoie à la création du formulaire
        return $this->render('tabs/create.html.twig', ['form' => $form->createView()]);
    }


    /**
     * @Route ("/deleteTabs/{idTabs}", name="app_delete_tabs")
     */
    public function deleteTabs(EntityManagerInterface $em, $idTabs)
    {
        $tabs = $em->getRepository('App\Entity\Tabs');
        $tabs = $tabs->find($idTabs);

        $em->remove($tabs);
        $em->flush();

        return $this->redirectToRoute('app_tabs', ['id' => $idTabs]);
    }


}

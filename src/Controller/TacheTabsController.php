<?php

namespace App\Controller;

use App\Entity\Tabs;
use App\Entity\Taches;
use App\Form\TachesType;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class TacheTabsController extends AbstractController
{
    /**
     * @Route("/tache/tabs/{id}", name="app_tache_index")
     */
    public function show(Tabs $tabs, EntityManagerInterface $em, $id): Response
    {
        $repoTache = $em->getRepository('App\Entity\Taches');
        $taches = $repoTache->findBy(array('idTabs' => $id));
        return $this->render('tache_tabs/index.html.twig', compact('tabs', 'taches'));
    }

    /**
     * @Route("/tache/create/{idTabs}", name="app_new_tache")
     */
    public function create(Request $request, EntityManagerInterface $em, $idTabs): Response
    {
        $tache = new Taches();
        $form = $this->createForm(TachesType::class, $tache);
        $form->handleRequest($request);

        if($form->isSubmitted() && $form->isValid()){
            $tache->setIdTabs($idTabs);
            $em->persist($tache);
            $em->flush();
            return $this->redirectToRoute('app_tache_index', ['id' => $idTabs]);
        }

        return $this->render('tache_tabs/create.html.twig', ['form' => $form->createView()]);
    }
}

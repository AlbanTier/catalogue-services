<?php

namespace App\Controller;

use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class AdminController extends AbstractController
{
    /**
     * @Route("/admin", name="app_home_admin")
     */
    public function index(): Response
    {
        return $this->render('admin/index.html.twig', [
            'controller_name' => 'AdminController',
        ]);
    }

    /**
     * @Route("/admin/users", name="app_users_admin")
     */
    public function gestionUsers(EntityManagerInterface $em): Response
    {
        $user = $em->getRepository('App\Entity\User');
        $user = $user->findAll();
        return $this->render('admin/users.html.twig', compact('user'));
    }

    /**
     * @Route("/admin/tabs", name="app_tabs_admin")
     */
    public function gestionTabs(): Response
    {
        return $this->render('admin/tabs.html.twig', [
            'controller_name' => 'AdminController',
        ]);
    }
}

<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

class MainController extends AbstractController
{
    #[Route('/', name: 'main_home')]
    public function index(): Response
    {
        return $this->render('main/index.html.twig', [

        ]);
    }

    #[Route('/aboutUs', name: 'main_aboutUs')]
    public function AboutUs(): Response
    {
        return $this->render('main/aboutUs.html.twig', [

        ]);
    }

}

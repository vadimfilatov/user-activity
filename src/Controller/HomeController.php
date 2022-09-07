<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

class HomeController extends AbstractController
{
    #[Route('/', name: 'home', methods: ['GET'])]
    public function index()
    {

        if(!$this->getUser()) {
            return $this->redirect("/login");
        }

        return $this->render("home.html.twig");
    }
}
<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use App\Repository\EtatOuvertureGarageRepository;


class BaseHTMLController extends AbstractController
{
    #[Route('/base', name: 'app_base')]
    public function index(EtatOuvertureGarageRepository $repo): Response
    {
         $etatOuverture = $repo->find(1);
         $isOpen = $etatOuverture->isIsOpen();
        return $this->render('base.html.twig', [
            'isOpen' => $isOpen
        ]);
    }
}

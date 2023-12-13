<?php

namespace App\Controller;

use App\Repository\ReparationRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use App\Repository\EtatOuvertureGarageRepository;

class PageAccueilController extends AbstractController
{
    #[Route('/', name: 'main')]
    public function index(ReparationRepository $repo, EtatOuvertureGarageRepository $etatOuvertureGarageRepository): Response
    {
         $reparation = $repo->findAll();
      /*   $etatOuverture = $etatOuvertureGarageRepository->find(1);
        $isOpen = $etatOuverture->isIsOpen(); 
         */
        return $this->render('page_accueil/index.html.twig', [
            'controller_name' => 'PageAccueilController',
            'reparations'=> $reparation,
        ]);
    }
}

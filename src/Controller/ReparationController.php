<?php

namespace App\Controller;

use App\Entity\Reparation;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use App\Repository\ReparationRepository;
use Doctrine\ORM\EntityManagerInterface; 


class ReparationController extends AbstractController
{
    #[Route('/reparation', name: 'app_reparation')]
    public function index(ReparationRepository $repo): Response
    {
        $reparations = $repo->findAll();
        return $this->render('reparation/index.html.twig', [
            'controller_name' => 'ReparationController',
            'reparations' => $reparations
        ]);
    }
    #[Route('/reparation/add', name: 'add_reparation')]
    public function addReparation(EntityManagerInterface $entityManager): Response {
        $reparation = new Reparation();
        $reparation->setCode('3800DLO');
        $reparation->setPrixMoyen(100);
        $reparation->setNomReparation('Changement essuie glaces');

         // tell Doctrine you want to (eventually) save the Product (no queries yet)
         $entityManager->persist($reparation);

         $entityManager->flush();

         return new Response('Saved new product with id '.$reparation->getId());
    }

    #[Route('/reparation/edit/{id}', name: 'update_reparation')]
    public function updateReparation(EntityManagerInterface $entityManager,ReparationRepository $repo, int $id): Response {
        $reparation = $entityManager->getRepository(Reparation::class)->find($id);
        if (!$reparation) {
            throw $this->createNotFoundException(
                'No reparation found for id '.$id
            );
        }

        $reparation->setCode('5000DLC');
		$reparation->setprixMoyen(500);
		$reparation->setNomReparation('Reparation carrosserie entiere');
        $entityManager->flush();

        return $this->redirectToRoute('app_reparation');
        
    }
    #[Route('/reparation/delete/{id}', name: 'delete_reparation')]
    public function delete(EntityManagerInterface $entityManager, int $id): Response
    {
        $reparation = $entityManager->getRepository(Reparation::class)->find($id);

        if (!$reparation) {
            throw $this->createNotFoundException(
                'No reparation found for id '.$id
            );
        }

        $entityManager->remove($reparation);
		$entityManager->flush();

        return $this->redirectToRoute('app_reparation');
    }
}


<?php

namespace App\Controller;

use Doctrine\Persistence\ManagerRegistry;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Request;
use App\Form\VehiculeType;
use App\Entity\Vehicule;
use App\Repository\VehiculeRepository;
use Doctrine\ORM\EntityManagerInterface;
use App\Entity\Demande;
use App\Repository\DemandeRepository;

class VehiculeController extends AbstractController
{
    #[Route('/vehicule', name: 'app_vehicule')]
    public function index(VehiculeRepository $vehiculeRepository): Response
    {
        $vehicules = $vehiculeRepository->findAll();
        return $this->render('vehicule/index.html.twig', [
            'controller_name' => 'VehiculeController',
            'vehicules'=> $vehicules
        ]);
    }

    #[Route('/vehicule/new', name: 'vehicule_create')]
    public function addVehicule(Request $request, ManagerRegistry $doctrine)
    {
        $this->denyAccessUnlessGranted('ROLE_EMPLOYEE');
        $manager = $doctrine->getManager();
        $vehicule = new Vehicule();
        $form = $this->createForm(VehiculeType::class);
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            // Récupérons les données du véhicule créé dans le create form.
            $vehicule = $form->getData();
            $manager->persist($vehicule);
            $manager->flush();
            return $this->render('vehicule/show.html.twig', 
            ['vehicule' => $vehicule]);
        }
        return $this->render('vehicule/create.html.twig' , [
            'formVehicule' => $form->createView(),
            'isEditMode' => false

        ]);
       
    }

    #[Route('/vehicule/edit/{id}', name: 'vehicule_edit')]
    public function editVehicule(Vehicule $vehicule, Request $request, ManagerRegistry $doctrine) {
         $this->denyAccessUnlessGranted('ROLE_EMPLOYEE');
        $manager = $doctrine->getManager();
        $form = $this->createForm(VehiculeType::class, $vehicule);
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            // Récupérons les données du véhicule créé dans le create form.
            $vehiculeData = $form->getData();
            $manager->persist($vehiculeData);
            $manager->flush();
            return $this->render('vehicule/show.html.twig', 
            ['vehicule' => $vehicule]);
        }
        return $this->render('vehicule/create.html.twig' , [
            'formVehicule' => $form->createView(),
            'isEditMode' => $vehicule->getId() !== null
        ]);
        
    }

    #[Route('/vehicule/delete/{id}', name: 'vehicule_delete')]
    public function deleteVehicule(EntityManagerInterface $entityManager, DemandeRepository $demandeRepository, int $id)
    {
        $this->denyAccessUnlessGranted('ROLE_EMPLOYEE');
       $demandes = $demandeRepository->findAll();
       foreach ($demandes as $demande) {
            if ($demande->getVehicule()->getId() === $id) {
                $entityManager->remove($demande);
                $entityManager->flush();
            }

       }
        
        $vehicule = $entityManager->getRepository(Vehicule::class)->find($id);

        if (!$vehicule) {
            throw $this->createNotFoundException(
                'No vehicule found for id '.$id
            );
        }
        $entityManager->remove($vehicule);
        $entityManager->flush();
        return $this->render('vehicule/index.html.twig', [
            'controller_name' => 'VehiculeController'
        ]);
                    
    }
}



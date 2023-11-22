<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use App\Repository\AvisRepository;
use Doctrine\Persistence\ManagerRegistry;
use Symfony\Component\HttpFoundation\Request;

use Doctrine\ORM\EntityManagerInterface;
use App\Entity\Avis;
use App\Form\AvisType;

class AvisController extends AbstractController
{
    #[Route('/avis', name: 'app_avis')]
    public function index(AvisRepository $repo): Response
    {
        $avis = $repo->findAll();
        return $this->render('avis/index.html.twig', [
            'controller_name' => 'AvisController',
        ]);
    }

    #[Route('/avis/new', name: 'avis_create')]
    #[Route('/avis/edit/{id}', name: 'avis_edit')]
    public function form(Avis $avis = null, Request $request, ManagerRegistry $doctrine) 
    {
        // $this->denyAccessUnlessGranted('AVIS_ADD_EDIT', $avis);

        $manager = $doctrine->getManager();
        if (!$avis){
            $avis = new Avis();
       }
      /*  $form = $this->createFormBuilder($avis)
        ->add('title')
        ->add('content')
        ->add('image')
        ->getForm(); */
        $form = $this->createForm(AvisType::class, $avis);

        $form->handleRequest($request);
        if($form->isSubmitted() && $form->isValid()) {
            
            $manager->persist($avis);
            $manager->flush();
            return $this->render('avis/show.html.twig', 
            ['avis' => $avis]);
        }
        return $this->render('avis/create.html.twig' , [
            'formAvis' => $form->createView(),
            'isEditMode' => $avis->getId() !== null
        ]);
    }

    #[Route('/avis/delete/{id}', name: 'avis_delete')]
    public function deleteAvis(EntityManagerInterface $entityManager, int $id)
    {
        //On vérifie si l'utilisateur peut supprimer avec le Voter
        $this->denyAccessUnlessGranted('ROLE_ADMIN');


        $avis = $entityManager->getRepository(Avis::class)->find($id);

        if (!$avis) {
            throw $this->createNotFoundException(
                'No avis found for id '.$id
            );
        }
        $entityManager->remove($avis);
        $entityManager->flush();
        return $this->render('avis/index.html.twig', [
            'controller_name' => 'AvisController'
        ]);
                    
    }
    

    #[Route('/avis/{id}', name: 'avis_show')]
    public function show(AvisRepository $repo, $id): Response
    {
        $avis = $repo->find($id);
        return $this->render('avis/show.html.twig', [
            'controller_name' => 'AvisController',
            'avis' => $avis
        ]);
    }

    
}

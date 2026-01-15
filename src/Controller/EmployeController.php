<?php

namespace App\Controller;

use App\Entity\Employe;
use App\Form\EmployeType;
use App\Repository\EmployeRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

final class EmployeController extends AbstractController
{
    #[Route('/employe', name: 'app_employe')]
    public function index(EmployeRepository $employeRepository): Response
    {
        $employes = $employeRepository->findBy([], ['nom' => 'ASC']);

        return $this->render('employe/show.html.twig', [
            'employes' => $employes,
            'page_title' => 'Équipe',
        ]);
    }

    #[Route('/employe/{id}', name: 'app_employe_edit')]
    public function edit(Employe $employe, Request $request, EntityManagerInterface $entityManager): Response{
        $form = $this->createForm(EmployeType::class, $employe);
        $form->handleRequest($request);

        if($form->isSubmitted() && $form->isValid()){
            $entityManager->flush();

            $this->addFlash('success', 'Les informations de ' . $employe->getPrenom() . ' ont été mises à jours.');
            return $this->redirectToRoute('app_employe');
        }

        return $this->render('employe/edit.html.twig', [
            'employeForm' => $form->createView(),
            'employe' => $employe,
            'page_title' => $employe->getPrenom() . ' ' .$employe->getNom(),
        ]);
    }

    #[Route('/employe/{id}/delete', name: 'app_employe_delete', methods: ['POST'])]
    public function delete(Employe $employe, EntityManagerInterface $entityManager): Response
    {
        $nomComplet = $employe->getPrenom() . ' ' . $employe->getNom();
        
        $entityManager->remove($employe);
        $entityManager->flush();
        
        $this->addFlash('success', "L'employé {$nomComplet} a été supprimé.");
        return $this->redirectToRoute('app_employe');
    }
}

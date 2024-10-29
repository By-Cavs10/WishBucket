<?php

namespace App\Controller;

use App\Entity\User;
use App\Entity\Wish;
use App\Form\WishFormType;
use App\Repository\WishRepository;
use Doctrine\ORM\EntityManagerInterface;
use phpDocumentor\Reflection\Types\True_;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Bundle\SecurityBundle\Security;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

#[Route('/wish', name: 'wish')]
class WishController extends AbstractController
{
    #[Route('/list', name: '_list')]
    public function list(WishRepository $wishRepository): Response
    {

        //Custom via repository
//        $wishes = $wishRepository->findAllByDateCreatedDESC();

        //Generique
        $wishes = $wishRepository->findBy(['isPublished' => true], ['dateCreated' => 'DESC']);
        return $this->render('wish/index.html.twig', [
            'wishes' => $wishes
        ]);
    }

    #[Route('/detail/{id}', name: '_detail', requirements: ['id' => '\d+'])]
    public function detail(Wish $wish): Response
    {
        return $this->render('wish/detail.html.twig', [
            'wish' => $wish,

        ]);
    }

    #[Route('/edit', name: '_edit')]
    public function create(Request $request,  EntityManagerInterface $em): Response
    {
        $wish = new Wish();
        $form = $this->createForm(WishFormType::class, $wish);
        $form->handleRequest($request);

        if ($form->isSubmitted()) {
            $em->persist($wish);
            $em->flush();
            $wish->setPublished(true);
            $this->addFlash('sucess', 'bravo pelo nouveau voeux sur le web');
            return $this->redirectToRoute('wish_list');
        }

        return $this->render('wish/edit.html.twig', [
            'form' => $form,
        ]);


    }

    #[Route('/update/{id}', name: '_update', requirements: ['id' => '\d+'])]
    public function update(Request $request, EntityManagerInterface $em, Wish $wish): Response
    {
        $form = $this->createForm(WishFormType::class, $wish);
        $form->handleRequest($request);

        if ($form->isSubmitted()) {
            $em->flush();

            $this->addFlash('success', 'Le voeux a été modifiée avec succès !');
            return $this->redirectToRoute('wish_list');
        }

        return $this->render('wish/edit.html.twig', [
            'form' => $form,
        ]);
    }

    #[Route('/delete/{id}', name: '_delete', requirements: ['id' => '\d+'])]
    public function delete(Wish $wish, EntityManagerInterface $em, Request $request): Response
    {
        if ($this->isCsrfTokenValid('delete'.$wish->getId(), $request->get('token'))) {
            $em->remove($wish);
            $em->flush();

            $this->addFlash('success', 'Le voeux a été supprimée');
        } else {
            $this->addFlash('danger', 'Pas possible de supprimer! ');
        }
        return $this->redirectToRoute('wish_list');

    }


}

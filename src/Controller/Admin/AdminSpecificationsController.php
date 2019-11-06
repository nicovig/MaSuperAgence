<?php

namespace App\Controller\Admin;

use App\Entity\Specifications;
use App\Form\SpecificationsType;
use App\Repository\SpecificationsRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/admin/specifications")
 */
class AdminSpecificationsController extends AbstractController
{
    /**
     * @Route("/", name="admin.specifications.index", methods={"GET"})
     */
    public function index(SpecificationsRepository $specificationsRepository): Response
    {
        return $this->render('admin/specifications/index.html.twig', [
            'specifications' => $specificationsRepository->findAll(),
        ]);
    }

    /**
     * @Route("/new", name="admin.specifications.new", methods={"GET","POST"})
     */
    public function new(Request $request): Response
    {
        $specification = new Specifications();
        $form = $this->createForm(SpecificationsType::class, $specification);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($specification);
            $entityManager->flush();

            return $this->redirectToRoute('admin.specifications.index');
        }

        return $this->render('admin/specifications/new.html.twig', [
            'specification' => $specification,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}/edit", name="admin.specifications.edit", methods={"GET","POST"})
     */
    public function edit(Request $request, Specifications $specification): Response
    {
        $form = $this->createForm(SpecificationsType::class, $specification);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('admin.specifications.index');
        }

        return $this->render('admin/specifications/edit.html.twig', [
            'specification' => $specification,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="admin.specifications.delete", methods={"DELETE"})
     */
    public function delete(Request $request, Specifications $specification): Response
    {
        if ($this->isCsrfTokenValid('specification/delete'.$specification->getId(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($specification);
            $entityManager->flush();
        }

        return $this->redirectToRoute('admin.specifications.index');
    }
}

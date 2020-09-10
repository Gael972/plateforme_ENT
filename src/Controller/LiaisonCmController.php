<?php

namespace App\Controller;

use App\Entity\LiaisonCm;
use App\Form\LiaisonCmType;
use App\Repository\LiaisonCmRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/liaison/cm")
 */
class LiaisonCmController extends AbstractController
{
    /**
     * @Route("/", name="liaison_cm_index", methods={"GET"})
     */
    public function index(LiaisonCmRepository $liaisonCmRepository): Response
    {
        return $this->render('liaison_cm/index.html.twig', [
            'liaison_cms' => $liaisonCmRepository->findAll(),
        ]);
    }

    /**
     * @Route("/new", name="liaison_cm_new", methods={"GET","POST"})
     */
    public function new(Request $request): Response
    {
        $liaisonCm = new LiaisonCm();
        $form = $this->createForm(LiaisonCmType::class, $liaisonCm);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($liaisonCm);
            $entityManager->flush();

            return $this->redirectToRoute('liaison_cm_index');
        }

        return $this->render('liaison_cm/new.html.twig', [
            'liaison_cm' => $liaisonCm,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="liaison_cm_show", methods={"GET"})
     */
    public function show(LiaisonCm $liaisonCm): Response
    {
        return $this->render('liaison_cm/show.html.twig', [
            'liaison_cm' => $liaisonCm,
        ]);
    }

    /**
     * @Route("/{id}/edit", name="liaison_cm_edit", methods={"GET","POST"})
     */
    public function edit(Request $request, LiaisonCm $liaisonCm): Response
    {
        $form = $this->createForm(LiaisonCmType::class, $liaisonCm);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('liaison_cm_index');
        }

        return $this->render('liaison_cm/edit.html.twig', [
            'liaison_cm' => $liaisonCm,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="liaison_cm_delete", methods={"DELETE"})
     */
    public function delete(Request $request, LiaisonCm $liaisonCm): Response
    {
        if ($this->isCsrfTokenValid('delete'.$liaisonCm->getId(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($liaisonCm);
            $entityManager->flush();
        }

        return $this->redirectToRoute('liaison_cm_index');
    }
}

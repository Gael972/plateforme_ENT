<?php

namespace App\Controller;

use App\Entity\Cursus;
use App\Form\CursusType;
use App\Repository\CursusRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/cursus")
 */
class CursusController extends AbstractController
{
    /**
     * @Route("/", name="cursus_index", methods={"GET"})
     */
    public function index(CursusRepository $cursusRepository): Response
    {
        return $this->render('cursus/index.html.twig', [
            'cursuses' => $cursusRepository->findAll(),
        ]);
    }

    /**
     * @Route("/new", name="cursus_new", methods={"GET","POST"})
     */
    public function new(Request $request): Response
    {
        $cursus = new Cursus();
        $form = $this->createForm(CursusType::class, $cursus);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($cursus);
            $entityManager->flush();

            return $this->redirectToRoute('cursus_index');
        }

        return $this->render('cursus/new.html.twig', [
            'cursus' => $cursus,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="cursus_show", methods={"GET"})
     */
    public function show(Cursus $cursus): Response
    {
        return $this->render('cursus/show.html.twig', [
            'cursus' => $cursus,
        ]);
    }

    /**
     * @Route("/{id}/edit", name="cursus_edit", methods={"GET","POST"})
     */
    public function edit(Request $request, Cursus $cursus): Response
    {
        $form = $this->createForm(CursusType::class, $cursus);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('cursus_index');
        }

        return $this->render('cursus/edit.html.twig', [
            'cursus' => $cursus,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="cursus_delete", methods={"DELETE"})
     */
    public function delete(Request $request, Cursus $cursus): Response
    {
        if ($this->isCsrfTokenValid('delete'.$cursus->getId(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($cursus);
            $entityManager->flush();
        }

        return $this->redirectToRoute('cursus_index');
    }
}

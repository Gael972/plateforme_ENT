<?php

namespace App\Controller;

use App\Entity\NoteTypeDevoir;
use App\Form\NoteTypeDevoirType;
use App\Repository\NoteTypeDevoirRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/note/type/devoir")
 */
class NoteTypeDevoirController extends AbstractController
{
    /**
     * @Route("/", name="note_type_devoir_index", methods={"GET"})
     */
    public function index(NoteTypeDevoirRepository $noteTypeDevoirRepository): Response
    {
        return $this->render('note_type_devoir/index.html.twig', [
            'note_type_devoirs' => $noteTypeDevoirRepository->findAll(),
        ]);
    }

    /**
     * @Route("/new", name="note_type_devoir_new", methods={"GET","POST"})
     */
    public function new(Request $request): Response
    {
        $noteTypeDevoir = new NoteTypeDevoir();
        $form = $this->createForm(NoteTypeDevoirType::class, $noteTypeDevoir);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($noteTypeDevoir);
            $entityManager->flush();

            return $this->redirectToRoute('note_type_devoir_index');
        }

        return $this->render('note_type_devoir/new.html.twig', [
            'note_type_devoir' => $noteTypeDevoir,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="note_type_devoir_show", methods={"GET"})
     */
    public function show(NoteTypeDevoir $noteTypeDevoir): Response
    {
        return $this->render('note_type_devoir/show.html.twig', [
            'note_type_devoir' => $noteTypeDevoir,
        ]);
    }

    /**
     * @Route("/{id}/edit", name="note_type_devoir_edit", methods={"GET","POST"})
     */
    public function edit(Request $request, NoteTypeDevoir $noteTypeDevoir): Response
    {
        $form = $this->createForm(NoteTypeDevoirType::class, $noteTypeDevoir);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('note_type_devoir_index');
        }

        return $this->render('note_type_devoir/edit.html.twig', [
            'note_type_devoir' => $noteTypeDevoir,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="note_type_devoir_delete", methods={"DELETE"})
     */
    public function delete(Request $request, NoteTypeDevoir $noteTypeDevoir): Response
    {
        if ($this->isCsrfTokenValid('delete'.$noteTypeDevoir->getId(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($noteTypeDevoir);
            $entityManager->flush();
        }

        return $this->redirectToRoute('note_type_devoir_index');
    }
}

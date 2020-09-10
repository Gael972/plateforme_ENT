<?php

namespace App\Controller;

use App\Entity\NoteDevoir;
use App\Form\NoteDevoirType;
use App\Repository\NoteDevoirRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/note/devoir")
 */
class NoteDevoirController extends AbstractController
{
    /**
     * @Route("/", name="note_devoir_index", methods={"GET"})
     */
    public function index(NoteDevoirRepository $noteDevoirRepository): Response
    {
        return $this->render('note_devoir/index.html.twig', [
            'note_devoirs' => $noteDevoirRepository->findAll(),
        ]);
    }

    /**
     * @Route("/new", name="note_devoir_new", methods={"GET","POST"})
     */
    public function new(Request $request): Response
    {
        $noteDevoir = new NoteDevoir();
        $form = $this->createForm(NoteDevoirType::class, $noteDevoir);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($noteDevoir);
            $entityManager->flush();

            return $this->redirectToRoute('note_devoir_index');
        }

        return $this->render('note_devoir/new.html.twig', [
            'note_devoir' => $noteDevoir,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="note_devoir_show", methods={"GET"})
     */
    public function show(NoteDevoir $noteDevoir): Response
    {
        return $this->render('note_devoir/show.html.twig', [
            'note_devoir' => $noteDevoir,
        ]);
    }

    /**
     * @Route("/{id}/edit", name="note_devoir_edit", methods={"GET","POST"})
     */
    public function edit(Request $request, NoteDevoir $noteDevoir): Response
    {
        $form = $this->createForm(NoteDevoirType::class, $noteDevoir);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('note_devoir_index');
        }

        return $this->render('note_devoir/edit.html.twig', [
            'note_devoir' => $noteDevoir,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="note_devoir_delete", methods={"DELETE"})
     */
    public function delete(Request $request, NoteDevoir $noteDevoir): Response
    {
        if ($this->isCsrfTokenValid('delete'.$noteDevoir->getId(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($noteDevoir);
            $entityManager->flush();
        }

        return $this->redirectToRoute('note_devoir_index');
    }
}

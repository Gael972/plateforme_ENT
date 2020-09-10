<?php

namespace App\Controller;

use App\Entity\NoteMatiere;
use App\Form\NoteMatiereType;
use App\Repository\NoteMatiereRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/note/matiere")
 */
class NoteMatiereController extends AbstractController
{
    /**
     * @Route("/", name="note_matiere_index", methods={"GET"})
     */
    public function index(NoteMatiereRepository $noteMatiereRepository): Response
    {
        return $this->render('note_matiere/index.html.twig', [
            'note_matieres' => $noteMatiereRepository->findAll(),
        ]);
    }

    /**
     * @Route("/new", name="note_matiere_new", methods={"GET","POST"})
     */
    public function new(Request $request): Response
    {
        $noteMatiere = new NoteMatiere();
        $form = $this->createForm(NoteMatiereType::class, $noteMatiere);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($noteMatiere);
            $entityManager->flush();

            return $this->redirectToRoute('note_matiere_index');
        }

        return $this->render('note_matiere/new.html.twig', [
            'note_matiere' => $noteMatiere,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="note_matiere_show", methods={"GET"})
     */
    public function show(NoteMatiere $noteMatiere): Response
    {
        return $this->render('note_matiere/show.html.twig', [
            'note_matiere' => $noteMatiere,
        ]);
    }

    /**
     * @Route("/{id}/edit", name="note_matiere_edit", methods={"GET","POST"})
     */
    public function edit(Request $request, NoteMatiere $noteMatiere): Response
    {
        $form = $this->createForm(NoteMatiereType::class, $noteMatiere);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('note_matiere_index');
        }

        return $this->render('note_matiere/edit.html.twig', [
            'note_matiere' => $noteMatiere,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="note_matiere_delete", methods={"DELETE"})
     */
    public function delete(Request $request, NoteMatiere $noteMatiere): Response
    {
        if ($this->isCsrfTokenValid('delete'.$noteMatiere->getId(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($noteMatiere);
            $entityManager->flush();
        }

        return $this->redirectToRoute('note_matiere_index');
    }
}

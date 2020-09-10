<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Request;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Response;
use App\Repository\StatutRepository;
use App\Entity\Membre;
use App\Entity\Statut;
use App\Entity\Ticket;

class TicketController extends AbstractController
{
    /**
     * @Route("/ticket", name="ticket")
     */
    public function index()
    {
        return $this->render('ticket/index.html.twig', [
            'controller_name' => 'TicketController',
        ]);
    }
	/**
	 * @Route("/ticketNew", name="ticket_new")
     */
    public function ticketNew( Request $request, EntityManagerInterface $manager)
    {
	
		//On démarre la session_cache_expire// on démarre les variables de session
		$sess = $request->getSession();
		//On teste la sécurité
		if($sess->get('roleUtilisateur')==1 || $sess->get('roleUtilisateur')==2 ){
			if(($sess->get('ticketReponse'))!= NULL){
				//on récupère le ticket de départ et on le met à jour
				$ticketDepart = $manager->getRepository(Ticket::class)->findOneById($sess->get('ticketReponse'));
				return $this->render('ticket/ticketNew.html.twig', [
					'ticketDepart' => $ticketDepart,
					'reponse' => true
				]);
			}else{
				//On récupère tous les membres
				$oUsers = $manager->getRepository(Membre::class)->findAll();
		
        return $this->render('ticket/ticketNew.html.twig', [
            'users' => $oUsers,
            'reponse' => false
		]);
			}
		}else{
			return $this->redirect("/logout");
		}
	}

    public function ticketAjout(Request $request, EntityManagerInterface $manager, StatutRepository $statutC)
    {
		//On démarre la session_cache_expire// on démarre les variables de session
		$sess = $request->getSession();
		//On teste la sécurité
		if($sess->get('roleUtilisateur')==1 || $sess->get('roleUtilisateur')==2 ){
			//On récupère les données du formulaires
			//on instancie un nouvel objet de type ticket 
			$ticket = new Ticket($statutC);
			$ticket->setMembreExp($manager->getRepository(Membre::class)->findOneById($sess->get('idUtilisateur')));
			$ticket->setMembreDest($manager->getRepository(Membre::class)->findOneById($request->request->get("destinataire")));
			$ticket->setTitre($request->request->get("titre"));
			$ticket->setContenu($request->request->get("content"));
			//tester si il s'agit d'une réponse ou pas.
			//si il s'agit d'une réponse 1) la variable de session "ticketReponse" ne doit pas être NULL 2)il faut mettre à jour le champ ticket du ticket auquel on répond.
			if(($sess->get('ticketReponse'))!= NULL){
				//on récupère le ticket de départ et on le met à jour
				$ticketDepart = $manager->getRepository(Ticket::class)->findOneById($sess->get('ticketReponse'));
				$ticketDepart->setStatut($manager->getRepository(Statut::class)->findOneById(3));
				$manager->persist($ticketDepart);
				$manager->flush();
				$sess->set("ticketReponse", NULL);
				//le ticket en cours de création doit être lié au ticket de départ
				$ticket->setTicket($ticketDepart);
			}
			//on déclare des attributs
			
			// on créé l'objet
			$manager->persist($ticket);
            $manager->flush();
			
		
        return $this->redirect('/ticketList');
		}else{
			return $this->redirect("/logout");
		}
	}

    /**
     * @Route("/ticketList", name="ticket_list", methods={"GET"})
     */
    public function ticketList(Request $request, EntityManagerInterface $manager): Response
    {
		$sess = $request->getSession();
		//On teste la sécurité
		if($sess->get('roleUtilisateur')==1 || $sess->get('roleUtilisateur')==2 ) {
			//on récupère les messages en réception
			$oTicketDest = $manager->getRepository(Ticket::class)->ticketGenerique($sess->get('idUtilisateur'), 1);
			//on récupère les messages en envoi
			$oTicketExp = $manager->getRepository(Ticket::class)->
			ticketGenerique($sess->get('idUtilisateur'), 2);
			//on récupère les tickets de l'utilisateur supprimé
			$oTicketSuppr = $manager->getRepository(Ticket::class)->
			ticketGenerique($sess->get('idUtilisateur'), 3);
			return $this->render('ticket/ticketList.html.twig', [
				'tickets' => $oTicketDest,
				'ticketsExp' => $oTicketExp,
				'ticketsSuppr' => $oTicketSuppr,
			]);
    	}else{
			return $this->redirect("/logout");
		}
	}

    /**
     * @Route("/ticketShow/{id}", name="ticket_show")
     */
    public function ticketShow(Ticket $ticket, EntityManagerInterface $manager): Response
    {
		//mise à jour de la date de lecture.
		$ticket->setLecture(new \Datetime);
		$manager->persist($ticket);
        $manager->flush();
		
        return $this->render('ticket/ticketShow.html.twig', [
			'ticket' => $ticket
			
        ]);
    }
	/**
	 * @Route("/ticketReponse/{id}", name="ticket_reponse")
     */
    public function ticketReponse(Ticket $ticket, Request $request, EntityManagerInterface $manager)
    {
	
		//On démarre la session_cache_expire// on démarre les variables de session
		$sess = $request->getSession();
		//On teste la sécurité
		if($sess->get('roleUtilisateur')==1 || $sess->get('roleUtilisateur')==2 ){
			//on met l'id du ticket en variablme de session
			$sess->set("ticketReponse", $ticket->getId());
		
        return $this->redirectToRoute("ticket_new");
		}else{
			echo "toto";
		}
	}

    /**
     * @Route("/ticketDelete/{id}", name="ticket_delete")
     */
    public function ticketDelete(Request $request, Ticket $ticket, EntityManagerInterface $manager)
    {
		$sess = $request->getSession();
		//On teste la sécurité
		if($sess->get('roleUtilisateur')==1 || $sess->get('roleUtilisateur')==2 ){
			//On récupère les données du formulaires
			//on instancie un nouvel objet de type ticket 
			$ticket->setStatut($manager->getRepository(Statut::class)->findOneById(4));
			$manager->persist($ticket);
			$manager->flush();
		}	
        return $this->redirectToRoute('ticket_list');
	}
   
}

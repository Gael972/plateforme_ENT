<?php

namespace App\Controller;

use App\Entity\Membre;
use App\Entity\NoteMatiere;
use App\Entity\NoteDevoir;
use App\Entity\LiaisonCm;
use App\Entity\NoteLiaison;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\JsonResponse;

class NoteController extends AbstractController
{
    /**
     * @Route("/getUtilisateursByIndexChoix", name="recup")
     */
    public function getUtilisateursByIndexChoix(Request $request, EntityManagerInterface $manager)
    {
		//Récupération de l'id Devoir
		$idDevoir= $request->request->get("idChoix");
		//Récupération de la classe 
		$classe = $manager->getRepository(NoteDevoir::class)->findOneById($idDevoir);
		//Récupération d'un tableau d'eleve
		$listeEleve = $manager->getRepository(LiaisonCm::class)->findByClasse($classe->getClasse());

		$liaisonNote = $manager->getRepository(NoteLiaison::class)->findOneByDevoir($idDevoir);

		$reponseEleve = [];
		foreach($listeEleve as $val){
			$liaisonNote = $manager->getRepository(NoteLiaison::class)->findOneBy(["devoir"=> $idDevoir, "eleve" => $val->getMembre()->getId()]);
			if ($liaisonNote){
				$note = $liaisonNote->getNote();
			}else{
				$note = 'note à saisir';
			}
			
			$tmp = array("id" => $val->getMembre()->getId(),
                        "nom" => $val->getMembre()->getNom(),
                        "prenom" => $val->getMembre()->getPrenom(),
						"devoir" => $idDevoir,
						"noteDevoir" => $note, 
                        "classe" => $val->getClasse()->getId());
			$reponseEleve[] = $tmp ;
		}
		$repEleve = json_encode($reponseEleve);
		
        return new JsonResponse($repEleve);
    }
	/**
     * @Route("/note", name="note")
     */
    public function index()
    {
        return $this->render('note/index.html.twig', [
            'controller_name' => 'NoteController',
        ]);
    }

    /**
     * @Route("/noteInsertion", name="note_insertion")
     */
    public function insertion(Request $request, EntityManagerInterface $manager)
    {
		$sess = $request->getSession();
		//On récupère les informations de l'utilisateur connecté
		$oUser = $manager->getRepository(Membre::class)->findOneById($sess->get('idUtilisateur'));
		//On initialise un tableau de devoirs
		$aDevoir = Array();
		//récupérer la liste de ses devoirs.
		$aMatieres = $manager->getRepository(NoteMatiere::class)->findByFormateur($sess->get('idUtilisateur'));
		foreach($aMatieres as $item){
			if($devoir = $manager->getRepository(NoteDevoir::class)->findOneByMatiere($item)){
				$aDevoir[] = $devoir ;
			}
			
			
		}
		dump($aDevoir);
		return $this->render('note/insertion.html.twig', [
            'listeDevoirs' => $aDevoir,
        ]);
    }

    /**
     * @Route("/enregistrerNotes", name="enregistrer_notes")
     */
    public function enregistrerNotes(Request $request, EntityManagerInterface $manager)
    {
		$idDevoir= $request->request->get("idDevoir");
		$idEleve= $request->request->get("idEleve");
		$note= $request->request->get("note");
		// $rep = $idDevoir.' '.$idEleve.' '.$note ;
		//Action
		$aLiaison = $manager->getRepository(NoteLiaison::class)->findOneBy(["devoir"=>$idDevoir, "eleve"=>$idEleve]);
		if($aLiaison){
			$rep []= $aLiaison->getNote();
			$aLiaison->setNote($note);	
		}else{
			$aLiaison = new NoteLiaison();
			$aLiaison->setNote($note);
			$aLiaison->setDevoir($manager->getRepository(NoteDevoir::class)->findOneById($idDevoir));
			$aLiaison->setEleve($manager->getRepository(Membre::class)->findOneById($idEleve));
		}
		$manager->persist($aLiaison);
        $manager->flush();
		
        $repNote = json_encode($rep);
        return new jsonResponse($repNote);
    }

}
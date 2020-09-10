<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Request;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Response;
use App\Entity\Membre;
use App\Entity\Cv;

class DashBoardController extends AbstractController
{
    /**
     * @Route("/dashboard", name="dash_board")
     */
    public function dashboard(Request $request, EntityManagerInterface $manager)
    {
		// on démarre les variables de session
			$sess = $request->getSession();
			if($sess->get('roleUtilisateur')==1 || $sess->get('roleUtilisateur')==2 ){
				
				//On récupère les informations de l'utilisateur connecté
				$oUser = $manager->getRepository(Membre::class)->findOneById($sess->get('idUtilisateur'));
				return $this->render('dash_board/index.html.twig', [
					'userConnecte' => $oUser,
				]);
			}else{
				return new Response("tu n'as pas le droit de te connecter");
			}
    }
	/**
     * @Route("/profil", name="profil")
     */
    public function profil(Request $request, EntityManagerInterface $manager)
    {
		// on démarre les variables de session
			$sess = $request->getSession();
			if($sess->get('roleUtilisateur')==1 || $sess->get('roleUtilisateur')==2 ){
				
				//On récupère les informations de la table membre de l'utilisateur connecté
				$oUser = $manager->getRepository(Membre::class)->findOneById($sess->get('idUtilisateur'));
				//On récupère les informations de la table CV de l'utilisateur connecté
				$aCv = $manager->getRepository(Cv::class)->findByMembre($sess->get('idUtilisateur'));
				return $this->render('dash_board/profil.html.twig', [
					'userConnecte' => $oUser,
					'infoCv' => $aCv,
				]);
			}else{
				return new Response("tu n'as pas le droit de te connecter");
			}
    }
}

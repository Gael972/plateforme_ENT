<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;
use App\Entity\Membre;

class SecurityController extends AbstractController
{
    /**
     * @Route("/security", name="security")
     */
    public function index()
    {
        return $this->render('security/index.html.twig', [
            'controller_name' => 'SecurityController',
        ]);
    }
	/**
     * @Route("/connexion", name="connexion")
     */
    public function connexion(Request $request)
    {
		$sess = $request->getSession();
		dump($sess->get('roleUtilisateur'));	
        return $this->render('security/index.html.twig');
    }
	/**
     * @Route("/identification", name="identification")
     */
    public function identification(Request $request, EntityManagerInterface $manager)
    {
		//récupération des données en provenance du formulaire de la page de connexion
		$email = $request->request->get("email");
		$password = $request->request->get("password");
		//on fait une requête pour récupérer si il existe le couple identifiant mot de passe
		$aUser = $manager->getRepository(Membre::class)->findBy(["email"=>$email, "password"=>$password]);
		if (sizeof($aUser)>0){
			//on est bien connecté
			//On récupère l'objet en question
			$utilisateur = new Membre();
			$utilisateur = $aUser[0];
			// on démarre les variables de session
			$sess = $request->getSession();
			$sess->set("idUtilisateur", $utilisateur->getId());
			$sess->set("nomUtilisateur", $utilisateur->getNom());
			$sess->set("prenomUtilisateur", $utilisateur->getPrenom());
			$sess->set("roleUtilisateur", $utilisateur->getRole());
			$sess->set("avatarUtilisateur", $utilisateur->getAvatar());
			$sess->set("ticketReponse", NULL);
			return $this->redirectToRoute('dash_board'); 
		}else{
			return new Response("tu n'as pas le droit de te connecter");
		}
    }
	/**
     * @Route("/logout", name="logout")
     */
    public function logout(Request $request)
    {
		$sess = $request->getSession();
		$sess->set("idUtilisateur", null);
		$sess->set("nomUtilisateur", null);
		$sess->set("prenomUtilisateur", null);
		$sess->set("roleUtilisateur", null);
		$sess->invalidate();
        $sess->clear();
        return $this->redirect("/"); 
    }
}

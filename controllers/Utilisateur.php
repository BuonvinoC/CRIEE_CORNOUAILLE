<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Utilisateur extends CI_Controller {

	public function contenu($id){
		$this->load->helper('url_helper');
		$this->load->view('v_entete');
	switch ($id) {
		case 'catalogue':
			$this->load->model('main_model');
			$data['donnees']=$this->main_model->afficheProduits1();
			$this->load->view('v_bandeau');
			$this->load->view('v_catalogue',$data);
			break;
		case 'encherir':
			$this->load->model('main_model');
			$dataConnect = array ('prixActuel' => $this->input->post('ajoutMontant'));	
			$this->encherir($dataConnect);			
			$datas['donnees']=$this->main_model->afficheProduits2();			
			$this->load->view('v_bandeau');
			$this->load->view('v_catalogue',$datas);
			break;			
		case 'panier':
			$this->load->model('main_model');
			$data['donnees']=$this->main_model->afficheProduits1();
			$this->load->view('v_bandeau');
			$this->load->view('v_panier',$data);
			break;
		case 'admin':
			$this->load->view('v_bandeau');
			$this->load->view('v_admin');
			break;
		case 'inscription':
			$this->load->view('v_bandeau');
			$this->load->view('v_inscription');
			break;
		case 'connexion':
			$this->load->view('v_bandeau');
			$this->load->view('v_connexion');
			break;
		case 'deconnexion':
			$sessionData= array(
					'login' => $this->session->userdata('login'),
					'mdp' => $this->session->userdata('mdp'),
					'logged_in' => FALSE
				);			
			$this->session->set_userdata($sessionData);
			$this->load->view('v_bandeau');
			session_destroy();						
			break;
		case 'commentaire':
			$this->load->model('main_model');
			$data['donnees']=$this->main_model->afficheCommentaire();
			$this->load->view('v_bandeau');
			$this->load->view('v_commentaire',$data);
			break;
		default:
			$this->load->view('v_bandeau');
			$this->load->view('v_accueil');
			}
	$this->load->view('v_finPage');
		}
	
	
	public function ajout_utilisateur() {
		
  
  /**Chargement des méthodes si déclarées dans le contrôleur**/
		/*$mail=$_POST['mail'];
		$nom=$_POST['nom'];
		$prenom=$_POST['prenom'];*/
		/*$test=$mail+"bonjour";*/
		$data = array ('nomClient' => $this->input->post('nomClient'),
		'prenomClient' => $this->input->post('prenomClient'),
		'mailClient' => $this->input->post('mailClient'),
		'mdpClient' => $this->input->post('mdpClient'),
		);
	  
	  /*$this->load->model('main_model');
	  $this->main_model->InsertClient($nom,$prenom,$mail);*/
	  
	  $this->load->model('main_model');
	  $this->main_model->InsertClient($data);
	  /*$this->load->database();
	  $sql = $this->db->conn_id->prepare("INSERT INTO client(nomClient, prenomClient, mailClient) VALUES ($nom,$prenom,$mail);");
    $sql->execute();*/
		
		}
		
	public function ajout_commentaire() {
	
	$chex = array ('idLot'=>$this->input->post('chbx'),
	'mail'=>$this->session->userdata('login'));
	var_dump($chex);
	  //foreach ($data as $row) {array_push($data,"'chbx' => $this->input->post('chbx')");}

	  $this->load->helper('url_helper');
	  $this->load->model('main_model');
	  $this->main_model->InsertPanierIntermediaire($chex);
		$this->load->view('v_bandeau');
		$this->load->view('v_commentaire');

		
		}	
		
		
	public function connexion_utilisateur () {
		$dataConnect = array ('mailClient' => $this->input->post('mailClient'),
		'mdpClient' => $this->input->post('mdpClient'),
		);
		
		$this->load->model('main_model');
		$this->main_model->connexionClient($dataConnect);
		
	}
	
	public function encherir ($montant) {
						
		$this->load->model('main_model');
		$this->main_model->updateEnchere($montant);
		
		
	}
	  

	public function index()
	{
		$this->load->helper('url_helper');
		$this->load->view('v_entete');
		$this->load->view('v_bandeau');		
		$this->load->view('v_accueil');
		$this->load->view('v_finPage');
	}
	
}
?>
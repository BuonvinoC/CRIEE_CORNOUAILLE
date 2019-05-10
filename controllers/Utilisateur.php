<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Utilisateur extends CI_Controller {
	public function contenu($id){
		$this->load->helper('url_helper');
		$this->load->view('v_entete');
                $this->load->view('v_bandeau');
		//$data['Utilisateur'] = $this;
		//$this->method_call =& get_instance();
	switch ($id) {
		case 'catalogue':
			$this->load->model('main_model');
			$data['donnees']=$this->main_model->afficheProduits1();
			//$this->encherir($dataConnect);
			//$this->load->view('v_bandeau');
			$this->load->view('v_catalogue',$data);
			break;
		case 'enchere':
			$this->load->model('main_model');
			$data['donnees']=$this->main_model->afficheProduits2();
			//$this->encherir($dataConnect);
			//$this->load->view('v_bandeau');
			$this->load->view('v_enchere',$data);
			break;
			case 'remporte':
				$this->load->model('main_model');
				$data['donnees']=$this->main_model->afficheLotRemporte();
				//$this->load->view('v_bandeau');
				$this->load->view('v_remporte',$data);
				break;
		case 'admin':
		$this->load->model('main_model');
		$data['donnees']=$this->main_model->afficheLotPropose();
			//$this->load->view('v_bandeau');
			$this->load->view('v_admin',$data);
			break;
		case 'inscription':
			//$this->load->view('v_bandeau');
			$this->load->view('v_inscription');
			break;
		case 'connexion':
			//$this->load->view('v_bandeau');
			$this->load->view('v_connexion');
			break;
		case 'deconnexion':
			$sessionData= array(
					'login' => $this->session->userdata('login'),
					'mdp' => $this->session->userdata('mdp'),
					'logged_in' => FALSE
				);
			$this->session->set_userdata($sessionData);
			//$this->load->view('v_bandeau');
			session_destroy();
			break;
		case 'mentions':
			$this->load->view('v_bandeau');
			$this->load->view('v_mentions');
			break;
		case 'faq':
			$this->load->view('v_bandeau');
			$this->load->view('v_faq');
			break;
		case 'propose':
			//$this->load->view('v_bandeau');
			$this->load->view('v_propose');
			break;
		default:
			//$this->load->view('v_bandeau');
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
		$data = array ('nom' => $this->input->post('nomClient'),
		'prenom' => $this->input->post('prenomClient'),
		'mail' => $this->input->post('mailClient'),
		'pwd' => $this->input->post('mdpClient'),
		);
	  /*$this->load->model('main_model');
	  $this->main_model->InsertClient($nom,$prenom,$mail);*/
	  $this->load->model('main_model');
	  $this->main_model->InsertClient($data);
	  /*$this->load->database();
	  $sql = $this->db->conn_id->prepare("INSERT INTO client(nomClient, prenomClient, mailClient) VALUES ($nom,$prenom,$mail);");
    $sql->execute();*/
		}
	/*public function ajout_commentaire() {
	$chex = array ('idLot'=>$this->input->post('chbx'),
	'mail'=>$this->session->userdata('login'));
	var_dump($chex);
	  //foreach ($data as $row) {array_push($data,"'chbx' => $this->input->post('chbx')");}
	  $this->load->helper('url_helper');
	  $this->load->model('main_model');
	  $this->main_model->InsertPanierIntermediaire($chex);
		$this->load->view('v_bandeau');
		$this->load->view('v_commentaire');
		}*/
                
                
	public function connexion_utilisateur () {
		$dataConnect = array ('mail' => $this->input->post('mailClient'),
		'pwd' => $this->input->post('mdpClient'),
		);
		$this->load->model('main_model');
		$this->main_model->connexionClient($dataConnect);
                /*header('Location: http://[::1]/CodeIgniter-3.1.9_Criee/index.php/utilisateur/contenu/catalogue');
		exit();*/
	}
	public function encherir () {
                $data = array ('prix_propose' => $this->input->post('ajoutMontant'), 'utilisateur' => $this->session->userdata('login'), 'idLot' =>$this->input->post('idL'));
		$this->load->model('main_model');
		$this->main_model->updateEnchere($data['prix_propose'], $data['utilisateur'], $data['idLot']);
                echo ($data['utilisateur'].' '.$data['prix_propose']);
	}
	public function proposer_lot() {
		$data = array ('lbl' => $this->input->post('lblLot'),
		'poi' => $this->input->post('poissonLot'),
		'datePeche' => $this->input->post('datePeche'),
		'poids' => $this->input->post('poids')
		);
	  $this->load->model('main_model');
	  $this->main_model->InsertLotPropose($data['lbl'], $data['poi'], $data['datePeche'], $data['poids']);
		header('Location: http://[::1]/CodeIgniter-3.1.9_Criee/index.php/utilisateur/');
		exit();
		}
        public function valider_lot() {
                $data = array ('prix' => $this->input->post('prixLot'),
                'dateFin' => $this->input->post('dateFinEnchere'),
                'libel' => $this->input->post('lbl'),
                'dat' => $this->input->post('datePeche'),
                'poids' => $this->input->post('poids')
                );
                $this->load->model('main_model');
                $this->main_model->InsertLot($data['prix'], $data['dateFin'], $data['libel'], $data['dat'], $data['poids']);
                header('Location: http://[::1]/CodeIgniter-3.1.9_Criee/index.php/utilisateur/contenu/enchere');
                exit();
                }
        public function finEnchere()
	{
		$data = array ('idLot' => $this->input->post('idLot')
		//'prix' => $this->input->post('prx'),
		//'acheteur' => $this->input->post('acht')
		);
		$this->load->model('main_model');
	$this->main_model->lotRemporte($data['idLot']/*,$data['prix'],$data['acheteur']*/);
	header('Location: http://[::1]/CodeIgniter-3.1.9_Criee/index.php/utilisateur/contenu/enchere');
  	  exit();
	}
	public function choisirLot()
	{

		  $LesLotsChoisis = $this->input->post('choixLots');
		  $this->load->model('main_model');
		 $this->main_model->ajoutPanierTemporaire($LesLotsChoisis);
		header('Location: http://[::1]/CodeIgniter-3.1.9_Criee/index.php/utilisateur/contenu/enchere');
  	 	 exit();

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

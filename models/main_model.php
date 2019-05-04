<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Main_model extends CI_Model{
	private $id;
	private $nom;
	private $prenom;
	function __construct(){
		parent::__construct();
	}
	public function updateEnchere($data) {
                $this->load->database();
			$this->db->insert('ENCHERIR',$data);
			$this->load->helper('url_helper');
			$this->load->view('v_entete');
			$this->load->view('v_bandeau');
			$this->load->view('v_connexion');
		}

	public function afficheProduits1() {
		$this->load->database();
		$sql = $this->db->conn_id->prepare("SELECT * FROM espece");
		$sql->execute();
		$donnees = $sql->fetchAll();
		$this->db=null;
		return $donnees;
	}
	public function afficheProduits2() {
		$this->load->database();
		$sqql = $this->db->conn_id->prepare("SELECT * FROM LOT");
		$sqql->execute();
		$donnees = $sqql->fetchAll();
		$this->db=null;
		return $donnees;
	}
	public function InsertPanier($designation, $quantite) {// fonction d'insertion dans la base de données DONNEES
		$this->load->database();
		$req = $this->db->conn_id->prepare('INSERT INTO PANIER(designationProduit, quantite) VALUES (:designation, :quantite)');
		$req->bindParam('designation', $designation, PDO::PARAM_STR); // on associe chaque paramètres
		$req->bindParam('quantite', $quantite, PDO::PARAM_INT);
		$result = $req->execute();
		return $result;
		$this->db=null;
	}
	public function InsertClient($data) {// fonction d'insertion dans la base de données DONNEES
		$this->load->database();
		$sql = $this->db->conn_id->prepare("SELECT mailClient FROM ACHETEUR");
		$sql->execute();
		$donnees = $sql->fetchAll();
		$test=0;
		foreach ($donnees as $row)
		{
			if ($row['mail']==$data['mail'])
			{$test=1;}
		}
		if ($test==1)
			$this->load->view('v_error_inscription');
		else
		{
			$this->load->database();
			$this->db->insert('ACHETEUR',$data);
			$this->load->helper('url_helper');
			$this->load->view('v_entete');
			$this->load->view('v_bandeau');
			$this->load->view('v_connexion');
		}
		$this->db=null;
	}
	public function InsertCommentaire($data) {// fonction d'insertion dans la base de données DONNEES
			$this->load->database();
			$this->db->insert('COMMENTAIRE',$data);
			$this->load->helper('url_helper');
		$this->db=null;
	}
	public function connexionClient($data) {
		$this->load->database();
		$sql = $this->db->conn_id->prepare("SELECT mail,pwd FROM ACHETEUR");
		$sql->execute();
		$donnees = $sql->fetchAll();
		foreach ($donnees as $row)
		{
			if (($row['mail']==$data['mail'])&&($row['pwd']==$data['pwd']))
				$session=1;
			else
				$session=0;
		}
		if ($session == 1){
			$sessionData= array(
					'login' => $data['mail'],
					'mdp' => $data['pwd'],
					'logged_in' => TRUE
				);
			$this->session->set_userdata($sessionData);
			$this->load->helper('url_helper');
			$this->load->view('v_entete');
			$this->load->view('v_bandeau');
		}
		else {
			$this->load->helper('url_helper');
			$this->load->view('v_entete');
			$this->load->view('v_bandeau');
			$this->load->view('v_error_connexion');
			$this->load->view('v_connexion');
		}
	}

	public function afficheLotProposé() {
		$this->load->database();
		$sql = $this->db->conn_id->prepare("SELECT * FROM lot_proposé");
		$sql->execute();
		$donnees = $sql->fetchAll();
		$this->db=null;
		return $donnees;
	}

	public function InsertLotProposé($lbl, $poi, $dat) {// fonction d'insertion dans la base de données DONNEES
		$this->load->database();
		$req = $this->db->conn_id->prepare('INSERT INTO lot_proposé(libelleLot, poisson, datePeche) VALUES (:lbl, :poi, :dat)');
		$req->bindParam('lbl', $lbl, PDO::PARAM_STR); // on associe chaque paramètres
		$req->bindParam('poi', $poi, PDO::PARAM_INT);
		$req->bindParam('dat', $dat, PDO::PARAM_INT);
		$result = $req->execute();
		return $result;
		$this->db=null;
	}

	public function InsertLot($prx, $dat, $lbl, $datP) {// fonction d'insertion dans la base de données DONNEES
		$this->load->database();
		$req = $this->db->conn_id->prepare('INSERT INTO lot(idLot, libelleLot, DatePeche, prixActuel, dateFinEnchere) VALUES (2, :lbl, :datP, :prx, :dat)');
		$req->bindParam('lbl', $lbl, PDO::PARAM_STR);
		$req->bindParam('datP', $datP, PDO::PARAM_STR);
		$req->bindParam('prx', $prx, PDO::PARAM_STR); // on associe chaque paramètres
		$req->bindParam('dat', $dat, PDO::PARAM_INT);

		$result = $req->execute();
		return $result;
		$this->db=null;
	}




}
?>

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
		$req = $this->db->conn_id->prepare("UPDATE LOT SET prixActuel=:nvMontant, AcheteurMax=:nvAcheteur WHERE LOT.idLot= 1");
		$req->bindParam('nvMontant', $data['nvMontant'], PDO::PARAM_STR); // on associe chaque paramètres
		$req->bindParam('nvAcheteur', $data['nvAcheteur'], PDO::PARAM_INT);
		$result = $req->execute();
		return $result;
		$this->db=null;
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
}
?>

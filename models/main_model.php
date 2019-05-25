<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Main_model extends CI_Model{
	private $id;
	private $nom;
	private $prenom;
	function __construct(){
		parent::__construct();
	}
	public function updateEnchere($mont,$util,$id) {
        $this->load->database();
		$req = $this->db->conn_id->prepare("UPDATE LOT SET prixActuel=:nvMontant, AcheteurMax=:nvAcheteur WHERE LOT.idLot= $id");
		$req->bindParam('nvMontant', $mont, PDO::PARAM_INT); // on associe chaque paramètres
		$req->bindParam('nvAcheteur', $util, PDO::PARAM_STR);
		$result = $req->execute();
		$this->db=null;
        return $result;
		}
	public function updateNote($note, $id) {
        $this->load->database();
		$req = $this->db->conn_id->prepare("UPDATE LOT SET noteLot=:nvNote WHERE LOT.idLot= $id");
		$req->bindParam('nvNote', $note, PDO::PARAM_INT); // on associe chaque paramètres
		$result = $req->execute();
		$reqq = $this->db->conn_id->prepare("UPDATE VENDEUR SET note=(SELECT AVG(LOT.noteLot) FROM LOT WHERE LOT.vendeur='vendeur')");
		$result = $reqq->execute();
		$this->db=null;
        return $result;
		}
	public function afficheProduits1() {
		$this->load->database();
		//$sql = $this->db->conn_id->prepare("SELECT * FROM espece");
                //CATALOGUE
                //SELECT ESPECE.LibelleEspece, ESPECE.Image, LOT.Qtt, LOT.Code, LOT.Libelle FROM LOT, ESPECE WHERE Lot.idEspece = Espece.idEspece
		$sql = $this->db->conn_id->prepare("select lot.idLot, lot.libelleLot, lot.PrixActuel, lot.poids, lot.noteLot, espece.nomEsp, espece.nomSciEsp, espece.image from lot, espece where lot.idEsp = espece.idEspece");
		$sql->execute();
		$donnees = $sql->fetchAll();
		$this->db=null;
		return $donnees;
	}
	public function afficheProduits2() {
		$this->load->database();
		$sqql = $this->db->conn_id->prepare("SELECT * FROM LOT WHERE LOT.idLot NOT IN (SELECT idLot FROM lot_remporté)");
                 //SELECT ESPECE.LibelleEspece, ESPECE.Image, LOT.Qtt, LOT.Code, LOT.Libelle FROM LOT, ESPECE WHERE Lot.idEspece = Espece.idEspece and LOT.AcheteurMax NOT NULL
		$sqql->execute();
		$donnees = $sqql->fetchAll();
		$this->db=null;
		return $donnees;
	}
	public function afficheNote(){
		$this->load->database();
		$sql = $this->db->conn_id->prepare("SELECT note FROM VENDEUR");
		$sql->execute();
		$donnees2 = $sqql->fetchAll();
		$this->db=null;
		return $donnees2;
	}
	public function InsertPanier($designation, $quantite) {// fonction d'insertion dans la base de données DONNEES
		$this->load->database();
		$req = $this->db->conn_id->prepare('INSERT INTO PANIER(designationProduit, quantite) VALUES (:designation, :quantite)');
		$req->bindParam('designation', $designation, PDO::PARAM_STR); // on associe chaque paramètres
		$req->bindParam('quantite', $quantite, PDO::PARAM_INT);
		$result = $req->execute();
		$this->db=null;
                return $result;
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
			$reqq = $this->db->conn_id->prepare('INSERT INTO client (mail, pwd, prenom, nom) VALUES (:mail, :pwd, :prenom, :nom)');
			$reqq->bindParam('mail', $data['mail'], PDO::PARAM_STR); // on associe chaque paramètres
			$reqq->bindParam('pwd', $data['pwd'], PDO::PARAM_STR); // on associe chaque paramètres
			$reqq->bindParam('prenom', $data['prenom'], PDO::PARAM_STR); // on associe chaque paramètres
			$reqq->bindParam('nom', $data['nom'], PDO::PARAM_STR); // on associe chaque paramètres
			$result = $reqq->execute();
			//$this->db->insert('ACHETEUR',$data);
			if($data['type']=="acheteur")
			{
			$req = $this->db->conn_id->prepare('INSERT INTO Acheteur (mail_acheteur, pwd, prenom, nom) VALUES (:mail, :pwd, :prenom, :nom)');
			$req->bindParam('mail', $data['mail'], PDO::PARAM_STR); // on associe chaque paramètres
			$req->bindParam('pwd', $data['pwd'], PDO::PARAM_STR); // on associe chaque paramètres
			$req->bindParam('prenom', $data['prenom'], PDO::PARAM_STR); // on associe chaque paramètres
			$req->bindParam('nom', $data['nom'], PDO::PARAM_STR); // on associe chaque paramètres
			$result = $req->execute();
			$this->db=null;
			return $result;
			}
			else
			{
			$req = $this->db->conn_id->prepare('INSERT INTO vendeur (mail_vendeur, pwd, prenom, nom) VALUES (:mail, :pwd, :prenom, :nom)');
			$req->bindParam('mail', $data['mail'], PDO::PARAM_STR); // on associe chaque paramètres
			$req->bindParam('pwd', $data['pwd'], PDO::PARAM_STR); // on associe chaque paramètres
			$req->bindParam('prenom', $data['prenom'], PDO::PARAM_STR); // on associe chaque paramètres
			$req->bindParam('nom', $data['nom'], PDO::PARAM_STR); // on associe chaque paramètres
			$result = $req->execute();
			$this->db=null;
			return $result;
			}
		}
	}
	/*public function InsertCommentaire($data) {// fonction d'insertion dans la base de données DONNEES
			$this->load->database();
			$this->db->insert('COMMENTAIRE',$data);
			//$this->load->helper('url_helper');
		$this->db=null;
	}*/
	public function connexionClient($data) {
		$session = 0;
		$this->load->database();
		$sql = $this->db->conn_id->prepare("SELECT mail,pwd FROM CLIENT");
		$sql->execute();
		$donnees = $sql->fetchAll();
		foreach ($donnees as $row)
		{
                    if (($data['mail']=="admin")&&($data['pwd']=="admin"))
				$session=2;
                    if (($row['mail']==$data['mail'])&&($row['pwd']==$data['pwd']))
				$session=1;
		}
		if ($session == 1){
			$sessionData= array(
					'login' => $data['mail'],
					'mdp' => $data['pwd'],
					'logged_in' => TRUE
				);
			$this->session->set_userdata($sessionData);
			/*$this->load->helper('url_helper');
			$this->load->view('v_entete');
			$this->load->view('v_bandeau');*/
			header('Location: http://[::1]/CodeIgniter-3.1.9_Criee/index.php/utilisateur');
  	  		exit();
		}
                elseif ($session == 2){
                    $sessionData= array(
					'login' => "admin",
					'mdp' => "admin",
					'logged_in' => TRUE
				);
			$this->session->set_userdata($sessionData);
			header('Location: http://[::1]/CodeIgniter-3.1.9_Criee/index.php/utilisateur');
  	  		exit();
                }
                else {
			$this->load->helper('url_helper');
			$this->load->view('v_error_connexion');
			header('Location: http://[::1]/CodeIgniter-3.1.9_Criee/index.php/utilisateur/contenu/connexion');
  	  		exit();
		}
	}
         public function insertLotPropose($lbl,$poi,$date,$poids,$login) {// fonction d'insertion dans la base de données DONNEES
			$this->load->database();
                            $req = $this->db->conn_id->prepare('INSERT INTO lot_proposé (libelleLot, poisson, datePeche, poids, vendeur) VALUES (:lbl, :poi, :date, :poids, :login )');
                            $req->bindParam('lbl', $lbl, PDO::PARAM_STR); // on associe chaque paramètres
                            $req->bindParam('poi', $poi, PDO::PARAM_STR); // on associe chaque paramètres
                            $req->bindParam('date', $date, PDO::PARAM_STR); // on associe chaque paramètres
							$req->bindParam('poids', $poids, PDO::PARAM_STR); // on associe chaque paramètres
							$req->bindParam('login', $login, PDO::PARAM_STR);
                            $result = $req->execute();
                            $this->db=null;
                            return $result;
	}
        /*public function DeleteLotPropose($id) {// fonction d'insertion dans la base de données DONNEES
			$this->load->database();
                            $req = $this->db->conn_id->prepare("DELETE FROM lot_proposé WHERE lot_proposé.idLot =$id");
                            /*$req->bindParam('id', $id, PDO::PARAM_STR); // on associe chaque paramètres
                            $req->bindParam('poi', $poi, PDO::PARAM_STR); // on associe chaque paramètres
                            $req->bindParam('date', $date, PDO::PARAM_STR); // on associe chaque paramètres
                            $req->bindParam('poids', $poids, PDO::PARAM_STR); // on associe chaque paramètres
                            $result = $req->execute();
                            $this->db=null;
                            return $result;
	}*/
        public function insertLotValide($prix,$date) {// fonction d'insertion dans la base de données DONNEES
			$this->load->database();
                            $req = $this->db->conn_id->prepare('INSERT INTO lot (prixActuel, DateFinEnchère ) VALUES (:prix, :date )');
                            $req->bindParam('prix', $prix, PDO::PARAM_STR); // on associe chaque paramètres
                            $req->bindParam('date', $date, PDO::PARAM_STR); // on associe chaque paramètres
                            $result = $req->execute();
                            $this->db=null;
                            return $result;
	}
        public function ajoutEnchere($data) {// fonction d'insertion dans la base de données DONNEES
			$this->load->database();
                        foreach ($data as $poisson ){
                            foreach ($poisson as $poi)
                            $req = $this->db->conn_id->prepare('INSERT INTO Lot(idLot ) VALUES (:poi)');
                            $req->bindParam('poi', $poi, PDO::PARAM_STR); // on associe chaque paramètres
                            $result = $req->execute();
                            return $result;
                            $this->db=null;
                        }
	}
       public function afficheLotPropose() {
		$this->load->database();
		$sqql = $this->db->conn_id->prepare("SELECT * FROM lot_proposé");
		$sqql->execute();
		$donnees = $sqql->fetchAll();
		$this->db=null;
		return $donnees;
	}
	public function InsertLot($id, $prx, $dat, $lbl, $datP, $poids, $vendeur) {// fonction d'insertion dans la base de données DONNEES
		$this->load->database();
		$req = $this->db->conn_id->prepare('INSERT INTO lot(libelleLot, DatePeche, prixActuel, dateFinEnchere, poids, vendeur) VALUES (:lbl, :datP, :prx, :dat, :poids, :vendeur)');
		$req->bindParam('lbl', $lbl, PDO::PARAM_STR);
		$req->bindParam('datP', $datP, PDO::PARAM_STR);
		$req->bindParam('prx', $prx, PDO::PARAM_INT); // on associe chaque paramètres
		$req->bindParam('dat', $dat, PDO::PARAM_STR);
		$req->bindParam('poids', $poids, PDO::PARAM_INT);
		$req->bindParam('vendeur', $vendeur, PDO::PARAM_STR);
		$result = $req->execute();

        $reqq = $this->db->conn_id->prepare("DELETE FROM lot_proposé WHERE lot_proposé.idLot =$id");
        $result = $reqq->execute();
        $this->db=null;
        return $result;
	}
public function lotRemporte($idLot) {
		$this->load->database();
		$req = $this->db->conn_id->prepare("INSERT INTO lot_remporté(idLot) VALUES (:idL)");
		$req->bindParam('idL', $idLot, PDO::PARAM_STR);
		$result = $req->execute();
		$this->db=null;
                return $result;
	}
	public function afficheLotRemporte() {
		$this->load->database();
		$sqql = $this->db->conn_id->prepare("SELECT * FROM LOT WHERE LOT.idLot IN (SELECT idLot FROM lot_remporté)");
		$sqql->execute();
		$donnees = $sqql->fetchAll();
		$this->db=null;
		return $donnees;
	}
        	public function ajoutPanierTemporaire($lesLotsSouhaites){
			$this->load->database();
			 $MailUser = $this->session->userdata('login');
                         print_r($lesLotsSouhaites);
		foreach($lesLotsSouhaites as $row) {
			$IdLotChoisi = $row['idLot'];
			$req = $this->db->conn_id->prepare('INSERT INTO panier_temporaire(mailAcheteur, idLot) VALUES (:MailUser, :IdLotChoisi)');
			$req->bindParam('MailUser',  $MailUser, PDO::PARAM_STR);
			$req->bindParam('IdLotChoisi', $IdLotChoisi, PDO::PARAM_STR);
			$result = $req->execute();
		}
		$this->db=null;
		return $result;
	}
}
?>

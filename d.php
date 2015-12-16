<?php
include_once 'connect.php';

switch ($_GET["table"]) {
	case "personne":
	deletePersonne($_GET);
	break;
	case "colis":
	deleteColis($_GET);
	break;		
	default:
	;
	break;
}

function deletePersonne($data){
	global $DBH;
	
	try {
		if(isset($data["id_personne"])){
			$stmt = $DBH->prepare("DELETE FROM personne where id_personne=?");
			$stmt->bindParam(1, $data["id_personne"]);
			$stmt->execute();

			$stmt = $DBH->prepare("DELETE FROM colis where id_personne=?");
			$stmt->bindParam(1, $data["id_personne"]);
			$stmt->execute();

			echo 'Personne deleted';
		}
		else{
			echo 'Donner un id_personne';
		}		
	}
	catch(PDOException $e) {
		echo 'Erreur : ' . $e->getMessage();
	}
}

function deleteColis($data){
	global $DBH;
	
	try {
		if(isset($data["id_colis"])){
			$stmt = $DBH->prepare("DELETE FROM colis where id_colis=?");
			$stmt->bindParam(1, $data["id_colis"]);
			$stmt->execute();

			echo 'Colis deleted';
		}
		else{
			echo 'Donner un id_colis';
		}		
	}
	catch(PDOException $e) {
		echo 'Erreur : ' . $e->getMessage();
	}
}

?>

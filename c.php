<?php
include_once 'connect.php';

switch ($_GET["table"]) {
	case "personne":
	createPersonne($_GET);
	break;
	case "colis":
	createColis($_GET);
	break;		
	default:
	;
	break;
}

function createPersonne($data){
	global $DBH;
	
	try {

		$stmt = $DBH->prepare("INSERT INTO personne(nom_personne) VALUES (?)");
		$stmt->bindParam(1, $data["nom"]);
		if(isset($data["nom"]) &&  $data["nom"]!=""){
			$stmt->execute();
			echo 'Personne inserted';	
		}
		else{
			echo "Donner un Nom";
		}		
		

	}
	catch(PDOException $e) {
		echo 'Erreur : ' . $e->getMessage();
	}
}

function createColis($data){
	global $DBH;
	
	try {

		$stmt = $DBH->prepare("INSERT INTO colis(libelle_colis, id_personne) VALUES (?,?)");
		$stmt->bindParam(1, $data["libelle"]);
		$stmt->bindParam(2, $data["id_personne"]);	
		if(isset($data["id_personne"])){
			//cherche si la personne existe
			$sth = $DBH->prepare("SELECT * FROM personne  WHERE id_personne= :pers");
			$sth->execute(array(':pers' => $data["id_personne"]));
			if($sth->rowCount()>0){
				$stmt->execute();
				echo 'Colis inserted';
			}
			else{
				echo 'Cette personne n\'existe pas';
			}	
		}
		else{
			echo "Donner un id_personne ";
		}			

	}
	catch(PDOException $e) {
		echo 'Erreur : ' . $e->getMessage();
	}
}

?>

<?php
include_once 'connect.php';

switch ($_GET["table"]) {
	case "personne":
		readPersonne();
		break;
	case "colis":
		readColis($_GET);
		break;		
	default:
		;
	break;
}

function readPersonne(){
	global $DBH;
	$result=array();

	try {

		$sth = $DBH->prepare("SELECT *,id_personne recid FROM personne");
		$sth->execute();	
		while ($rows = $sth->fetch(PDO::FETCH_ASSOC)){
			$result[] = $rows;
		}
		echo json_encode($result);
	}
	catch(PDOException $e) {
	    echo 'Erreur : ' . $e->getMessage();
	}
}

function readColis($data){

	global $DBH;
	$result=array();

	try {

		$sth = $DBH->prepare("SELECT *,id_colis recid FROM colis WHERE id_personne= :pers");
		$sth->execute(array(':pers' => $data["id_personne"]));
		while ($rows = $sth->fetch(PDO::FETCH_ASSOC)){
			$result[] = $rows;
		}
		echo json_encode($result);
	}
	catch(PDOException $e) {
	    echo 'Erreur : ' . $e->getMessage();
	}
}

/*function readAllPersonne($data){
	global $DBH;
	$rows =array();

	try {

		$sth = $DBH->prepare("SELECT * FROM personnes");
		$sth->execute();
		$rows =  $sth->fetchAll(PDO::FETCH_ASSOC);		
		echo json_encode( $rows, JSON_UNESCAPED_UNICODE );
	}
	catch(PDOException $e) {
	    echo 'Erreur : ' . $e->getMessage();
	}
}*/

?>
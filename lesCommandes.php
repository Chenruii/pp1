<?php
	include("modele/commande.class.php");

	$commande = new Commande ("mysql-allofastfood.alwaysdata.net","allofastfood_bdd","135552","passlagi2711","lescommandes");
	$mail = $_REQUEST['mail'];
	$champ = array("idcommande","datecmde","etat","prix");
	$where = array("mail"=>$mail);

	$resultats = $commande->selectAllWhere($champ,$where);
	print(json_encode($resultats));

?>
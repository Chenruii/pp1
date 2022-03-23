<?php
include("_header.php");
$json = array('error' => true);
if(isset($_GET['idProduit'])){
	$produit = $DB->query('SELECT idProduit FROM produit WHERE idProduit=:idProduit', array('idProduit' => $_GET['idProduit']));
	if(empty($produit)){
		$json['message'] = "Ce produit n'existe pas";
	}else{
		$panier->add($produit[0]->idProduit);
		$json['error']  = false;
		$json['total']  = number_format($panier->total(),2,',',' ');
		$json['count']  = $panier->count();
		$json['message'] = 'Le produit a bien été ajouté à votre panier';
	}
}else{
	$json['message'] = "Vous n'avez pas sélectionné de produit à ajouter au panier";
}
echo json_encode($json);

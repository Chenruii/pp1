<?php

	$db = new PDO("mysql:host=localhost;dbname=venteenligne","root","");
	if(isset($_GET["nom"])){
		$nom1 = $_GET['nom'];
		$resultat = $db->query("SELECT * FROM produit WHERE nom =\"$nom1\" ");
		$produit=$resultat->fetch();
		$idx=$produit["idProduit"];
		$nom=$produit["nom"];
		$prix=$produit["prix"];
		$categorie=$produit["categorie"];
		$stock=$produit["stock"];
		if(!$resultat){
			echo"erreur dans l'éxécution de la requête</br>";
			echo"le message d'erreur est:". mysql_error($resultat);
		}
	}


	echo"<form action='admin.php' method='post'>";
	echo"<h1>Utilisateur</h1>\n";
	echo"<table border='1'>";
	echo "<tr>\n";
	echo "<td><strong>Index</strong></td>";
	echo "<td><input type='text' name='idx' value='".$idx."' /></td>";
	echo "</tr>\n";
	echo "<tr>\n";
	echo "<td><strong>Nom</strong></td>";
	echo "<td><input type='text' name='nom' value='".$nom."' /></td>";
	echo "</tr>\n";
	echo "<tr>\n";
	echo "<td><strong>Prix</strong></td>";
	echo "<td><input type='text' name='prix' value='".$prix."' /></td>";
	echo "</tr>\n";
	echo "<tr>\n";
	echo "<td><strong>Catégorie</strong></td>";
	echo "<td><input type='text' name='categorie' value='".$categorie."' /></td>";
	echo "</tr>\n";
	echo "<tr>\n";
	echo "<td><strong>Stock</strong></td>";
	echo "<td><input type='text' name='stock' value='".$stock."' /></td>";
	echo "</tr>\n";
	echo "</table>";
	echo "</br>";
	echo "<td><input type='hidden' name='nomOrigine' value='".$_GET["nom"]."' />\n";
	echo "<td><input type='submit' name='supprimer' value='supprimer' />\n";
	echo"<form>";
?>
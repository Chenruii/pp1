<!Doctype hmtl>
<html>
<?php
    session_start();
    if( isset($_SESSION["user_id"]) == false ){
    
        header("Location: 404.php");
        die();
    }
    else{
        if ($_SESSION["user_id"]["status"] != "admin") {
        
            header("HTTP/1.0 403 forbidden");
            die();
        } 
    }
?>


<head>
	<title>Gestion des Produits</title>
	<?php
	include("_header.php");
	include("vue/head.php");
	?>
</head>
<body style="overflow:scroll">
	<?php

		include("vue/header.php");

		$db = new PDO("mysql:host=localhost;dbname=venteenligne","root","");
		if(isset($_POST["modifier"])){

	        $resultat =$db->query("UPDATE produit SET nom='".$_POST['nom']."'".",prix='".$_POST['prix']."'".",categorie='".$_POST['categorie']."'".",stock='".$_POST['stock']."'"."
	         where nom='".$_POST['nomOrigine']."' and idProduit='".$_POST['idx']."';");
	        if(!$resultat){
	            echo"erreur dans l'éxécution de la requête</br>";
	            echo"le message d'erreur est:". mysql_error($resultat);
	        }
	        else{
	        	echo"<center><h3><p style='margin-left: 5px'><font color='red' > Modification enregistré</font></p></h3></center></br>";
	        }	
		}

		elseif (isset($_POST["supprimer"])) {
		    $resultat =$db->query("DELETE FROM produit WHERE nom='".$_POST['nomOrigine']."' and idProduit='".$_POST['idx']."';");
		    /*nom =\"$nom\" AND idx='".$_POST['idx']."';"*/
		    if(!$resultat){
		        echo"erreur dans l'éxécution de la requête</br>";
		        echo"le message d'erreur est:". mysql_error($resultat);
		    }
		    else{
	        	echo"<center><h3><p style='margin-left: 5px'><font color='red'> Suppression réussie</font></p></h3></center><</br>";
	        }
		}


	?>
	<div class="intro-body">
            <div class="container2">
                <div class="row">
                    <div class="col-md-8 col-md-offset-2">
                        <h2 class="brand-heading"> <p class="intro-text">Liste des produits</p></h2>
                        
                        <section id="table" class="container1 content-section text-center">
                            <div class="row">
                                <div class="table-responsive">
                                    <table class="table">
                                        <tr>
                                            <th></th>
                                            <th>Nom</th>
                                            <th>Prix</th>
                                            <th>Catégorie</th>
                                            <th>Stock</th>
                                            <th></th>    
                                        </tr>
                                        <?php
                                            /*$categorie=array("Wings");*/
                                            $produits = $unControleur->selectAll();
                                            foreach ( $produits as $produit ){
                                                echo "<tr>";
                                                echo "<th><a href='#' class='img'> <img src=image/".$produit->idProduit.".JPG height='53'></a></th>";
                                                echo "<th>{$produit->nom}</th>";             // On affiche le nom
                                                echo "<th>{$produit->prix}</th>";      // etc... 
                                                echo "<th>{$produit->categorie}</th>"; 
                                                echo "<th>{$produit->stock}</th>";
                                                echo "<th><a href='modifier.php?nom=".$produit->nom."'>modifier</a></th>";
                                                echo "<th><a href='supprimer.php?nom=".$produit->nom."'>supprimer</a></th>"; 
                                                echo "</tr>";

                                            }
                                            echo "<th><a href='ajouter.php?'>Ajouter</a></th>";
                                        ?>
                                    </table>
                                </div>
                            </div>
                        </section>
                    </div>
                </div>
            </div>
        </div>


</body>
</html>


<?php
	include("vue/footer.php");
?>
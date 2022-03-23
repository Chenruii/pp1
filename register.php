<!doctype html>
<html>

	<?php
		include("_header.php");
		include("vue/head.php");
		include("vue/header.php");
	?>
	<body style="overflow:scroll">
	    <?php
			include("vue/vueInsertUser.php");
			if(isset($_POST["valider"])){

				$tab=array();
				$tab['nom']=$_POST['nom'];
				$tab['prenom']=$_POST['prenom'];
				$tab['mail']=$_POST['mail'];
				$tab['mdp']=$_POST['mdp'];
				$tab['adresse']=$_POST['adresse'];
				$tab['tel']=$_POST['tel'];
				$tab['cp']=$_POST['cp'];
				$tab['ville']=$_POST['ville'];
				$tab['status']="client";
				if(!empty($tab['nom']) AND !empty($tab['prenom']) AND !empty($tab['mail']) 
					AND !empty($tab['mdp']) AND !empty($tab['adresse']) AND !empty($tab['tel']) 
					AND !empty($tab['cp']) AND !empty($tab['ville']) AND !empty($tab['status'])){
					$unControleur->insert($tab);
				}
				else{
					echo "<center style= 'margin-top: 20px; margin-bottom: 10px;'><h3><font color='red' >Vous devez remplir tous les champs</font></h3></center>";
				}	
			}
			include("vue/footer.php");
		?>
			
	</body>
</html>

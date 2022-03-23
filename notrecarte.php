<!DOCTYPE html>
<html>
  <head>
    <meta name="viewport" content="initial-scale=1.0, user-scalable=no">
    <meta charset="utf-8">
    <link href="favicon.ico" rel="shortcut icon" type="image/x-icon">
    
    <title>Notre Carte</title>
    <style>

	.footer_section1{ background:url(img/pattern_bg.jpg) repeat left top;
	}
	</style>
    <?php
      include("_header.php");
      include("vue/head.php");
      include("vue/header.php");
	  /*include("controleur/controleur.class.php");
	  $unControleur = new Controleur ("mysql-allofastfood.alwaysdata.net","allofastfood_bdd","135552","passlagi2711");
	  $unModele = new Modele ("mysql-allofastfood.alwaysdata.net","allofastfood_bdd","135552","passlagi2711");*/
	  /*<?= $produit->idProduit;?>*/

    ?>
    <link href="css/style2.css" rel="stylesheet" type="text/css">
  </head>
	<body style="overflow:scroll">
		<div class="home">
			<div class="row">
				<div class="wrap">
					<?php 
					$produits = $unControleur->selectAll();?>
					<?php foreach ( $produits as $produit ):

					?>


						<div class="box">
							<div class="product full">
								<a href="detailProduit.php?id=<?=$produit->idProduit;?>">
									<img src="image/<?= $produit->idProduit;?>.JPG">
								</a>
								<div class="description">
									<?= $produit->nom; ?> :
									<a href="#" class="prix"><?= number_format($produit->prix,2,',',' '); ?> €</a>
								</div>
								<a href="addpanier.php?id=<?= $produit->idProduit; ?>" class="gift addPanier">
									Gift
								</a>
								<div class="rating">
									<span>Rating :</span>
									<ul>
										<li><a href="#">1</a></li>
										<li><a href="#">2</a></li>
										<li><a href="#">3</a></li>
										<li><a href="#">4</a></li>
										<li><a href="#">5</a></li>
									</ul>
								</div>

								<a class="add addPanier" href="addpanier.php?idProduit=<?= $produit->idProduit; ?>">
									add
								</a>
							</div>
						</div>
					<?php endforeach ?>
				</div>
			</div>
		</div>
	</br></br></br></br></br></br></br></br></br></br></br></br></br></br></br></br></br></br></br></br></br></br></br></br></br></br></br></br></br></br></br></br></br></br></br></br></br></br></br></br>

	</body>
	<?php
		include("vue/footer.php");
	?>
</html>
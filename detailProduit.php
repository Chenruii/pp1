<!DOCTYPE html>
<html>
  <head>
    <meta name="viewport" content="initial-scale=1.0, user-scalable=no">
    <meta charset="utf-8">
    <link href="favicon.ico" rel="shortcut icon" type="image/x-icon">
    
    <title>Détail du produit</title>
    <style>

	.footer_section1{ background:url(img/pattern_bg.jpg) repeat left top;
	}
	</style>
    <?php
      include("_header.php");
      include("vue/head.php");
      include("vue/header.php");
	  /*<?= $produit->idProduit;?>*/
	  $idDuProduit=$_GET['id'];
    ?>
    <link href="css/style2.css" rel="stylesheet" type="text/css">
  </head>
	<body style="overflow:scroll">
		<div class="home">
			<div class="row">
				<div class="wrap">
					<?php
						if (isset($_GET['id'])){

							$id = $_GET['id'];
							$produit = $unModele->selectWhereId($id);
							$produit1 = $unModele->selectWhereIdPrix($id);

							/*$produitAcheter = $unModele->selectWhereIdProduitAcheter($id);*/
						}

					?>
					
					<div class="box">
						<div class="product full">
							<a href="#">
								<img src="image/<?= $_GET['id'];?>.JPG">
							</a>
							<div class="description">
								<?php echo $produit["nom"] ; ?> :
								<a href="#" class="prix"><?php echo number_format($produit1["prix"],2,',',' '); ?> €</a>
							</div>
							<a href="addpanier.php?id=<?= $_GET['id']; ?>" class="gift addPanier">
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
							<a class="add addPanier" href="addpanier.php?idProduit=<?= $_GET['id']; ?>">
								add
							</a>
						</div>
					</div>
					
				</div>
			</div>
		</div>
	</br>

	</body>
	<?php
		include("vue/footer.php");
	?>
</html>
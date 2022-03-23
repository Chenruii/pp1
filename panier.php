<!DOCTYPE html>
<html>
  <head>
    <meta name="viewport" content="initial-scale=1.0, user-scalable=no">
    <meta charset="utf-8">
    <link href="favicon.ico" rel="shortcut icon" type="image/x-icon">
    
    <title>Panier</title>
    <style>

		.footer_section1{ background:url(img/pattern_bg.jpg) repeat left top;}

		.btn-primary {
		    margin-top: 20px;
		    margin-left: 342px;
		    color: #ffffff;
		    background-color: #428bca;
		    border-color: #357ebd;
		}
	
	</style>
    <?php

    	include("_header.php");
	    include("vue/head.php");
	    include("vue/header.php");
	    include("modele/paypal.class.php");
		/*var_dump($_SESSION["user_id"]["status"]);*/
		
	    $idProduits = array_keys($_SESSION['panier']);
	    if($panier->count()==0){

	    }
	    else{
			if(empty($idProduits)){
				$produits = array();
			}else{
				$produits = $DB->query1('SELECT * FROM produit WHERE idProduit IN ('.implode(',',$idProduits).')');
			}
			$port = 0.0;
			$tva=1.196;
			$total=$panier->total();
			$prixtva= round($total*$tva,2);
			$paypal = new Paypal();
			$params = array(
				'RETURNURL' => 'http://localhost/vente_enligne/process.php',
				'CANCELURL' => 'http://localhost/vente_enligne/panier.php',

				'PAYMENTREQUEST_0_AMT' => $prixtva + $port,
				'PAYMENTREQUEST_0_CURRENCYCODE' => 'EUR',
				'PAYMENTREQUEST_0_SHIPPINGAMT' => $port,
				'PAYMENTREQUEST_0_ITEMAMT' => $prixtva,
			);
			$response = $paypal->request('SetExpressCheckout', $params);
			if($response){
				$paypal = 'https://www.sandbox.paypal.com/webscr?cmd=_express-checkout&useraction=commit&token=' . $response['TOKEN'];
			}else{
				var_dump($paypal->errors);
				die('Erreur ');
			}
	    }
	?>
  </head>
  <body style="overflow:scroll;">
  		<div class="checkout">
		<div class="title">
			<div class="wrap">
				<h2 class="first">Votre Panier</h2>
				<?php if(isset($_SESSION['user_id'])){ ?><a class="btn btn-primary" href="<?php if(isset($paypal)) echo $paypal; ?>" style="font-family: Dosis; font-size:16px;">Payer la commande</a><?php }else{?><h4 style="color:red;">Vous devez être connecté pour payer votre commande. <a href="connect.php">Se connecter</a></h4><?php } ?>
			</div>	
		</div>
		<form method="post" action="panier.php">
		<div class="table">
			<div class="wrap">

				<div class="rowtitle">
					<span class="name">Nom du produit</span>
					<span class="price">Prix</span>
					<span class="quantity">Quantité</span>
					<span class="subtotal">Prix avec TVA</span>
					<span class="action">Actions</span>
				</div>

				<?php
				$idProduits = array_keys($_SESSION['panier']);
				if(empty($idProduits)){
					$produits = array();
				}else{
					$produits = $DB->query('SELECT * FROM produit WHERE idProduit IN ('.implode(',',$idProduits).')');
				}
				foreach($produits as $produit):
				?>
				<div class="row">
					<a href="#" class="img"> <img src="image/<?= $produit->idProduit; ?>.JPG" height="53"></a>
					<span class="name"><?= $produit->nom; ?></span>
					<span class="price"><?= number_format($produit->prix,2,',',' '); ?> €</span>
					<span class="quantity"><input type="text" name="panier[quantity][<?= $produit->idProduit; ?>]" value="<?= $_SESSION['panier'][$produit->idProduit]; ?>"></span>
					<span class="subtotal"><?= number_format($produit->prix * 1.196,2,',',' '); ?> €</span>
					<span class="action">
						<a href="panier.php?delPanier=<?= $produit->idProduit; ?>" class="del"><img src="image/del.png"></a>
					</span>
				</div>
				<?php endforeach; ?>
				
				<div class="rowtotal">
					Grand Total : <span class="total"><?= number_format($panier->total() * 1.196,2,',',' '); ?> € </span>
				</div>

				<input type="submit" value="Recalculer" style="font-family:Dosis; font-size:16px;">
			</div>
		</div>
		</form>
	</div>
	</br>
	</br>
	</br></br></br></br></br></br>	
    </body>	
	<?php
		include("vue/footer.php");
	?>
</html>
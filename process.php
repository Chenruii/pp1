<?php
ob_start();
include("_header.php");
include("vue/head.php");
include("vue/header.php");

$idProduits = array_keys($_SESSION['panier']);
$qte2=array_values($_SESSION['panier']);

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


include("modele/paypal.class.php");
$paypal = new Paypal();
$response = $paypal->request('GetExpressCheckoutDetails', array(
	'TOKEN' => $_GET['token']
));
if($response){
	if($response['CHECKOUTSTATUS'] == 'PaymentActionCompleted'){

		die(header('Location: success.php'));

	}
}else{
	var_dump($paypal->errors);
	die();
}



$params = array(
	'TOKEN' => $_GET['token'],
	'PAYERID'=> $_GET['PayerID'],
	'PAYMENTACTION' => 'Sale',

	'PAYMENTREQUEST_0_AMT' => $prixtva + $port,
	'PAYMENTREQUEST_0_CURRENCYCODE' => 'EUR',
	'PAYMENTREQUEST_0_SHIPPINGAMT' => $port,
	'PAYMENTREQUEST_0_ITEMAMT' => $prixtva,
);
/*foreach($products as $k => $product){
	$params["L_PAYMENTREQUEST_0_NAME$k"] = $product['name'];
	$params["L_PAYMENTREQUEST_0_DESC$k"] = '';
	$params["L_PAYMENTREQUEST_0_AMT$k"] = $product['priceTVA'];
	$params["L_PAYMENTREQUEST_0_QTY$k"] = $product['count'];
}*/
$response = $paypal->request('DoExpressCheckoutPayment',$params);
if($response){
	var_dump($response);
	$response['PAYMENTINFO_0_TRANSACTIONID'];
	$produits = $DB->query1("INSERT INTO commande VALUES (null,CURRENT_DATE,'".$prixtva."','en cours','".$_SESSION['user_id']['idClient']."')");
	for($i=0;$i<count($idProduits); $i++){
		/*$produits2 = $DB->query1("INSERT INTO acheter VALUES (null,'".$_SESSION['user_id']['idClient']."','".implode(',',$idProduits)."')");*/
		$produits2 = $DB->query1("INSERT INTO acheter VALUES (null,'".$_SESSION['user_id']['idClient']."','".$idProduits[$i]."')");
		$produits3 = $DB->query1("UPDATE produit SET stock = stock - '".$qte2[$i]."' WHERE idProduit =  '".$idProduits[$i]."'");
	}
	die(header('Location: success.php'));

}else{
	var_dump($paypal->errors);
}
}
?>
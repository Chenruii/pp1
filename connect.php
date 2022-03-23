<?php 
session_start();

// On demande à se connecter ======
if( isset($_GET["action"]) && $_GET["action"] == "login"){

	$username = $_POST["mail"];
	$password = $_POST["password"];

	// connexion sql
	$db = new PDO("mysql:host=localhost;dbname=venteenligne","root","");
	
	/*else{*/
		if(!empty($username) AND !empty($password)){
			$user = $db->query("SELECT * FROM `client` WHERE `mail` = \"$username\" AND `mdp` = \"$password\" ;");

			// On vérifie qu'on a bien un retour utilisateur
			if( $user->rowCount() == 1){
				$_SESSION["user_id"] = $user->fetch();
				if($_SESSION["user_id"]["status"] == "admin"){

					header("Location: admin.php");
				}
				else{

					header("Location: panier.php");
				}
			}
			else{
				echo "Mauvais pseudo ou mot de passe";
			}
		}
		else{

		echo "Tous les champs doivent être remplis";
		}

	/*}*/

	
}
include("_header.php");
include("vue/head.php");
include("vue/header.php");
	?>
<style>
	/*body{
	    margin-top: 160px;
	    margin-left: 430px;
	    width: 500px;
	    background-color: #222930;
	}*/

	.account-wall
	{   
	    border-radius: 2px 2px 2px 2px;
	    margin-top: 20px;
	    padding: 40px 0px 20px 0px;
	    background-color: #f7f7f7;
	    -moz-box-shadow: 0px 2px 2px rgba(0, 0, 0, 0.3);
	    -webkit-box-shadow: 0px 2px 2px rgba(0, 0, 0, 0.3);
	    box-shadow: 0px 2px 2px rgba(0, 0, 0, 0.3);
	    width: 100%;
	}

	.login-title
	{
	    color: #555;
	    font-family: 'Dosis';
    	font-weight: 700;
	    display: block;
	}

	.form-signin
	{
	    max-width: 330px;
	    padding: 15px;
	    margin: 0 auto;
	}

	.form-signin .form-control
	{
	    position: relative;
	    font-size: 16px;
	    height: auto;
	    padding: 10px;
	    
	}
	  
	.form-signin input[type="text"]
	{   
	    margin-bottom: -1px;
	    border-radius: 20px;
	}
	.form-signin input[type="password"]
	{   
	    margin-top: 2px;
	    margin-bottom: 10px;
	    border-radius: 20px;
	}

	.loginmodal-submit {
	  border: 1px solid #3079ed; 
	  border: 0px;
	  color: #fff;
	  margin-bottom: 9px;
	  text-shadow: 0 1px rgba(0,0,0,0.1); 
	  background-color: #4d90fe;
	  padding: 5px 5px 5px 5px;
	  font-family: roboto;
	  font-size: 15px;
	  border-radius: 20px;
	}

	.loginmodal-submit:hover {
	  border: 1px solid #2f5bb7; 
	  border: 0px;
	  text-shadow: 0 1px rgba(0,0,0,0.3);
	  background-color: #357ae8;
	}
</style>

	<body style="overflow:scroll">
		<div align="center">
	        <div class="account-wall">
	        	<h1 align="center" class="login-title">Se Connecter</h1>
	            <form action="connect.php?action=login" method="post" class="form-signin">
	                <input type="text" class="form-control" placeholder="Email" name="mail">
	                <input type="password" class="form-control" placeholder="Mot de passe" name="password"><br/>
	                <button class="loginmodal-submit" type="submit">
	                    Se Connecter</button><br/>
	                <a href="register.php" class="login-title">S'inscrire</a>
	            </form>
	        </div>
		</div>
	</body>
<?php

include("vue/footer.php");
?>

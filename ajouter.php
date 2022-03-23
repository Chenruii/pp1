<!doctype html>
<html>

   <?php
      include("_header.php");
      include("vue/head.php");
      include("vue/header.php");
   ?>
   <body style="overflow:scroll">
       <?php
         include("vue/vueInsertArticle.php");
         if(isset($_POST["valider"])){

            $tab=array();
            $tab['nom']=$_POST['nom'];
            $tab['prix']=$_POST['prix'];
            $tab['categorie']=$_POST['categorie'];
            $tab['stock']=$_POST['stock'];

            if(!empty($tab['nom']) AND !empty($tab['prix']) AND !empty($tab['categorie']) 
               AND !empty($tab['stock'])){
               $unControleur->insertProduit($tab);
            }
            else{
               echo "<center style= 'margin-top: 20px; margin-bottom: 10px;'><h3><font color='red' >Vous devez remplir tous les champs</font></h3></center>";
            }
            
         }
         include("vue/footer.php");
      ?>
         
   </body>
</html>

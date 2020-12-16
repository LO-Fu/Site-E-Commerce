<?php
session_start();
include_once File::build_path(array("controller","ControllerPanier.php"));

$erreur = false;

$action = (isset($_POST['action'])? $_POST['action']:  (isset($_GET['action'])? $_GET['action']:null )) ;
if($action !== null)
{
   if(!in_array($action,array('ajout', 'suppression', 'refresh')))
   $erreur=true;

   //récupération des variables en POST ou GET
   $i = (isset($_POST['i'])? $_POST['i']:  (isset($_GET['i'])? $_GET['i']:null )) ;
   $v = (isset($_POST['v'])? $_POST['v']:  (isset($_GET['v'])? $_GET['v']:null )) ;
   $c = (isset($_POST['c'])? $_POST['c']:  (isset($_GET['c'])? $_GET['c']:null )) ;
   $p = (isset($_POST['p'])? $_POST['p']:  (isset($_GET['p'])? $_GET['p']:null )) ;
   $q = (isset($_POST['q'])? $_POST['q']:  (isset($_GET['q'])? $_GET['q']:null )) ;

   //Suppression des espaces verticaux
   $i = preg_replace('#\v#', '',$i);
   $v = preg_replace('#\v#', '',$v);
   $c = preg_replace('#\v#', '',$c);
   //On vérifie que $p est un float
   $p = floatval($p);

   //On traite $q qui peut être un entier simple ou un tableau d'entiers
    
   if (is_array($q)){
      $Qte = array();
      $i=0;
      foreach ($q as $contenu){
         $Qte[$i++] = intval($contenu);
      }
   }
   else
   $q = intval($q);
    
}

if (!$erreur){
   switch($action){
      Case "ajout":
         ajouterArticle($i,$v,$c,$q,$p);
         break;

      Case "suppression":
         supprimerArticle($i);
         break;

      Case "refresh" :
         for ($i = 0 ; $i < count($Qte) ; $i++)
         {
            modifierQte($_SESSION['panier']['id'][$i],round($Qte[$i]));
         }
         break;

      Default:
         break;
   }
}

//echo '<?xml version="1.0" encoding="utf-8"?>';?>
<!DOCTYPE html>
<html>
<head>
<title>Votre panier</title>
</head>
<body>

<form method="post" action="panier.php">
<table style="width: 400px">
    <tr>
        <td colspan="4">Votre panier</td>
    </tr>
    <tr>
        <td>Libellé</td>
        <td>Quantité</td>
        <td>Prix Unitaire</td>
        <td>Action</td>
    </tr>


    <?php
    if (creationPanier())
    {
       $nbArticles=count($_SESSION['panier']['id']);
       if ($nbArticles <= 0)
       echo "<tr><td>Votre panier est vide </ td></tr>";
       else
       {
          for ($i=0 ;$i < $nbArticles ; $i++)
          {
             echo "<tr>";
             echo "<td>".htmlspecialchars($_SESSION['panier']['id'][$i])."</ td>";
             echo "<td><input type=\"text\" size=\"4\" name=\"q[]\" value=\"".htmlspecialchars($_SESSION['panier']['qte'][$i])."\"/></td>";
             echo "<td>".htmlspecialchars($_SESSION['panier']['prix'][$i])."</td>";
             echo "<td><a href=\"".htmlspecialchars("panier.php?action=suppression&i=".rawurlencode($_SESSION['panier']['id'][$i]))."\">XX</a></td>";
             echo "</tr>";
          }

          echo "<tr><td colspan=\"2\"> </td>";
          echo "<td colspan=\"2\">";
          echo "Total : ".MontantGlobal();
          echo "</td></tr>";

          echo "<tr><td colspan=\"4\">";
          echo "<input type=\"submit\" value=\"Rafraichir\"/>";
          echo "<input type=\"hidden\" name=\"action\" value=\"refresh\"/>";

          echo "</td></tr>";
       }
    }
    ?>
</table>
</form>
</body>
</html>
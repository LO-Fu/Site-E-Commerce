<?php
/*setCookie("panier",0);
setCookie("panier[id]", 0);
setCookie("panier[variete]", 0);
setCookie("panier[couleur]", 0);
setCookie("panier[qte]", 0);*/

/*$_SESSION['panier']=array();
if (isset($_COOKIE['panier'])) array_push($_SESSION['panier'], $_COOKIE['panier']);

echo var_dump($_SESSION['panier']);*/
session_start();
if (!isset($_SESSION['panier'])){
         $_SESSION['panier']=array();
         $_SESSION['panier']['id'] = array();
         $_SESSION['panier']['variete'] = array();
         $_SESSION['panier']['couleur'] = array();
         $_SESSION['panier']['qte'] = array();
         $_SESSION['panier']['prix'] = array();
         $_SESSION['panier']['lock'] = false;
}

    /*if ($_GET["action"]=="destroy") {
        // on a demander à tout supprimer
        session_destroy();
        header("Location: ".$_SERVER["PHP_SELF"]);
        die();
    }

if (isset($_GET["ajout"])) {
        array_push($_SESSION['panier']["id"],$gi);
        header("Location: ".$_SERVER["PHP_SELF"]);
        die();
   }  */  



$DS = DIRECTORY_SEPARATOR;
require __DIR__ . $DS . "/lib/File.php" ;
require_once File::build_path(array("controller","routeur.php"));
?>
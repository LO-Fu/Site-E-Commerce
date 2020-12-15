<?php
require_once File::build_path(array("model","ModelFleur.php")); // chargement du modèle
class ControllerFleur {

	protected static $object = 'fleur';

	public static function readAll() {
        $controller=static::$object;
        $view='list';
        $pagetitle='Liste de fleurs';
        $fleurs = ModelFleur::selectAll();     //appel au modèle pour gerer la BD
        require File::build_path(array("view","view.php"));  //"redirige" vers la vue
    }

    public static function read(){
        $controller=static::$object;
    	$idFleur = $_GET['id'];
    	$v = ModelFleur::select($idFleur);
        $pagetitle=$idFleur;
    	if($v==NULL) {
            $view='error';
            require File::build_path(array("view","view.php"));
        }
    	else {
            $view='detail';
            require File::build_path(array("view","view.php"));   
            } 
    }

    public static function create(){
        $controller=static::$object;
        $view='update';
        $event = "created";
        $primaryAction = "required";
        $pagetitle="Création de fleur";
        $idFleur='';
        $f = new ModelFleur();
        require File::build_path(array("view","view.php"));
    }

    public static function created(){
        $fleur = new ModelFleur($_GET['variete'],$_GET['couleur'],$_GET['prix'], $_GET['identifiant']);
        ModelFleur::save($fleur);
        $controller= static::$object;
        $view='created';
        $pagetitle="Fleur créée";
        $fleurs = ModelFleur::selectAll();
        $id = htmlspecialchars($_GET['identifiant']);
        require File::build_path(array("view","view.php"));
    }

    public static function update(){
        $controller=static::$object;
        $idFleur = $_GET['id'];
        $f = ModelFleur::select($idFleur);
        $pagetitle="Modification de fleur";
        $primaryAction = "readonly";
        $event = "updated";
        $view='update';
        require File::build_path(array("view","view.php"));
    }

    public static function updated(){
        $fleur = new ModelFleur($_GET['variete'],$_GET['couleur'],$_GET['prix'], $_GET['identifiant']);
        ModelFleur::update($fleur);
        $controller=static::$object;
        $view='updated';
        $pagetitle="Fleur mise à jour";
        $f=Array(htmlspecialchars($_GET['variete']), htmlspecialchars($_GET['couleur']));
        $fleurs = ModelFleur::selectAll();
        require File::build_path(array("view","view.php"));
    }

    public static function delete(){
        ModelFleur::delete($_GET["id"]);
        $id=htmlspecialchars($_GET["id"]);
        $fleurs=ModelFleur::selectAll();
        $controller=static::$object;
        $view='deleted';
        $pagetitle="Supprimer voiture";
        require File::build_path(array("view","view.php"));
    }

    /*public static function addCart(){
        if(!isset($_REQUEST['panier'])) echo 'lol1';
        else{
            $bool=false;

            if (!isset($_SESSION['cart'])) $_SESSION = array();
            $params['id']= $_REQUEST['panier']['id'];
            $fleur= ModelFleur::select($params);
            if(!$fleur) echo 'lol2';
            else {
                $fleurToAdd= array($_REQUEST['panier'],1);
                if (empty($_SESSION['cart'])){
                    array_push($_SESSION, $fleurToAdd);
                    $bool=true;
                }
                else{
                    foreach ($_SESSION['cart'] as $key => $value) {
                        if($value[0] == $_REQUEST['panier']) {
                            if (isset($_REQUEST['qte'])){
                                if ($_REQUEST['qte']<=0){
                                    array_slice($_SESSION, $key, 1);
                                }
                                else{
                                    $_SESSION['cart'][$key][1] = $_REQUEST['qte'];
                                }
                            }
                            else{
                                $_SESSION['cart'][$key][1]++;
                            }
                            $bool=true;
                        }
                    }
                }
            }
            if (!$bool){
                array_push($_SESSION, $fleurToAdd);

                header('Location: ' . $_SERVER['HTTP_REFERER']);
            }
        }
    }*/

    public static function ajouterArticle(){

         //Si le produit existe déjà on ajoute seulement la quantité
         $positionProduit = array_search($_GET['id'],  $_SESSION['panier']['id']);
         $maFleur=ModelFleur::select($_GET['id']);
         $controller=static::$object;
        $view='panier';

         if ($positionProduit !== false)
         {
            $_SESSION['panier']['qte'][$positionProduit] += 1 ;
         }
         else
         {
            //Sinon on ajoute le produit
            array_push( $_SESSION['panier']['id'],$maFleur->get('id'));
            array_push( $_SESSION['panier']['variete'],$maFleur->get('variete'));
            array_push( $_SESSION['panier']['couleur'],$maFleur->get('couleur'));
            array_push( $_SESSION['panier']['qte'],1);
            array_push( $_SESSION['panier']['prix'],$maFleur->get('prix'));
         }
        require File::build_path(array("view","view.php"));
   }

   public static function modifierQte(){
    
         $maFleur=ModelFleur::select($_GET['id']);
         $controller=static::$object;
        //Si la quantité est positive on modifie sinon on supprime l'article
        if ($qte > 0)
        {
            //Recharche du produit dans le panier
            $positionProduit = array_search($_GET['id'],  $_SESSION['panier']['id']);

            if ($positionProduit !== false)
            {
               $_SESSION['panier']['qte'][$positionProduit] = $qte ;
            }
        }
        else
        supprimerArticle($id);
   }

   public static function supprimerArticle($id){

         //Nous allons passer par un panier temporaire
         $tmp=array();
         $tmp['id'] = array();
         $tmp['variete'] = array();
         $tmp['couleur'] = array();
         $tmp['qte'] = array();
         $tmp['prix'] = array();
         $tmp['lock'] = $_SESSION['panier']['lock'];

         for($i = 0; $i < count($_SESSION['panier']['id']); $i++)
         {
            if ($_SESSION['panier']['id'][$i] !== $id)
            {
               array_push( $tmp['id'],$_SESSION['panier']['id'][$i]);
               array_push( $tmp['variete'],$_SESSION['panier']['variete'][$i]);
               array_push( $tmp['couleur'],$_SESSION['panier']['couleur'][$i]);
               array_push( $tmp['qte'],$_SESSION['panier']['qte'][$i]);
               array_push( $tmp['prix'],$_SESSION['panier']['prix'][$i]);
            }

         }
         //On remplace le panier en session par notre panier temporaire à jour
         $_SESSION['panier'] =  $tmp;
         //On efface notre panier temporaire
         unset($tmp);
   }

   public static function total(){
        $total = 0;
        foreach ($_SESSION['panier']['id'] as $product){
            $total = $total + $_SESSION['panier']['qte'][array_search($product,  $_SESSION['panier']['id'])]*$_SESSION['panier']['prix'][array_search($product,  $_SESSION['panier']['id'])];
        }
        return $total;
   }

}
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
}
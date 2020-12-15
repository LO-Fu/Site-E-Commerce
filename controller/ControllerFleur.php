<?php
require_once File::build_path(array("model","ModelFleur.php")); // chargement du modèle
class ControllerFleur {

	protected static $object = 'fleur';

	public static function readAll() {
        $controller='fleur';
        $view='list';
        $pagetitle='Liste de fleurs';
        $fleurs = ModelFleur::selectAll();     //appel au modèle pour gerer la BD
        require File::build_path(array("view","view.php"));  //"redirige" vers la vue
    }

    public static function read(){
        $controller='fleur';
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
        $controller='fleur';
        $view='update';
        $event = "created";
        $primaryAction = "required";
        $pagetitle="Création de fleur";
        require File::build_path(array("view","view.php"));
    }

    public static function created(){
        $fleur = new ModelVoiture($_GET['variete'],$_GET['couleur'],$_GET['prix']);
        $fleur->save();
        $controller= static::$object;
        $view='created';
        $pagetitle="Fleur créée";
        require File::build_path(array("view","view.php"));
    }

    public static function update(){
        $controller='fleur';
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
        $controller='fleur';
        $view='updated';
        $pagetitle="Fleur mise à jour";
        $f=Array(htmlspecialchars($_GET['variete']), htmlspecialchars($_GET['couleur']));
        $fleurs = ModelFleur::selectAll();
        require File::build_path(array("view","view.php"));
    }
}
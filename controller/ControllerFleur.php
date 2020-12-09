<?php
require_once File::build_path(array("model","ModelFleur.php")); // chargement du modèle
class ControllerFleur {

	protected static $object = 'fleur';

	public static function readAll() {
        $controller='fleur';
        $view='list';
        $pagetitle='Liste de fleurs';
        $tab_v = ModelFleur::selectAll();     //appel au modèle pour gerer la BD
        require File::build_path(array("view","view.php"));  //"redirige" vers la vue
    }

    public static function read(){
        $controller='fleur';
    	$p1 = $_GET['variete'];
    	$p2 = $_GET['couleur'];
    	$v = ModelFleur::select($p1,$p2);
        $pagetitle=$p1.$p2;
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
        $view='create';
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
        $f = ModelFleur::getFleurByCV($_GET['couleur'], $_GET['variete']);
        $pagetitle="Modification de voitures";
        $view='update';
        require File::build_path(array("view","view.php"));
    }

    public static function updated(){
        $fleur = new ModelFleur($_GET['variete'],$_GET['couleur'],$_GET['prix']);
        ModelFleur::update($fleur);
        $controller='fleur';
        $view='updated';
        $pagetitle="Fleur mise à jour";
        $f=Array(htmlspecialchars($_GET['variete']), htmlspecialchars($_GET['couleur']));
        require File::build_path(array("view","view.php"));
    }
}
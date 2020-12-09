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
}
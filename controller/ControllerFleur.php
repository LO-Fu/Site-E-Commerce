<?php
require_once File::build_path(array("model","ModelFleur.php")); // chargement du modèle
class ControllerFleur {
	public static function readAll() {
        $controller='fleur';
        $view='list';
        $pagetitle='Liste de fleurs';
        $tab_v = ModelFleur::getAllFleurs();     //appel au modèle pour gerer la BD
        require File::build_path(array("view","view.php"));  //"redirige" vers la vue
    }
}
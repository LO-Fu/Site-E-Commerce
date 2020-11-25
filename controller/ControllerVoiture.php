<?php
require_once File::build_path(array("model","ModelVoiture.php")); // chargement du modèle
class ControllerVoiture {
    public static function readAll() {
        $controller='voiture';
        $view='list';
        $pagetitle='Liste de voitures';
        $tab_v = ModelVoiture::selectAll();     //appel au modèle pour gerer la BD
        require File::build_path(array("view","view.php"));  //"redirige" vers la vue
    }

    public static function read(){
        $controller='voiture';
    	$p = $_GET['immat'];
    	$v = ModelVoiture::getVoitureByImmat($p);
        $pagetitle=$p;
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
        $controller='voiture';
        $view='create';
        $pagetitle="Création de voitures";
    	require File::build_path(array("view","view.php"));
    }

    public static function created(){
    	$voiture = new ModelVoiture($_GET['marque'],$_GET['couleur'],$_GET['immat']);
    	$voiture->save();
        $controller='voiture';
        $view='created';
        $pagetitle="Voiture créée";
        require File::build_path(array("view","view.php"));
    }

    public static function delete(){
        $p=$_GET["immat"];
        ModelVoiture::deleteByImmat($p);
        $p=htmlspecialchars($p);
        $tab_v=ModelVoiture::getAllVoitures();
        $controller='voiture';
        $view='deleted';
        $pagetitle="Supprimer voiture";
        require File::build_path(array("view","view.php"));
    }

    public static function update(){
        $controller='voiture';
        $p = $_GET['immat'];
        $v = ModelVoiture::getVoitureByImmat($p);
        $pagetitle="Modification de voitures";
        $view='update';
        require File::build_path(array("view","view.php"));
    }

    public static function updated(){
        $voiture = new ModelVoiture($_GET['marque'],$_GET['couleur'],$_GET['immat']);
        ModelVoiture::update($voiture);
        $controller='voiture';
        $view='updated';
        $pagetitle="Voiture mise à jour";
        $p=$_GET["immat"];
        $p=htmlspecialchars($p);
        require File::build_path(array("view","view.php"));
    }

}
?>
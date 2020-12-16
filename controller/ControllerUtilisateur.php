<?php
require_once File::build_path(array("model", "ModelUtilisateur.php")); // chargement du modèle
require_once File::build_path(array("lib", "Security.php"));

class ControllerUtilisateur
{

    protected static $object = 'utilisateur';

    public static function readAll()
    {
        $controller = static::$object;
        $view = 'list';
        $pagetitle = "Liste d'utilisateurs";
        $tab_v = ModelUtilisateur::selectAll();     //appel au modèle pour gerer la BD
        require File::build_path(array("view", "view.php"));  //"redirige" vers la vue
    }

    public static function read()
    {
        $controller = static::$object;
        $p = htmlspecialchars($_GET['login']);
        $v = ModelUtilisateur::select($p);
        $pagetitle = $p;
        if ($v == NULL) {
            $view = 'error';
            require File::build_path(array("view", "view.php"));
        } else {
            $view = 'detail';
            require File::build_path(array("view", "view.php"));
        }
    }

    public static function delete()
    {
        $p = $_GET["login"];
        ModelUtilisateur::delete($p);
        $p = htmlspecialchars($p);
        $tab_v = ModelUtilisateur::selectAll();
        $controller = static::$object;
        $view = 'deleted';
        $pagetitle = "Supprimer utilisateur";
        require File::build_path(array("view", "view.php"));
    }

    public static function create()
    {
        $controller = static::$object;
        $view = 'update';
        $event = "created";
        $primaryAction = "required";
        $pagetitle = "Création de d'utilisateur";
        $login = '';
        $u = new ModelUtilisateur();
        require File::build_path(array("view", "view.php"));
    }

    public static function created()
    {
        $utilisateur = new ModelUtilisateur($_GET['login'], $_GET['nom'], $_GET['prenom'], Security::hacher($_GET['mdp']));
        ModelUtilisateur::save($utilisateur);
        $controller = static::$object;
        $view = 'created';
        $pagetitle = "Utilisateur créé";
        $tab_v = ModelUtilisateur::selectAll();
        $login = htmlspecialchars($_GET['login']);
        require File::build_path(array("view", "view.php"));
    }

    public static function update()
    {
        $controller = static::$object;
        $login = $_GET['login'];
        $u = ModelUtilisateur::select($login);
        $pagetitle = "Modification d'utilisateur'";
        $primaryAction = "readonly";
        $event = "updated";
        $view = 'update';
        require File::build_path(array("view", "view.php"));
    }

    public static function updated()
    {
        $utilisateur = new ModelUtilisateur($_GET['login'], $_GET['nom'], $_GET['prenom'], Security::hacher($_GET['mdp']));
        ModelUtilisateur::update($utilisateur);
        $controller = static::$object;
        $view = 'updated';
        $pagetitle = "Utilisateur mise à jour";
        $tab_v = ModelUtilisateur::selectAll();
        require File::build_path(array("view", "view.php"));
    }

    public static function connect()
    {
        $controller = static::$object;
        $view = 'connect';
        $pagetitle = "Authentification";
        require File::build_path(array("view", "view.php"));
    }

    public static function connected()
    {
        $login = htmlspecialchars($_GET['login']);
        if (ModelUtilisateur::checkPassword($login, Security::hacher(htmlspecialchars($_GET['mdp'])))) {
            $_SESSION['login'] = $login;
            self::read();
        } else {
            header('Location: index.php');
        }
    }

    public static function deconnect()
    {
        if(isset($_SESSION['login'])){
            session_unset();
            session_destroy();
        }
            header('Location: index.php');
    }
}

?>
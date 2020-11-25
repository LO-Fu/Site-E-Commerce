<?php
require_once File::build_path(array("model","Model.php"));
//require_once 'Trajet.php';

class ModelUtilisateur {


    protected static $object='utilisateur';
    private $login;
    private $nom;
    private $prenom;

    // Getter générique (pas expliqué en TD)
    public function get($nom_attribut) {
        if (property_exists($this, $nom_attribut))
            return $this->$nom_attribut;
        return false;
    }

    // Setter générique (pas expliqué en TD)
    public function set($nom_attribut, $valeur) {
        if (property_exists($this, $nom_attribut))
            $this->$nom_attribut = $valeur;
        return false;
    }

    // un constructeur
    public function __construct($login = NULL, $nom = NULL, $prenom = NULL) {
        if (!is_null($login) && !is_null($nom) && !is_null($prenom)) {
            $this->login = $login;
            $this->nom = $nom;
            $this->prenom = $prenom;
        }
    }

    // une methode d'affichage.
    /*public function afficher() {
        echo "Utilisateur {$this->prenom} {$this->nom} de login {$this->login}\n";
    }*/

    public static function getAllUtilisateurs() {
        $rep = Model::$pdo->query("SELECT * FROM utilisateur");
        $rep->setFetchMode(PDO::FETCH_CLASS, 'ModelUtilisateur');
        return $rep->fetchAll();
    }

    /*public static function findTrajets($login) {
        try{
            $sql="SELECT t.* FROM `utilisateur` u JOIN `passager` p ON u.login=p.utilisateur_login JOIN `trajet` t ON t.id=p.trajet_id WHERE login=:login";
            $req_prep = Model::$pdo->prepare($sql);
            $values = array(
            ":login" => $login,);
            $req_prep->execute($values);
            $req_prep->setFetchMode(PDO::FETCH_CLASS, 'Utilisateur');
            $tab_voit = $req_prep->fetchAll();
        if (empty($tab_voit))
            return false;
        return $tab_voit;
       } catch(PDOException $e) {
            echo $e->getMessage();
            die();
        }
    }*/
}
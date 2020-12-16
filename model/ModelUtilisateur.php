<?php
require_once File::build_path(array("model","Model.php"));

class ModelUtilisateur extends Model{


    protected static $object='utilisateur';
    protected static $primary='login';
    protected $login;
    protected $nom;
    protected $prenom;
    protected $mdp;

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
    public function __construct($login = NULL, $nom = NULL, $prenom = NULL, $mdp = NULL) {
        if (!is_null($login) && !is_null($nom) && !is_null($prenom) && !is_null($mdp)) {
            $this->login = $login;
            $this->nom = $nom;
            $this->prenom = $prenom;
            $this->mdp = $mdp;
        }
    }


    public static function getAllUtilisateurs() {
        $rep = Model::$pdo->query("SELECT * FROM utilisateur");
        $rep->setFetchMode(PDO::FETCH_CLASS, 'ModelUtilisateur');
        return $rep->fetchAll();
    }

    public static function checkPassword($login,$mot_de_passe_hache){
        $rep = "SELECT mdp FROM utilisateur WHERE login =:login";
        $req_prep = Model::$pdo->prepare($rep);
        $values = array(
          'login' => $login
        );
        $req_prep->execute($values);
        $req_prep->setFetchMode(PDO::FETCH_CLASS, 'ModelUtilisateur');
        $u = $req_prep->fetch();
        $mdp = $u[0]->get('mdp');
        if ($mdp == $mot_de_passe_hache){
            return true;
        }else{
            return false;
        }
    }
}
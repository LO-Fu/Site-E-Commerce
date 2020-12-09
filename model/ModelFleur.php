<?php
require_once File::build_path(array("model","Model.php"));

class ModelFleur extends Model
{

    protected static $object='fleur';
    protected static $primary='variete';
    protected static $secondary='couleur';
    private $variete;
    private $couleur;
    private $prix;

    public function __construct($v = NULL, $c = NULL, $p = NULL)
    {
        if (!is_null($v) && !is_null($c) && !is_null($p)) {
            $this->variete = $v;
            $this->couleur = $c;
            $this->prix = $p;
        }
    }

    public static function getFleurByCV($couleur, $variete)
    {
        $sql = "SELECT * from voiture WHERE variete=:var AND couleur=:coul";
        $req_prep = Model::$pdo->prepare($sql);

        $values = array(
            "var" => $variete,
            "coul" => $couleur
        );

        $req_prep->execute($values);

        $req_prep->setFetchMode(PDO::FETCH_CLASS, 'ModelFleur');
        $tab_fleur= $req_prep->fetchAll();
        // Careful: you should handle the special case of no results
        if (empty($tab_fleur))
            return false;
        return $tab_fleur[0];

    }

    public function get($nom_attribut) {
        if (property_exists($this, $nom_attribut))
            return $this->$nom_attribut;
        return false;
    }

    // Setter générique
    public function set($nom_attribut, $valeur) {
        if (property_exists($this, $nom_attribut))
            $this->$nom_attribut = $valeur;
        return false;
    }

    static public function getAllFleurs()
    {
        $rep = Model::$pdo->query("SELECT * FROM fleur");
        $rep->setFetchMode(PDO::FETCH_CLASS, 'ModelFleur');
        return $rep->fetchAll();
    }
}
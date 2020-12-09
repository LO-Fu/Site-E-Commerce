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

    // Getter générique
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
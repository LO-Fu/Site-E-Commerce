<?php
require_once File::build_path(array("model","Model.php"));

class ModelFleur extends Model
{

    protected static $object='fleur';
    protected static $primary='id';
    protected $id;
    protected $variete;
    protected $couleur;
    protected $prix;

    public function __construct($v = NULL, $c = NULL, $p = NULL, $id = NULL)
    {
        if (!is_null($v) && !is_null($c) && !is_null($p) && !is_null($id)) {
            $this->variete = $v;
            $this->couleur = $c;
            $this->prix = $p;
            $this->id = $id;
        }
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


}
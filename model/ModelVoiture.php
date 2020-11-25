<?php
require_once File::build_path(array("model","Model.php"));

class ModelVoiture extends Model
{

    protected static $object='voiture';
    private $marque;
    private $couleur;
    private $immatriculation;

    public function __construct($m = NULL, $c = NULL, $i = NULL)
    {
        if (!is_null($m) && !is_null($c) && !is_null($i)) {
            $this->marque = $m;
            $this->couleur = $c;
            $this->immatriculation = $i;
        }
    }

    static public function getAllVoitures()
    {
        $rep = Model::$pdo->query("SELECT * FROM voiture");
        $rep->setFetchMode(PDO::FETCH_CLASS, 'ModelVoiture');
        return $rep->fetchAll();
    }

    public function getMarque()
    {
        return $this->marque;
    }

    public function setMarque($marque2)
    {
        $this->marque = $marque2;
    }

    public function getCouleur()
    {
        return $this->couleur;
    }

    public function setCouleur($couleur2)
    {
        $this->marque = $couleur2;
    }

    public function getimmatriculation()
    {
        return $this->immatriculation;
    }

    public function setImmatriculation($immatriculation2)
    {
        if (strlen($immatriculation2) > 8) {
            $this->marque = $immatriculation2;
        }
    }

    /*public function afficher()
    {
        echo "<p> Voiture immatriculée $this->immatriculation de marque $this->marque (couleur $this->couleur) </p>";
    }*/

    public static function getVoitureByImmat($immat) {
    // In the query, put tags :xxx instead of variables $xxx
    $sql = "SELECT * from voiture WHERE immatriculation=:nom_tag";
    // Prepare the SQL statement
    $req_prep = Model::$pdo->prepare($sql);

    $values = array(
        "nom_tag" => $immat,
        //nomdutag => valeur, ...
    );
    // Execute the SQL prepared statement after replacing tags 
    // with the values given in $values
    $req_prep->execute($values);

    // Retrieve results as previously
    $req_prep->setFetchMode(PDO::FETCH_CLASS, 'ModelVoiture');
    $tab_voit = $req_prep->fetchAll();
    // Careful: you should handle the special case of no results
    if (empty($tab_voit))
        return false;
    return $tab_voit[0];
    }

    public static function deleteByImmat($immat){
        $sql = "DELETE FROM `voiture` WHERE `voiture`.`immatriculation` =:immat";
        $req_prep = Model::$pdo->prepare($sql);
        $values = array(
            "immat" => $immat,);

        $req_prep->execute($values);
    }

    public function save(){
        try{
            $sql = "INSERT INTO voiture (immatriculation,marque,couleur) VALUES (:immat,:marque,:couleur)";
            $req_prep = Model::$pdo->prepare($sql);

            $values = array(
            ":immat" => $this->immatriculation,
            ":marque" => $this->marque,
            ":couleur" => $this->couleur,);
            $req_prep->execute($values);
        } catch(PDOException $e) {
            echo $e->getMessage(); // affiche un message d'erreur
            die();
        }
    }

    public static function update($data){
        try{
            $sql = "UPDATE voiture SET marque = :marque, couleur = :couleur WHERE `voiture`.`immatriculation`=:immat";
            $req_prep = Model::$pdo->prepare($sql);

            $values = array(
            ":immat" => $data->immatriculation,
            ":marque" => $data->marque,
            ":couleur" => $data->couleur,);
            $req_prep->execute($values);
        }catch(PDOException $e) {
            echo $e->getMessage(); // affiche un message d'erreur
            die();
        }
    }


}

?>
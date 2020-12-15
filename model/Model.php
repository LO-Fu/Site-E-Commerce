<?php
require_once File::build_path(array("config","Conf.php"));

class Model{

	public static $pdo;

	public static function Init(){
		$hostname = Conf::getHostname();
		$database_name = Conf::getDatabase();
		$login = Conf::getLogin();
		$password = Conf::getPassword();

		try{
			self::$pdo = new PDO("mysql:host=$hostname;dbname=$database_name",$login,$password,array(PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES utf8"));
			self::$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
		} catch(PDOException $e) {
			echo $e->getMessage(); // affiche un message d'erreur
  			die();
		}
	}

	public static function selectAll()
    {
    	$table_name=static::$object;
    	$class_name='Model'.ucfirst($table_name);
        $rep = self::$pdo->query("SELECT * FROM ".$table_name);
        $rep->setFetchMode(PDO::FETCH_CLASS, $class_name);
        return $rep->fetchAll();
    }

    public static function select($primary_value) {
        $table_name=static::$object;
        $class_name='Model'.ucfirst($table_name);
        $primary_key=static::$primary;
        // In the query, put tags :xxx instead of variables $xxx
        $sql = "SELECT * from ".$table_name." WHERE ".$primary_key."=:nom_tag";
        // Prepare the SQL statement
        $req_prep = Model::$pdo->prepare($sql);

        $values = array(
            "nom_tag" => $primary_value,
            //nomdutag => valeur, ...
        );
        // Execute the SQL prepared statement after replacing tags
        // with the values given in $values
        $req_prep->execute($values);

        // Retrieve results as previously
        $req_prep->setFetchMode(PDO::FETCH_CLASS, $class_name);
        $tab_voit = $req_prep->fetchAll();
        // Careful: you should handle the special case of no results
        if (empty($tab_voit))
            return false;
        return $tab_voit[0];
    }

    public static function delete($primary_value){
    	$table_name=static::$object;
    	$class_name='Model'.ucfirst($table_name);
    	$primary_key=static::$primary;

        $sql = "DELETE FROM ".$table_name." WHERE ".$primary_key." =:name_tag";
        $req_prep = Model::$pdo->prepare($sql);
        $values = array(
            "name_tag" => $primary_value,);

        $req_prep->execute($values);
    }

    public static function update($data){
        try{
            $sql = "UPDATE :object SET ";
            $pkey = static::$primary;
            $values = array(":object" => static::$object);
            foreach($data as $clef => $value){
                echo "$clef => $value\n";
                echo "a";
                $sql = $sql."$clef=:$clef, ";
                $values[":".$clef] = $value;
            }
            $values[":".$pkey] = $values -> $pkey;
            var_dump($values);
            var_dump($sql);
            var_dump($data);
            $req_prep = Model::$pdo->prepare($sql."WHERE `:object`.`$pkey`=:primary");
            $req_prep->execute($values);

        }catch(PDOException $e) {
            echo $e->getMessage(); // affiche un message d'erreur
            die();
        }
    }
}

Model::Init();
?>
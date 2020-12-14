<?php
var_dump($_GET);
var_dump($idFleur);
var_dump($f);
$variete = htmlspecialchars($f::get('variete'));
$couleur = htmlspecialchars($f::get('couleur'));
$prix = htmlspecialchars($f::get('prix'));
?>

<!DOCTYPE html>
<html>
<body>
<form method="get" action="index.php">
    <fieldset>
        <legend>Mon formulaire :</legend>
        <p>
            <label for="id">ID</label> :
            <input type="text" value="<?php echo $idFleur ?>" name="identifiant" id="id" <?php if ($view == 'update')echo "readonly"; else echo "required"?>/>
        </p>
        <p>
            <label for="var_id">Variete</label> :
            <input type="text" value="<?php echo $variete ?>" name="variete" id="var_id" required/>
        </p>
        <p>
            <label for="couleur_id">Couleur</label> :
            <input type="text" value="<?php echo $couleur ?>" name="couleur" id="couleur_id" required/>
        </p>
        <p>
            <label for="prix_id">Prix</label> :
            <input type="text" value="<?php echo $prix ?>" name="prix" id="prix_id" required />
        </p>
        <p>
            <input type="submit" value="Envoyer" />
            <input type='hidden' name='controller' value='fleur'/>
            <input type='hidden' name='action' value="<?php if ($view == 'update')echo "updated"; else echo "created"?>"/>
        </p>
    </fieldset>
</form>
</body>
</html>

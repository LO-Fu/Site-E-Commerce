<?php
$g3=$f->get('prix');
$g1=htmlspecialchars($_GET['variete']);
$g2=htmlspecialchars($_GET['couleur']);
$g3=htmlspecialchars($g3);
?>

<!DOCTYPE html>
<html>
<body>
<form method="get" action="index.php">
    <fieldset>
        <legend>Mon formulaire :</legend>
        <p>
            <label for="var_id">Variete</label> :
            <input type="text" value="<?php echo $g1 ?>" name="variete" id="var_id" readonly/>
        </p>
        <p>
            <label for="couleur_id">Couleur</label> :
            <input type="text" value="<?php echo $g2 ?>" name="couleur" id="couleur_id" readonly/>
        </p>
        <p>
            <label for="prix_id">Prix</label> :
            <input type="text" value="<?php echo $g3 ?>" name="prix" id="prix_id" required />
        </p>
        <p>
            <input type="submit" value="Envoyer" />
            <input type='hidden' name='controller' value='fleur'/>
            <input type='hidden' name='action' value='updated'/>
        </p>
    </fieldset>
</form>
</body>
</html>

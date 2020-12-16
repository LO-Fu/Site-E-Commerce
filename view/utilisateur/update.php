<?php
$nom = htmlspecialchars($u->get('nom'));
$prenom = htmlspecialchars($u->get('prenom'));
$mdp = htmlspecialchars($u->get('mdp'));
?>

<!DOCTYPE html>
<html>
<body>
<form method="get" action="index.php">
    <fieldset>
        <legend>Mon formulaire :</legend>
        <p>
            <label for="login">Login</label> :
            <input type="text" value="<?php echo $login ?>" name="login" id="login" <?php echo $primaryAction ?>/>
        </p>
        <p>
            <label for="nom_id">Nom</label> :
            <input type="text" value="<?php echo $nom ?>" name="nom" id="nom_id" required/>
        </p>
        <p>
            <label for="prenom_id">Prénom</label> :
            <input type="text" value="<?php echo $prenom ?>" name="prenom" id="prenom_id" required/>
        </p>
        <p>
            <label for="mdp_id">mdp</label> :
            <input type="password" value="<?php echo $mdp ?>" name="mdp" id="mdp_id" required/>
        </p>
        <p>
            <label for="mdp_id">Confirmation mdp</label> :
            <input type="password" value="<?php echo $mdp ?>" name="mdp" id="mdp_id" required/>
        </p>
        <p>
            <input type="submit" value="Envoyer" />
            <input type='hidden' name='controller' value='utilisateur'/>
            <input type='hidden' name='action' value="<?php echo $event?>"/>
        </p>
    </fieldset>
</form>
</body>
</html>

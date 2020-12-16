!DOCTYPE html>
<html>
<body>
<form method="get" action="index.php">
    <fieldset>
        <legend>Mon formulaire :</legend>
        <p>
            <label for="login">Login</label> :
            <input type="text" placeholder="lof" name="login" id="login" required/>
        </p>
        <p>
            <label for="mdp_id">mdp</label> :
            <input type="password" name="mdp" id="mdp_id" required/>
        </p>
        <p>
            <input type="submit" value="Envoyer" />
            <input type='hidden' name='controller' value='utilisateur'/>
            <input type='hidden' name='action' value="connected"/>
        </p>
    </fieldset>
</form>
</body>
</html>
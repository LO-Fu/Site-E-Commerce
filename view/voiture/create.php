<!DOCTYPE html>
<html>
    <body>
        <form method="get" action="index.php?controller=voiture&action=created">
  <fieldset>
    <legend>Mon formulaire :</legend>
    <p>
      <label for="immat_id">Immatriculation</label> :
      <input type="text" placeholder="Ex : 256AB34" name="immat" id="immat_id" required/>
    </p>
     <p>
      <label for="marque_id">Marque</label> :
      <input type="text" placeholder="Ex : Porsche" name="marque" id="marque_id" required/>
    </p>
     <p>
      <label for="coul_id">Couleur</label> :
      <input type="text" placeholder="Ex : Rouge" name="couleur" id="coul_id" required/>
    </p>
    <p>
      <input type="submit" value="Envoyer" />
      <input type='hidden' name='controller' value='voiture'/>
      <input type='hidden' name='action' value='created'/>
    </p>
  </fieldset> 
</form>
    </body>
</html>
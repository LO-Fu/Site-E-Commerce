<?php
  $g1=$v->getImmatriculation();
  $g2=$v->getMarque();
  $g3=$v->getCouleur();
  $g1=htmlspecialchars($g1);
  $g2=htmlspecialchars($g2);
  $g3=htmlspecialchars($g3);
?>

<!DOCTYPE html>
<html>
    <body>
        <form method="get" action="index.php?controller=voiture&action=updated">
  <fieldset>
    <legend>Mon formulaire :</legend>
    <p>
      <label for="immat_id">Immatriculation</label> :
      <input type="text" value="<?php echo $g1 ?>" name="immat" id="immat_id" readonly/>
    </p>
     <p>
      <label for="marque_id">Marque</label> :
      <input type="text" value="<?php echo $g2 ?>" name="marque" id="marque_id" required />
    </p>
     <p>
      <label for="coul_id">Couleur</label> :
      <input type="text" value="<?php echo $g3 ?>" name="couleur" id="coul_id" required />
    </p>
    <p>
      <input type="submit" value="Envoyer" />
      <input type='hidden' name='controller' value='voiture'/>
      <input type='hidden' name='action' value='updated'/>
    </p>
  </fieldset> 
</form>
    </body>
</html>
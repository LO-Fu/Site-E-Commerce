<?php
  $num_baniere = rand(1,6);
  $fleur = isset($_GET['fleur']) ? $_GET['fleur'] : "rose";
  /*  remarque PHP : la structure "ternaire" ci-dessus
      est exactement équivalente au code suivant :
    if (isset($_GET['fleur'])) {
      $fleur = $_GET['fleur'];
    } else {
      $fleur = "rose";
    }
  */
?>
<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="img/icones/fleur.ico" rel="icon" type="image/x-icon" />
    <link rel="stylesheet" type="text/css" href="css/stylesDivers.css">
    <link rel="stylesheet" type="text/css" href="css/stylesBaniere.css">
    <link rel="stylesheet" type="text/css" href="css/stylesMenu.css">
    <link rel="stylesheet" type="text/css" href="css/stylesGalerie.css">
    <title>Galeries de fleurs</title>
  </head>
  <body>
    <?php echo "<p>appel serveur à ".date('H:i:s')."</p>"; ?>
    <div id="page">
      <img id="parametres" src="img/divers/parametres.png">
      <header>
        <div id="baniere">
            <img id="1" class="img_baniere visible" alt="baniere" src="img/baniere/baniere<?php echo $num_baniere; ?>.jpg">
        </div>
        <nav>
          <ul>
            <li><a href="index.php?fleur=rose">rose</a></li>
            <li><a href="index.php?fleur=hortensia">hortensia</a></li>
            <li><a href="index.php?fleur=fruitier">fruitier</a></li>
            <li><a href="index.php?fleur=autre">autre</a></li>
          </ul>
        </nav>
      </header>
      <main>
        <div class="titrePage">
          <h1><span id="titre">Galerie de fleurs</span></h1>
        </div>
        <div class='galerie'>
          <div class='ligne_galerie'>
            <img id='fleur1' class='img_galerie' alt='<?php echo $fleur; ?>1' title='<?php echo $fleur; ?>' src='img/fleurs/<?php echo $fleur; ?>/<?php echo $fleur; ?>1.jpg'>
            <img id='fleur2' class='img_galerie' alt='<?php echo $fleur; ?>2' title='<?php echo $fleur; ?>' src='img/fleurs/<?php echo $fleur; ?>/<?php echo $fleur; ?>2.jpg'>
            <img id='fleur3' class='img_galerie' alt='<?php echo $fleur; ?>3' title='<?php echo $fleur; ?>' src='img/fleurs/<?php echo $fleur; ?>/<?php echo $fleur; ?>3.jpg'>
          </div>
          <div class='ligne_galerie'>
            <img id='fleur4' class='img_galerie' alt='<?php echo $fleur; ?>4' title='<?php echo $fleur; ?>' src='img/fleurs/<?php echo $fleur; ?>/<?php echo $fleur; ?>4.jpg'>
            <img id='fleur5' class='img_galerie' alt='<?php echo $fleur; ?>5' title='<?php echo $fleur; ?>' src='img/fleurs/<?php echo $fleur; ?>/<?php echo $fleur; ?>5.jpg'>
            <img id='fleur6' class='img_galerie' alt='<?php echo $fleur; ?>6' title='<?php echo $fleur; ?>' src='img/fleurs/<?php echo $fleur; ?>/<?php echo $fleur; ?>6.jpg'>
          </div>
        </div>
      </main>
      <footer>
        <p>JavaScript 2020</p>
        <p>TD1 - dynamiser les pages web</p>
      </footer>
    </div>
  </body>
</html>
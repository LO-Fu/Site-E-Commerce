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
    <link href="../img/icones/fleur.ico" rel="icon" type="image/x-icon" />
    <link rel="stylesheet" type="text/css" href="../css/stylesDivers.css">
    <link rel="stylesheet" type="text/css" href="../css/stylesBaniere.css">
    <link rel="stylesheet" type="text/css" href="../css/stylesMenu.css">
    <link rel="stylesheet" type="text/css" href="../css/stylesGalerie.css">
        <title><?php echo $pagetitle; ?></title>
    </head>
    <body>
    	<header>
        <div id="baniere">
            <img id="1" class="img_baniere visible" alt="baniere" src="../img/baniere/baniere<?php echo $num_baniere; ?>.jpg">
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
		<?php
		// Si $controleur='voiture' et $view='list',
		// alors $filepath="/chemin_du_site/view/voiture/list.php"
		$filepath = File::build_path(array("view", $controller, "$view.php"));
		require $filepath;
		?>
		<footer>
        <p>PHP 2020</p>
        <p>Site E-Commerce de Floralys</p>
      </footer>
    </body>
</html>
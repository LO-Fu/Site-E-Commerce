<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <title><?php echo $pagetitle; ?></title>
    </head>
    <body>
    	<header>
    		<nav>
    			<p style="border: 1px solid black;text-align:left;padding-right:1em;">
    				<a href="index.php?controller=voiture&action=readAll">Accueil</a>
    				<a href="index.php?controller=utilisateur&action=readAll">Utilisateurs</a>
    				<a href="index.php?controller=trajet&action=readAll">Trajets</a>
    			</p>
    		</nav>
    	</header>
		<?php
		// Si $controleur='voiture' et $view='list',
		// alors $filepath="/chemin_du_site/view/voiture/list.php"
		$filepath = File::build_path(array("view", $controller, "$view.php"));
		require $filepath;
		?>
		<footer>
			<p style="border: 1px solid black;text-align:right;padding-right:1em;">
  					Site de covoiturage de Fu Lo
			</p>
		</footer>
    </body>
</html>
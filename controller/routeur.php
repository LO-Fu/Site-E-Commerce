<?php
require_once File::build_path(array("controller", "ControllerFleur.php"));
require_once File::build_path(array("controller", "ControllerUtilisateur.php"));
require_once File::build_path(array("controller", "ControllerPanier.php"));

if (isset($_GET['controller'])) $controller = $_GET['controller'];
else{
    $controller = 'fleur';
}
    $controller_class = "Controller" . ucfirst($controller);
if (class_exists($controller_class)) {
    // On recupère l'action passée dans l'URL
    if (isset($_GET['action'])) $action = $_GET['action'];
    else $action = "readAll";
}

// Appel de la méthode statique $action de ControllerVoiture
$class_methods = get_class_methods($controller_class);
if (in_array($action, $class_methods)) $controller_class::$action();
else {
    $view = 'errorController';
    require File::build_path(array("view", "view.php"));
}
?>

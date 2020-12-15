<?php

session_start();

if (isset($_SESSION['LAST_ACTIVITY']) && (time() - $_SESSION['LAST_ACTIVITY'] > (30 * 60))) {
    // if last request was more than 30 minutes ago
    session_unset();     // unset $_SESSION variable for the run-time
    session_destroy();   // destroy session data in storage
} else {
    $_SESSION['LAST_ACTIVITY'] = time(); // update last activity time stamp
}

if (!isset($_SESSION['panier'])) {
    $_SESSION['panier'] = array();
    $_SESSION['panier']['id'] = array();
    $_SESSION['panier']['variete'] = array();
    $_SESSION['panier']['couleur'] = array();
    $_SESSION['panier']['qte'] = array();
    $_SESSION['panier']['prix'] = array();
    $_SESSION['panier']['lock'] = false;
}


$DS = DIRECTORY_SEPARATOR;
require __DIR__ . $DS . "/lib/File.php";
require_once File::build_path(array("controller", "routeur.php"));
?>
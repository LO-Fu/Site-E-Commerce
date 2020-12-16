<?php
require File::build_path(array("view","view.php"));
?>
<!DOCTYPE html>
<html>
<body>
<?php
if (isset($_SESSION['login'])) {
    if (!empty($_SESSION['panier'])) {
        echo "Merci pour votre achat !";
        $_SESSION['panier'] = array();
        $_SESSION['panier']['id'] = array();
        $_SESSION['panier']['variete'] = array();
        $_SESSION['panier']['couleur'] = array();
        $_SESSION['panier']['qte'] = array();
        $_SESSION['panier']['prix'] = array();
        $_SESSION['panier']['lock'] = false;
    } else {
        echo "Votre panier est vide";
    }
} else {
    echo "<a href=\"index.php?controller=utilisateur&action=connect\">Veuillez vous connecter</a>";
}
?>
</body>
</html>


<!DOCTYPE html>
<html>
<head>
    <title>Votre panier</title>
</head>
<body>

<form method="post" action="../../view/panier/achat.php">
    <table style="width: 400px">
        <tr>
            <td colspan="4">Votre panier</td>
        </tr>
        <tr>
            <td>Libellé</td>
            <td>Quantité</td>
            <td>Prix Unitaire</td>
            <td>Action</td>
        </tr>


        <?php

            $nbArticles=count($_SESSION['panier']['id']);
            if ($nbArticles <= 0)
                echo "<tr><td>Votre panier est vide </ td></tr>";
            else
            {
                for ($i=0 ;$i < $nbArticles ; $i++)
                {
                    echo "<tr>";
                    echo "<td>".htmlspecialchars($_SESSION['panier']['id'][$i])."</ td>";
                    echo "<td>".htmlspecialchars($_SESSION['panier']['qte'][$i])."</td>";
                    echo "<td>".htmlspecialchars($_SESSION['panier']['prix'][$i])."</td>";
                    echo "<td><a href=\"".htmlspecialchars("index.php?controller=fleur&action=supprimerArticle&id=".rawurlencode($_SESSION['panier']['id'][$i]))."\">Supprimer</a></td>";
                    echo "</tr>";
                }

                echo "<tr><td colspan=\"2\"> </td>";
                echo "<td colspan=\"2\">";
                echo "Total : ". ControllerFleur::total();
                echo "</td></tr>";

                echo "<tr><td colspan=\"4\">";

                echo "<input type=\"submit\" value=\"Rafraichir\"/>";
                echo "<input type=\"hidden\" name=\"action\" value=\"Valider\"/>";

                echo "</td></tr>";
            }
        ?>
    </table>
</form>
</body>
</html>
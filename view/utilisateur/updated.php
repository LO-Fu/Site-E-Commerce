<?php
echo "<p>L'utilisateur au nom $u[0] et prénom $u[1] a bien été modifié.</p>";
require File::build_path(array("view","utilisateur","list.php"));
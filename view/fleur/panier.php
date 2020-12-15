<?php
    foreach($_SESSION['panier'] as $attribute){
        foreach ($attribute as $key => $value){
            echo $value;
        }
    }
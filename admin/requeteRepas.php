<?php
    /* Fichier php pour faire les requêtes d'appel sur la base pour récupérer les données de la table t_menu_men */
    include "../bdd/connect.php";

    $menu = $mysqli->query("SELECT * FROM t_menu_men");




?>
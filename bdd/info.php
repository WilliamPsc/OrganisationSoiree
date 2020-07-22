<?php

    /* Informations pratiques - Récupération des informations */
    $information = $mysqli->query("SELECT inf_dateD, inf_dateF, inf_adresse, inf_nom FROM t_information_inf");
    $confirmation = $mysqli->query("SELECT COUNT(sre_id) FROM t_soiree_sre WHERE sre_confirmation ='1'");
    $voiture = $mysqli->query("SELECT COUNT(sre_id) FROM t_soiree_sre WHERE sre_voiture ='1'");
    $place = $mysqli->query("SELECT SUM(sre_place) FROM t_soiree_sre");
    $matelas = $mysqli->query("SELECT SUM(sre_matelas) FROM t_soiree_sre");
    $infAmene = $mysqli->query("SELECT inf_amene FROM t_information_inf");


    /* Liste des personnes confirmées */
    $personnes = $mysqli->query("SELECT * FROM t_soiree_sre WHERE sre_confirmation='1'");
    $personne = $mysqli->query("SELECT * FROM t_soiree_sre");

    /* Récupération des infos d'une personne */
    $invite = $mysqli->query("SELECT * FROM t_soiree_sre WHERE sre_id = '" . $id . "'");
    $invite2 = $mysqli->query("SELECT * FROM t_soiree_sre WHERE org_pseudo = '" . $_SESSION['pseudo'] . "';");
    $invite3 = $mysqli->query("SELECT * FROM t_organisateur_org WHERE org_pseudo = '" . $_SESSION['pseudo'] . "';");
   
?>
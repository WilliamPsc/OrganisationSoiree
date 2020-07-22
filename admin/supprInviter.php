<?php
session_start();
include "../bdd/connect.php";
$requete1 = "SELECT org_pseudo FROM t_organisateur_org WHERE org_statut = '1'";
$exe = mysqli_query($mysqli, $requete1);
$requete2 = "SELECT org_pseudo FROM t_organisateur_org WHERE org_statut = '0'";
$exe2 = mysqli_query($mysqli, $requete2);

foreach ($exe as $orga) {
    $requete = "UPDATE `t_soiree_sre` SET `sre_confirmation`= 0,`sre_voiture`= 0,`sre_vient`= NULL,`sre_place`= 0,`sre_amene`= NULL,`sre_matelas`= 0 WHERE org_pseudo = '" . $orga['org_pseudo'] . "';";
    $exec_requete = mysqli_query($mysqli, $requete);
}
foreach ($exe2 as $orga2) {
    $requete2 = "UPDATE `t_soiree_sre` SET `sre_confirmation`= 1,`sre_voiture`= 1,`sre_place`= 0,`sre_amene`= NULL,`sre_matelas`= 9 WHERE org_pseudo = '" . $orga2['org_pseudo'] . "';";
    $exec_requete = mysqli_query($mysqli, $requete2);
}
header("refresh:1;url=index.php");

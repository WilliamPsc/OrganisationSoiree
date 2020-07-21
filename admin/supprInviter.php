<?php
session_start();
include "../bdd/connect.php";
$requete1 = "SELECT org_pseudo FROM t_organisateur_org WHERE org_statut = '1'";
$exe = mysqli_query($mysqli, $requete1);

foreach ($exe as $orga) {
    $requete = "DELETE FROM t_soiree_sre WHERE org_pseudo = '" . $orga['org_pseudo'] . "';";
    $exec_requete = mysqli_query($mysqli, $requete);
    $requete2 = "DELETE FROM t_organisateur_org WHERE org_pseudo = '" . $orga['org_pseudo'] . "';";
    $exec_requete1 = mysqli_query($mysqli, $requete2);
}
header('Location: index.php');

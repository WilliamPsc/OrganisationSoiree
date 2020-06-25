<?php
session_start();
include "../bdd/connect.php";
$id = $_POST['id'];
$requete1 = "SELECT org_pseudo FROM t_soiree_sre WHERE sre_id = '" . $id . "'";
$exe = mysqli_query($mysqli, $requete1);
$val = $exe->fetch_assoc();
$org = $val['org_pseudo'];

$requete = "DELETE FROM t_soiree_sre WHERE org_pseudo = '" . $org . "';";
$exec_requete = mysqli_query($mysqli, $requete);
$requete2 = "DELETE FROM t_organisateur_org WHERE org_pseudo = '" . $org . "';";
$exec_requete1 = mysqli_query($mysqli, $requete2);
if ($exec_requete && $exec_requete1) {
    header('Location: ../bdd/deconnexion.php');
}
?>
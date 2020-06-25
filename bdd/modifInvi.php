<?php
session_start();
include "connect.php";
if (isset($_POST['prenom'])) {

    // on applique les deux fonctions mysqli_real_escape_string et htmlspecialchars
    // pour éliminer toute attaque de type injection SQL et XSS
    $prenom = mysqli_real_escape_string($mysqli, htmlspecialchars($_POST['prenom']));
    $amene = mysqli_real_escape_string($mysqli, htmlspecialchars($_POST['amene']));
    $voiture = mysqli_real_escape_string($mysqli, htmlspecialchars($_POST['voiture']));
    $placeV = mysqli_real_escape_string($mysqli, htmlspecialchars($_POST['placeV']));
    $confirmation = mysqli_real_escape_string($mysqli, htmlspecialchars($_POST['confirmation']));
    $placeM = mysqli_real_escape_string($mysqli, htmlspecialchars($_POST['placeM']));
    $id = mysqli_real_escape_string($mysqli, htmlspecialchars($_POST['id']));

    if ($prenom !== "") {
        $requete = "UPDATE `t_soiree_sre` SET `sre_prenom`='" . utf8_decode($prenom) . "',`sre_confirmation`='" . $confirmation . "',
                                        `sre_voiture`='" . $voiture . "',`sre_place`='" . $placeV . "',`sre_amene`='" . utf8_decode($amene) . "',`sre_matelas`='" . $placeM . "' WHERE `sre_id`='" . $id . "'";
        $exec_requete = mysqli_query($mysqli, $requete);
        if ($exec_requete) {
            header('Location: ../admin/index.php');
        } else {
            header('Location: ../admin/modifInv.php'); // utilisateur ou mot de passe incorrect
        }
    } else {
        header('Location: ../admin/modifInv.php'); // utilisateur ou mot de passe incorrect
    }
} else {
    header('Location: ../admin/modifInv.php'); // utilisateur ou mot de passe incorrect
}

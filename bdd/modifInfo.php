<?php
session_start();
include "connect.php";
if (isset($_POST['dateD']) && isset($_POST['dateF']) && isset($_POST['adresse']) && isset($_POST['nom'])) {

    // on applique les deux fonctions mysqli_real_escape_string et htmlspecialchars
    // pour éliminer toute attaque de type injection SQL et XSS
    $dateD = mysqli_real_escape_string($mysqli, htmlspecialchars($_POST['dateD']));
    $dateF = mysqli_real_escape_string($mysqli, htmlspecialchars($_POST['dateF']));
    $adresse = mysqli_real_escape_string($mysqli, htmlspecialchars($_POST['adresse']));
    $nom = mysqli_real_escape_string($mysqli, htmlspecialchars($_POST['nom']));
    $affaires = mysqli_real_escape_string($mysqli, htmlspecialchars($_POST['affaires']));


    if ($dateD !== "" && $dateF !== "") {
        $requete = "UPDATE `t_information_inf` SET 
            `inf_dateD`='" . $dateD . "',`inf_dateF`='" . $dateF . "',`inf_adresse`='" . $adresse . "',`inf_nom`='" . $nom . "',`inf_amene`='" . $affaires . "' WHERE `inf_id` = '0';";
        $exec_requete = mysqli_query($mysqli, $requete);
        if ($exec_requete) {
            header('Location: ../admin/index.php');
        } else {
            header('Location: ../admin/modifInfo.php'); // utilisateur ou mot de passe incorrect
        }
    } else {
        header('Location: ../admin/modifInfo.php'); // utilisateur ou mot de passe incorrect
    }
} else {
    header('Location: ../admin/modifInfo.php'); // utilisateur ou mot de passe incorrect
}

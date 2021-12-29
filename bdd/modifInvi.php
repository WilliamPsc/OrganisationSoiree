<?php
session_start();
include "connect.php";
if (isset($_POST['prenom'])) {

    // on applique les deux fonctions mysqli_real_escape_string et htmlspecialchars
    // pour éliminer toute attaque de type injection SQL et XSS
    $prenom = mysqli_real_escape_string($mysqli, htmlspecialchars($_POST['prenom']));
    $nom = mysqli_real_escape_string($mysqli, htmlspecialchars($_POST['nom']));
    $voiture = mysqli_real_escape_string($mysqli, htmlspecialchars($_POST['voiture']));
    $placeV = mysqli_real_escape_string($mysqli, htmlspecialchars($_POST['placeV']));
    $confirmation = mysqli_real_escape_string($mysqli, htmlspecialchars($_POST['confirmation']));
    $placeM = mysqli_real_escape_string($mysqli, htmlspecialchars($_POST['placeM']));
    $id = mysqli_real_escape_string($mysqli, htmlspecialchars($_POST['id']));
    $vient = mysqli_real_escape_string($mysqli, htmlspecialchars($_POST['vient']));
    $pseudo = mysqli_real_escape_string($mysqli, htmlspecialchars($_POST['pseudo']));
    $statut = mysqli_real_escape_string($mysqli, htmlspecialchars($_POST['statut']));
    $mail = mysqli_real_escape_string($mysqli, htmlspecialchars($_POST['mail']));

    if($voiture == 0){
        $placeV = 0;
        $vient = "";
    }

    $requete = "UPDATE `t_soiree_sre` SET 
        `org_pseudo`='" . $pseudo . "',`sre_prenom`='" . $prenom . "',`sre_confirmation`='" . $confirmation . "', `sre_voiture`='" . $voiture . "',`sre_vient`='" . $vient . "',
            `sre_place`='" . $placeV . "',`sre_matelas`='" . $placeM . "' WHERE `sre_id`='" . $id . "'";
    $exec_requete = mysqli_query($mysqli, $requete);
    
    $requete = "UPDATE `t_organisateur_org` SET 
        `org_prenom`='" . $prenom . "',`org_nom`='" . $nom . "',`org_pseudo`='" . $pseudo . "',`org_statut`='" . $statut . "', `org_mail`='" . $mail . "' WHERE `org_id` = ' " . $id . " '";
    $exec_requete2 = mysqli_query($mysqli, $requete);

    if ($exec_requete && $exec_requete2) {
        header('Location: ../index.php');
    } else {
        header('Location: ../admin/modifInv.php'); // utilisateur ou mot de passe incorrect
    }
} else {
    header('Location: ../admin/modifInv.php'); // utilisateur ou mot de passe incorrect
}

<?php
session_start();
include "connect.php";
if (isset($_POST['prenom'])) {

    // on applique les deux fonctions mysqli_real_escape_string et htmlspecialchars
    // pour éliminer toute attaque de type injection SQL et XSS
    $prenom = mysqli_real_escape_string($mysqli, htmlspecialchars($_POST['prenom']));
    $nom = mysqli_real_escape_string($mysqli, htmlspecialchars($_POST['nom']));
    $amene = mysqli_real_escape_string($mysqli, htmlspecialchars($_POST['amene']));
    $voiture = mysqli_real_escape_string($mysqli, htmlspecialchars($_POST['voiture']));
    $placeV = mysqli_real_escape_string($mysqli, htmlspecialchars($_POST['placeV']));
    $confirmation = mysqli_real_escape_string($mysqli, htmlspecialchars($_POST['confirmation']));
    $placeM = mysqli_real_escape_string($mysqli, htmlspecialchars($_POST['placeM']));
    $id = mysqli_real_escape_string($mysqli, htmlspecialchars($_POST['id']));
    $vient = mysqli_real_escape_string($mysqli, htmlspecialchars($_POST['vient']));
    $password = mysqli_real_escape_string($mysqli, htmlspecialchars($_POST['pwd']));
    $pseudo = mysqli_real_escape_string($mysqli, htmlspecialchars($_POST['pseudo']));
    $pass = hash('sha256',$password);

    if ($prenom !== "") {
        $requete = "UPDATE `t_soiree_sre` SET 
            `org_pseudo`='" . $pseudo . "',`sre_prenom`='" . $prenom . "',`sre_confirmation`='" . $confirmation . "', `sre_voiture`='" . $voiture . "',`sre_vient`='" . $vient . "',
                `sre_place`='" . $placeV . "',`sre_amene`='" . $amene . "',`sre_matelas`='" . $placeM . "' WHERE `sre_id`='" . $id . "'";
        $exec_requete = mysqli_query($mysqli, $requete);
        
        $requete = "UPDATE `t_organisateur_org` SET 
            `org_prenom`='" . $prenom . "',`org_nom`='" . $nom . "',`org_pseudo`='" . $pseudo . "',`org_password`='" . $pass . "' WHERE `org_id` = ' " . $id . " '";
        $exec_requete = mysqli_query($mysqli, $requete);

        $_SESSION['pseudo'] = $pseudo;
        if ($exec_requete) {
            header('Location: ../index.php');
        } else {
            header('Location: ../admin/modifInv.php'); // utilisateur ou mot de passe incorrect
        }
    } else {
        header('Location: ../admin/modifInv.php'); // utilisateur ou mot de passe incorrect
    }
} else {
    header('Location: ../admin/modifInv.php'); // utilisateur ou mot de passe incorrect
}

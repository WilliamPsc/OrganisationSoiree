<?php
include "connect.php";
if (isset($_POST['prenom']) && isset($_POST['nom']) && isset($_POST['voiture']) && isset($_POST['place']) && isset($_POST['amene']) 
    && isset($_POST['matelas']) && isset($_POST['pseudo']) && isset($_POST['pwd'])) {

    // on applique les deux fonctions mysqli_real_escape_string et htmlspecialchars
    // pour éliminer toute attaque de type injection SQL et XSS
    $prenom = mysqli_real_escape_string($mysqli, htmlspecialchars($_POST['prenom']));
    $nom = mysqli_real_escape_string($mysqli, htmlspecialchars($_POST['nom']));
    $voiture = mysqli_real_escape_string($mysqli, htmlspecialchars($_POST['voiture']));
    $place = mysqli_real_escape_string($mysqli, htmlspecialchars($_POST['place']));
    $amene = mysqli_real_escape_string($mysqli, htmlspecialchars($_POST['amene']));
    $matelas = mysqli_real_escape_string($mysqli, htmlspecialchars($_POST['matelas']));
    $pseudo = mysqli_real_escape_string($mysqli, htmlspecialchars($_POST['pseudo']));
    $password = mysqli_real_escape_string($mysqli, htmlspecialchars($_POST['pwd']));
    $pass = hash('sha256', $password);


    if ($prenom !== "" && $nom != "" && $voiture != "" && $place != "" && $matelas != "" && $pseudo != "" && $pass != "") {
        $requete1 = "INSERT INTO `t_soiree_sre`(`org_pseudo`, `sre_prenom`, `sre_confirmation`, `sre_voiture`, `sre_place`, `sre_amene`, `sre_matelas`)
                        VALUES ('" . $pseudo . "','" . $prenom . "','1','" . $voiture . "','" . $place . "','" . $amene . "','" . $matelas . "')";
        $exec_requete = mysqli_query($mysqli, $requete1);

        $requete2 = "INSERT INTO `t_organisateur_org`(`org_prenom`, `org_nom`, `org_validation`, `org_pseudo`, `org_password`, `org_statut`)
                        VALUES ('" . $prenom . "','" . $nom . "','1','" . $pseudo . "','" . $pass . "','1')";
        $exec_requete2 = mysqli_query($mysqli, $requete2);
        if ($exec_requete && $exec_requete2) {
            header('Location: inscription_reussie.php');
        } else {
            header('Location: inscription.php'); // utilisateur ou mot de passe incorrect
        }
    } else {
        header('Location: inscription.php'); // utilisateur ou mot de passe incorrect
    }
} else {
    header('Location: inscription.php'); // utilisateur ou mot de passe incorrect
}

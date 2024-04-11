<?php
include "connect.php";
if (isset($_POST['prenom']) && isset($_POST['nom']) && isset($_POST['voiture']) && isset($_POST['pseudo']) && isset($_POST['pwd'])) {
    // on applique les deux fonctions mysqli_real_escape_string et htmlspecialchars
    // pour éliminer toute attaque de type injection SQL et XSS
    $prenom = mysqli_real_escape_string($mysqli, htmlspecialchars($_POST['prenom']));
    $nom = mysqli_real_escape_string($mysqli, htmlspecialchars($_POST['nom']));
    $voiture = mysqli_real_escape_string($mysqli, htmlspecialchars($_POST['voiture']));
    $vient = mysqli_real_escape_string($mysqli, htmlspecialchars($_POST['vient']));
    $place = mysqli_real_escape_string($mysqli, htmlspecialchars($_POST['place']));
    $matelas = mysqli_real_escape_string($mysqli, htmlspecialchars($_POST['matelas']));
    $pseudo = mysqli_real_escape_string($mysqli, htmlspecialchars($_POST['pseudo']));
    $password = mysqli_real_escape_string($mysqli, htmlspecialchars($_POST['pwd']));
    $mail = mysqli_real_escape_string($mysqli, htmlspecialchars($_POST['mail']));
    $pass = hash('sha256', $password);

    $pseudoUsed = "SELECT COUNT(*) AS nbPseudo FROM `t_organisateur_org` WHERE `org_pseudo` = '" . $pseudo . "'";
    $res = mysqli_query($mysqli, $pseudoUsed);
    $present  = mysqli_fetch_assoc($res);
    if ($present['nbPseudo'] != 0) {
        $_GET['inscriptionfailed'] = '-1';
        header('Location: inscription.php?inscriptionfailed=' . $_GET['inscriptionfailed']);
    } else {
        if ($prenom !== "" && $nom != "" && $voiture != "" && $pseudo != "" && $pass != "") {
            $requete1 = "INSERT INTO `t_soiree_sre`(`org_pseudo`, `sre_prenom`, `sre_confirmation`, `sre_voiture`, `sre_vient`, `sre_place`, `sre_amene`, `sre_matelas`)
                            VALUES ('" . $pseudo . "','" . $prenom . "','1','" . $voiture . "','" . $vient . "','" . $place . "','','" . $matelas . "')";
            $exec_requete = mysqli_query($mysqli, $requete1);

            $requete2 = "INSERT INTO `t_organisateur_org`(`org_prenom`, `org_nom`, `org_pseudo`, `org_password`, `org_statut`, `org_mail`)
                            VALUES ('" . $prenom . "','" . $nom . "','" . $pseudo . "','" . $pass . "','1','" . $mail . "')";
            $exec_requete2 = mysqli_query($mysqli, $requete2);
            if ($exec_requete && $exec_requete2) {
                header('Location: connexion.php?connexion=1');
            } else {
                $_GET['inscriptionfailed'] = '-2';
                header('Location: inscription.php?inscriptionfailed=' . $_GET['inscriptionfailed']);
            }
        } else {
            $_GET['inscriptionfailed'] = '-3';
            header('Location: inscription.php?inscriptionfailed=' . $_GET['inscriptionfailed']);
        }
    }
} else {
    $_GET['inscriptionfailed'] = '-3';
    header('Location: inscription.php?inscriptionfailed=' . $_GET['inscriptionfailed']);
}

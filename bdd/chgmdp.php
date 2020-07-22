<?php
session_start();
include "connect.php";
if (isset($_POST['mail']) && isset($_POST['pseudo'])) {

    // on applique les deux fonctions mysqli_real_escape_string et htmlspecialchars
    // pour éliminer toute attaque de type injection SQL et XSS
    $username = mysqli_real_escape_string($mysqli, htmlspecialchars($_POST['pseudo']));
    $mail = mysqli_real_escape_string($mysqli, htmlspecialchars($_POST['mail']));
    

    if ($username !== "" && $mail !== "") {
        $requete = "SELECT count(*) FROM t_organisateur_org WHERE org_pseudo = '" . $username . "'; ";
        $exec_requete = mysqli_query($mysqli, $requete);
        $reponse = mysqli_fetch_array($exec_requete);
        $count = $reponse['count(*)'];
        if ($count == 1) {
            $newMDP = randMDP(20);
            $sha = hash('sha256', $newMDP);
            $message = "Voici votre nouveau mot de passe à utiliser lors de votre connexion : $newMDP .\n\n Vous pouvez le modifier en vous connectant sur le site : https://soiree.pensec.fr .";
            $headers = 'From: william@pensec.fr';

            $requete = "UPDATE `t_organisateur_org` SET `org_password`= '" . $sha . "' WHERE `org_pseudo` = '" . $username . "';";
            $exec_requete = mysqli_query($mysqli, $requete);

            mail($mail, "Nouveau mot de passe", $message, $headers);
            header('Location: connexion.php');        
        } else {
            header('Location: ../bdd/mdpOublie.php'); // utilisateur ou mot de passe incorrect
        }
    } else {
        header('Location: ../bdd/mdpOublie.php'); // utilisateur ou mot de passe incorrect
    }
} else {
    header('Location: ../bdd/mdpOublie.php'); // utilisateur ou mot de passe incorrect
}


function randMDP($taille){
    $string = "";
    $user_ramdom_key = "abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789";
    srand((double)microtime()*time());
    for($i = 0; $i < $taille; $i++) {
        $string .= $user_ramdom_key[rand()%strlen($user_ramdom_key)];
    }
    return $string;
}
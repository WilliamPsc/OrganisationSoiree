<?php
session_start();
include "connect.php";
if (isset($_POST['mail'])) {

    // on applique les deux fonctions mysqli_real_escape_string et htmlspecialchars
    // pour éliminer toute attaque de type injection SQL et XSS
    $mail = mysqli_real_escape_string($mysqli, htmlspecialchars($_POST['mail']));
    

    if ($mail !== "") {
        $requete = "SELECT count(*), org_pseudo FROM t_organisateur_org WHERE org_mail = '" . $mail . "'; ";
        $exec_requete = mysqli_query($mysqli, $requete);
        $reponse = mysqli_fetch_array($exec_requete);
        $count = $reponse['count(*)'];
        if ($count > 0) {
            $newMDP = randMDP(10);
            $pseudo = $reponse['org_pseudo'];
            $sha = hash('sha256', $newMDP);
            $message = "Bonjour $pseudo ,\nVos identifiants à utiliser sont :\n\t Login : $pseudo \n\t Mot de passe : $newMDP\n\n Vous pouvez donc à présent vous connecter de nouveau sur le site : https://soiree.pensec.fr . En espérant vous revoir bientôt !";
            $headers = 'From: soiree@pensec.fr';

            $requete = "UPDATE `t_organisateur_org` SET `org_password`= '" . $sha . "' WHERE `org_pseudo` = '" . $pseudo . "';";
            $exec_requete = mysqli_query($mysqli, $requete);

            mail($mail, "Nouveau mot de passe", $message, $headers);
            $_GET['mdpchg'] = '2';
            header('Location: connexion.php?mdpchg=' . $_GET['mdpchg']);        
        } else {
            $_GET['mdpchg'] = '-1';
            header('Location: mdpOublie.php?mdpchg=' . $_GET['mdpchg']);
        }
    } else {
        $_GET['mdpchg'] = '-2';
        header('Location: mdpOublie.php?mdpchg=' . $_GET['mdpchg']);
    }
} else {
    $_GET['mdpchg'] = '-2';
    header('Location: mdpOublie.php?mdpchg=' . $_GET['mdpchg']);
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
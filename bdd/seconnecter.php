<?php
session_start();
include "connect.php";
if (isset($_POST['pseudo']) && isset($_POST['pwd'])) {

    // on applique les deux fonctions mysqli_real_escape_string et htmlspecialchars
    // pour éliminer toute attaque de type injection SQL et XSS
    $username = mysqli_real_escape_string($mysqli, htmlspecialchars($_POST['pseudo']));
    $password = mysqli_real_escape_string($mysqli, htmlspecialchars($_POST['pwd']));
    $pass = hash('sha256', $password);

    if ($username !== "" && $pass !== "") {
        $requete = "SELECT count(*) FROM t_organisateur_org WHERE org_pseudo = '" . $username . "' and org_password = '" . $pass . "'; ";
        $exec_requete = mysqli_query($mysqli, $requete);
        $reponse = mysqli_fetch_array($exec_requete);
        $count = $reponse['count(*)'];
        if ($count != 0) { // nom d'utilisateur et mot de passe correctes
            $_SESSION['pseudo'] = $username;
            $test = $mysqli->query("SELECT SUM(org_statut) FROM t_organisateur_org WHERE org_pseudo = '" . $username . "';");
            $val = $test->fetch_assoc();
            //echo $val['SUM(org_statut)'];
            if($val['SUM(org_statut)'] == 1){
                header('Location: ../invite/index.php');
            }
            if($val['SUM(org_statut)'] == 0){
                header('Location: ../admin/index.php');
            }
            
        } else {
            header('Location: ../bdd/connexion.php'); // utilisateur ou mot de passe incorrect
        }
    } else {
        header('Location: ../bdd/connexion.php'); // utilisateur ou mot de passe incorrect
    }
} else {
    header('Location: ../bdd/connexion.php'); // utilisateur ou mot de passe incorrect
}

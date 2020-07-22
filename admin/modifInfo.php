<!DOCTYPE html>
<html lang="fr-fr">

<head>
    <title>Organisation Soirée</title>
    <link rel="icon" href="images/icone.png" type="image/png">
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="keywords" content="Soirée, préparation">
    <meta name="description" content="Site d'organisation de soirée">
    <meta name="author" content="William PENSEC">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/flag-icon-css/3.1.0/css/flag-icon.min.css" rel="stylesheet">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>

</head>

<body>
    <?php
    session_start();

    if (empty($_SESSION['pseudo'])) {
        header('Location: ../bdd/connexion.php');
    } else {
        include "../bdd/connect.php";
        include "../bdd/info.php";
        include "../template/header.php";
    ?>

        <nav class="navbar navbar-expand-sm bg-dark navbar-dark sticky-top">
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#collapsibleNavbar">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="collapsibleNavbar">
                <ul class="navbar-nav">
                    <li class="nav-item">
                        <a class="navbar-brand" href="index.php" style="color:red">Accueil</a>

                    </li>
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="" id="dropdown09" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Déconnexion</a>
                        <div class="dropdown-menu" aria-labelledby="dropdown09">
                            <a class="dropdown-item" href="../bdd/deconnexion.php">Déconnexion</a>
                        </div>
                    </li>
                </ul>
            </div>
            <span style="color:white;">
                <?php
                if ($_SESSION['pseudo'] !== "") {
                    $user = $_SESSION['pseudo'];
                    echo "Bonjour $user";
                }
                ?>
            </span>
        </nav>


        <br /><br />
        <div class="container">
            <h2>Modification des informations de la soirée</h2>

            <form action="../bdd/modifInfo.php" method="post">
                <label>Date début :</label>
                <input name='dateD' class="form-control" type="date" placeholder="dateD" value="<?php
                                                                                                mysqli_data_seek($information, 0);
                                                                                                while ($dateD = $information->fetch_assoc()) {
                                                                                                    echo $dateD['inf_dateD'];
                                                                                                }
                                                                                                ?>" />

                <label>Date fin :</label>
                <input name='dateF' class="form-control" type="date" placeholder="dateF" value="<?php
                                                                                                mysqli_data_seek($information, 0);
                                                                                                while ($dateF = $information->fetch_assoc()) {
                                                                                                    echo $dateF['inf_dateF'];
                                                                                                }
                                                                                                ?>" />

                <label>Adresse :</label>
                <input name='adresse' class="form-control" type="text" placeholder="Adresse" value="<?php
                                                                                                    mysqli_data_seek($information, 0);
                                                                                                    while ($adresse = $information->fetch_assoc()) {
                                                                                                        echo $adresse['inf_adresse'];
                                                                                                    }
                                                                                                    ?>" />

                <label>Titre de la fête :</label>
                <input name='nom' class="form-control" type="text" placeholder="Adresse" value="<?php
                                                                                                mysqli_data_seek($information, 0);
                                                                                                while ($nom = $information->fetch_assoc()) {
                                                                                                    echo $nom['inf_nom'];
                                                                                                }
                                                                                                ?>" />

                <label>Affaires à amener :</label>
                <input name='affaires' class="form-control" type="text" placeholder="Affaires" value="<?php
                                                                                                mysqli_data_seek($infAmene, 0);
                                                                                                while ($nom = $infAmene->fetch_assoc()) {
                                                                                                    echo $nom['inf_amene'];
                                                                                                }
                                                                                                ?>" />

                <br /><br />
                <input type="submit" name="submit" class="btn btn-primary btn-lg" value="Modifier" />
            </form>
        </div>




    <?php
    }
    include "../template/footer.php";
    ?>
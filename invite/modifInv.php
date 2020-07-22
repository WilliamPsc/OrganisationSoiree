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
    $id = $_POST['id'];

    if (empty($_SESSION['pseudo'])) {
        header('Location: ../bdd/connexion.php');
    } else {
        include "../bdd/connect.php";
        include "../bdd/info.php";
    ?>

        <div class="jumbotron text-center" style="margin-bottom:0">
            <h1>
                <?php
                while ($titre = $information->fetch_assoc()) {
                    echo $titre['inf_nom'];
                }
                ?>
            </h1>
        </div>

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
            <h2>Modification d'un invité</h2>

            <form action="../bdd/modifInvi.php" method="post">
                <label>Prénom :</label>
                <input name='prenom' class="form-control" type="text" placeholder="Prénom" value="<?php
                                                                                                    mysqli_data_seek($invite, 0);
                                                                                                    while ($inv = $invite->fetch_assoc()) {
                                                                                                        echo $inv['sre_prenom'];
                                                                                                    }
                                                                                                    ?>" />

                <label>Nom :</label>
                <input name='nom' class="form-control" type="text" placeholder="Nom" value="<?php
                                                                                            mysqli_data_seek($invite3, 0);
                                                                                            while ($inv = $invite3->fetch_assoc()) {
                                                                                                echo $inv['org_nom'];
                                                                                            }
                                                                                            ?>" />

                <label>Amène :</label>
                <input name='amene' class="form-control" type="text" value=" <?php
                                                                                mysqli_data_seek($invite, 0);
                                                                                while ($inv = $invite->fetch_assoc()) {
                                                                                    echo $inv['sre_amene'];
                                                                                }
                                                                                ?>" />

                <label>Voiture :</label>
                <input name='voiture' class="form-control" type="number" placeholder="0" min="0" max="1" value="<?php
                                                                                                                mysqli_data_seek($invite, 0);
                                                                                                                while ($inv = $invite->fetch_assoc()) {
                                                                                                                    echo $inv['sre_voiture'];
                                                                                                                }
                                                                                                                ?>" />

                <label>Part de :</label>
                <input name='vient' class="form-control" type="text" placeholder="Gondor" value="<?php
                                                                                                    mysqli_data_seek($invite, 0);
                                                                                                    while ($inv = $invite->fetch_assoc()) {
                                                                                                        echo $inv['sre_vient'];
                                                                                                    }
                                                                                                    ?>" />

                <label>Nombre de place :</label>
                <input name='placeV' class="form-control" type="number" placeholder="0" min="0" value="<?php
                                                                                                        mysqli_data_seek($invite, 0);
                                                                                                        while ($inv = $invite->fetch_assoc()) {
                                                                                                            echo $inv['sre_place'];
                                                                                                        }
                                                                                                        ?>" />

                <label>Confirmation :</label>
                <input name='confirmation' class=" form-control" type="number" placeholder="0" min="0" max="1" value="<?php
                                                                                                                        mysqli_data_seek($invite, 0);
                                                                                                                        while ($inv = $invite->fetch_assoc()) {
                                                                                                                            echo $inv['sre_confirmation'];
                                                                                                                        }
                                                                                                                        ?>" />

                <label>Nombre de place de matelas :</label>
                <input name='placeM' class="form-control" type="number" placeholder="0" min="0" value="<?php
                                                                                                        mysqli_data_seek($invite, 0);
                                                                                                        while ($inv = $invite->fetch_assoc()) {
                                                                                                            echo $inv['sre_matelas'];
                                                                                                        }
                                                                                                        ?>" />

                <label>Pseudo :</label>
                <input name='pseudo' class="form-control" type="text" value="<?php
                                                                                mysqli_data_seek($invite3, 0);
                                                                                while ($inv = $invite3->fetch_assoc()) {
                                                                                    echo $inv['org_pseudo'];
                                                                                }
                                                                                ?>" />

                <label>Mot de passe :</label>
                <input name='pwd' class="form-control" type="password" value="<?php
                                                                                mysqli_data_seek($invite3, 0);
                                                                                while ($inv = $invite3->fetch_assoc()) {
                                                                                    echo $inv['org_password'];
                                                                                }
                                                                                ?>" />

                <br /><br />
                <input type="hidden" name="id" value="<?php echo $id ?>" />
                <input type="submit" name="submit" class="btn btn-primary btn-lg" value="Modifier" />
            </form>
        </div>


        <br /><br />
        <div class="jumbotron text-center" style="margin-bottom:10px">
            <p style="text-align:center;">
                <a href="https://www.pensec.fr/" target="_blank" style="color:black;">William PENSEC</a>

                <br />
                Master 1 Informatique

                <br />
                2020
            </p>
        </div>

    <?php
    }
    ?>
</body>

</html>
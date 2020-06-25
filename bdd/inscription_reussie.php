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

    if (isset($_SESSION['pseudo'])) {
        header('Location: admin/index.php');
    } else {
        include "connect.php";
        include "info.php";
    }
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
                    <a class="navbar-brand" href="../index.php">Accueil</a>
                    
                </li>
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="" id="dropdown09" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" style="color:red">Connexion / Inscription</a>
                    <div class="dropdown-menu" aria-labelledby="dropdown09">
                    <a class="dropdown-item" href="connexion.php">Se connecter</a>
                    <a class="dropdown-item" href="inscription.php">S'inscrire</a>
                    </div>
                </li>
            </ul>
        </div>
    </nav>


    <div class="container" style="margin-top:30px;">
        <h2>S'inscrire</h2>
        Inscription réussie
        <br />
        Redirection dans 5 secondes
        <?php
            header("refresh:5;url=connexion.php");
        ?>
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
</body>
</html>
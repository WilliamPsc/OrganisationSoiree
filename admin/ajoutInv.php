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

        <!--<div class="container" style="margin-top:30px;">
        <div class="progress">
            <div class="progress-bar bg-success progress-bar-striped progress-bar-animated" role="progressbar" aria-valuenow="100" aria-valuemin="0" aria-valuemax="100" style="width:100%">
            </div>
        </div>
    </div>-->


        <br /><br />
        <div class="container">
            <h2>Ajout d'un invité</h2>

            <form action="../bdd/ajout.php" method="post">
                <div class="form-group">
                    <label for="prenom">Prénom:</label>
                    <input type="text" class="form-control" placeholder="Prénom" name="prenom" required>
                </div>
                <div class="form-group">
                    <label for="nom">Nom:</label>
                    <input type="text" class="form-control" placeholder="Nom" name="nom" required>
                </div>
                <div class="form-group">
                    <label for="voiture">Voiture (0 : non / 1 : oui) :</label>
                    <input type="number" class="form-control" name='voiture' placeholder="0" min="0" max="1" value="0" />
                </div>
                <div class="form-group">
                    <label for="vient">Vient de :</label>
                    <input type="text" class="form-control" name='vient' placeholder="Gondor" />
                </div>
                <div class="form-group">
                    <label for="place">Nombre de place:</label>
                    <input type="number" class="form-control" name="place" value="0" min="0" max="10" required>
                </div>
                <div class="form-group">
                    <label for="amene">Amène:</label>
                    <input type="text" class="form-control" placeholder="Jus de fruits, bonbons, ..." name="amene" value="">
                </div>
                <div class="form-group">
                    <label for="matelas">Nombre de place de matelas:</label>
                    <input type="number" class="form-control" name="matelas" value="0" min="0" max="20" required>
                </div>
                <div class="form-group">
                    <label for="pseudo">Pseudo:</label>
                    <input type="text" class="form-control" placeholder="Pseudo" name="pseudo" required>
                </div>
                <div class="form-group">
                    <label for="pwd">Mot de passe:</label>
                    <input type="password" class="form-control" placeholder="Mot de passe" name="pwd" required>
                </div>
                <button type="submit" class="btn btn-primary" id='inscription'>Ajouter</button>
            </form>
        </div>

    <?php
    }
    include "../template/footer.php"
    ?>
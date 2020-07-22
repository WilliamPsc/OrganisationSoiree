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
    /* PARTIE BASIQUE */
    session_start();
    include "bdd/connect.php";

    if (isset($_SESSION['pseudo'])) {
        $test = $mysqli->query("SELECT SUM(org_statut) FROM t_organisateur_org WHERE org_pseudo = '" . $_SESSION['pseudo'] . "';");
        $val = $test->fetch_assoc();
        if ($val['SUM(org_statut)'] == 1) {
            header('Location: invite/index.php');
        }
        if ($val['SUM(org_statut)'] == 0) {
        }
    } else {
        include "bdd/info.php";
        include "template/header.php";
    }
    ?>

    <nav class="navbar navbar-expand-sm bg-dark navbar-dark sticky-top">
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#collapsibleNavbar">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="collapsibleNavbar">
            <ul class="navbar-nav">
                <li class="nav-item">
                    <a class="navbar-brand" href="index.php">Accueil</a>

                </li>
                <li class="nav-item">
                    <a class="navbar-brand" href="repas.php" style="color:red">Menu</a>

                </li>
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="" id="dropdown09" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Connexion / Inscription</a>
                    <div class="dropdown-menu" aria-labelledby="dropdown09">
                        <a class="dropdown-item" href="bdd/connexion.php">Se connecter</a>
                        <a class="dropdown-item" href="bdd/inscription.php">S'inscrire</a>
                    </div>
                </li>
            </ul>
        </div>
    </nav>

    <br /><br />
    <div class="container">
        <h2>Menu du repas</h2>
        <div class="table-responsive-md">
            <table class="table table-bordered table-hover">
                <tbody>
                    <tr>
                        <td>Apéritif (gateaux apéritifs, chips, ...)</td>
                        <td>

                        </td>
                    </tr>
                    <tr>
                        <td>Plat (pizzas)</td>
                        <td>
                            <ul>
                                <!--<li>Brieuc</li>
                                <li>Émeline</li>
                                <li>Benjamin</li>
                                <li>Mathilde</li>-->
                            </ul>
                            Quantités : 1 pizza pour 2 personnes
                        </td>
                    </tr>
                    <tr>
                        <td>Dessert</td>
                        <td>
                            <ul>
                                <!--<li>Ugo</li>
                                <li>Anaelle</li>-->
                            </ul>
                        </td>
                    </tr>

                    <tr>
                        <td>Boissons (alcool)</td>
                        <td>

                        </td>
                    </tr>
                    <tr>
                        <td>Boissons (soft)</td>
                        <td>

                        </td>
                    </tr>

                    <tr>
                        <td>Petit-déjeuner</td>
                        <td>

                        </td>
                    </tr>
                    <tr>
                        <td>Autres (bonbons, ...)</td>
                        <td>

                        </td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>

    <?php
    include "template/footer.php"
    ?>
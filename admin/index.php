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
        $test = $mysqli->query("SELECT SUM(org_statut) FROM t_organisateur_org WHERE org_pseudo = '" . $_SESSION['pseudo'] . "';");
        $val = $test->fetch_assoc();
        if ($val['SUM(org_statut)'] == 1) {
            header('Location: ../invite/index.php');
        }
        if ($val['SUM(org_statut)'] == 0) {
            //header('Location: ../admin/index.php');
        }
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

        <?php
        include "../template/compte_rebours.php";
        ?>

        <div class="container" style="margin-top:30px;">
            <h2>Informations pratiques</h2>
            <input type="button" class="btn btn-info btn-block" style="text-align: center;" onclick="window.location.href='modifInfo.php'" value="Modifier"><br />
            <div class="table-responsive-md">
                <table class="table table-bordered table-hover">
                    <tbody>
                        <tr>
                            <td>Date début:</td>
                            <td>
                                <?php
                                mysqli_data_seek($information, 0);
                                while ($dateD = $information->fetch_assoc()) {
                                    $date0 = new DateTime($dateD['inf_dateD']);
                                    echo $date0->format('d/m/Y');
                                }
                                ?>
                            </td>
                        </tr>
                        <tr>
                            <td>Date fin:</td>
                            <td>
                                <?php
                                mysqli_data_seek($information, 0);
                                while ($dateF = $information->fetch_assoc()) {
                                    $date1 = new DateTime($dateF['inf_dateF']);
                                    echo $date1->format('d/m/Y');
                                }
                                ?>
                            </td>
                        </tr>
                        <tr>
                            <td>Adresse :</td>
                            <td>
                                <?php
                                mysqli_data_seek($information, 0);
                                while ($adresse = $information->fetch_assoc()) {
                                    echo $adresse['inf_adresse'];
                                }
                                ?>
                            </td>
                        </tr>
                        <tr>
                            <td>Nombre de personnes confirmées :</td>
                            <td>
                                <?php
                                mysqli_data_seek($confirmation, 0);
                                while ($conf = $confirmation->fetch_assoc()) {
                                    echo $conf['COUNT(sre_id)'];
                                }
                                ?>
                            </td>
                        </tr>
                        <tr>
                            <td>Nombre de places pour dormir :</td>
                            <td>
                                <?php
                                while ($dodo = $matelas->fetch_assoc()) {
                                    echo $dodo['SUM(sre_matelas)'];
                                }
                                ?>
                            </td>
                        </tr>
                        <tr>
                            <td>Nombre de voiture sur parking :</td>
                            <td>
                                <?php
                                while ($car = $voiture->fetch_assoc()) {
                                    echo $car['COUNT(sre_id)'];
                                }
                                ?>
                            </td>
                        </tr>
                        <tr>
                            <td>Nombre de place dans les voitures :</td>
                            <td>
                                <?php
                                while ($car = $place->fetch_assoc()) {
                                    echo $car['COUNT(sre_place)'];
                                }
                                ?>
                            </td>
                        </tr>
                        <tr>
                            <td>A amener :</td>
                            <td>
                                <?php
                                while ($amene = $infAmene->fetch_assoc()) {
                                    $info = $amene['inf_amene'];
                                };
                                ?>
                                <ul>
                                    <?php
                                    $delimiters = ";";
                                    $res = explode($delimiters, $info);
                                    foreach ($res as $ligne) {
                                        echo "<li>";
                                        echo $ligne;
                                        echo "</li>";
                                    }
                                    ?>
                                </ul>
                            </td>
                    </tbody>
                </table>
            </div>
        </div>

        <br /><br />
        <div class="container">
            <h2>Liste des personnes confirmées</h2>
            <input type="button" class="btn btn-info btn-block" style="text-align: center;" onclick="window.location.href='ajoutInv.php'" value="Ajouter une personne"><br />
            <input type="button" class="btn btn-danger btn-block" style="text-align: center;" onclick="window.location.href='supprInviter.php'" value="Supprimer tout le monde"><br />
            <div class="table-responsive-md">
                <table class="table table-bordered table-hover">
                    <thead>
                        <tr>
                            <th>Prénom</th>
                            <th>Voiture</th>
                            <th>Vient de</th>
                            <th>Places voitures</th>
                            <th>Amène</th>
                            <th>Gestion</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        foreach ($personne as $data) {
                        ?>
                            <tr>
                                <td>
                                    <?php
                                    echo $data["sre_prenom"];
                                    ?>
                                </td>
                                <td>
                                    <?php
                                    if ($data["sre_voiture"] == 1) {
                                        echo $data["sre_voiture"];
                                    }
                                    ?>
                                </td>
                                <td>
                                    <?php
                                    echo $data["sre_vient"];
                                    ?>
                                </td>
                                <td>
                                    <?php
                                    if ($data["sre_place"] > 0) {
                                        echo $data["sre_place"];
                                    }
                                    ?>
                                </td>
                                <td>
                                    <?php
                                    echo $data["sre_amene"];
                                    ?>
                                </td>
                                <td>
                                    <form method="post" action="modifInv.php">
                                        <input type="hidden" name="id" value="<?php echo $data['sre_id'] ?>" />
                                        <input type="submit" class="btn btn-success btn-block" style="text-align: center;" method="post" value="Modifier">
                                    </form>
                                    <hr>
                                    <form method="post" action="supprInv.php">
                                        <input type="hidden" name="id" value="<?php echo $data['sre_id'] ?>" />
                                        <input type="submit" class="btn btn-danger btn-block" style="text-align: center;" method="post" value="Supprimer">
                                    </form>
                                </td>
                            </tr>
                        <?php
                        }
                        ?>
                    </tbody>
                </table>
            </div>
        </div>

    <?php
    }
    include "../template/footer.php";
    ?>
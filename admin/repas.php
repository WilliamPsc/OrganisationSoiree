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
    /* PARTIE ADMIN */
    session_start();

    if (empty($_SESSION['pseudo'])) {
        header('Location: ../bdd/connexion.php');
    } else {
        include "../bdd/connect.php";
        include "../bdd/info.php";
        include "requeteRepas.php";
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
                        <a class="navbar-brand" href="index.php">Accueil</a>

                    </li>
                    <li class="nav-item">
                        <a class="navbar-brand" href="repas.php" style="color:red">Menu</a>

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
            <h2>Menu prévu</h2>
            <input type="button" class="btn btn-info btn-block" style="text-align: center;" onclick="window.location.href='modifRepas.php'" value="Modifier"><br />
            <div class="table-responsive-md">
                <table class="table table-bordered table-hover">
                    <tbody>
                        <tr>
                            <td>Apéritif (gateaux apéritifs, chips, ...)</td>
                            <td>
                                <?php
                                mysqli_data_seek($menu, 0);
                                while ($plat = $menu->fetch_assoc()) {
                                    $aperitif = $plat['men_aperitif'];
                                    if($aperitif === 0){
                                        $aperitif = "0";
                                    }
                                };
                                ?>
                                <ul>
                                    <?php
                                    $delimiters = ";";
                                    $res = explode($delimiters, $aperitif);
                                    if ($aperitif === "0") {
                                    } else {
                                        foreach ($res as $ligne) {
                                            echo "<li>";
                                            echo $ligne;
                                            echo "</li>";
                                        }
                                    }
                                    ?>
                                </ul>
                            </td>
                        </tr>
                        <tr>
                            <td>Plat (pizzas)</td>
                            <td>
                                <?php
                                mysqli_data_seek($menu, 0);
                                while ($plat = $menu->fetch_assoc()) {
                                    $platJ = $plat['men_plat'];
                                    if($platJ === 0){
                                        $platJ = "0";
                                    }
                                };
                                ?>
                                <ul>
                                    <?php
                                    $delimiters = ";";
                                    $res1 = explode($delimiters, $platJ);
                                    if ($platJ === "0") {
                                    } else {
                                        foreach ($res1 as $ligne) {
                                            echo "<li>";
                                            echo $ligne;
                                            echo "</li>";
                                        }
                                    }
                                    ?>
                                </ul>
                                Quantités : 1 pizza pour 2 personnes
                            </td>
                        </tr>
                        <tr>
                            <td>Dessert</td>
                            <td>
                                <?php
                                mysqli_data_seek($menu, 0);
                                while ($plat = $menu->fetch_assoc()) {
                                    $dessert = $plat['men_dessert'];
                                    if($dessert === 0){
                                        $dessert = "0";
                                    }
                                };
                                ?>
                                <ul>
                                    <?php
                                    $delimiters = ";";
                                    $res2 = explode($delimiters, $dessert);
                                    if ($dessert === "0") {
                                    } else {
                                        foreach ($res2 as $ligne) {
                                            echo "<li>";
                                            echo $ligne;
                                            echo "</li>";
                                        }
                                    }
                                    ?>
                                </ul>
                            </td>
                        </tr>

                        <tr>
                            <td>Boissons (alcool)</td>
                            <td>
                                <?php
                                mysqli_data_seek($menu, 0);
                                while ($plat = $menu->fetch_assoc()) {
                                    $alcool = $plat['men_boissonsAlc'];
                                    if($alcool === 0){
                                        $alcool = "0";
                                    }
                                };
                                ?>
                                <ul>
                                    <?php
                                    $delimiters = ";";
                                    $res3 = explode($delimiters, $alcool);
                                    if ($alcool === "0") {
                                    } else {
                                        foreach ($res3 as $ligne) {
                                            echo "<li>";
                                            echo $ligne;
                                            echo "</li>";
                                        }
                                    }
                                    ?>
                                </ul>
                            </td>
                        </tr>
                        <tr>
                            <td>Boissons (soft)</td>
                            <td>
                                <?php
                                mysqli_data_seek($menu, 0);
                                while ($plat = $menu->fetch_assoc()) {
                                    $soft = $plat['men_boissonsSoft'];
                                    if($soft === 0){
                                        $soft = "0";
                                    }
                                };
                                ?>
                                <ul>
                                    <?php
                                    $delimiters = ";";
                                    $res4 = explode($delimiters, $soft);
                                    if ($soft === "0") {
                                    } else {
                                        foreach ($res4 as $ligne) {
                                            echo "<li>";
                                            echo $ligne;
                                            echo "</li>";
                                        }
                                    }
                                    ?>
                                </ul>
                            </td>
                        </tr>

                        <tr>
                            <td>Petit-déjeuner</td>
                            <td>
                                <?php
                                mysqli_data_seek($menu, 0);
                                while ($plat = $menu->fetch_assoc()) {
                                    $launch = $plat['men_launch'];
                                    echo $launch;
                                    if($launch === 0){
                                        $launch = "0";
                                    }
                                    echo $launch;
                                };
                                ?>
                                <ul>
                                    <?php
                                    $delimiters = ";";
                                    $res5 = explode($delimiters, $launch);
                                    if ($launch === "0") {
                                        echo "bruh";
                                    } else {
                                        foreach ($res5 as $ligne) {
                                            echo "<li>";
                                            echo $ligne;
                                            echo "</li>";
                                        }
                                    }
                                    ?>
                                </ul>
                            </td>
                        </tr>
                        <tr>
                            <td>Autres (bonbons, ...)</td>
                            <td>
                                <?php
                                mysqli_data_seek($menu, 0);
                                while ($plat = $menu->fetch_assoc()) {
                                    $autres = $plat['men_autres'];
                                    if($autres === 0){
                                        $autres = "0";
                                    }
                                };
                                ?>
                                <ul>
                                    <?php
                                    $delimiters = ";";
                                    $res6 = explode($delimiters, $autres);
                                    if ($autres === "0") {
                                    } else {
                                        foreach ($res6 as $ligne) {
                                            echo "<li>";
                                            echo $ligne;
                                            echo "</li>";
                                        }
                                    }

                                    ?>
                                </ul>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>

    <?php
    }
    include "../template/footer.php"
    ?>
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
        $test = $mysqli->query("SELECT SUM(org_statut) FROM t_organisateur_org WHERE org_pseudo = '" . $_SESSION['pseudo'] . "';");
        $val = $test->fetch_assoc();
        if($val['SUM(org_statut)'] == 1){
            //header('Location: ../invite/index.php');
        }
        if($val['SUM(org_statut)'] == 0){
            header('Location: ../admin/index.php');
        }
    ?>

<div class="jumbotron text-center" id="titre" style="margin-bottom:0">
            <h1>
                <?php
                while ($titre = $information->fetch_assoc()) {
                     $value = $titre['inf_nom'];
                     //echo $value;
                }
                ?>
            </h1>
            <canvas id='myCanvas' width="1100" height='500' style="background-color: black; height: 500px;"></canvas>
            <script>
                const max_fireworks = 5,
                max_sparks = 50;
                let canvas = document.getElementById('myCanvas');
                let context = canvas.getContext('2d');
                var longueur=document.getElementById("titre").offsetWidth;
                if(longueur > 1100){
                    longueur = 1100;
                }
                document.getElementById("myCanvas").style.width=longueur+"px";

                let fireworks = [];
                
                for (let i = 0; i < max_fireworks; i++) {
                let firework = {
                    sparks: []
                };
                for (let n = 0; n < max_sparks; n++) {
                    let spark = {
                    vx: Math.random() * 5 + .5,
                    vy: Math.random() * 5 + .5,
                    weight: Math.random() * .3 + .03,
                    red: Math.floor(Math.random() * 2),
                    green: Math.floor(Math.random() * 2),
                    blue: Math.floor(Math.random() * 2)
                    };
                    if (Math.random() > .5) spark.vx = -spark.vx;
                    if (Math.random() > .5) spark.vy = -spark.vy;
                    firework.sparks.push(spark);
                }
                fireworks.push(firework);
                resetFirework(firework);
                }
                window.requestAnimationFrame(explode);
                
                function resetFirework(firework) {
                firework.x = Math.floor(Math.random() * canvas.width);
                firework.y = canvas.height;
                firework.age = 0;
                firework.phase = 'fly';
                }
                
                function explode() {
                context.clearRect(0, 0, canvas.width, canvas.height);
                fireworks.forEach((firework,index) => {
                    if (firework.phase == 'explode') {
                        firework.sparks.forEach((spark) => {
                        for (let i = 0; i < 10; i++) {
                            context.font = "40pt Calibri,Geneva";
                            context.fillStyle = "rgb(255,255,255)";
                            context.textAlign = "center";
                            context.fillText("<?php echo $value; ?>", canvas.width / 2, canvas.height / 2);
                            let trailAge = firework.age + i;
                            let x = firework.x + spark.vx * trailAge;
                            let y = firework.y + spark.vy * trailAge + spark.weight * trailAge * spark.weight * trailAge;
                            let fade = i * 20 - firework.age * 2;
                            let r = Math.floor(spark.red * fade);
                            let g = Math.floor(spark.green * fade);
                            let b = Math.floor(spark.blue * fade);
                            context.beginPath();
                            context.fillStyle = 'rgba(' + r + ',' + g + ',' + b + ',1)';
                            context.rect(x, y, 4, 4);
                            context.fill();
                        }
                    });
                    firework.age++;
                    if (firework.age > 100 && Math.random() < .05) {
                        resetFirework(firework);
                    }
                    } else {
                    firework.y = firework.y - 10;
                    for (let spark = 0; spark < 15; spark++) {
                        context.beginPath();
                        context.fillStyle = 'rgba(' + index * 50 + ',' + spark * 17 + ',0,1)';
                        context.rect(firework.x + Math.random() * spark - spark / 2, firework.y + spark * 4, 4, 4);
                        context.fill();
                    }
                    if (Math.random() < .001 || firework.y < 200) firework.phase = 'explode';
                    }
                });
                window.requestAnimationFrame(explode);
                }
            </script>
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
            <h2>Informations pratiques</h2>
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
                                <ul>
                                    <li>Matelas</li>
                                    <li>Sac de couchage</li>
                                    <li>Maillot de bain et serviette (pour les courageux)</li>
                                </ul>
                            </td>
                    </tbody>
                </table>
            </div>
        </div>

        <br /><br />
        <div class="container">
            <h2>Mes informations sur la soirée</h2>
            <div class="table-responsive-md">
                <table class="table table-bordered table-hover">
                    <thead>
                        <tr>
                            <th>Prénom</th>
                            <th>Nom</th>
                            <th>Voiture</th>
                            <th>Places</th>
                            <th>Amène</th>
                            <th>Pseudo</th>
                            <th>Gestion</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        foreach ($invite2 as $data) {
                            foreach($invite3 as $data2){
                        ?>
                            <tr>
                                <td>
                                    <?php
                                    echo $data["sre_prenom"];
                                    ?>
                                </td>
                                <td>
                                    <?php
                                    echo $data2["org_nom"];
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
                                    <?php
                                    echo $data2["org_pseudo"];
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
                        }
                        ?>
                    </tbody>
                </table>
            </div>
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
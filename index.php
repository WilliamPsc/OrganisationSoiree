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
    include "bdd/connect.php";

    if (isset($_SESSION['pseudo'])) {
        $test = $mysqli->query("SELECT SUM(org_statut) FROM t_organisateur_org WHERE org_pseudo = '" . $_SESSION['pseudo'] . "';");
            $val = $test->fetch_assoc();
            if($val['SUM(org_statut)'] == 1){
                header('Location: invite/index.php');
            }
            if($val['SUM(org_statut)'] == 0){
                header('Location: admin/index.php');
            }
    } else {
        include "bdd/info.php";
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
            <canvas id='canvas' width="1100" height='500' style="background-color: black; height: 500px; cursor: crosshair;">Canvas is not supported in your browser.</canvas>
            <script>
                window.requestAnimFrame = ( function() {
                    return window.requestAnimationFrame ||
                                window.webkitRequestAnimationFrame ||
                                window.mozRequestAnimationFrame ||
                                function( callback ) {
                                    window.setTimeout( callback, 1000 / 60 );
                                };
                })();

                // now we will setup our basic variables for the demo
                var canvas = document.getElementById( 'canvas' ),
                        ctx = canvas.getContext( '2d' ),
                        // full screen dimensions
                        cw = 1100,
                        ch = 500,                       
                        // firework collection
                        fireworks = [],
                        // particle collection
                        particles = [],
                        // starting hue
                        hue = 120,
                        // when launching fireworks with a click, too many get launched at once without a limiter, one launch per 5 loop ticks
                        limiterTotal = 5,
                        limiterTick = 0,
                        // this will time the auto launches of fireworks, one launch per 80 loop ticks
                        timerTotal = 80,
                        timerTick = 0,
                        mousedown = false,
                        // mouse x coordinate,
                        mx,
                        // mouse y coordinate
                        my;
                        
                // set canvas dimensions
                if(window.innerWidth >= 1100){
                    canvas.width = cw;
                }else{
                    canvas.width = window.innerWidth - 100;
                    cw = window.innerWidth - 100;
                }

                if(window.innerHeight >= 500){
                    canvas.height = ch;
                }else{
                    canvas.height = window.innerHeight - 100;
                    ch = window.innerHeight - 100;
                }

                // now we are going to setup our function placeholders for the entire demo

                // get a random number within a range
                function random( min, max ) {
                    return Math.random() * ( max - min ) + min;
                }

                // calculate the distance between two points
                function calculateDistance( p1x, p1y, p2x, p2y ) {
                    var xDistance = p1x - p2x,
                            yDistance = p1y - p2y;
                    return Math.sqrt( Math.pow( xDistance, 2 ) + Math.pow( yDistance, 2 ) );
                }

                // create firework
                function Firework( sx, sy, tx, ty ) {
                    // actual coordinates
                    this.x = sx;
                    this.y = sy;
                    // starting coordinates
                    this.sx = sx;
                    this.sy = sy;
                    // target coordinates
                    this.tx = tx;
                    this.ty = ty;
                    // distance from starting point to target
                    this.distanceToTarget = calculateDistance( sx, sy, tx, ty );
                    this.distanceTraveled = 0;
                    // track the past coordinates of each firework to create a trail effect, increase the coordinate count to create more prominent trails
                    this.coordinates = [];
                    this.coordinateCount = 3;
                    // populate initial coordinate collection with the current coordinates
                    while( this.coordinateCount-- ) {
                        this.coordinates.push( [ this.x, this.y ] );
                    }
                    this.angle = Math.atan2( ty - sy, tx - sx );
                    this.speed = 2;
                    this.acceleration = 1.05;
                    this.brightness = random( 50, 70 );
                    // circle target indicator radius
                    this.targetRadius = 1;
                }

                // update firework
                Firework.prototype.update = function( index ) {
                    // remove last item in coordinates array
                    this.coordinates.pop();
                    // add current coordinates to the start of the array
                    this.coordinates.unshift( [ this.x, this.y ] );
                    
                    // cycle the circle target indicator radius
                    if( this.targetRadius < 8 ) {
                        this.targetRadius += 0.3;
                    } else {
                        this.targetRadius = 1;
                    }
                    
                    // speed up the firework
                    this.speed *= this.acceleration;
                    
                    // get the current velocities based on angle and speed
                    var vx = Math.cos( this.angle ) * this.speed,
                            vy = Math.sin( this.angle ) * this.speed;
                    // how far will the firework have traveled with velocities applied?
                    this.distanceTraveled = calculateDistance( this.sx, this.sy, this.x + vx, this.y + vy );
                    
                    // if the distance traveled, including velocities, is greater than the initial distance to the target, then the target has been reached
                    if( this.distanceTraveled >= this.distanceToTarget ) {
                        createParticles( this.tx, this.ty );
                        // remove the firework, use the index passed into the update function to determine which to remove
                        fireworks.splice( index, 1 );
                    } else {
                        // target not reached, keep traveling
                        this.x += vx;
                        this.y += vy;
                    }
                }

                // draw firework
                Firework.prototype.draw = function() {
                    ctx.beginPath();
                    // move to the last tracked coordinate in the set, then draw a line to the current x and y
                    ctx.moveTo( this.coordinates[ this.coordinates.length - 1][ 0 ], this.coordinates[ this.coordinates.length - 1][ 1 ] );
                    ctx.lineTo( this.x, this.y );
                    ctx.strokeStyle = 'hsl(' + hue + ', 100%, ' + this.brightness + '%)';
                    ctx.stroke();
                    
                    ctx.beginPath();
                    // draw the target for this firework with a pulsing circle
                    ctx.arc( this.tx, this.ty, this.targetRadius, 0, Math.PI * 2 );
                    ctx.stroke();
                }

                // create particle
                function Particle( x, y ) {
                    this.x = x;
                    this.y = y;
                    // track the past coordinates of each particle to create a trail effect, increase the coordinate count to create more prominent trails
                    this.coordinates = [];
                    this.coordinateCount = 5;
                    while( this.coordinateCount-- ) {
                        this.coordinates.push( [ this.x, this.y ] );
                    }
                    // set a random angle in all possible directions, in radians
                    this.angle = random( 0, Math.PI * 2 );
                    this.speed = random( 1, 10 );
                    // friction will slow the particle down
                    this.friction = 0.95;
                    // gravity will be applied and pull the particle down
                    this.gravity = 1;
                    // set the hue to a random number +-50 of the overall hue variable
                    this.hue = random( hue - 50, hue + 50 );
                    this.brightness = random( 50, 80 );
                    this.alpha = 1;
                    // set how fast the particle fades out
                    this.decay = random( 0.015, 0.03 );
                }

                // update particle
                Particle.prototype.update = function( index ) {
                    // remove last item in coordinates array
                    this.coordinates.pop();
                    // add current coordinates to the start of the array
                    this.coordinates.unshift( [ this.x, this.y ] );
                    // slow down the particle
                    this.speed *= this.friction;
                    // apply velocity
                    this.x += Math.cos( this.angle ) * this.speed;
                    this.y += Math.sin( this.angle ) * this.speed + this.gravity;
                    // fade out the particle
                    this.alpha -= this.decay;
                    
                    // remove the particle once the alpha is low enough, based on the passed in index
                    if( this.alpha <= this.decay ) {
                        particles.splice( index, 1 );
                    }
                }

                // draw particle
                Particle.prototype.draw = function() {
                    ctx. beginPath();
                    // move to the last tracked coordinates in the set, then draw a line to the current x and y
                    ctx.moveTo( this.coordinates[ this.coordinates.length - 1 ][ 0 ], this.coordinates[ this.coordinates.length - 1 ][ 1 ] );
                    ctx.lineTo( this.x, this.y );
                    ctx.strokeStyle = 'hsla(' + this.hue + ', 100%, ' + this.brightness + '%, ' + this.alpha + ')';
                    ctx.stroke();
                }

                // create particle group/explosion
                function createParticles( x, y ) {
                    // increase the particle count for a bigger explosion, beware of the canvas performance hit with the increased particles though
                    var particleCount = 30;
                    while( particleCount-- ) {
                        particles.push( new Particle( x, y ) );
                    }
                }

                // main demo loop
                function loop() {
                    // this function will run endlessly with requestAnimationFrame
                    requestAnimFrame( loop );
                    
                    // increase the hue to get different colored fireworks over time
                    //hue += 0.5;
                
                    // create random color
                    hue= random(0, 360 );

                    ctx.font = "40pt Calibri,Geneva";
                    ctx.fillStyle = "rgb(255,255,255)";
                    ctx.textAlign = "center";
                    ctx.fillText("<?php echo $value; ?>", canvas.width / 2, canvas.height / 2);
                    
                    // normally, clearRect() would be used to clear the canvas
                    // we want to create a trailing effect though
                    // setting the composite operation to destination-out will allow us to clear the canvas at a specific opacity, rather than wiping it entirely
                    ctx.globalCompositeOperation = 'destination-out';
                    // decrease the alpha property to create more prominent trails
                    ctx.fillStyle = 'rgba(0, 0, 0, 0.5)';
                    ctx.fillRect( 0, 0, cw, ch );
                    // change the composite operation back to our main mode
                    // lighter creates bright highlight points as the fireworks and particles overlap each other
                    ctx.globalCompositeOperation = 'lighter';
                    
                    // loop over each firework, draw it, update it
                    var i = fireworks.length;
                    while( i-- ) {
                        fireworks[ i ].draw();
                        fireworks[ i ].update( i );
                    }
                    
                    // loop over each particle, draw it, update it
                    var i = particles.length;
                    while( i-- ) {
                        particles[ i ].draw();
                        particles[ i ].update( i );
                    }
                    
                    // launch fireworks automatically to random coordinates, when the mouse isn't down
                    if( timerTick >= timerTotal ) {
                        if( !mousedown ) {
                            // start the firework at the bottom middle of the screen, then set the random target coordinates, the random y coordinates will be set within the range of the top half of the screen
                            fireworks.push( new Firework( cw / 2, ch, random( 0, cw ), random( 0, ch / 2 ) ) );
                            timerTick = 0;
                        }
                    } else {
                        timerTick++;
                    }
                    
                    // limit the rate at which fireworks get launched when mouse is down
                    if( limiterTick >= limiterTotal ) {
                        if( mousedown ) {
                            // start the firework at the bottom middle of the screen, then set the current mouse coordinates as the target
                            fireworks.push( new Firework( cw / 2, ch, mx, my ) );
                            limiterTick = 0;
                        }
                    } else {
                        limiterTick++;
                    }
                }

                // mouse event bindings
                // update the mouse coordinates on mousemove
                canvas.addEventListener( 'mousemove', function( e ) {
                    mx = e.pageX - canvas.offsetLeft;
                    my = e.pageY - canvas.offsetTop;
                });

                // toggle mousedown state and prevent canvas from being selected
                canvas.addEventListener( 'mousedown', function( e ) {
                    e.preventDefault();
                    mousedown = true;
                });

                canvas.addEventListener( 'mouseup', function( e ) {
                    e.preventDefault();
                    mousedown = false;
                });

                // once the window loads, we are ready for some fireworks!
                window.onload = loop;
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
                    <a class="nav-link dropdown-toggle" href="" id="dropdown09" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Connexion / Inscription</a>
                    <div class="dropdown-menu" aria-labelledby="dropdown09">
                    <a class="dropdown-item" href="bdd/connexion.php">Se connecter</a>
                    <a class="dropdown-item" href="bdd/inscription.php">S'inscrire</a>
                    </div>
                </li>
            </ul>
        </div>
    </nav>

    <div class="container" style="margin-top:30px; height:100px;">
        <div class="progress">
            <div class="progress-bar bg-success progress-bar-striped progress-bar-animated" id="barre" role="progressbar" aria-valuenow="100" aria-valuemin="0" aria-valuemax="100" >
                <span id="barre2"></span>
            </div>
        </div>
        <?php
            mysqli_data_seek($confirmation, 0);
            while ($conf = $confirmation->fetch_assoc()) {
                $personnesConfirmees = $conf['COUNT(sre_id)'];
            }
        ?>
        <script type="text/javascript">
            var pBar = document.getElementById('barre');
            var pBar2 = document.getElementById('barre2');
            var value = <?php echo $personnesConfirmees; ?>;
            var barre = Math.floor((100 / 25) * value);
            pBar2.innerHTML = barre + "%";
            pBar.style.width = barre + "%";
        </script>
        
        
        <div id="compte_a_rebours" style="text-align: center; margin-top:20px;"><noscript>Merci d'activer votre JavaScript.</noscript></div>
        <?php
            mysqli_data_seek($information, 0);
            while ($dateCR = $information->fetch_assoc()) {
                $dateTest = new DateTime($dateCR['inf_dateD']);
                $var = $dateTest->format('Y-m-d'). " 18:00:00";
            }
        ?>
        <script type="text/javascript">
            function compte_rebours(){
                var compte_a_rebours = document.getElementById("compte_a_rebours");
                var date_actuelle = new Date();
                var dateFCR = '<?php echo $var; ?>';
                var date_evenement = new Date(dateFCR);

                var temps = (date_evenement - date_actuelle) / 1000;

                if(temps < 0){
                    compte_a_rebours.innerHTML = "<h4> Temps écoulé </h4>";
                }

                if(temps > 0){
                    var jours = Math.floor(temps / (60 * 60 * 24));
                    var heures = Math.floor((temps - (jours * 60 * 60 * 24)) / (60 * 60));
                    var minutes = Math.floor((temps - ((jours * 60 * 60 * 24 + heures * 60 * 60))) / 60);
                    var secondes = Math.floor(temps - ((jours * 60 * 60 * 24 + heures * 60 * 60 + minutes * 60)));

                    if(jours == 1){
                        compte_a_rebours.innerHTML = "<h4>" + jours + " jour - " + heures + " : " + minutes + " : " + secondes + "</h4";
                    }
                    if(jours == 0){
                        compte_a_rebours.innerHTML = "<h4>" + heures + " : " + minutes + " : " + secondes + "</h4";
                    }else{
                        compte_a_rebours.innerHTML = "<h4>" + jours + " jours - " + heures + " : " + minutes + " : " + secondes + "</h4";
                    }

                } else{
                    compte_a_rebours.innerHTML = "<h4>" + temps + " </h4>";
                }

                var actualisation = setTimeout("compte_rebours()", 1000);
            }
            compte_rebours();
        </script>
    </div>

    <div class="container" style="margin-top:30px;">
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
        <h2>Liste des personnes confirmées</h2>
        <div class="table-responsive-md">
            <table class="table table-bordered table-hover">
                <thead>
                    <tr>
                        <th>Prénom</th>
                        <th>Voiture</th>
                        <th>Places</th>
                        <th>Amène</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    foreach ($personnes as $data) {
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
                        </tr>
                    <?php
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
</body>

</html>
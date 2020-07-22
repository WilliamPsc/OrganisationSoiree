<div class="container" style="margin-top:30px; height:100px;">

        <div id="compte_a_rebours" style="text-align: center; margin-top:20px;"><noscript>Merci d'activer votre JavaScript.</noscript></div>
        <?php
        mysqli_data_seek($information, 0);
        while ($dateCR = $information->fetch_assoc()) {
            $dateTest = new DateTime($dateCR['inf_dateD']);
            $var = $dateTest->format('Y-m-d') . " 19:00:00";
        }
        ?>
        <script type="text/javascript">
            function compte_rebours() {
                var compte_a_rebours = document.getElementById("compte_a_rebours");
                var date_actuelle = new Date();
                var dateFCR = '<?php echo $var; ?>';
                var date_evenement = new Date(dateFCR);

                var temps = (date_evenement - date_actuelle) / 1000;

                if (temps <= 0) {
                    compte_a_rebours.innerHTML = "<h4> Temps écoulé </h4>";
                }

                if (temps > 0) {
                    var jours = Math.floor(temps / (60 * 60 * 24));
                    var heures = Math.floor((temps - (jours * 60 * 60 * 24)) / (60 * 60));
                    var minutes = Math.floor((temps - ((jours * 60 * 60 * 24 + heures * 60 * 60))) / 60);
                    var secondes = Math.floor(temps - ((jours * 60 * 60 * 24 + heures * 60 * 60 + minutes * 60)));

                    if (jours == 1) {
                        compte_a_rebours.innerHTML = "<h4> Temps restant : " + jours + " jour - " + heures + " : " + minutes + " : " + secondes + "</h4";
                    }
                    if (jours == 0) {
                        compte_a_rebours.innerHTML = "<h4> Temps restant : " + heures + " : " + minutes + " : " + secondes + "</h4";
                    } else {
                        compte_a_rebours.innerHTML = "<h4> Temps restant : " + jours + " jours - " + heures + " : " + minutes + " : " + secondes + "</h4";
                    }

                }

                var actualisation = setTimeout("compte_rebours()", 1000);
            }
            compte_rebours();
        </script>
    </div>
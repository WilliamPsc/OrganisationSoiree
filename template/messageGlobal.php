<?php
$mailR = $mysqli->query("SELECT `org_mail` FROM t_organisateur_org WHERE org_pseudo = '" . $_SESSION['pseudo'] . "';");
$mail = $mailR->fetch_assoc();
if (strpos($mail['org_mail'], "@") == false) {
    echo "<div class=\"container\" style=\"height:100px;\">";
    echo "<div class=\"alert alert-danger\">";
    echo "<strong>Mettez à jour votre profil !</strong> Une modification a été mise en place et nécessite une adresse mail afin de récupérer le mot de passe et pseudo en cas de perte. ";
    echo "Rendez vous <a href=\"modifInv.php\">ici</a> afin d'y remédier.";
    echo "</div>";
    echo "</div>";
}

echo "<div class=\"container\" style=\"height:100px;\">";
echo "<div class=\"alert alert-warning\">";
echo "<center><strong>Si possible faites un test avant de venir (auto test suffira) !</strong></center>";
echo "</div>";
echo "</div>";

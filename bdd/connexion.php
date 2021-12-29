<?php
/* PARTIE BDD */
session_start();

if (isset($_SESSION['pseudo'])) {
    header('Location: ../admin/index.php');
} else {
    include "connect.php";
    include "info.php";
    include "../template/header.php";

    include "../template/menuConnexion.php";
    include "../template/compte_rebours.php";
?>

    <div class="container" style="margin-top:30px;">
        <h2>Se connecter</h2>
        <?php
        if (isset($_GET['connexion'])) {
            if ($_GET["connexion"] == '1') {
                echo "<div class=\"alert alert-success\">";
                echo "<strong>Félicitations!</strong> Vous êtes bien inscrits ! Vous pouvez à présent vous connecter.";
                echo "</div>";
            }
        }

        if (isset($_GET['mdpchg'])) {
            if ($_GET["mdpchg"] == '2') {
                echo "<div class=\"alert alert-success\">";
                echo "<strong>Félicitations!</strong> Mot de passe changé ! Un mail vous a été envoyé, si vous ne le trouvez pas regardez dans vos spams ! Vous pourrez ensuite vous connecter.";
                echo "</div>";
            }
        }

        if (isset($_GET['mdpchg'])) {
            if ($_GET["mdpchg"] == '-1') {
                echo "<div class=\"alert alert-warning\">";
                echo "<strong>Attention!</strong> Mot de passe changé ! Regardez vos mails (spams compris)";
                echo "</div>";
            }
        }

        if (isset($_GET['connect'])) {
            if ($_GET["connect"] == '-1') {
                echo "<div class=\"alert alert-warning\">";
                echo "<strong>Attention!</strong> Aucune concordance pseudo/mot de passe trouvée. Si vous avez oublié votre mot de passe cliquez sur le lien ci dessous.";
                echo "</div>";
            }elseif ($_GET["connect"] == '-2') {
                echo "<div class=\"alert alert-warning\">";
                echo "<strong>Attention!</strong> Un des champs est vide.";
                echo "</div>";
            }
        }
        ?>
        <form action="seconnecter.php" method="post">
            <div class="form-group">
                <label for="pseudo">Pseudo:</label>
                <input type="text" class="form-control" placeholder="Pseudo" name="pseudo" required>
            </div>
            <div class="form-group">
                <label for="pwd">Mot de passe:</label>
                <input type="password" class="form-control" placeholder="Mot de passe" name="pwd" required>
            </div>
            <button type="submit" class="btn btn-primary" id='connexion'>Connexion</button>
        </form>
        <form action="mdpOublie.php" method="post">
            <button type="submit" class="btn btn-link">Mot de passe oublié</button>
        </form>
    </div>

<?php
}
include "../template/footer.php"
?>
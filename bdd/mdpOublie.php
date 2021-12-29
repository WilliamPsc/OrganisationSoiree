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
        <h2>Changer mon mot de passe</h2>
        <p>
            Veuillez saisir votre adresse email et votre pseudo afin que l'on puisse réinitialiser votre mot de passe et vous communiquer le nouveau.
        </p>
        <?php
            if (isset($_GET['mdpchg'])) {
                if ($_GET["mdpchg"] == '-1') {
                    echo "<div class=\"alert alert-warning\">";
                    echo "<strong>Attention!</strong> Mail inexistant. Vérifiez que vous l'avez bien écrit ou c'était peut-être un autre 😉.";
                    echo "</div>";
                } elseif ($_GET['mdpchg'] == '-2') {
                    echo "<div class=\"alert alert-warning\">";
                    echo "<strong>Attention!</strong> Champ vide !";
                    echo "</div>";
                }
            }
            $_GET["mdpchg"] = '1';
            ?>
        <form action="chgmdp.php" method="post">
            <div class="form-group">
                <label for="mail">Mail:</label>
                <input type="email" class="form-control" placeholder="mail@exemple.fr" name="mail" required>
            </div>
            <button type="submit" class="btn btn-primary" id='envoi'>Envoyer</button>
        </form>
    </div>

<?php
}
include "../template/footer.php";
?>
<?php
/* PARTIE ADMIN */
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
    include "../template/menuAdmin.php";
    include "../template/compte_rebours.php";
?>
    <script type="text/javascript" src="../js/function.js"></script>
    <script type="text/javascript">
        let voiture = true;
    </script>

    <div class="container" style="margin-top:30px;">
        <h2>Ajout d'un invité</h2>
        <?php
        if (isset($_GET['inscriptionfailed'])) {
            if ($_GET["inscriptionfailed"] == '-1') {
                echo "<div class=\"alert alert-warning\">";
                echo "<strong>Attention!</strong> Pseudo existant. Veuillez en choisir un autre";
                echo "</div>";
            } elseif ($_GET['inscriptionfailed'] == '-2') {
                echo "<div class=\"alert alert-warning\">";
                echo "<strong>Attention!</strong> Requête échouée. Veuillez recommencer";
                echo "</div>";
            } elseif ($_GET['inscriptionfailed'] == '-3') {
                echo "<div class=\"alert alert-warning\">";
                echo "<strong>Attention!</strong> Un des champs obligatoire était vide.";
                echo "</div>";
            }
        }
        ?>
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
                <label for="pseudo">Pseudo:</label>
                <input type="text" class="form-control" placeholder="Pseudo" name="pseudo" required>
            </div>
            <div class="form-group">
                <label for="pwd">Mot de passe:</label>
                <input type="password" class="form-control" placeholder="Mot de passe" name="pwd" required>
            </div>
            <div class="form-group">
                <label for="voiture">Viens tu avec ta voiture ?</label>
                <select class="form-control" name="voiture" id="car" required>
                    <option value="1">Oui</option>
                    <option value="0">Non</option>
                </select>
            </div>
            <div class="form-group" id="voiture">
                <label for="vient">Tu pars d'où ?</label>
                <input type="text" class="form-control" name='vient' placeholder="Gondor" />
            </div>
            <div class="form-group" id="voiture2">
                <label for="place">Nombre de place disponible dans ma voiture :</label>
                <input type="number" class="form-control" name="place" value="0" min="0" max="10" required>
            </div>
            <div class="form-group">
                <label for="amene">Qu'amènes tu en nourriture ?</label>
                <input type="text" class="form-control" placeholder="Jus de fruits, bonbons, ..." name="amene" value="">
            </div>
            <div class="form-group">
                <label for="matelas">Nombre de matelas que tu amènes :</label>
                <input type="number" class="form-control" name="matelas" value="0" min="0" max="20" required>
            </div>
            <button type="submit" class="btn btn-primary" id='inscription'>Ajouter</button>
        </form>
    </div>

<?php
}
include "../template/footer.php"
?>
    <?php
    session_start();

    if (isset($_SESSION['pseudo'])) {
        header('Location: admin/index.php');
    } else {
        include "connect.php";
        include "info.php";
        include "../template/header.php";
        include "../template/menuConnexion.php";
        include "../template/compte_rebours.php";
    ?>

        <script type="text/javascript" src="../js/function.js"></script>
        <script type="text/javascript">
            let voiture = true;
        </script>

        <div class="container" style="margin-top:30px;">
            <h2>S'inscrire</h2>
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
            <form action="sinscrire.php" method="post">
                <div class="form-group">
                    <label for="prenom">Prénom :</label>
                    <input type="text" class="form-control" placeholder="Prénom" name="prenom" required>
                </div>
                <div class="form-group">
                    <label for="nom">Nom :</label>
                    <input type="text" class="form-control" placeholder="Nom" name="nom" required>
                </div>
                <div class="form-group">
                    <label for="mail">Mail de récupération :</label>
                    <input type="email" class="form-control" placeholder="exemple@exemple.fr" name="mail" required>
                </div>
                <div class="form-group">
                    <label for="pseudo">Pseudo :</label>
                    <input type="text" class="form-control" placeholder="Pseudo" name="pseudo" required>
                </div>
                <div class="form-group">
                    <label for="pwd">Mot de passe :</label>
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
                    <input type="text" class="form-control" name='vient' placeholder="Gondor" value="" />
                </div>
                <div class="form-group" id="voiture2">
                    <label for="place">Nombre de place disponible dans ma voiture :</label>
                    <input type="number" class="form-control" name="place" value="0" min="0" max="10" />
                </div>
                <div class="form-group">
                    <p>Qu'amènes tu en nourriture ? <i>Ceci sera à remplir une fois connecté au site !</i></p>
                </div>
                <div class="form-group">
                    <label for="matelas">Nombre de matelas que tu amènes :</label>
                    <input type="number" class="form-control" name="matelas" value="0" min="0" max="20">
                </div>
                <button type="submit" class="btn btn-primary" id='inscription'>Envoyer</button>
            </form>
        </div>

    <?php
    }
    include "../template/footer.php";
    ?>
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

    <div class="container" style="margin-top:30px;">
        <h2>Modification des informations de la soirée</h2>

        <form action="../bdd/modifInfo.php" method="post">
            <label>Date début :</label>
            <input name='dateD' class="form-control" type="date" placeholder="dateD" value="<?php
                                                                                            mysqli_data_seek($information, 0);
                                                                                            while ($dateD = $information->fetch_assoc()) {
                                                                                                echo $dateD['inf_dateD'];
                                                                                            }
                                                                                            ?>" />

            <label>Date fin :</label>
            <input name='dateF' class="form-control" type="date" placeholder="dateF" value="<?php
                                                                                            mysqli_data_seek($information, 0);
                                                                                            while ($dateF = $information->fetch_assoc()) {
                                                                                                echo $dateF['inf_dateF'];
                                                                                            }
                                                                                            ?>" />

            <label>Adresse :</label>
            <input name='adresse' class="form-control" type="text" placeholder="Adresse" value="<?php
                                                                                                mysqli_data_seek($information, 0);
                                                                                                while ($adresse = $information->fetch_assoc()) {
                                                                                                    echo $adresse['inf_adresse'];
                                                                                                }
                                                                                                ?>" />

            <label>Titre de la fête :</label>
            <input name='nom' class="form-control" type="text" placeholder="Adresse" value="<?php
                                                                                            mysqli_data_seek($information, 0);
                                                                                            while ($nom = $information->fetch_assoc()) {
                                                                                                echo $nom['inf_nom'];
                                                                                            }
                                                                                            ?>" />

            <label>Affaires à amener :</label>
            <input name='affaires' class="form-control" type="text" placeholder="Affaires" value="<?php
                                                                                                    mysqli_data_seek($infAmene, 0);
                                                                                                    while ($nom = $infAmene->fetch_assoc()) {
                                                                                                        echo $nom['inf_amene'];
                                                                                                    }
                                                                                                    ?>" />

            <br /><br />
            <input type="submit" name="submit" class="btn btn-primary btn-lg" value="Modifier" />
        </form>
    </div>

<?php
}
include "../template/footer.php";
?>
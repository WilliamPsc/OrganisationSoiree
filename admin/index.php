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
        if ($val['SUM(org_statut)'] == 0) {
            //header('Location: ../admin/index.php');
        }
        include "../template/menuAdmin.php";
        include "../template/compte_rebours.php";
        include "../template/tableau.php";
    ?>

        <div class="container"  style="margin-top:30px;">
            <h2>Liste des personnes confirmées</h2>
            <input type="button" class="btn btn-info btn-block" style="text-align: center;" onclick="window.location.href='ajoutInv.php'" value="Ajouter une personne"><br />
            <input type="button" class="btn btn-danger btn-block" style="text-align: center;" onclick="window.location.href='supprInviter.php'" value="Réinitialisation"><br />
            <div class="table-responsive-md">
                <table class="table table-bordered table-hover">
                    <thead>
                        <tr>
                            <th>Prénom</th>
                            <th>Voiture</th>
                            <th>Vient de</th>
                            <th>Places voitures</th>
                            <th>Amène</th>
                            <th>Gestion</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        foreach ($personne as $data) {
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
                                        echo "Oui";
                                    }else{
                                        echo "Non";
                                    }
                                    ?>
                                </td>
                                <td>
                                    <?php
                                    echo $data["sre_vient"];
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
                        ?>
                    </tbody>
                </table>
            </div>
        </div>

    <?php
    }
    include "../template/footer.php";
    ?>
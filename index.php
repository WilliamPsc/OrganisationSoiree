    <?php
    /* PARTIE BASIQUE */
    session_start();
    include "bdd/connect.php";

    if (isset($_SESSION['pseudo'])) {
        $test = $mysqli->query("SELECT SUM(org_statut) FROM t_organisateur_org WHERE org_pseudo = '" . $_SESSION['pseudo'] . "';");
        $val = $test->fetch_assoc();
        if ($val['SUM(org_statut)'] == 1) {
            header('Location: invite/index.php');
        }
        if ($val['SUM(org_statut)'] == 0) {
            header('Location: admin/index.php');
        }
    } else {
        include "bdd/info.php";
        include "template/header.php";
        include "template/menu.php";
        include "template/compte_rebours.php";
        include "template/tableau.php";
    ?>

        <br /><br />
        <div class="container">
            <h2>Liste des personnes confirmées</h2>
            <div class="table-responsive-md">
                <table class="table table-bordered table-hover">
                    <thead>
                        <tr>
                            <th>Prénom</th>
                            <th>Voiture</th>
                            <th>Vient de</th>
                            <th>Places voiture</th>
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
    include "template/footer.php";
    ?>
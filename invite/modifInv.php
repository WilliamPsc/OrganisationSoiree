<?php
/* PARTIE INVITE */
session_start();
$id = $_POST['id'];
if (empty($_SESSION['pseudo'])) {
    header('Location: ../bdd/connexion.php');
} else {
    include "../bdd/connect.php";
    include "../bdd/info.php";
    include "../template/header.php";
    $test = $mysqli->query("SELECT SUM(org_statut) FROM t_organisateur_org WHERE org_pseudo = '" . $_SESSION['pseudo'] . "';");
    $val = $test->fetch_assoc();
    if ($val['SUM(org_statut)'] == 0) {
        header('Location: ../admin/index.php');
    }
    include "../template/menuAdmin.php";
    include "../template/compte_rebours.php";
?>
    <script type="text/javascript">
        function getComboA(selectObject) {
            console.log(selectObject);
            if (selectObject == 1) {
                document.getElementById("voiture11").style.display = "block";
                document.getElementById("voiture12").style.display = "block";
                document.getElementById("voiture21").style.display = "block";
                document.getElementById("voiture22").style.display = "block";
            } else if (selectObject == 0) {
                document.getElementById("voiture11").style.display = "none";
                document.getElementById("voiture12").style.display = "none";
                document.getElementById("voiture21").style.display = "none";
                document.getElementById("voiture22").style.display = "none";
            }
        }
    </script>

    <div class="container" style="margin-top:30px;">
        <h2>Modification d'un invité</h2>

        <form action="../bdd/modifInvi.php" method="post">
            <input name='statut' class="form-control" type="hidden" value="<?php
                                                                            mysqli_data_seek($invite1, 0);
                                                                            while ($inv1 = $invite1->fetch_assoc()) {
                                                                                echo $inv1['org_statut'];
                                                                            }
                                                                            ?>" />
            <label for="prenom">Prénom :</label>
            <input name='prenom' class="form-control" type="text" placeholder="Prénom" value="<?php
                                                                                                mysqli_data_seek($invite, 0);
                                                                                                while ($inv = $invite->fetch_assoc()) {
                                                                                                    echo $inv['sre_prenom'];
                                                                                                }
                                                                                                ?>" />

            <label for="nom">Nom :</label>
            <input name='nom' class="form-control" type="text" placeholder="Nom" value="<?php
                                                                                        mysqli_data_seek($invite3, 0);
                                                                                        while ($inv = $invite3->fetch_assoc()) {
                                                                                            echo $inv['org_nom'];
                                                                                        }
                                                                                        ?>" />

            <label for="pseudo">Pseudo :</label>
            <input name='pseudo' class="form-control" type="text" value="<?php
                                                                            mysqli_data_seek($invite3, 0);
                                                                            while ($inv = $invite3->fetch_assoc()) {
                                                                                echo $inv['org_pseudo'];
                                                                            }
                                                                            ?>" />

            <label for="amene">Qu'amènes tu en nourriture ?</label>
            <input name='amene' class="form-control" type="text" value=" <?php
                                                                            mysqli_data_seek($invite, 0);
                                                                            while ($inv = $invite->fetch_assoc()) {
                                                                                echo $inv['sre_amene'];
                                                                            }
                                                                            ?>" />

            <label for="voiture">Viens tu avec ta voiture ?</label>
            <select class="form-control" name="voiture" onchange="getComboA(this.options[this.selectedIndex].value)" required>
                <option value="<?php
                                mysqli_data_seek($invite, 0);
                                while ($inv = $invite->fetch_assoc()) {
                                    echo $inv['sre_voiture'];
                                }
                                ?>" selected hidden><?php
                                                    mysqli_data_seek($invite, 0);
                                                    while ($inv = $invite->fetch_assoc()) {
                                                        $voiture = $inv['sre_voiture'];
                                                        if ($inv['sre_voiture'] == 1) {
                                                            echo "Oui";
                                                        } elseif ($inv['sre_voiture'] == 0) {
                                                            echo "Non";
                                                        }
                                                    }
                                                    ?></option>
                <option value="1">Oui</option>
                <option value="0">Non</option>
            </select>

            <label for="vient" id="voiture12">Part de :</label>
            <input name='vient' class="form-control" id="voiture11" type="text" placeholder="Gondor" value="<?php
                                                                                                            mysqli_data_seek($invite, 0);
                                                                                                            while ($inv = $invite->fetch_assoc()) {
                                                                                                                echo $inv['sre_vient'];
                                                                                                            }
                                                                                                            ?>" />

            <label for="placeV" id="voiture22">Nombre de place disponible dans la voiture:</label>
            <input name='placeV' class="form-control" id="voiture21" type="number" placeholder="0" min="0" value="<?php
                                                                                                                    mysqli_data_seek($invite, 0);
                                                                                                                    while ($inv = $invite->fetch_assoc()) {
                                                                                                                        echo $inv['sre_place'];
                                                                                                                    }
                                                                                                                    ?>" />

            <label for="confirmation">Confirmation :</label>
            <select class="form-control" name="confirmation" required>
                <option value="<?php
                                mysqli_data_seek($invite, 0);
                                while ($inv = $invite->fetch_assoc()) {
                                    echo $inv['sre_confirmation'];
                                }
                                ?>" selected hidden><?php
                                                    mysqli_data_seek($invite, 0);
                                                    while ($inv = $invite->fetch_assoc()) {
                                                        if ($inv['sre_confirmation'] == 1) {
                                                            echo "Oui";
                                                        } elseif ($inv['sre_confirmation'] == 0) {
                                                            echo "Non";
                                                        }
                                                    }
                                                    ?></option>
                <option value="1">Oui</option>
                <option value="0">Non</option>
            </select>

            <label for="placeM">Nombre de place de matelas :</label>
            <input name='placeM' class="form-control" type="number" placeholder="0" min="0" value="<?php
                                                                                                    mysqli_data_seek($invite, 0);
                                                                                                    while ($inv = $invite->fetch_assoc()) {
                                                                                                        echo $inv['sre_matelas'];
                                                                                                    }
                                                                                                    ?>" />
            <br /><br />
            <input type="hidden" name="id" value="<?php echo $id ?>" />
            <input type="submit" name="submit" class="btn btn-primary btn-lg" value="Modifier" />
        </form>
        <div>
            <script type="text/javascript">
                getComboA(<?php echo $voiture ?>)
            </script>
        </div>
    </div>

<?php
}
include "../template/footer.php";
?>
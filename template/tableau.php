<div class="container" style="margin-top:30px;">
        <h2>Informations pratiques</h2>
        <?php
            if(isset($_SESSION['pseudo'])){
                if($val['org_statut'] == 0){
                    echo "<input type=\"button\" class=\"btn btn-info btn-block\" style=\"text-align: center;\" onclick=\"window.location.href='modifInfo.php'\" value=\"Modifier\"><br />";
                }
            }
        ?>
        <div class="table-responsive-md">
            <table class="table table-bordered table-hover">
                <tbody>
                    <tr>
                        <td>Date début:</td>
                        <td>
                            <?php
                            mysqli_data_seek($information, 0);
                            while ($dateD = $information->fetch_assoc()) {
                                $date0 = new DateTime($dateD['inf_dateD']);
                                echo $date0->format('d/m/Y') . " || 19h00";
                            }
                            ?>
                        </td>
                    </tr>
                    <tr>
                        <td>Date fin:</td>
                        <td>
                            <?php
                            mysqli_data_seek($information, 0);
                            while ($dateF = $information->fetch_assoc()) {
                                $date1 = new DateTime($dateF['inf_dateF']);
                                echo $date1->format('d/m/Y');
                            }
                            ?>
                        </td>
                    </tr>
                    <tr>
                        <td>Adresse :</td>
                        <td>
                            <?php
                            mysqli_data_seek($information, 0);
                            while ($adresse = $information->fetch_assoc()) {
                                echo $adresse['inf_adresse'];
                            }
                            ?>
                        </td>
                    </tr>
                    <tr>
                        <td>Nombre de personnes confirmées :</td>
                        <td>
                            <?php
                            mysqli_data_seek($confirmation, 0);
                            while ($conf = $confirmation->fetch_assoc()) {
                                echo $conf['COUNT(sre_id)'];
                            }
                            ?>
                        </td>
                    </tr>
                    <tr>
                        <td>Nombre de places pour dormir :</td>
                        <td>
                            <?php
                            mysqli_data_seek($matelas, 0);
                            while ($dodo = $matelas->fetch_assoc()) {
                                echo $dodo['SUM(sre_matelas)'];
                            }
                            ?>
                        </td>
                    </tr>
                    <tr>
                        <td>Nombre de voiture sur parking :</td>
                        <td>
                            <?php
                            mysqli_data_seek($voiture, 0);
                            while ($car = $voiture->fetch_assoc()) {
                                echo $car['COUNT(sre_id)'];
                            }
                            ?>
                        </td>
                    </tr>
                    <tr>
                        <td>Nombre de place dans les voitures :</td>
                        <td>
                            <?php
                            mysqli_data_seek($place, 0);
                            while ($car = $place->fetch_assoc()) {
                                echo $car['SUM(sre_place)'];
                            }
                            ?>
                        </td>
                    <tr>
                        <td>A amener :</td>
                        <td>
                            <?php
                            while ($amene = $infAmene->fetch_assoc()) {
                                $info = $amene['inf_amene'];
                            };
                            ?>
                            <ul>
                                <?php
                                $delimiters = ";";
                                $res = explode($delimiters, $info);
                                foreach ($res as $ligne) {
                                    echo "<li>";
                                    echo $ligne;
                                    echo "</li>";
                                }
                                ?>
                            </ul>
                        </td>
                </tbody>
            </table>
        </div>
    </div>
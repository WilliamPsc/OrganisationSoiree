<?php
/* PARTIE ADMIN */
session_start();
include "bdd/connect.php";
include "bdd/info.php";
include "template/header.php";

if (isset($_SESSION['pseudo'])) {
    include "template/menuInvite.php";
} else {
    include "template/menu.php";
}

include "template/compte_rebours.php";
include "bdd/dataRepas.php";
?>

<div class="container">
    <h2>Menu du repas</h2>
    <div class="table-responsive-md">
        <table class="table table-bordered table-hover">
            <tbody>
                <tr>
                    <td>Apéritif</td>
                    <td>
                        <ul>
                            <?php echo $aperitifMenu ?>
                        </ul>
                    </td>
                </tr>
                <tr>
                    <td>Pizzas</td>
                    <td>
                        <ul>
                            <?php echo $pizzasMenu ?>
                        </ul>
                        Quantités : 1 pizza pour 2 personnes
                    </td>
                </tr>
                <tr>
                    <td>Dessert</td>
                    <td>
                        <ul>
                            <?php echo $dessertMenu ?>
                        </ul>
                    </td>
                </tr>

                <tr>
                    <td>Boissons</td>
                    <td>
                        <ul>
                            <?php
                            if ($softMenu != "") {
                            ?>
                                <li>Soft</li>
                                <ul>
                                    <?php echo $softMenu ?>
                                </ul>
                            <?php
                            }
                            ?>

                            <?php
                            if ($alcoolMenu != "") {
                            ?>
                                <li>Alcool</li>
                                <ul>
                                    <?php echo $alcoolMenu ?>
                                </ul>
                            <?php
                            }
                            ?>
                        </ul>
                    </td>
                </tr>
                <tr>
                    <td>Petit-déjeuner</td>
                    <td>
                        <ul>
                            <?php echo $petitDejMenu ?>
                        </ul>
                    </td>
                </tr>
                <tr>
                    <td>Bonbons</td>
                    <td>
                        <ul>
                            <?php echo $bonbonsMenu ?>
                        </ul>
                    </td>
                </tr>
            </tbody>
        </table>
    </div>
</div>

<?php
include "template/footer.php"
?>
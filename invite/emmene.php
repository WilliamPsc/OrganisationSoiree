<?php
/* PARTIE ADMIN */
session_start();
$id = $_POST['id'];
if (empty($_SESSION['pseudo'])) {
header('Location: ../bdd/connexion.php');
} else {
include "../bdd/connect.php";
include "../bdd/info.php";
include "../template/header.php";
$test = $mysqli->query("SELECT org_statut FROM t_organisateur_org WHERE org_pseudo = '" . $_SESSION['pseudo'] . "';");
$val = $test->fetch_assoc();
if ($val['org_statut'] == 0) {
    header('Location: ../admin/index.php');
}
include "../template/menuInvite.php";
include "../template/compte_rebours.php";
?>
<div class="container" style="margin-top:30px;">
    <h2>Qu'amènes tu en nourriture ?</h2>
    <form action="../bdd/recolteAmener.php" method="POST">
        <div class="form-group">
            <div class="form-group" id="type">
                <div class="form-check-inline">
                    <label class="form-check-label">
                        <input type="checkbox" class="form-check-input" id="aperitif" name="aperitif">Apéritif
                    </label>
                </div>
                <div class="form-check-inline">
                    <label class="form-check-label">
                        <input type="checkbox" class="form-check-input" id="pizzas" name="pizzas">Pizzas
                    </label>
                </div>
                <div class="form-check-inline">
                    <label class="form-check-label">
                        <input type="checkbox" class="form-check-input" id="dessert" name="dessert">Dessert
                    </label>
                </div>
                <div class="form-check-inline">
                    <label class="form-check-label">
                        <input type="checkbox" class="form-check-input" id="petitdej" name="petitdej">Petit déjeuner
                    </label>
                </div>
                <div class="form-check-inline">
                    <label class="form-check-label">
                        <input type="checkbox" class="form-check-input" id="bonbons" name="bonbons">Bonbons
                    </label>
                </div>
                <div class="form-check-inline">
                    <label class="form-check-label">
                        <input type="checkbox" class="form-check-input" id="boissons" name="boissons">Boissons
                    </label>
                </div>
            </div>
        </div>

        <div class="form-group" id="hrRepasTop">
            <hr style="height:2px; border:none; color:#000; background-color:#000; width:60%; text-align:center; margin: 0 auto;">
        </div>

        <!-- ---------------------------- Apéritif ---------------------------- -->
        <div class="form-group" id="typeAperitif" style="display:none">
            <label for="typeAperitif">Type apéritif :</label>
            <div class="input-group mb-3" name="typeAperitif">
                <div class="form-check-inline">
                    <label class="form-check-label" for="cake">
                        <input type="checkbox" class="form-check-input" id="cake" name="cake" value="Cake">Cake
                    </label>
                </div>
                <div class="form-check-inline">
                    <label class="form-check-label" for="gateauxAperitifs">
                        <input type="checkbox" class="form-check-input" id="gateauxAperitifs" name="gateauxAperitifs" value="Gâteaux apéritifs">Gâteaux apéritifs
                    </label>
                </div>
                <div class="form-check-inline">
                    <label class="form-check-label" for="pringles">
                        <input type="checkbox" class="form-check-input" id="pringles" name="pringles" value="Pringles">Pringles
                    </label>
                </div>
                <div class="form-check-inline">
                    <label class="form-check-label" for="chips">
                        <input type="checkbox" class="form-check-input" id="chips" name="chips" value="Chips">Chips
                    </label>
                </div>
            </div>
        </div>

        <div class="form-group" id="quantiteCake" style="display:none">
            <label for="quantiteCake">Nombre de cakes : </label>
            <select class="form-control" name="quantiteCake">
                <option value="1">1</option>
                <option value="2">2</option>
                <option value="3">3</option>
            </select>
        </div>

        <div class="form-group" id="quantiteGatAperitifs" style="display:none">
            <label for="quantiteGatAperitifs">Nombre de paquets de gâteaux apéritifs : </label>
            <select class="form-control" name="quantiteGatAperitifs">
                <option value="1">1</option>
                <option value="2">2</option>
                <option value="3">3</option>
                <option value="4">4</option>
            </select>
        </div>

        <div class="form-group" id="quantitePringles" style="display:none">
            <label for="quantitePringles">Nombre de paquets de pringles : </label>
            <select class="form-control" name="quantitePringles">
                <option value="1">1</option>
                <option value="2">2</option>
                <option value="3">3</option>
            </select>
        </div>

        <div class="form-group" id="quantiteChips" style="display:none">
            <label for="quantiteChips">Nombre de paquets de chips : </label>
            <select class="form-control" name="quantiteChips">
                <option value="1">1</option>
                <option value="2">2</option>
                <option value="3">3</option>
                <option value="4">4</option>
                <option value="5">5</option>
            </select>
        </div>

        <div class="form-group" id="hrAperitif" style="display:none">
            <hr style="height:2px; border:none; color:#000; background-color:#000; width:60%; text-align:center; margin: 0 auto;">
        </div>

        <!-- ---------------------------- Pizzas ---------------------------- -->
        <div class="form-group" id="typePizza" style="display:none">
            <label for="typePizza">Type pizza :</label>
            <div class="input-group mb-3" name="typePizza">
                <div class="form-check-inline">
                    <label class="form-check-label" for="pizzaVegetarienne">
                        <input type="checkbox" class="form-check-input" id="pizzaVegetarienne" name="pizzaVegetarienne" value="Végétarienne">Végétarienne
                    </label>
                </div>
                <div class="form-check-inline">
                    <label class="form-check-label" for="pizzaClassique">
                        <input type="checkbox" class="form-check-input" id="pizzaClassique" name="pizzaClassique" value="Classique">Classique
                    </label>
                </div>
            </div>
        </div>

        <div class="form-group" id="quantitePizzaVegetarienne" style="display:none">
            <label for="quantiteVege">Quantités de pizzas Végétarienne : </label>
            <select class="form-control" name="quantiteVege">
                <option value="1">1</option>
                <option value="2">2</option>
                <option value="3">3</option>
            </select>
        </div>

        <div class="form-group" id="quantitePizzaClassique" style="display:none">
            <label for="quantiteClassique">Quantités de pizzas Classique : </label>
            <select class="form-control" name="quantiteClassique">
                <option value="1">1</option>
                <option value="2">2</option>
                <option value="3">3</option>
                <option value="4">4</option>
                <option value="5">5</option>
            </select>
        </div>

        <div class="form-group" id="hrPizzas" style="display:none">
            <hr style="height:2px; border:none; color:#000; background-color:#000; width:60%; text-align:center; margin: 0 auto;">
        </div>

        <!-- ---------------------------- Dessert ---------------------------- -->
        <div class="form-group" id="typeDessert" style="display:none">
            <label for="typeDessert">Type dessert :</label>
            <div class="input-group mb-3" name="typeDessert">
                <div class="form-check-inline">
                    <label class="form-check-label" for="gateauChocolat">
                        <input type="checkbox" class="form-check-input" id="gateauChocolat" name="gateauChocolat" value="Gateau chocolat">Gateau chocolat
                    </label>
                </div>
                <div class="form-check-inline">
                    <label class="form-check-label" for="roseSables">
                        <input type="checkbox" class="form-check-input" id="roseSables" name="roseSables" value="Rose des sables">Rose des sables
                    </label>
                </div>
                <div class="form-check-inline">
                    <label class="form-check-label" for="tiramisu">
                        <input type="checkbox" class="form-check-input" id="tiramisu" name="tiramisu" value="Tiramisu">Tiramisu
                    </label>
                </div>
                <div class="form-check-inline">
                    <label class="form-check-label" for="tarte">
                        <input type="checkbox" class="form-check-input" id="tarte" name="tarte" value="Tarte">Tarte
                    </label>
                </div>
            </div>
        </div>

        <div class="form-group" id="quantiteGateauChocolats" style="display:none">
            <label for="quantiteGateauChocolat">Combien de parts pour le gateau au chocolat ?</label>
            <select class="form-control" name="quantiteGateauChocolat">
                <option value="4">4</option>
                <option value="6">6</option>
                <option value="8">8</option>
                <option value="10">10</option>
            </select>
        </div>

        <div class="form-group" id="quantiteRoseDesSables" style="display:none">
            <label for="quantiteRoseSables">Combien de parts pour les roses des sables ?</label>
            <select class="form-control" name="quantiteRoseSables">
                <option value="4">4</option>
                <option value="6">6</option>
                <option value="8">8</option>
                <option value="10">10</option>
            </select>
        </div>

        <div class="form-group" id="quantiteTiramisus" style="display:none">
            <label for="quantiteTiramisu">Combien de parts pour le tiramisu ?</label>
            <select class="form-control" name="quantiteTiramisu">
                <option value="4">4</option>
                <option value="6">6</option>
                <option value="8">8</option>
                <option value="10">10</option>
            </select>
        </div>

        <div class="form-group" id="quantiteTartes" style="display:none">
            <label for="quantiteTarte">Combien de parts pour la tarte ?</label>
            <select class="form-control" name="quantiteTarte">
                <option value="4">4</option>
                <option value="6">6</option>
                <option value="8">8</option>
                <option value="10">10</option>
            </select>
        </div>

        <div class="form-group" id="hrDessert" style="display:none">
            <hr style="height:2px; border:none; color:#000; background-color:#000; width:60%; text-align:center; margin: 0 auto;">
        </div>

        <!-- ---------------------------- Petit déjeuner ---------------------------- -->
        <div class="form-group" id="typePetitDejeuner" style="display:none">
            <label for="typePetitDejeuner">Type petit-déjeuner :</label>
            <div class="input-group mb-3" name="typePetitDejeuner">
                <div class="form-check-inline">
                    <label class="form-check-label" for="brioche">
                        <input type="checkbox" class="form-check-input" id="brioche" name="brioche" value="Brioche">Brioche
                    </label>
                </div>
                <div class="form-check-inline">
                    <label class="form-check-label" for="briocheChocolat">
                        <input type="checkbox" class="form-check-input" id="briocheChocolat" name="briocheChocolat" value="Brioche au chocolat">Brioche au chocolat
                    </label>
                </div>
                <div class="form-check-inline">
                    <label class="form-check-label" for="crepes">
                        <input type="checkbox" class="form-check-input" id="crepes" name="crepes" value="Crêpes">Crêpes
                    </label>
                </div>
                <div class="form-check-inline">
                    <label class="form-check-label" for="jusOrange">
                        <input type="checkbox" class="form-check-input" id="jusOrange" name="jusOrange" value="Jus d'orange">Jus d'orange
                    </label>
                </div>
            </div>
        </div>

        <div class="form-group" id="quantiteBrioches" style="display:none">
            <label for="quantiteBrioche">Combien de paquets de brioches ?</label>
            <select class="form-control" name="quantiteBrioche">
                <option value="1">1</option>
                <option value="2">2</option>
                <option value="3">3</option>
                <option value="4">4</option>
            </select>
        </div>

        <div class="form-group" id="quantiteBriocheChocolats" style="display:none">
            <label for="quantiteBriocheChocolat">Combien de paquets de brioches au chocolat ?</label>
            <select class="form-control" name="quantiteBriocheChocolat">
                <option value="1">1</option>
                <option value="2">2</option>
                <option value="3">3</option>
                <option value="4">4</option>
            </select>
        </div>

        <div class="form-group" id="quantiteCrepes" style="display:none">
            <label for="quantiteCrepe">Combien de paquets de crêpes (en douzaine) ?</label>
            <select class="form-control" name="quantiteCrepe">
                <option value="0.5">0.5</option>
                <option value="1" selected>1</option>
                <option value="2">2</option>
                <option value="3">3</option>
            </select>
        </div>

        <div class="form-group" id="quantiteJusOranges" style="display:none">
            <label for="quantiteJusOrange">Combien de litres de jus d'orange ?</label>
            <select class="form-control" name="quantiteJusOrange">
                <option value="1">1</option>
                <option value="2">2</option>
                <option value="4">4</option>
                <option value="6">6</option>
            </select>
        </div>

        <div class="form-group" id="hrPetitDejeuner" style="display:none">
            <hr style="height:2px; border:none; color:#000; background-color:#000; width:60%; text-align:center; margin: 0 auto;">
        </div>

        <!-- ---------------------------- Bonbons ---------------------------- -->
        <div class="form-group" id="quantiteBonbons" style="display:none">
            <label for="quantiteBonbon">Combien de paquets de bonbons ?</label>
            <select class="form-control" name="quantiteBonbon">
                <option value="1">1</option>
                <option value="2">2</option>
                <option value="3">3</option>
                <option value="4">4</option>
            </select>
        </div>

        <div class="form-group" id="hrBonbons" style="display:none">
            <hr style="height:2px; border:none; color:#000; background-color:#000; width:60%; text-align:center; margin: 0 auto;">
        </div>

        <!-- ---------------------------- Boissons ---------------------------- -->
        <div class="form-group" id="typeBoissons" style="display:none">
            <label for="typeBoissons">Type boissons :</label>
            <div class="input-group mb-3" name="typeBoissons">
                <div class="form-check-inline">
                    <label class="form-check-label" for="soft">
                        <input type="checkbox" class="form-check-input" id="soft" name="soft" value="Soft">Soft
                    </label>
                </div>
                <div class="form-check-inline">
                    <label class="form-check-label" for="alcool">
                        <input type="checkbox" class="form-check-input" id="alcool" name="alcool" value="Alcool">Alcool
                    </label>
                </div>
            </div>
        </div>

        <!-- SOFT -->
        <div class="form-group" id="typeBoissonsSoft" style="display:none">
            <label for="typeBoissonsSoft">Boissons soft :</label>
            <div class="input-group mb-3" name="typeBoissonsSoft">
                <div class="form-check-inline">
                    <label class="form-check-label" for="coca">
                        <input type="checkbox" class="form-check-input" id="coca" name="coca" value="Coca">Coca
                    </label>
                </div>
                <div class="form-check-inline">
                    <label class="form-check-label" for="orangina">
                        <input type="checkbox" class="form-check-input" id="orangina" name="orangina" value="Orangina">Orangina
                    </label>
                </div>
                <div class="form-check-inline">
                    <label class="form-check-label" for="fanta">
                        <input type="checkbox" class="form-check-input" id="fanta" name="fanta" value="Fanta">Fanta
                    </label>
                </div>
                <div class="form-check-inline">
                    <label class="form-check-label" for="schweppes">
                        <input type="checkbox" class="form-check-input" id="schweppes" name="schweppes" value="Schweppes">Schweppes
                    </label>
                </div>
                <div class="form-check-inline">
                    <label class="form-check-label" for="schweppesAgrum">
                        <input type="checkbox" class="form-check-input" id="schweppesAgrum" name="schweppesAgrum" value="Schweppes agrumes">Schweppes agrumes
                    </label>
                </div>
                <div class="form-check-inline">
                    <label class="form-check-label" for="oasis">
                        <input type="checkbox" class="form-check-input" id="oasis" name="oasis" value="Oasis">Oasis
                    </label>
                </div>
                <div class="form-check-inline">
                    <label class="form-check-label" for="iceTea">
                        <input type="checkbox" class="form-check-input" id="iceTea" name="iceTea" value="Ice Tea">Ice Tea
                    </label>
                </div>
                <div class="form-check-inline">
                    <label class="form-check-label" for="jdf">
                        <input type="checkbox" class="form-check-input" id="jdf" name="jdf" value="Jus de fruits">Jus de fruits
                    </label>
                </div>
            </div>
        </div>

        <div class="form-group" id="quantiteCoca" style="display:none">
            <label for="quantiteCoca">Combien de litres de Coca?</label>
            <input type="number" id="quantiteCoca" name="quantiteCoca" min="1" max="6" step="0.5" value="1">
        </div>

        <div class="form-group" id="quantiteOrangina" style="display:none">
            <label for="quantiteOrangina">Combien de litres d'Orangina ?</label>
            <input type="number" id="quantiteOrangina" name="quantiteOrangina" min="1" max="6" step="0.5" value="1">
        </div>

        <div class="form-group" id="quantiteFanta" style="display:none">
            <label for="quantiteFanta">Combien de litres de Fanta ?</label>
            <input type="number" id="quantiteFanta" name="quantiteFanta" min="1" max="6" step="0.5" value="1">
        </div>

        <div class="form-group" id="quantiteSchweppes" style="display:none">
            <label for="quantiteSchweppes">Combien de litres de Schweppes ?</label>
            <input type="number" id="quantiteSchweppes" name="quantiteSchweppes" min="1" max="6" step="0.5" value="1">
        </div>

        <div class="form-group" id="quantiteSchweppesAgrum" style="display:none">
            <label for="quantiteSchweppesAgrum">Combien de litres de Schweppes agrumes ?</label>
            <input type="number" id="quantiteSchweppesAgrum" name="quantiteSchweppesAgrum" min="1" max="6" step="0.5" value="1">
        </div>

        <div class="form-group" id="quantiteOasis" style="display:none">
            <label for="quantiteOasis">Combien de litres d'Oasis' ?</label>
            <input type="number" id="quantiteOasis" name="quantiteOasis" min="1" max="6" step="0.5" value="1">
        </div>

        <div class="form-group" id="quantiteIceTea" style="display:none">
            <label for="quantiteIceTea">Combien de litres d'Ice Tea' ?</label>
            <input type="number" id="quantiteIceTea" name="quantiteIceTea" min="1" max="6" step="0.5" value="1">
        </div>

        <div class="form-group" id="quantiteJusFruits" style="display:none">
            <label for="quantiteJusFruits">Combien de litres de jus de fruits ?</label>
            <input type="number" id="quantiteJusFruits" name="quantiteJusFruits" min="1" max="6" step="0.5" value="1">
        </div>

        <!-- ALCOOL -->
        <div class="form-group" id="typeBoissonsAlcool" style="display:none">
            <label for="typeBoissonsAlcool">Boissons avec alcool :</label>
            <div class="input-group mb-3" name="typeBoissonsAlcool">
                <div class="form-check-inline">
                    <label class="form-check-label" for="bieres">
                        <input type="checkbox" class="form-check-input" id="bieres" name="bieres" value="Bières">Bières
                    </label>
                </div>
                <div class="form-check-inline">
                    <label class="form-check-label" for="champagne">
                        <input type="checkbox" class="form-check-input" id="champagne" name="champagne" value="Champagne">Champagne
                    </label>
                </div>
                <div class="form-check-inline">
                    <label class="form-check-label" for="crement">
                        <input type="checkbox" class="form-check-input" id="crement" name="crement" value="Crément">Crément
                    </label>
                </div>
                <div class="form-check-inline">
                    <label class="form-check-label" for="rhumArrange">
                        <input type="checkbox" class="form-check-input" id="rhumArrange" name="rhumArrange" value="Rhum arrangé">Rhum arrangé
                    </label>
                </div>
                <div class="form-check-inline">
                    <label class="form-check-label" for="rhum">
                        <input type="checkbox" class="form-check-input" id="rhum" name="rhum" value="Rhum">Rhum
                    </label>
                </div>
                <div class="form-check-inline">
                    <label class="form-check-label" for="vodka">
                        <input type="checkbox" class="form-check-input" id="vodka" name="vodka" value="Vodka">Vodka
                    </label>
                </div>
                <div class="form-check-inline">
                    <label class="form-check-label" for="whisky">
                        <input type="checkbox" class="form-check-input" id="whisky" name="whisky" value="Whisky">Whisky
                    </label>
                </div>
            </div>
        </div>

        <div class="form-group" id="quantiteBieres" style="display:none">
            <label for="quantiteBieres">Combien de bières ?</label>
            <input type="number" id="quantiteBieres" name="quantiteBieres" min="4" max="24" value="4">
        </div>

        <div class="form-group" id="quantiteChampagne" style="display:none">
            <label for="quantiteChampagne">Combien de bouteilles de Champagne ?</label>
            <select class="form-control" name="quantiteChampagne">
                <option value="1">1</option>
                <option value="2">2</option>
                <option value="3">3</option>
                <option value="4">4</option>
                <option value="5">5</option>
            </select>
        </div>

        <div class="form-group" id="quantiteCrement" style="display:none">
            <label for="quantiteCrement">Combien de bouteilles de Crément ?</label>
            <select class="form-control" name="quantiteCrement">
                <option value="1">1</option>
                <option value="2">2</option>
                <option value="3">3</option>
                <option value="4">4</option>
                <option value="5">5</option>
            </select>
        </div>

        <div class="form-group" id="quantiteRhumArrange" style="display:none">
            <label for="quantiteRhumArrange">Combien de bouteilles de Rhum arrangé ?</label>
            <select class="form-control" name="quantiteRhumArrange">
                <option value="1">1</option>
                <option value="2">2</option>
                <option value="3">3</option>
            </select>
        </div>

        <div class="form-group" id="quantiteRhum" style="display:none">
            <label for="quantiteRhum">Combien de bouteilles de Rhum ?</label>
            <select class="form-control" name="quantiteRhum">
                <option value="1">1</option>
                <option value="2">2</option>
                <option value="3">3</option>
            </select>
        </div>

        <div class="form-group" id="quantiteVodka" style="display:none">
            <label for="quantiteVodka">Combien de bouteilles de Vodka ?</label>
            <select class="form-control" name="quantiteVodka">
                <option value="1">1</option>
                <option value="2">2</option>
            </select>
        </div>

        <div class="form-group" id="quantiteWhisky" style="display:none">
            <label for="quantiteWhisky">Combien de bouteilles de Whisky ?</label>
            <select class="form-control" name="quantiteWhisky">
                <option value="1">1</option>
                <option value="2">2</option>
            </select>
        </div>

        <div class="form-group" id="hrBoissons" style="display:none">
            <hr style="height:2px; border:none; color:#000; background-color:#000; width:60%; text-align:center; margin: 0 auto;">
        </div>

        <!-- -------------------------------------------------------------- -->
        <input type="hidden" name="id" value="<?php echo $id ?>" />
        <input type="submit" name="submit" class="btn btn-primary btn-lg" value="Envoyer" />
    </form>


    <script type="text/javascript">
        // ---------------------------- Apéritif ---------------------------- //
        aperitif.onchange = function() {
            if (aperitif.checked) {
                document.getElementById("typeAperitif").style.display = "block";
                document.getElementById("hrAperitif").style.display = "block";
            } else {
                document.getElementById("typeAperitif").style.display = "none";
                document.getElementById("hrAperitif").style.display = "none";
            }
        }

        cake.onchange = function() {
            if (cake.checked) {
                document.getElementById("quantiteCake").style.display = "block";
            } else {
                document.getElementById("quantiteCake").style.display = "none";
            }
        }

        gateauxAperitifs.onchange = function() {
            if (gateauxAperitifs.checked) {
                document.getElementById("quantiteGatAperitifs").style.display = "block";
            } else {
                document.getElementById("quantiteGatAperitifs").style.display = "none";
            }
        }

        pringles.onchange = function() {
            if (pringles.checked) {
                document.getElementById("quantitePringles").style.display = "block";
            } else {
                document.getElementById("quantitePringles").style.display = "none";
            }
        }

        chips.onchange = function() {
            if (chips.checked) {
                document.getElementById("quantiteChips").style.display = "block";
            } else {
                document.getElementById("quantiteChips").style.display = "none";
            }
        }

        // ---------------------------- Pizzas ---------------------------- //
        pizzas.onchange = function() {
            if (pizzas.checked) {
                document.getElementById("typePizza").style.display = "block";
                document.getElementById("hrPizzas").style.display = "block";
            } else {
                document.getElementById("typePizza").style.display = "none";
                document.getElementById("hrPizzas").style.display = "none";
            }
        }

        pizzaVegetarienne.onchange = function() {
            if (pizzaVegetarienne.checked) {
                document.getElementById("quantitePizzaVegetarienne").style.display = "block";
            } else {
                document.getElementById("quantitePizzaVegetarienne").style.display = "none";
            }
        }

        pizzaClassique.onchange = function() {
            if (pizzaClassique.checked) {
                document.getElementById("quantitePizzaClassique").style.display = "block";
            } else {
                document.getElementById("quantitePizzaClassique").style.display = "none";
            }
        }

        // ---------------------------- Dessert ---------------------------- //
        dessert.onchange = function() {
            if (dessert.checked) {
                document.getElementById("typeDessert").style.display = "block";
                document.getElementById("hrDessert").style.display = "block";
            } else {
                document.getElementById("typeDessert").style.display = "none";
                document.getElementById("hrDessert").style.display = "none";
            }
        }

        gateauChocolat.onchange = function() {
            if (gateauChocolat.checked) {
                document.getElementById("quantiteGateauChocolats").style.display = "block";
            } else {
                document.getElementById("quantiteGateauChocolats").style.display = "none";
            }

        }

        roseSables.onchange = function() {
            if (roseSables.checked) {
                document.getElementById("quantiteRoseDesSables").style.display = "block";
            } else {
                document.getElementById("quantiteRoseDesSables").style.display = "none";
            }

        }

        tiramisu.onchange = function() {
            if (tiramisu.checked) {
                document.getElementById("quantiteTiramisus").style.display = "block";
            } else {
                document.getElementById("quantiteTiramisus").style.display = "none";
            }

        }

        tarte.onchange = function() {
            if (tarte.checked) {
                document.getElementById("quantiteTartes").style.display = "block";
            } else {
                document.getElementById("quantiteTartes").style.display = "none";
            }

        }

        // ---------------------------- Petit déjeuner ---------------------------- //
        petitdej.onchange = function() {
            if (petitdej.checked) {
                document.getElementById("typePetitDejeuner").style.display = "block";
                document.getElementById("hrPetitDejeuner").style.display = "block";
            } else {
                document.getElementById("typePetitDejeuner").style.display = "none";
                document.getElementById("hrPetitDejeuner").style.display = "none";
            }
        }

        brioche.onchange = function() {
            if (brioche.checked) {
                document.getElementById("quantiteBrioches").style.display = "block";
            } else {
                document.getElementById("quantiteBrioches").style.display = "none";
            }

        }

        briocheChocolat.onchange = function() {
            if (briocheChocolat.checked) {
                document.getElementById("quantiteBriocheChocolats").style.display = "block";
            } else {
                document.getElementById("quantiteBriocheChocolats").style.display = "none";
            }

        }

        crepes.onchange = function() {
            if (crepes.checked) {
                document.getElementById("quantiteCrepes").style.display = "block";
            } else {
                document.getElementById("quantiteCrepes").style.display = "none";
            }

        }

        jusOrange.onchange = function() {
            if (jusOrange.checked) {
                document.getElementById("quantiteJusOranges").style.display = "block";
            } else {
                document.getElementById("quantiteJusOranges").style.display = "none";
            }

        }

        // ---------------------------- Bonbons ---------------------------- //
        bonbons.onchange = function() {
            if (bonbons.checked) {
                document.getElementById("quantiteBonbons").style.display = "block";
                document.getElementById("hrBonbons").style.display = "block";
            } else {
                document.getElementById("quantiteBonbons").style.display = "none";
                document.getElementById("hrBonbons").style.display = "none";
            }
        }

        // ---------------------------- Boissons ---------------------------- //
        boissons.onchange = function() {
            if (boissons.checked) {
                document.getElementById("typeBoissons").style.display = "block";
                document.getElementById("hrBoissons").style.display = "block";
            } else {
                document.getElementById("typeBoissons").style.display = "none";
                document.getElementById("hrBoissons").style.display = "none";
            }
        }

        soft.onchange = function() {
            if (soft.checked) {
                document.getElementById("typeBoissonsSoft").style.display = "block";
            } else {
                document.getElementById("typeBoissonsSoft").style.display = "none";
            }
        }

        coca.onchange = function() {
            if (coca.checked) {
                document.getElementById("quantiteCoca").style.display = "block";
            } else {
                document.getElementById("quantiteCoca").style.display = "none";
            }
        }

        orangina.onchange = function() {
            if (orangina.checked) {
                document.getElementById("quantiteOrangina").style.display = "block";
            } else {
                document.getElementById("quantiteOrangina").style.display = "none";
            }
        }

        fanta.onchange = function() {
            if (fanta.checked) {
                document.getElementById("quantiteFanta").style.display = "block";
            } else {
                document.getElementById("quantiteFanta").style.display = "none";
            }
        }

        schweppes.onchange = function() {
            if (schweppes.checked) {
                document.getElementById("quantiteSchweppes").style.display = "block";
            } else {
                document.getElementById("quantiteSchweppes").style.display = "none";
            }
        }

        schweppesAgrum.onchange = function() {
            if (schweppesAgrum.checked) {
                document.getElementById("quantiteSchweppesAgrum").style.display = "block";
            } else {
                document.getElementById("quantiteSchweppesAgrum").style.display = "none";
            }
        }

        oasis.onchange = function() {
            if (oasis.checked) {
                document.getElementById("quantiteOasis").style.display = "block";
            } else {
                document.getElementById("quantiteOasis").style.display = "none";
            }
        }

        iceTea.onchange = function() {
            if (iceTea.checked) {
                document.getElementById("quantiteIceTea").style.display = "block";
            } else {
                document.getElementById("quantiteIceTea").style.display = "none";
            }
        }

        jdf.onchange = function() {
            if (jdf.checked) {
                document.getElementById("quantiteJusFruits").style.display = "block";
            } else {
                document.getElementById("quantiteJusFruits").style.display = "none";
            }
        }

        alcool.onchange = function() {
            if (alcool.checked) {
                document.getElementById("typeBoissonsAlcool").style.display = "block";
            } else {
                document.getElementById("typeBoissonsAlcool").style.display = "none";
            }
        }

        bieres.onchange = function() {
            if (bieres.checked) {
                document.getElementById("quantiteBieres").style.display = "block";
            } else {
                document.getElementById("quantiteBieres").style.display = "none";
            }
        }

        champagne.onchange = function() {
            if (champagne.checked) {
                document.getElementById("quantiteChampagne").style.display = "block";
            } else {
                document.getElementById("quantiteChampagne").style.display = "none";
            }
        }

        crement.onchange = function() {
            if (crement.checked) {
                document.getElementById("quantiteCrement").style.display = "block";
            } else {
                document.getElementById("quantiteCrement").style.display = "none";
            }
        }

        rhumArrange.onchange = function() {
            if (rhumArrange.checked) {
                document.getElementById("quantiteRhumArrange").style.display = "block";
            } else {
                document.getElementById("quantiteRhumArrange").style.display = "none";
            }
        }

        rhum.onchange = function() {
            if (rhum.checked) {
                document.getElementById("quantiteRhum").style.display = "block";
            } else {
                document.getElementById("quantiteRhum").style.display = "none";
            }
        }

        vodka.onchange = function() {
            if (vodka.checked) {
                document.getElementById("quantiteVodka").style.display = "block";
            } else {
                document.getElementById("quantiteVodka").style.display = "none";
            }
        }

        whisky.onchange = function() {
            if (whisky.checked) {
                document.getElementById("quantiteWhisky").style.display = "block";
            } else {
                document.getElementById("quantiteWhisky").style.display = "none";
            }
        }
    </script>
</div>

<?php
}
include "../template/footer.php";
?>
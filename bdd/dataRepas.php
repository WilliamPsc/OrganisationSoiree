<?php
function findQuantity($delimiter, $str)
{
    $quantity = 0;
    $tabPlat = explode(", ", $str);

    foreach ($tabPlat as $item) {
        if (strpos($item, $delimiter) !== false) {
            preg_match_all('/\d+\.*\d*/', $item, $aff);
            $quantity += floatval($aff[0][0]);
        }
    }
    return $quantity;
}

function buildString($quantity, $menuSingu, $menuPluriel){
    $str = "";
    if($quantity == 0) return "";
    if($quantity == 1){
        $str = "<li>" . $quantity . " " . $menuSingu . "</li>";
    }else{
        $str = "<li>" . $quantity . " " . $menuPluriel . "</li>";
    }

    return $str;
}

$ameneMenuSQL = $mysqli->query("SELECT `sre_amene` FROM `t_soiree_sre` WHERE (`sre_amene`!= \"\" OR `sre_amene` != NULL) AND `sre_confirmation`=1;");
$str = "";
while ($row = $ameneMenuSQL->fetch_array()) {
    $str .= $row['sre_amene'] . " ";
}
$repas = explode("; ", $str);

$aperitifStr = "";
$pizzasStr = "";
$dessertStr = "";
$boissonsStr = "";
$petitDejStr = "";
$bonbonsStr = "";

foreach ($repas as $ssmenu) {
    if (strpos($ssmenu, 'Apéritif (') !== false) {
        $aperitifStr .= substr($ssmenu, 11, strlen($ssmenu) - 12) . ", ";
    }

    if (strpos($ssmenu, 'Pizzas (') !== false) {
        $pizzasStr .= substr($ssmenu, 8, strlen($ssmenu) - 9) . ", ";
    }

    if (strpos($ssmenu, 'Dessert (') !== false) {
        $dessertStr .= substr($ssmenu, 9, strlen($ssmenu) - 10) . ", ";
    }

    if (strpos($ssmenu, 'Boissons (') !== false) {
        $boissonsStr .= substr($ssmenu, 10, strlen($ssmenu) - 11) . ", ";
    }

    if (strpos($ssmenu, 'PetitDejeuner (') !== false) {
        $petitDejStr .= substr($ssmenu, 15, strlen($ssmenu) - 16) . ", ";
    }

    if (strpos($ssmenu, 'Bonbons (') !== false) {
        $bonbonsStr .= substr($ssmenu, 0) . ", ";
    }
}

// ======= APERITIF ======= //
$aperitifCakeQte = findQuantity("Cake (", $aperitifStr);
$aperitifGatAperoQte = findQuantity("Gâteaux apéritifs (", $aperitifStr);
$aperitifPringlesQte = findQuantity("Pringles (", $aperitifStr);
$aperitifChipsQte = findQuantity("Chips (", $aperitifStr);

$aperitifMenu = buildString($aperitifCakeQte, "cake", "cakes");
$aperitifMenu .= buildString($aperitifGatAperoQte, "paquet de gâteaux apéritifs", "paquets de gâteaux apéritifs");
$aperitifMenu .= buildString($aperitifPringlesQte, "paquet de pringles", "paquets de pringles");
$aperitifMenu .= buildString($aperitifChipsQte, "paquet de chips", "paquets de chips");

// ======= PIZZAS ======= //
$pizzaClassiqueQte = findQuantity("Classique (", $pizzasStr);
$pizzaVegetarienneQte = findQuantity("Végétarienne (", $pizzasStr);

$pizzasMenu = buildString($pizzaClassiqueQte, "classique", "classiques");
$pizzasMenu .= buildString($pizzaVegetarienneQte, "végétarienne", "végétariennes");

// ======= DESSERT ======= //
$dessertGatChocoQte = findQuantity("Gateau chocolat (", $dessertStr);
$dessertRosesSablesQte = findQuantity("Rose des sables (", $dessertStr);
$dessertTiramisuQte = findQuantity("Tiramisu (", $dessertStr);
$dessertTarteQte = findQuantity("Tarte (", $dessertStr);

$dessertMenu = buildString($dessertGatChocoQte, "part de gâteau au chocolat", "parts de gâteau au chocolat");
$dessertMenu .= buildString($dessertRosesSablesQte, "part de roses des sables", "parts de roses des sables");
$dessertMenu .= buildString($dessertTiramisuQte, "part de tiramisu", "parts de tiramisu");
$dessertMenu .= buildString($dessertTarteQte, "part de tarte", "parts de tarte");


// ======= PETIT DEJEUNER ======= //
$petitDejBriocheQte = findQuantity("Brioche (", $petitDejStr);
$petitDejBriocheChocoQte = findQuantity("Brioche au chocolat (", $petitDejStr);
$petitDejCrepesQte = findQuantity("Crêpes (", $petitDejStr);
$petitDejJusOrangeQte = findQuantity("Jus d'orange (", $petitDejStr);

$petitDejMenu = buildString($petitDejBriocheQte, "brioche", "brioches");
$petitDejMenu .= buildString($petitDejBriocheChocoQte, "brioche au chocolat", "brioches au chocolat");
$petitDejMenu .= buildString($petitDejCrepesQte*12, "crêpe", "crêpes");
$petitDejMenu .= buildString($petitDejJusOrangeQte, "litre de jus d'oranges", "litres de jus d'oranges");


// ======= BOISSONS ======= //
// SOFT
$softCocaQte = findQuantity("Coca (", $boissonsStr);
$softOranginaQte = findQuantity("Orangina (", $boissonsStr);
$softFantaQte = findQuantity("Fanta (", $boissonsStr);
$softSchweppesQte = findQuantity("Schweppes (", $boissonsStr);
$softSchweppesAgrumQte = findQuantity("Schweppes agrumes (", $boissonsStr);
$softOasisQte = findQuantity("Oasis (", $boissonsStr);
$softIceTeaQte = findQuantity("Ice Tea (", $boissonsStr);
$softJDFQte = findQuantity("Jus de fruits (", $boissonsStr);

$softMenu = buildString($softCocaQte, "litre de Coca", "litres de Coca");
$softMenu .= buildString($softOranginaQte, "litre d'Orangina", "litres d'Orangina");
$softMenu .= buildString($softFantaQte, "litre de Fanta", "litres de Fanta");
$softMenu .= buildString($softSchweppesQte, "litre de Schweppes", "litres de Schweppes");
$softMenu .= buildString($softSchweppesAgrumQte, "litre de Schweppes agrumes", "litres de Schweppes agrumes");
$softMenu .= buildString($softOasisQte, "litre d'Oasis", "litres d'Oasis");
$softMenu .= buildString($softIceTeaQte, "litre d'Ice Tea", "litres d'Ice Tea");
$softMenu .= buildString($softJDFQte, "litre de jus de fruits", "litres de jus de fruits");


// ALCOOL
$alcoolBieresQte = findQuantity("Bières (", $boissonsStr);
$alcoolChampagneQte = findQuantity("Champagne (", $boissonsStr);
$alcoolCrementQte = findQuantity("Crément (", $boissonsStr);
$alcoolRhumArrangeQte = findQuantity("Rhum arrangé (", $boissonsStr);
$alcoolRhumQte = findQuantity("Rhum (", $boissonsStr);
$alcoolVodkaQte = findQuantity("Vodka (", $boissonsStr);
$alcoolWhiskyQte = findQuantity("Whisky (", $boissonsStr);

$alcoolMenu = buildString($alcoolBieresQte, "bière", "bières");
$alcoolMenu .= buildString($alcoolChampagneQte, "bouteille de Champagne", "");
$alcoolMenu .= buildString($alcoolCrementQte, "bouteille de Crément", "bouteilles de Crément");
$alcoolMenu .= buildString($alcoolRhumArrangeQte, "bouteille de Rhum Arrangé", "bouteilles de Rhum Arrangé");
$alcoolMenu .= buildString($alcoolRhumQte, "bouteille de Rhum", "bouteilles de Rhum");
$alcoolMenu .= buildString($alcoolVodkaQte, "bouteille de Vodka", "bouteilles de Vodka");
$alcoolMenu .= buildString($alcoolWhiskyQte, "bouteille de Whisky", "bouteilles de Whisky");


// ======= BONBONS ======= //
$bonbonsQte = findQuantity("Bonbons (", $bonbonsStr);
$bonbonsMenu = buildString($bonbonsQte, "paquet", "paquets");

// ======================= //

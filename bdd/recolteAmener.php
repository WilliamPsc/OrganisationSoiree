<?php
session_start();
include "connect.php";
if (isset($_SESSION['pseudo'])) {
    $strInsert = "";
    $id = mysqli_real_escape_string($mysqli, htmlspecialchars($_POST['id']));

    // Apéritif
    if ($_POST['aperitif'] == "on") {
        $aperitif = "Apéritif (";

        if (isset($_POST['cake'])) {
            $tmp = htmlspecialchars($_POST['cake']);
            $aperitif .= $tmp . " (";

            if (isset($_POST['quantiteCake'])) {
                $tmp = htmlspecialchars($_POST['quantiteCake']);
                if ($_POST['quantiteCake'] == "1") {
                    $aperitif .= $tmp . " unité)";
                } else {
                    $aperitif .= $tmp . " unités)";
                }
            }
            if (isset($_POST['gateauxAperitifs']) || isset($_POST['pringles']) || isset($_POST['chips'])) $aperitif .= ", ";
        }


        if (isset($_POST['gateauxAperitifs'])) {
            $tmp = htmlspecialchars($_POST['gateauxAperitifs']);
            $aperitif .= $tmp . " (";

            if (isset($_POST['quantiteGatAperitifs'])) {
                $tmp = htmlspecialchars($_POST['quantiteGatAperitifs']);
                if ($_POST['quantiteGatAperitifs'] == "1") {
                    $aperitif .= $tmp . " paquet)";
                } else {
                    $aperitif .= $tmp . " paquets)";
                }
            }
            if (isset($_POST['pringles']) || isset($_POST['chips'])) $aperitif .= ", ";
        }

        if (isset($_POST['chips'])) {
            $tmp = htmlspecialchars($_POST['chips']);
            $aperitif .= $tmp . " (";

            if (isset($_POST['quantiteChips'])) {
                $tmp = htmlspecialchars($_POST['quantiteChips']);
                if ($_POST['quantiteChips'] == "1") {
                    $aperitif .= $tmp . " paquet)";
                } else {
                    $aperitif .= $tmp . " paquets)";
                }
            }
            if (isset($_POST['pringles'])) $aperitif .= ", ";
        }

        if (isset($_POST['pringles'])) {
            $tmp = htmlspecialchars($_POST['pringles']);
            $aperitif .= $tmp . " (";

            if (isset($_POST['quantitePringles'])) {
                $tmp = htmlspecialchars($_POST['quantitePringles']);
                if ($_POST['quantitePringles'] == "1") {
                    $aperitif .= $tmp . " paquet)";
                } else {
                    $aperitif .= $tmp . " paquets)";
                }
            }
        }

        $aperitif .= "); ";

        // echo "Apéritif : " . $aperitif . "<br/>";
        $strInsert .= $aperitif;
    }

    // Pizzas
    if ($_POST['pizzas'] == "on") {
        $pizzas = "Pizzas (";

        if (isset($_POST['pizzaVegetarienne'])) {
            $tmp = htmlspecialchars($_POST['pizzaVegetarienne']);
            $pizzas .= $tmp . " (";

            if (isset($_POST['quantiteVege'])) {
                $tmp = htmlspecialchars($_POST['quantiteVege']);
                if ($_POST['quantiteVege'] == "1") {
                    $pizzas .= $tmp . " pizza)";
                } else {
                    $pizzas .= $tmp . " pizzas)";
                }
            }

            if (isset($_POST['pizzaClassique'])) $pizzas .= ", ";
        }


        if (isset($_POST['pizzaClassique'])) {
            $tmp = htmlspecialchars($_POST['pizzaClassique']);
            $pizzas .= $tmp . " (";

            if (isset($_POST['quantiteClassique'])) {
                $tmp = htmlspecialchars($_POST['quantiteClassique']);
                if ($_POST['quantiteClassique'] == "1") {
                    $pizzas .= $tmp . " pizza)";
                } else {
                    $pizzas .= $tmp . " pizzas)";
                }
            }
        }

        $pizzas .= "); ";
        // echo "Pizzas : " . $pizzas . "<br/>";
        $strInsert .= $pizzas;
    }

    // Dessert
    if ($_POST['dessert'] == "on") {
        $dessert = "Dessert (";

        if (isset($_POST['gateauChocolat'])) {
            $tmp = htmlspecialchars($_POST['gateauChocolat']);
            $dessert .= $tmp . " (";

            if (isset($_POST['quantiteGateauChocolat'])) {
                $tmp = htmlspecialchars($_POST['quantiteGateauChocolat']);
                $dessert .= $tmp . " parts)";
            }

            if (isset($_POST['roseSables']) || isset($_POST['tiramisu']) || isset($_POST['tarte'])) $dessert .= ", ";
        }

        if (isset($_POST['roseSables'])) {
            $tmp = htmlspecialchars($_POST['roseSables']);
            $dessert .= $tmp . " (";

            if (isset($_POST['quantiteRoseSables'])) {
                $tmp = htmlspecialchars($_POST['quantiteRoseSables']);
                $dessert .= $tmp . " parts)";
            }

            if (isset($_POST['tiramisu']) || isset($_POST['tarte'])) $dessert .= ", ";
        }

        if (isset($_POST['tiramisu'])) {
            $tmp = htmlspecialchars($_POST['tiramisu']);
            $dessert .= $tmp . " (";

            if (isset($_POST['quantiteTiramisu'])) {
                $tmp = htmlspecialchars($_POST['quantiteTiramisu']);
                $dessert .= $tmp . " parts)";
            }

            if (isset($_POST['tarte'])) $dessert .= ", ";
        }

        if (isset($_POST['tarte'])) {
            $tmp = htmlspecialchars($_POST['tarte']);
            $dessert .= $tmp . " (";

            if (isset($_POST['quantiteTarte'])) {
                $tmp = htmlspecialchars($_POST['quantiteTarte']);
                $dessert .= $tmp . " parts)";
            }
        }

        $dessert .= "); ";
        // echo "Dessert : " . $dessert . "<br/>";
        $strInsert .= $dessert;
    }

    // Petit déjeuner
    if ($_POST['petitdej'] == "on") {
        $petitdej = "PetitDejeuner (";

        if (isset($_POST['brioche'])) {
            $tmp = htmlspecialchars($_POST['brioche']);
            $petitdej .= $tmp . " (";

            if (isset($_POST['quantiteBrioche'])) {
                $tmp = htmlspecialchars($_POST['quantiteBrioche']);
                if ($_POST['quantiteBrioche'] == "1") {
                    $petitdej .= $tmp . " paquet)";
                } else {
                    $petitdej .= $tmp . " paquets)";
                }
            }

            if (isset($_POST['briocheChocolat']) || isset($_POST['crepes']) || isset($_POST['jusOrange'])) $petitdej .= ", ";
        }

        if (isset($_POST['briocheChocolat'])) {
            $tmp = htmlspecialchars($_POST['briocheChocolat']);
            $petitdej .= $tmp . " (";

            if (isset($_POST['quantiteBriocheChocolat'])) {
                $tmp = htmlspecialchars($_POST['quantiteBriocheChocolat']);
                if ($_POST['quantiteBriocheChocolat'] == "1") {
                    $petitdej .= $tmp . " paquet)";
                } else {
                    $petitdej .= $tmp . " paquets)";
                }
            }

            if (isset($_POST['crepes']) || isset($_POST['jusOrange'])) $petitdej .= ", ";
        }

        if (isset($_POST['crepes'])) {
            $tmp = htmlspecialchars($_POST['crepes']);
            $petitdej .= $tmp . " (";

            if (isset($_POST['quantiteCrepe'])) {
                $tmp = htmlspecialchars($_POST['quantiteCrepe']);
                if ($_POST['quantiteCrepe'] == "1") {
                    $petitdej .= $tmp . " paquet)";
                } else {
                    $petitdej .= $tmp . " paquets)";
                }
            }

            if (isset($_POST['jusOrange'])) $petitdej .= ", ";
        }

        if (isset($_POST['jusOrange'])) {
            $tmp = htmlspecialchars($_POST['jusOrange']);
            $petitdej .= $tmp . " (";

            if (isset($_POST['quantiteJusOrange'])) {
                $tmp = htmlspecialchars($_POST['quantiteJusOrange']);
                if ($_POST['quantiteJusOrange'] == "1") {
                    $petitdej .= $tmp . " litre)";
                } else {
                    $petitdej .= $tmp . " litres)";
                }
            }
        }

        $petitdej .= "); ";
        // echo "Petit déjeuner : " . $petitdej . "<br/>";
        $strInsert .= $petitdej;
    }

    // Bonbons
    if ($_POST['bonbons'] == "on") {
        $bonbons = "Bonbons (";

        if (isset($_POST['quantiteBonbon'])) {
            $tmp = htmlspecialchars($_POST['quantiteBonbon']);
            if ($_POST['quantiteBonbon'] == "1") {
                $bonbons .= $tmp . " paquet); ";
            } else {
                $bonbons .= $tmp . " paquets); ";
            }
        }

        // echo "Bonbons : " . $bonbons . "<br/>";
        $strInsert .= $bonbons;
    }

    // Boissons
    if ($_POST['boissons'] == "on") {
        $boissons = "Boissons (";

        if ($_POST['soft'] == "Soft") {
            $boissons .= "Soft (";

            if (isset($_POST['coca'])) {
                $tmp = htmlspecialchars($_POST['coca']);
                $boissons .= $tmp . " (";

                if (isset($_POST['quantiteCoca'])) {
                    $tmp = htmlspecialchars($_POST['quantiteCoca']);
                    if ($_POST['quantiteCoca'] == "1") {
                        $boissons .= $tmp . " litre)";
                    } else {
                        $boissons .= $tmp . " litres)";
                    }
                }

                if (isset($_POST['orangina']) || isset($_POST['fanta']) || isset($_POST['schweppes']) || isset($_POST['schweppesAgrum']) || isset($_POST['oasis']) || isset($_POST['iceTea']) || isset($_POST['jdf'])) $boissons .= ", ";
            }

            if (isset($_POST['orangina'])) {
                $tmp = htmlspecialchars($_POST['orangina']);
                $boissons .= $tmp . " (";

                if (isset($_POST['quantiteOrangina'])) {
                    $tmp = htmlspecialchars($_POST['quantiteOrangina']);
                    if ($_POST['quantiteOrangina'] == "1") {
                        $boissons .= $tmp . " litre)";
                    } else {
                        $boissons .= $tmp . " litres)";
                    }
                }

                if (isset($_POST['fanta']) || isset($_POST['schweppes']) || isset($_POST['schweppesAgrum']) || isset($_POST['oasis']) || isset($_POST['iceTea']) || isset($_POST['jdf'])) $boissons .= ", ";
            }

            if (isset($_POST['fanta'])) {
                $tmp = htmlspecialchars($_POST['fanta']);
                $boissons .= $tmp . " (";

                if (isset($_POST['quantiteFanta'])) {
                    $tmp = htmlspecialchars($_POST['quantiteFanta']);
                    if ($_POST['quantiteFanta'] == "1") {
                        $boissons .= $tmp . " litre)";
                    } else {
                        $boissons .= $tmp . " litres)";
                    }
                }

                if (isset($_POST['schweppes']) || isset($_POST['schweppesAgrum']) || isset($_POST['oasis']) || isset($_POST['iceTea']) || isset($_POST['jdf'])) $boissons .= ", ";
            }

            if (isset($_POST['schweppes'])) {
                $tmp = htmlspecialchars($_POST['schweppes']);
                $boissons .= $tmp . " (";

                if (isset($_POST['quantiteSchweppes'])) {
                    $tmp = htmlspecialchars($_POST['quantiteSchweppes']);
                    if ($_POST['quantiteSchweppes'] == "1") {
                        $boissons .= $tmp . " litre)";
                    } else {
                        $boissons .= $tmp . " litres)";
                    }
                }

                if (isset($_POST['schweppesAgrum']) || isset($_POST['oasis']) || isset($_POST['iceTea']) || isset($_POST['jdf'])) $boissons .= ", ";
            }

            if (isset($_POST['schweppesAgrum'])) {
                $tmp = htmlspecialchars($_POST['schweppesAgrum']);
                $boissons .= $tmp . " (";

                if (isset($_POST['quantiteSchweppesAgrum'])) {
                    $tmp = htmlspecialchars($_POST['quantiteSchweppesAgrum']);
                    if ($_POST['quantiteSchweppesAgrum'] == "1") {
                        $boissons .= $tmp . " litre)";
                    } else {
                        $boissons .= $tmp . " litres)";
                    }
                }

                if (isset($_POST['oasis']) || isset($_POST['iceTea']) || isset($_POST['jdf'])) $boissons .= ", ";
            }

            if (isset($_POST['oasis'])) {
                $tmp = htmlspecialchars($_POST['oasis']);
                $boissons .= $tmp . " (";

                if (isset($_POST['quantiteOasis'])) {
                    $tmp = htmlspecialchars($_POST['quantiteOasis']);
                    if ($_POST['quantiteOasis'] == "1") {
                        $boissons .= $tmp . " litre)";
                    } else {
                        $boissons .= $tmp . " litres)";
                    }
                }

                if (isset($_POST['iceTea']) || isset($_POST['jdf'])) $boissons .= ", ";
            }

            if (isset($_POST['iceTea'])) {
                $tmp = htmlspecialchars($_POST['iceTea']);
                $boissons .= $tmp . " (";

                if (isset($_POST['quantiteIceTea'])) {
                    $tmp = htmlspecialchars($_POST['quantiteIceTea']);
                    if ($_POST['quantiteIceTea'] == "1") {
                        $boissons .= $tmp . " litre)";
                    } else {
                        $boissons .= $tmp . " litres)";
                    }
                }

                if (isset($_POST['jdf'])) $boissons .= ", ";
            }

            if (isset($_POST['jdf'])) {
                $tmp = htmlspecialchars($_POST['jdf']);
                $boissons .= $tmp . " (";

                if (isset($_POST['quantiteJusFruits'])) {
                    $tmp = htmlspecialchars($_POST['quantiteJusFruits']);
                    if ($_POST['quantiteJusFruits'] == "1") {
                        $boissons .= $tmp . " litre)";
                    } else {
                        $boissons .= $tmp . " litres)";
                    }
                }
            }

            $boissons .= ")";
            if (isset($_POST['alcool'])) $boissons .= ", ";
        }

        if ($_POST['alcool'] == "Alcool") {
            $boissons .= "Alcool (";

            if (isset($_POST['bieres'])) {
                $tmp = htmlspecialchars($_POST['bieres']);
                $boissons .= $tmp . " (";

                if (isset($_POST['quantiteBieres'])) {
                    $tmp = htmlspecialchars($_POST['quantiteBieres']);
                    $boissons .= $tmp . " bières)";
                }

                if (isset($_POST['champagne']) || isset($_POST['crement']) || isset($_POST['rhumArrange']) || isset($_POST['rhum']) || isset($_POST['vodka']) || isset($_POST['whisky'])) $boissons .= ", ";
            }

            if (isset($_POST['champagne'])) {
                $tmp = htmlspecialchars($_POST['champagne']);
                $boissons .= $tmp . " (";

                if (isset($_POST['quantiteChampagne'])) {
                    $tmp = htmlspecialchars($_POST['quantiteChampagne']);
                    if ($_POST['quantiteChampagne'] == "1") {
                        $boissons .= $tmp . " bouteille)";
                    } else {
                        $boissons .= $tmp . " bouteilles)";
                    }
                }

                if (isset($_POST['crement']) || isset($_POST['rhumArrange']) || isset($_POST['rhum']) || isset($_POST['vodka']) || isset($_POST['whisky'])) $boissons .= ", ";
            }

            if (isset($_POST['crement'])) {
                $tmp = htmlspecialchars($_POST['crement']);
                $boissons .= $tmp . " (";

                if (isset($_POST['quantiteCrement'])) {
                    $tmp = htmlspecialchars($_POST['quantiteCrement']);
                    if ($_POST['quantiteCrement'] == "1") {
                        $boissons .= $tmp . " bouteille)";
                    } else {
                        $boissons .= $tmp . " bouteilles)";
                    }
                }

                if (isset($_POST['rhumArrange']) || isset($_POST['rhum']) || isset($_POST['vodka']) || isset($_POST['whisky'])) $boissons .= ", ";
            }

            if (isset($_POST['rhumArrange'])) {
                $tmp = htmlspecialchars($_POST['rhumArrange']);
                $boissons .= $tmp . " (";

                if (isset($_POST['quantiteRhumArrange'])) {
                    $tmp = htmlspecialchars($_POST['quantiteRhumArrange']);
                    if ($_POST['quantiteRhumArrange'] == "1") {
                        $boissons .= $tmp . " bouteille)";
                    } else {
                        $boissons .= $tmp . " bouteilles)";
                    }
                }

                if (isset($_POST['rhum']) || isset($_POST['vodka']) || isset($_POST['whisky'])) $boissons .= ", ";
            }

            if (isset($_POST['rhum'])) {
                $tmp = htmlspecialchars($_POST['rhum']);
                $boissons .= $tmp . " (";

                if (isset($_POST['quantiteRhum'])) {
                    $tmp = htmlspecialchars($_POST['quantiteRhum']);
                    if ($_POST['quantiteRhum'] == "1") {
                        $boissons .= $tmp . " bouteille)";
                    } else {
                        $boissons .= $tmp . " bouteilles)";
                    }
                }

                if (isset($_POST['vodka']) || isset($_POST['whisky'])) $boissons .= ", ";
            }

            if (isset($_POST['vodka'])) {
                $tmp = htmlspecialchars($_POST['vodka']);
                $boissons .= $tmp . " (";

                if (isset($_POST['quantiteVodka'])) {
                    $tmp = htmlspecialchars($_POST['quantiteVodka']);
                    if ($_POST['quantiteVodka'] == "1") {
                        $boissons .= $tmp . " bouteille)";
                    } else {
                        $boissons .= $tmp . " bouteilles)";
                    }
                }

                if (isset($_POST['whisky'])) $boissons .= ", ";
            }

            if (isset($_POST['whisky'])) {
                $tmp = htmlspecialchars($_POST['whisky']);
                $boissons .= $tmp . " (";

                if (isset($_POST['quantiteWhisky'])) {
                    $tmp = htmlspecialchars($_POST['quantiteWhisky']);
                    if ($_POST['quantiteWhisky'] == "1") {
                        $boissons .= $tmp . " bouteille)";
                    } else {
                        $boissons .= $tmp . " bouteilles)";
                    }
                }
            }

            $boissons .= ")";
        }

        $boissons .= ");";
        // echo "Boissons : " . $boissons . "<br/>";
        $strInsert .= $boissons;
    }

    // echo "<br/>String finale : " . $strInsert;

    $requete = "UPDATE `t_soiree_sre` SET 
        `sre_amene`='" . $strInsert . "' WHERE `sre_id`='" . $id . "'";
    $exec_requete = mysqli_query($mysqli, $requete);

    if ($exec_requete) {
        header('Location: ../invite/index.php');
    } else {
        header('Location: ../invite/emmene.php'); // utilisateur ou mot de passe incorrect
    }
} else {
    header('Location: ../index.php'); // utilisateur ou mot de passe incorrect
}

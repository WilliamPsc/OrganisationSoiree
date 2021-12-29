<nav class="navbar navbar-expand-sm bg-dark navbar-dark sticky-top">
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#collapsibleNavbar">
        <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="collapsibleNavbar">
        <ul class="navbar-nav">
            <li class="nav-item">
                <a class="navbar-brand" href="<?php echo $GLOBALS['baseURL'] . "invite/index.php" ?>" style="color:red">Accueil</a>
            </li>
            <li class="nav-item">
                <a class="navbar-brand" href="<?php echo $GLOBALS['baseURL'] . "repas.php" ?>">Menu</a>
            </li>
            <li class="nav-item dropdown">
                <a class="nav-link dropdown-toggle" href="" id="dropdown09" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Déconnexion</a>
                <div class="dropdown-menu" aria-labelledby="dropdown09">
                    <a class="dropdown-item" href="<?php echo $GLOBALS['baseURL'] . "bdd/deconnexion.php" ?>">Déconnexion</a>
                </div>
            </li>
        </ul>
    </div>
    <span style="color:white;">
        <?php
        if ($_SESSION['pseudo'] !== "") {
            $user = $_SESSION['pseudo'];
            echo "Bonjour $user";
        }
        ?>
    </span>
</nav>
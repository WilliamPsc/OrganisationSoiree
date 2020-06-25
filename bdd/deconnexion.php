<?php
    session_start();
  
    if(isset($_SESSION['pseudo'])){

        session_destroy();
          
        header('Location: ../index.php');
  
    }else{ // Dans le cas contraire on t'empêche d'accéder à cette page en te redirigeant vers la page que tu veux.
  
        header('Location: ../bdd/connexion.php');
  
    }
?>
<?php
session_start();
$mysqli = mysqli_connect('pensecfrhzwilly.mysql.db', 'pensecfrhzwilly', 'Adresses963', 'pensecfrhzwilly') or die('could not connect to database');
$id = $_POST['id'];
$requete = "DELETE FROM t_soiree_sre WHERE sre_id = '" . $id . "'";
$exec_requete = mysqli_query($mysqli, $requete);
if ($exec_requete) {
    header('Location: ../admin/index.php');
}
?>
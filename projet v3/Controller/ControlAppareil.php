<?php
error_reporting(E_ALL);
        ini_set('display_errors', '1');
include("../model/Appareil.php");

if (isset($_GET['idSup'])) {
    
    $id = $_GET['idSup'];
    if (Appareil::delete($id)) {
        header('Location: ../vue/allApp.php');
    } else {
        echo "<script>alert('Erreur lors de la suppression de l\'appareil.');</script>";
        header('Location: ../vue/allApp.php');
    }
}
if (isset($_POST['update_appareil'])) {
    $id = $_POST['id'];
    $type = $_POST['type'];
    $marque = $_POST['marque'];
    $modele = $_POST['modele'];
    $num_serie = $_POST['num_serie'];
    $id_client = $_POST['id_client'];

    if (Appareil::update($id, $type, $marque, $modele, $num_serie, $id_client)) {
        header('Location: ../vue/allApp.php');
    } else {
        echo "<script>alert('Erreur lors de la suppression de l\'appareil.');</script>";
        header('Location: ../vue/allApp.php');
    }
}
if (isset($_POST['add_appareil'])) {
    $type = $_POST['type'];
    $marque = $_POST['marque'];
    $modele = $_POST['modele'];
    $num_serie = $_POST['num_serie'];
    $id_client = $_POST['id_client'];

    if (Appareil::add($type, $marque, $modele, $num_serie, $id_client)) {
        header('Location: ../vue/allApp.php');
    } else {
        echo "<script>alert('Erreur lors de l\'ajout de l\'appareil.');</script>";
        header('Location: ../vue/allApp.php');
    }
}
?>
<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);

include("../Connexion.php");
include("../model/Reparation.php");

if (isset($_GET['idModifier'])) {
    if (Reparation::StartRepair( $_GET['idModifier'])) {
        
        header('Location: ../vue/techRep.php');
        
    } else {
        echo "<script>alert('Erreur lors de la mise à jour de la réparation.');</script>";
        header('Location: ../vue/techRep.php');
        }
}

if (isset($_GET['idAnnuler'])) {
    if (Reparation::delete($_GET['idAnnuler'])) {
        header('Location: ../vue/allRep.php');

        
    } else {
        echo "<script>alert('Erreur lors de la suppression de la réparation.');</script>";
        header('Location: ../vue/allRep.php');

    }
}


if (isset($_POST['finaliser'])) {
    
    

    if (!empty($_POST['date_fin_reelle']) && !empty($_POST['panne']) && !empty($_POST['cout'])) {
        $id = $_POST['id'];  
        $reparation = Reparation::findbyid($id);
        $date_fin_reelle = $_POST['date_fin_reelle'];
        $panne = $_POST['panne'];
        $cout = $_POST['cout'];

        if (date('Y-m-d', strtotime($date_fin_reelle)) < date('Y-m-d', strtotime($reparation->date_depot))) {
            header('Location: ../vue/FinaliserReparation.php?erreur=4&idFinalizer='.$id);
        } else {
            if (Reparation::FinaliserReparation($id, $date_fin_reelle, $panne, $cout)) {
                header('Location: ../vue/techRep.php');  
            
            } else {
                echo "<script>alert('Erreur lors de la finalisation de la réparation.');</script>";
                header('Location: ../vue/techRep.php');  
            }
        }
    }
    
} 
if (isset($_POST['ajouter'])) {
    if (!empty($_POST['date_depot']) && !empty($_POST['date_fin_prevue']) && !empty($_POST['panne']) && !empty($_POST['cout'])) {
        $id = $_POST['id'];
        $date_depot = $_POST['date_depot'];
        $date_fin_prevue = $_POST['date_fin_prevue'];
        $panne = $_POST['panne'];
        $cout = $_POST['cout'];
        $id_appareil = $_POST['app'];
        $id_technicien = $_POST['tech'];
        $statut = $_POST['statut'];

        if (date('Y-m-d', strtotime($date_depot)) > date('Y-m-d')) {
            header('Location: ../vue/ajoutRep.php?erreur=2');
           
        }


        if (date('Y-m-d', strtotime($date_depot)) > date('Y-m-d', strtotime($date_fin_prevue))) {
            header('Location: ../vue/ajoutRep.php?erreur=3');
            
        }

        if (Reparation::AjouterReparation( $date_depot, $date_fin_prevue, $panne, $cout , $id_appareil, $id_technicien, $statut)) {
            echo "<script>alert('Succes lors de l\'ajout de la réparation.');</script>";
            header('Location: ../vue/allRep.php');

           
        } else {
            echo "<script>alert('Erreur lors de l\'ajout de la réparation.');</script>";
            header('Location: ../vue/allRep.php');

        }
    }
}
if (isset($_POST['ajouterfromTech'])) {
    if (!empty($_POST['date_depot']) && !empty($_POST['date_fin_prevue']) && !empty($_POST['panne']) && !empty($_POST['cout'])) {
        $id = $_POST['id'];
        $date_depot = $_POST['date_depot'];
        $date_fin_prevue = $_POST['date_fin_prevue'];
        $panne = $_POST['panne'];
        $cout = $_POST['cout'];
        $id_appareil = $_POST['app'];
        $id_technicien = $_POST['tech'];
        $statut = $_POST['statut'];

        if (Reparation::AjouterReparation( $date_depot, $date_fin_prevue, $panne, $cout , $id_appareil, $id_technicien, $statut)) {
            echo "<script>alert('Succes lors de l\'ajout de la réparation.');</script>";
            header('Location: ../vue/techRep.php');

            
        } else {
            echo "<script>alert('Erreur lors de l\'ajout de la réparation.');</script>";
            header('Location: ../vue/techRep.php');

        }
    }
}

if (isset($_POST['update']))
{
    if (!empty($_POST['date_depot']) && !empty($_POST['date_fin_prevue'])  && !empty($_POST['panne']) && !empty($_POST['cout']) ) {
        $id = $_POST['id'];
        $date_depot = $_POST['date_depot'];
        $date_fin_prevue = $_POST['date_fin_prevue'];
        $panne = $_POST['panne'];
        $cout = $_POST['cout'];
        $id_appareil = $_POST['id_appareil'];
        $id_technicien = $_POST['id_technicien'];
        $statut = $_POST['statut'];

        if (empty($_POST['date_fin_reelle'])) {
            $date_fin_reelle = null;
        } else {
            $date_fin_reelle = $_POST['date_fin_reelle'];
            $statut = 2; 
        }

        if (Reparation::ModifierReparation($id, $date_depot, $date_fin_prevue, $panne, $cout, $id_appareil, $id_technicien, $statut, $date_fin_reelle)) {
            echo "<script>alert('Succes lors de la modification de la réparation.');</script>";
            header('Location: ../vue/allRep.php');
            exit;
        } else {
            echo "<script>alert('Erreur lors de la modification de la réparation.');</script>";
            header('Location: ../vue/allRep.php');
        }
    }
}

?>
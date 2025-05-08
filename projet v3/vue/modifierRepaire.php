<?php
session_start();
error_reporting(E_ALL);
ini_set('display_errors', '1');
if (!isset($_SESSION['login'])) {
    header('Location:Authentification.php');
    exit;
}

include("../model/Reparation.php");
include("../model/Appareil.php");
include("../model/user.php");

if (!isset($_GET['idMod'])) {
    echo "ID de réparation non spécifié.";
    exit;
}

$id = $_GET['idMod'];
$reparation = Reparation::findbyid($id);

if (!$reparation) {
    echo "Réparation introuvable.";
    exit;
}

$techniciens = User::findAllTechnicians(); 
$appareils = Appareil::findAll(); 
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Modifier Réparation</title>
    <link rel="stylesheet" href="../style/styleform.css">
    <link rel="stylesheet" href="../style/globals.css">
</head>
<body>
<div class="form-container">
    <h1>Modifier Réparation</h1>
    <form method="post" action="../Controller/ControlReparation.php">
        <input type="hidden" name="id" value="<?= $reparation->id ?>">

        <div class="form-group">
            <label for="date_depot">Date de Dépôt :</label>
            <input type="date" id="date_depot" name="date_depot" value="<?= $reparation->date_depot ?>" required>
        </div>

        <div class="form-group">
            <label for="date_fin_prevue">Date de Fin Prévue :</label>
            <input type="date" id="date_fin_prevue" name="date_fin_prevue" value="<?= $reparation->date_fin_prevue ?>" required>
        </div>

        <div class="form-group">
            <label for="date_fin_reelle">Date de Fin Réelle :</label>
            <input type="date" id="date_fin_reelle" name="date_fin_reelle" value="<?= $reparation->date_fin_reelle ?>">
        </div>
        
        <div class="form-group">
            <label for="panne">Panne :</label>
            <input type="text" id="panne" name="panne" value="<?= $reparation->panne ?>" required>
        </div>

        <div class="form-group">
            <label for="cout">Coût :</label>
            <input type="number" id="cout" name="cout" value="<?= $reparation->cout ?>" required>
        </div>

        <div class="form-group">
            <label for="statut">Statut :</label>
            <select id="statut" name="statut" required>
                <option value="0" <?= $reparation->statut == 0 ? 'selected' : '' ?>>En attente</option>
                <option value="1" <?= $reparation->statut == 1 ? 'selected' : '' ?>>En réparation</option>
                <option value="2" <?= $reparation->statut == 2 ? 'selected' : '' ?>>Terminé</option>
            </select>
        </div>

        <div class="form-group">
            <label for="id_technicien">Technicien :</label>
            <select id="id_technicien" name="id_technicien" required>
                <?php foreach ($techniciens as $tech): ?>
                    <option value="<?= $tech->id ?>" <?= $reparation->id_technicien == $tech->id ? 'selected' : '' ?>>
                        <?= $tech->nom ?>
                    </option>
                <?php endforeach; ?>
            </select>
        </div>

        <div class="form-group">
            <label for="id_appareil">Appareil :</label>
            <select id="id_appareil" name="id_appareil" required>
                <?php foreach ($appareils as $app): ?>
                    <option value="<?= $app->id ?>" <?= $reparation->id_appareil == $app->id ? 'selected' : '' ?>>
                        <?= $app->type ?> - <?= $app->marque ?> - <?= $app->modele ?>
                    </option>
                <?php endforeach; ?>
            </select>
        </div>

        <div class="button-group">
            <button type="submit" name="update">Modifier</button>
            <button type="button" onclick="window.location.href='../vue/allRep.php'">Annuler</button>
        </div>
    </form>
</div>
</body>
</html>
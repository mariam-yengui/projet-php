<?php
session_start();
if (!isset($_SESSION['login'])) {
    header('Location:Authentification.php');
    exit;
}

include("../model/Reparation.php");
include("../model/Appareil.php");
include("../model/user.php");

$techniciens = User::findAllTechnicians(); // Assuming a method to fetch all technicians
$appareils = Appareil::findAll(); // Assuming a method to fetch all devices
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Ajouter Réparation</title>
    <link rel="stylesheet" href="../style/styleform.css">
    <link rel="stylesheet" href="../style/globals.css">
</head>
<body>
<div class="form-container">
    <h1>Ajouter Réparation</h1>
    <form method="post" action="../Controller/ControlReparation.php">
        <input type="hidden" name="id">

        <div class="form-group">
            <label for="date_depot">Date de Dépôt :</label>
            <input type="date" id="date_depot" name="date_depot" required>
            <?php if (isset($_GET['erreur']) && $_GET['erreur'] == 2) 
            echo "<span style='color:red;'>Erreur date depot doit etre inferieur du date d'aujourdhui</span>";
            else if (isset($_GET['erreur']) && $_GET['erreur'] == 4)  ?>
        </div>

        <div class="form-group">
            <label for="date_fin_prevue">Date de Fin Prévue :</label>
            <input type="date" id="date_fin_prevue" name="date_fin_prevue" required>
            <?php if (isset($_GET['erreur']) && $_GET['erreur'] == 3) echo "<span style='color:red;'>Erreur date depot doit etre inferieur du date fin prevue</span>"; ?>
        </div>

        <div class="form-group">
            <label for="panne">Panne :</label>
            <input type="text" id="panne" name="panne" required>
        </div>

        <div class="form-group">
            <label for="cout">Coût :</label>
            <input type="number" id="cout" name="cout" required>
        </div>

        <div class="form-group">
            <label for="statut">Statut :</label>
            <select id="statut" name="statut" required>
                <option value="0">En attente</option>
                <option value="1">En réparation</option>
                <option value="2">Terminé</option>
            </select>
        </div>

        <div class="form-group">
            <label for="id_technicien">Technicien :</label>
            <select id="id_technicien" name="tech" required>
                <?php foreach ($techniciens as $tech): ?>
                    <option value="<?= $tech->id ?>"><?= $tech->nom ?></option>
                <?php endforeach; ?>
            </select>
        </div>

        <div class="form-group">
            <label for="id_appareil">Appareil :</label>
            <select id="id_appareil" name="app" required>
                <?php foreach ($appareils as $app): ?>
                    <option value="<?= $app->id ?>">
                        <?= $app->type ?> - <?= $app->marque ?> - <?= $app->modele ?>
                    </option>
                <?php endforeach; ?>
            </select>
        </div>

        <div class="button-group">
            <button type="submit" name="ajouter">Ajouter</button>
            
        </div>
    </form>
</div>
</body>
</html>
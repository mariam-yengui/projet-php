<?php
session_start();
if (!isset($_SESSION['login']))
   header('Location:Authentification.php');
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Finaliser Réparation</title>
    <link rel="stylesheet" href="../style/styleform.css">
    <link rel="stylesheet" href="../style/globals.css">
</head>
<body>
    <div class="form-container">
        <h1>Finaliser Réparation</h1>
        <form method="post" action="../Controller/ControlReparation.php">
            <div class="form-group">
                <label for="date_fin_reelle">Date de fin réelle :</label>
                <input type="date" id="date_fin_reelle" name="date_fin_reelle" required>
                <?php if (isset($_GET['erreur']) && $_GET['erreur'] == 4) echo "<span style='color:red;'>Erreur date finalisation doit etre superieur au date depot</span>"; ?>
            </div>

            <div class="form-group">
                <label for="panne">Panne :</label>
                <input type="text" id="panne" name="panne" value="panne" required>
            </div>

            <input type="hidden" name="id" value="<?= $_GET['idFinalizer'] ?>" />

            <div class="form-group">
                <label for="cout">Coût :</label>
                <input type="number" id="cout" name="cout" value="cout" required>
            </div>

            <div class="button-group">
                <button type="submit" name="finaliser">Valider</button>
                <button type="button"  onclick="window.location.href='../vue/techRep.php'" >Retour</button>
            </div>
        </form>
    </div>
</body>
</html>
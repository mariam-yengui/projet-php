<?php
session_start();
if (!isset($_SESSION['login'])) {
    header('Location: Authentification.php');
    exit;
}

include("../model/user.php");

$clients = User::findAllClients();
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Ajouter Appareil</title>
    <link rel="stylesheet" href="../style/styleform.css">
    <link rel="stylesheet" href="../style/globals.css">
</head>
<body>
<div class="form-container">
    <h1>Ajouter un Appareil</h1>
    <form method="post" action="../Controller/ControlAppareil.php">
        <div class="form-group">
            <label>Type:</label>
            <div class="radio-group">
                <div>
                    <input type="radio" id="portable" name="type" value="PC portable" required>
                    <label for="portable">PC portable</label>
                </div>
                <div>
                    <input type="radio" id="bureau" name="type" value="PC bureau" required>
                    <label for="bureau">PC bureau</label>
                </div>
            </div>
        </div>

        <div class="form-group">
            <label for="marque">Marque:</label>
            <input type="text" id="marque" name="marque" required>
        </div>

        <div class="form-group">
            <label for="modele">Modèle:</label>
            <input type="text" id="modele" name="modele" required>
        </div>

        <div class="form-group">
            <label for="num_serie">Numéro de Série:</label>
            <input type="text" id="num_serie" name="num_serie" required>
        </div>

        <div class="form-group">
            <label for="id_client">Client:</label>
            <select id="id_client" name="id_client" required>
                <?php foreach ($clients as $client): ?>
                    <option value="<?php echo $client->id; ?>">
                        <?php echo $client->nom; ?>
                    </option>
                <?php endforeach; ?>
            </select>
        </div>

        <div class="button-group">
            <button type="submit" name="add_appareil">Ajouter</button>
        </div>
    </form>
</div>
</body>
</html>

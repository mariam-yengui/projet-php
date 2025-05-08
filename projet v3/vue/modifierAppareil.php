<?php
session_start();
if (!isset($_SESSION['login'])) {
    header('Location: Authentification.php');
    exit;
}

include("../model/Appareil.php");
include("../model/user.php");

if (!isset($_GET['idMod'])) {
    echo "ID de l'appareil non spécifié.";
    exit;
}

$id = $_GET['idMod'];
$app = Appareil::findbyid($id);

if (!$app) {
    echo "Appareil introuvable.";
    exit;
}

$clients = User::findAllClients();
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Modifier Appareil</title>
    <link rel="stylesheet" href="../style/styleform.css">
    <link rel="stylesheet" href="../style/globals.css">
</head>
<body>
<div class="form-container">
    <h1>Modifier Appareil</h1>
    <form method="post" action="../Controller/ControlAppareil.php">
        <input type="hidden" name="id" value="<?php echo $app->id; ?>">

        <div class="form-group">
            <label>Type:</label>
            <div class="radio-group">
                <div>
                    <input type="radio" id="portable" name="type" value="PC portable" <?php echo ($app->type == "PC portable") ? "checked" : ""; ?>>
                    <label for="portable">PC portable</label>
                </div>
                <div>
                    <input type="radio" id="bureau" name="type" value="PC bureau" <?php echo ($app->type == "PC bureau") ? "checked" : ""; ?>>
                    <label for="bureau">PC bureau</label>
                </div>
            </div>
        </div>

        <div class="form-group">
            <label for="marque">Marque:</label>
            <input type="text" id="marque" name="marque" value="<?php echo htmlspecialchars($app->marque); ?>" required>
        </div>

        <div class="form-group">
            <label for="modele">Modèle:</label>
            <input type="text" id="modele" name="modele" value="<?php echo htmlspecialchars($app->modele); ?>" required>
        </div>

        <div class="form-group">
            <label for="num_serie">Numéro de Série:</label>
            <input type="text" id="num_serie" name="num_serie" value="<?php echo htmlspecialchars($app->num_serie); ?>" required>
        </div>

        <div class="form-group">
            <label for="id_client">Client:</label>
            <select id="id_client" name="id_client" required>
                <?php foreach ($clients as $client): ?>
                    <option value="<?php echo $client->id; ?>" <?php echo $client->id == $app->id_client ? 'selected' : ''; ?>>
                        <?php echo htmlspecialchars($client->nom); ?>
                    </option>
                <?php endforeach; ?>
            </select>
        </div>

        <div class="button-group">
            <button type="submit" name="update_appareil">Modifier</button>
            <button type="button" onclick="window.location.href='../vue/allTechApp.php'">Annuler</button>
        </div>
    </form>
</div>
</body>
</html>
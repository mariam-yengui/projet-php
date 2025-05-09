<?php
session_start();
if (!isset($_SESSION['login'])) {
    header('Location: Authentification.php');
    exit;
}
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Ajouter Technicien</title>
    <link rel="stylesheet" href="../style/styleform.css">
    <link rel="stylesheet" href="../style/globals.css">
</head>
<body>
<div class="form-container">
    <h1>Ajouter un Technicien</h1>
    <form method="post" action="../Controller/ControlUser.php">
        <div class="form-group">
            <label for="login">Login:</label>
            <input type="text" id="login" name="login_ta" required>
        </div>

        <div class="form-group">
            <label for="password">Password:</label>
            <input type="password" id="password" name="password_ta" required>
        </div>

        <div class="form-group">
            <label for="nom">Nom:</label>
            <input type="text" id="nom" name="nom_ta" required>
        </div>

        <div class="form-group">
            <label for="email">Email:</label>
            <input type="email" id="email" name="email_ta" required>
        </div>

        <div class="form-group">
            <label for="adresse">Adresse:</label>
            <input type="text" id="adresse" name="adresse_ta" required>
        </div>

        <div class="form-group">
            <label for="tel">Téléphone:</label>
            <input type="text" id="tel" name="tel_ta" required>
        </div>

        <div class="button-group">
            <button type="submit" name="tech_ajouter">Ajouter</button>
            
        </div>
    </form>
</div>
</body>
</html>

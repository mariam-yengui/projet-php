

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Authentification</title>
    <link rel="stylesheet" href="../style/login.css">
    <link rel="stylesheet" href="../style/globals.css">
</head>
<body>
    <div class="login-container">
        <h1>Login</h1>
        <p>Je vous souhaite la bienvenue !</p>
        <form method="post" action="../Controller/ControlUser.php">
            <input type="text" name="login" placeholder="Username" required>
            <?php if (isset($_GET['error']) && $_GET['error'] == 5) { echo "<p style='color: red;'>Login ou mot de passe incorrectes</p>"; } ?>
            <input type="password" name="password" placeholder="Password" required>
            <?php if (isset($_GET['error']) && $_GET['error'] == 5) { echo "<p style='color: red;'>Login ou mot de passe incorrectes</p>"; } ?>
            <button type="submit" name="connect">se connecter</button>
        </form>
        
    </div>
</body>
</html>
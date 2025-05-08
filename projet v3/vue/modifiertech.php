<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../style/styleform.css">
    <link rel="stylesheet" href="../style/globals.css">
    <title>Modifier Technicien</title>
</head>
<body>
    <div class="form-container">
        <?php
        if ($_GET['idMod']) {
            include("../model/user.php");
            $technician = User::findbyid($_GET['idMod']);
            if ($technician) {
                echo "<h1>Modifier le Technicien</h1>";
                echo "<form method='POST' action='../Controller/ControlUser.php'>";
                echo "<input type='hidden' name='id_t' value='" . $technician->id . "'>";

                echo "<div class='form-group'>";
                echo "<label for='nom'>Nom:</label>";
                echo "<input type='text' id='nom' name='nom_t' value='" . htmlspecialchars($technician->nom) . "' required>";
                echo "</div>";

                echo "<div class='form-group'>";
                echo "<label for='email'>Email:</label>";
                echo "<input type='email' id='email' name='email_t' value='" . htmlspecialchars($technician->email) . "' required>";
                echo "</div>";

                echo "<div class='form-group'>";
                echo "<label for='adresse'>Adresse:</label>";
                echo "<input type='text' id='adresse' name='adresse_t' value='" . htmlspecialchars($technician->adresse) . "' required>";
                echo "</div>";

                echo "<div class='form-group'>";
                echo "<label for='tel'>Téléphone:</label>";
                echo "<input type='text' id='tel' name='tel_t' value='" . htmlspecialchars($technician->tel) . "' required>";
                echo "</div>";

                echo "<div class='button-group'>";
                echo "<button type='submit' name='tech_modifier'>Modifier</button>";
                echo "<button type='button' onclick=\"window.location.href='../vue/allTech.php'\">Annuler</button>";
                echo "</div>";

                echo "</form>";
            } else {
                echo "<p>Technicien non trouvé.</p>";
            }
        } else {
            echo "<p>Aucun identifiant fourni.</p>";
        }
        ?>
    </div>
</body>
</html>
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
            if ($technician) {?>
                <h1>Modifier le Technicien</h1>
                <form method='POST' action='../Controller/ControlUser.php'>";
                <input type='hidden' name='id_t' value='<?php echo $technician->id; ?>' required>

                <div class='form-group'>
                <label for='nom'>Nom:</label>";
                <input type='text' id='nom' name='nom_t' value='<?php echo $technician->nom;?>' required>
                </div>
                <div class='form-group'>
                <label for='email'>Email:</label>
                <input type='email' id='email' name='email_t' value='<?php echo $technician->email; ?>' required>
                </div>
                <div class='form-group'>"
                <label for='adresse'>Adresse:</label>"
                <input type='text' id='adresse' name='adresse_t' value='<?php echo $technician->adresse?> 'quired>
                </div>
                <div class='form-group'>
                <label for='tel'>Téléphone:</label>
                <input type='text' id='tel' name='tel_t' value='<?php echo$technician->tel?>' required>
                </div>
                <div class='button-group'>
                <button type='submit' name='tech_modifier'>Modifier</button>
                
                </div>";

                echo "</form>";
            <?php} else {
                echo "<p>Technicien non trouvé.</p>";
            }
        } else {
            echo "<p>Aucun identifiant fourni.</p>";
        }
        ?>
    </div>
</body>
</html>
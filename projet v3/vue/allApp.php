<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../style/globals.css">
    <link rel="stylesheet" href="../style/styletab.css">
    <title>tous appareil</title>
</head>
<body>
<section id="minContent">
<main>
<div>
        <div class="table-data">
            <div class="order">
                <div class="head">
                    <h3>Liste des appareils</h3>
                </div>
            <!-- style="width: 100%; border-collapse: collapse; text-align: center;" -->
        <table>
            <tr>
                <th>id</th>
                <th>type</th>
                <th>marque</th>
                <th>modele</th>
                <th>numero série</th>
                <th>id client</th>
                <th>Action</th>

            </tr>
            <?php
            include("../model/Appareil.php");
            $devices = Appareil::findAll();
            foreach ($devices as $device) {
                echo "<tr>";
                echo "<td>" .$device->id. "</td>";
                echo "<td>" .$device->type. "</td>";
                echo "<td>" .$device->marque. "</td>";
                echo "<td>" .$device->modele. "</td>";
                echo "<td>" .$device->num_serie. "</td>";
                echo "<td>" .$device->id_client. "</td>";
                echo "<td><a class='finbtn' href='../Controller/ControlAppareil.php?idSup=$device->id'>supprimer</a>";
                echo "<a class='startbtn' href='../vue/modifierAppareil.php?idMod=$device->id'>modifier</a></td>";
                echo "</tr>";
            }
            ?>

        </table>
        <!-- <a href="../vue/ajouterAppareil.php">Ajouter un appareil</a> -->

        </div>
    </div>
</main>
</section>
</body>
</html>
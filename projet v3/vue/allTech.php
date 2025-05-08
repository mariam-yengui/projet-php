<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);

session_start();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>All Technicians and Devices</title>
    <link rel="stylesheet" href="../style/globals.css">
    <link rel="stylesheet" href="../style/styletab.css">
</head>
<body>
    <section id="minContent">
<main>
<main>
        <div class="table-data">
            <div class="order">
                <div class="head">
                    <h3>Liste des techniciens</h3>
                </div>
    <div>
        <!-- border="1" style="width: 100%; border-collapse: collapse; text-align: center;" -->
        <table >
            <tr>
                <th>id</th>
                <th>Nom</th>
                <th>email</th>
                <th>address</th>
                <th>telephone</th>

            </tr>
            <?php
                include("../model/user.php");
                $technicians = User::findAllTechnicians();
                foreach ($technicians as $technician) {
                    echo "<tr>";
                    echo "<td>" .$technician->id. "</td>";
                    echo "<td>" .$technician->nom. "</td>";
                    echo "<td>" .$technician->email. "</td>";
                    echo "<td>" .$technician->adresse. "</td>";
                    echo "<td>" .$technician->tel. "</td>";
                    echo "<td><a class='finbtn' href='../Controller/ControlUser.php?idSup=$technician->id'>supprimer</a>";
                    echo "<a class='startbtn' href='../vue/modifiertech.php?idMod=$technician->id'>modifier</a></td>";
                    echo "</tr>";
                }
            ?>
        </table>
        <!-- <a href="../vue/ajoutertechnician.php">Ajouter un technician</a> -->
           
    </div>
            </div></div></main></section>

</body>
</html>
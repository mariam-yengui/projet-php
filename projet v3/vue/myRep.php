<?php

session_start();
if (!isset($_SESSION['login']))
   header('Location: Authentification.php');

include("../model/Appareil.php");
include("../model/Reparation.php");

$tab = Appareil::findbyidClient($_SESSION['id']);

?>

<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <link rel="stylesheet" href="../style/globals.css">
    <link rel="stylesheet" href="../style/styletab.css">
    <link rel="stylesheet" href="../style/boxes.css">
    <link href='https://unpkg.com/boxicons@2.0.9/css/boxicons.min.css' rel='stylesheet'>
    <title>Accueil</title>
</head>

<body>
<section id="minContent">
    <main>
        <div class="table-data">
            <div class="order">
                <div class="head">
                    <h3>Liste de mes Reparations</h3>
                </div>
                <table>
                    <tr>
                        <th>Type du PC</th>
                        <th>Marque</th>
                        <th>Modèle</th>
                        <th>N° série</th>
                        <th>Date de dépôt</th>
                        <th>Date fin prévue</th>
                        <th>Date fin réelle</th>
                        <th>Panne</th>
                        <th>Coût</th>
                        <th>Statut</th>
                    </tr>
                    <?php
                    foreach ($tab as $app) {
                        $tabRep = Reparation::findbyidApp($app->id);

                        if (is_array($tabRep) || is_object($tabRep)) {
                            foreach ($tabRep as $rep) {
                                echo "<tr>";
                                echo "<td>" . $app->type . "</td>";
                                echo "<td>" . $app->marque . "</td>";
                                echo "<td>" . $app->modele . "</td>";
                                echo "<td>" . $app->num_serie . "</td>";
                                echo "<td>" . $rep->date_depot . "</td>";
                                echo "<td>" . $rep->date_fin_prevue . "</td>";
                                echo "<td>" . $rep->date_fin_reelle . "</td>";
                                echo "<td>" . $rep->panne . "</td>";
                                echo "<td>" . $rep->cout . "</td>";
                                switch ($rep->statut) {
                                    case "En attente":
                                        echo "<td>" . "<span class='status pending'>En attente</span>" . "</td>";
                                        break;
                                    case "En réparation":
                                        echo "<td>" . "<span class='status process'>En reparation</span>" . "</td>";
                                        break;
                                    case "Terminé":
                                        echo "<td>" . "<span class='status completed'>Termine</span>" . "</td>";
                                        break;
                                }
                                echo "</tr>";
                            }
                        }
                    }
                    ?>
                </table>
            </div>
        </div>
    </main>
</section>
</body>

</html>
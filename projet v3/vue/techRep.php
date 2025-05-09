<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);


session_start();
if (!isset($_SESSION['login']))
   header('Location:Authentification.php');

   include("../model/Appareil.php");
        include("../model/Reparation.php");
        $tab = Reparation::findbyidTech($_SESSION['id']);

        $num_en_attente = array_filter($tab, function($rep) {
            return $rep->statut == "En attente";
        });
        $num_en_reparation = array_filter($tab, function($rep) {
            return $rep->statut == "En réparation";
        });
        $num_termine = array_filter($tab, function($rep) {
            return $rep->statut == "Terminé";
        });
?>

<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <title>Interface Technicien</title>
    
    <link rel="stylesheet" href="../style/globals.css">
    <link rel="stylesheet" href="../style/styletab.css">
    <link rel="stylesheet" href="../style/boxes.css">
    <link href='https://unpkg.com/boxicons@2.0.9/css/boxicons.min.css' rel='stylesheet'>
</head>

<body>
<section id="minContent">
    <main>
    <ul class="box-info">
        <li>
        	<i class='bx bxs-calendar-check' ></i>
    	<span class="text">
        		<h3><?php echo sizeof($num_en_attente); ?></h3>
    		<p>En attente</p>
	</span>
</li>
    <li>
        	<i class='bx bxs-group' ></i>
    	<span class="text">
        		<h3><?php echo sizeof($num_en_reparation); ?></h3>
    		<p>En reparation</p>
	</span>
</li>
    <li>
        	<i class='bx bxs-dollar-circle' ></i>
    	<span class="text">
        		<h3><?php echo sizeof($num_termine); ?></h3>
    		<p>Termine</p>
	</span>
</li>
</ul>
<div class="table-data">
    <div class="order">
		<div class="head">
            <h3>Liste de mes Reparations</h3>
        </div>
    <!-- border="1" style="width: 100%; border-collapse: collapse; text-align: center;" -->
    <table >
        <tr>
            <th>Type du PC</th>
            <th>Marque</th>
            <th>Modèle</th>
            <th>N° Série</th>
            <th>Date de dépôt</th>
            <th>Date début</th>
            <th>Date fin prévue</th>
            <th>Date fin réelle</th>
            <th>Panne</th>
            <th>Coût</th>
            <th>Statut</th>
            <th>Action Technicien</th>
        </tr>
        <?php
        
        error_reporting(E_ALL);
        ini_set('display_errors', 1);
        

        foreach ($tab as $rep) {
            $app = Appareil::findbyid($rep->id_appareil);
            
                echo "<tr>";
                echo "<td>" . $app->type . "</td>";
                echo "<td>" . $app->marque . "</td>";
                echo "<td>" . $app->modele . "</td>";

                echo "<td>" . $app->num_serie . "</td>";
                echo "<td>" . $rep->date_depot . "</td>";
                echo "<td>" . $rep->date_debut . "</td>";
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
                echo "<td>";
                if ($rep->statut == "En attente") {
                    echo "<a class='startbtn' href='../Controller/ControlReparation.php?idModifier={$rep->id}'>Start Repair</a>";
                } else if ($rep->statut == "En réparation") {
                    echo "<a class='finbtn' href='../vue/FinaliserReparation.php?idFinalizer={$rep->id}'>Finalize Repair</a>";
                } else {
                    echo "No Action";
                }
                echo "</td>";
                echo "</tr>";
            
        }
        ?>
    </table>
    </div></div></main></section>
</body>

</html>
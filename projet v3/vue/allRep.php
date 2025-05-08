<?php        error_reporting(E_ALL);
        ini_set('display_errors', '1');
session_start();
if (!isset($_SESSION['login']))
   header('Location: Authentification.php');
   
   include("../model/Appareil.php");
        include("../model/Reparation.php");
        include("../model/user.php");
        $tab = Reparation::findAll();

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
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../style/globals.css">
    <link rel="stylesheet" href="../style/styletab.css">
    <link rel="stylesheet" href="../style/boxes.css">
    <link href='https://unpkg.com/boxicons@2.0.9/css/boxicons.min.css' rel='stylesheet'>
</head>
<body>

<form method="POST" action="../Controller/ControlReparation.php">
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
        <h3>Liste de Reparation</h3>
        </div>
        
        <table >

        <tr>
            <th>Type du PC</th>
            <th>Marque</th>
            <th>Modèle</th>
            <th>N° Série</th>
            <th>Nom du Client</th>
            <th>Date de Dépôt</th>
            <th>Date Fin Prévue</th>
            <th>Date Fin Réelle</th>
            <th>Panne</th>
            <th>Coût</th>
            <th>Nom du Technicien</th>
            <th>Statut</th>
            <th>Action</th>
        </tr>
        <?php
        
        foreach ($tab as $rep) {
            $app = Appareil::findbyid($rep->id_appareil);
            $client = User::findbyid($app->id_client);
            $tech = User::findbyid($rep->id_technicien);
            
            echo "<tr>";
            echo "<td>" . $app->type . "</td>";
            echo "<td>" . $app->marque . "</td>";
            echo "<td>" . $app->modele . "</td>";
            echo "<td>" . $app->num_serie . "</td>";
            echo "<td>" . $client->nom. "</td>";
            echo "<td>" . $rep->date_depot . "</td>";
            echo "<td>" . $rep->date_fin_prevue . "</td>";
            echo "<td>" . $rep->date_fin_reelle . "</td>";
            echo "<td>" . $rep->panne . "</td>";
            echo "<td>" . $rep->cout . "</td>";
            echo "<td>" . $tech->nom . "</td>";
			//(0 : en attente, 1 : en reparation, 2 :termine
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
            echo"<td><a class='finbtn' href='../Controller/ControlReparation.php?
            idAnnuler=$rep->id'>annuler</a>";
            echo"<a class='startbtn' href='../vue/modifierRepaire.php?idMod=$rep->id'>modifier</a></td>";
            echo "</tr>";
        }
        ?></table>
        </form>
    </div>
</div>
</main>
</section>
</body>
</html>
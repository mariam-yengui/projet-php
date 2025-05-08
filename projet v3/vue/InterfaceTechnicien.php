<?php 
        error_reporting(E_ALL);
        ini_set('display_errors', '1');
session_start();
if (!isset($_SESSION['login']))
   header('Location: Authentification.php');

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Administration</title>
    <link href='https://unpkg.com/boxicons@2.0.9/css/boxicons.min.css' rel='stylesheet'>
    <link rel="stylesheet" href="../style/sideMinue.css">
</head>
<body>
    <!--side bare-->
    <section id="sidebar">
        <a href="#" class="brand">
            <i class='bx bxs-smile'></i>
            <span class="text"><?php echo $_SESSION['login']; ?></span>

        </a>
        <ul class="side-menu top">
           
            <li class="active">
                <a href="techRep.php" target="page-content" class="active">
                <i class='bx bxs-briefcase-alt-2'></i>
                    <span class="text">Mes Reparations</span>
                </a>
            </li>
            <li>
                <a href="ajoutRepTech.php" target="page-content">
                <i class='bx bxs-add-to-queue' ></i>
                    <span class="text">Ajouter Reparation</span>
                </a>
            </li>
           

        </ul>
        <ul class="side-menu">
            <li>
                <a href="../Controller/ControlUser.php?logout=true" class="logout">
                <i class='bx bxs-log-out-circle' ></i>
                    <span class="text">Logout</span>
                </a>
            </li>
        </ul>
    </section>
    <!--side bare-->
    <section id="content">
        <!--nav bar-->
        <nav>
            <i class='bx bx-menu'></i>
            <a href="#" class="nav-link">Dashboard</a>
           
        </nav>
        <!--nav bar--> 
        <iframe src="techRep.php" name="page-content" class="page-content" style="width: 100%; height: 100vh" frameborder="0"></iframe>
           
</body>
<script src="../style/genral.js"></script>
</html>
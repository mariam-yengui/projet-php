<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);

session_start();

include("../model/user.php");

if (isset($_POST['connect'])){

    if (!empty($_POST['login']) && !empty($_POST['password'])) {
        $u = User::connect($_POST['login'], $_POST['password']);
        
        if ($u != null) {
            
            if ($u->role == 0) {
                
                header('Location: ../vue/Accueil.php'); 
                
            } elseif ($u->role == 1) {
                header('Location: ../vue/InterfaceTechnicien.php');
            } elseif ($u->role == 2) {
                header('Location: ../vue/Administration.php');
            }
        } else {
            echo "<script>alert('Login ou mot de passe incorrect');</script>";
            header('Location: ../vue/Authentification.php?error=5');
        }
    }
}

if (isset($_GET['idSup'])) {
    
    $id = $_GET['idSup'];
    if (User::delete($id)) {
        header('Location: ../vue/allTech.php');
    } else {
        echo "<script>alert('Erreur lors de la suppression du technicien.');</script>";
        header('Location: ../vue/allTech.php');
    }
}

if (isset($_POST['tech_modifier'])) {
    $id = $_POST['id_t'];
    $nom = $_POST['nom_t'];
    $email = $_POST['email_t'];
    $adresse = $_POST['adresse_t'];
    $tel = $_POST['tel_t'];

    User::update($id, $nom, $email, $adresse, $tel);
    header('Location: ../vue/allTech.php');
}

if (isset($_POST['tech_ajouter'])) {
    $login = $_POST['login_ta'];
    $password = $_POST['password_ta'];
    $nom = $_POST['nom_ta'];
    $email = $_POST['email_ta'];
    $adresse = $_POST['adresse_ta'];
    $tel = $_POST['tel_ta'];

    User::add($login, $password, $nom, $email, $adresse, $tel, 1);
    header('Location: ../vue/allTech.php');
}

if (isset($_GET['logout'])) {
  
    
    session_destroy();
   
    header('Location: ../vue/Authentification.php');
   

}
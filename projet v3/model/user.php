<?php
class User
{
    private $id;
    private $login;
    private $password;
    private $nom;
    private $email;
    private $adresse;
    private $tel;
    private $role;
    //  rôle (0 : client, 1 : technicien,  2 : admin)

    function __construct($id, $login, $password, $nom, $email, $adresse, $tel, $role)
    {
        $this->id = $id;
        $this->login = $login;
        $this->password = $password;
        $this->nom = $nom;
        $this->email = $email;
        $this->adresse = $adresse;
        $this->tel = $tel;
        $this->role = $role;
    }
    public function __get($attr)
    {
          return $this->$attr;
    }
    public function __set($attr, $value)
    {
        $this->$attr = $value;
    }

    public static function findbyid($id)
    {
        include("../Connexion.php");
        $requetePrep = $conn->prepare("SELECT * FROM utilisateur WHERE id = :id");
        $requetePrep->bindParam(':id', $id);
        $requetePrep->execute();
        $result = $requetePrep->fetch(PDO::FETCH_ASSOC);
        return new User($result['id'], $result['login'], $result['password'], $result['nom'], $result['email'], $result['adresse'], $result['tel'], $result['role']);
    }
    public static function delete($id)
    {
        include("../Connexion.php");
        $requetePrep = $conn->prepare("DELETE FROM utilisateur WHERE id = :id");
        $requetePrep->bindParam(':id', $id);
        return $requetePrep->execute();
    }
    public static function update($id, $nom, $email, $adresse, $tel) {
        include("../Connexion.php");
        $requetePrep = $conn->prepare("UPDATE utilisateur SET nom = :nom, email = :email, adresse = :adresse, tel = :tel WHERE id = :id");
        
        $requetePrep->bindParam(':nom', $nom);
        $requetePrep->bindParam(':email', $email);
        $requetePrep->bindParam(':adresse', $adresse);
        $requetePrep->bindParam(':tel', $tel);
        $requetePrep->bindParam(':id', $id);

        return $requetePrep->execute();
    }
    public static function add($login, $password, $nom, $email, $adresse, $tel, $role) {
        include("../Connexion.php");
        $requetePrep = $conn->prepare("INSERT INTO utilisateur (login, password, nom, email, adresse, tel, role) VALUES (:login, :password, :nom, :email, :adresse, :tel, :role)");
        
        $requetePrep->bindParam(':login', $login);
        $requetePrep->bindParam(':password', $password);
        $requetePrep->bindParam(':nom', $nom);
        $requetePrep->bindParam(':email', $email);
        $requetePrep->bindParam(':adresse', $adresse);
        $requetePrep->bindParam(':tel', $tel);
        $requetePrep->bindParam(':role', $role);

        return $requetePrep->execute();
    }
    public static function findAllTechnicians()
    {
        include("../Connexion.php");
        $requetePrep = $conn->prepare("SELECT * FROM utilisateur WHERE role = 1");
        $requetePrep->execute();
        $result = $requetePrep->fetchAll(PDO::FETCH_ASSOC);
        $technicians = [];
        foreach ($result as $r) {
            $technicians[] = new User($r['id'], $r['login'], $r['password'], $r['nom'], $r['email'], $r['adresse'], $r['tel'], $r['role']);
        }
        return $technicians;
    }
    public static function findAllClients()
    {
        include("../Connexion.php");
        $requetePrep = $conn->prepare("SELECT * FROM utilisateur WHERE role = 0");
        $requetePrep->execute();
        $result = $requetePrep->fetchAll(PDO::FETCH_ASSOC);
        $clients = [];
        foreach ($result as $r) {
            $clients[] = new User($r['id'], $r['login'], $r['password'], $r['nom'], $r['email'], $r['adresse'], $r['tel'], $r['role']);
        }
        return $clients;
    }

    public static function connect($login, $password)
    {
        include("../Connexion.php");
        $requetePrep = $conn->prepare("SELECT * FROM utilisateur WHERE login = :login AND password = :password");
       $requetePrep->bindParam(':login', $login);
       $requetePrep->bindParam(':password', $password);
        $requetePrep->execute();

        echo "Login: $login, Password: $password<br>";
        echo "Rows found: " . $requetePrep->rowCount() . "<br>";

        if ($requetePrep->rowCount() > 0) {
            $result = $requetePrep->fetch(PDO::FETCH_ASSOC);
            
            $u = new User($result['id'], $result['login'], $result['password'], $result['nom'], $result['email'], $result['adresse'], $result['tel'], $result['role']);
            session_start();
            $_SESSION['id'] = $u->id;
            $_SESSION['login'] = $u->login;
            $_SESSION['password'] = $u->password;
            $_SESSION['nom'] = $u->nom;
            $_SESSION['email'] = $u->email;
            $_SESSION['adresse'] = $u->adresse;
            $_SESSION['tel'] = $u->tel;
            $_SESSION['role'] = $u->role;
            return $u;
        } else {
            echo "No matching user found.<br>"; 
            return null;
        }
    }

}

?>
<?php
class Appareil
{
    private $id;
    private $type;
    private $marque;
    private $modele;
    private $num_serie;
    private $id_client;

    public function __construct($id, $type, $marque, $modele, $num_serie, $id_client)
    {
        $this->id = $id;
        $this->type = $type;
        $this->marque = $marque;
        $this->modele = $modele;
        $this->num_serie = $num_serie;
        $this->id_client = $id_client;
    }
    public function __get($attr)
    {
        if (!isset($this->$attr))
            return "erreur";
        else
            return ($this->$attr);
    }
    public function __set($attr, $value)
    {
        $this->$attr = $value;
    }
    public static function findbyidClient($id_client)
    {
        error_reporting(E_ALL);
        ini_set('display_errors', 1);
       // echo "slam i m in appareil<br>";
        include("../Connexion.php");
        $tab = [];
        $requetePrep = $conn->prepare("select * from appareil where id_client=:id_client");
        
        $requetePrep->bindParam(':id_client', $id_client);
        
        $requetePrep->execute();
        $resultApp = $requetePrep->fetchAll();
        foreach ($resultApp as $r) {
            //echo "slam i m in appareil<br>";
            $app = new Appareil($r['id'], $r['type'], $r['marque'], $r['modele'], $r['numserie'], $r['id_client']);
            //echo $app ;
            $tab[] = $app;
        }
        return $tab;
    }
    public static function findbyid($id)
    {
        include("../Connexion.php");
        $requetePrep = $conn->prepare("select * from appareil where id=:id");
        $requetePrep->bindParam(':id', $id);
        $requetePrep->execute();
        if ($requetePrep->rowCount() == 0) {
            return null;
        } else {
            $r = $requetePrep->fetch(PDO::FETCH_ASSOC);
            return new Appareil($r['id'], $r['type'], $r['marque'], $r['modele'], $r['numserie'], $r['id_client']);
        }
    }
   public static function findAll()
    {
        include("../Connexion.php");
        $requetePrep = $conn->prepare("select * from appareil");
        $requetePrep->execute();
        if ($requetePrep->rowCount() == 0) {
            return null;
        } else {
            $resultApp = $requetePrep->fetchAll(PDO::FETCH_ASSOC);
            $tab = [];
            foreach ($resultApp as $r) {
                $app = new Appareil($r['id'], $r['type'], $r['marque'], $r['modele'], $r['numserie'], $r['id_client']);
                //echo $app ;
                $tab[] = $app;
            }
            return $tab;
        }
    }
    public static function delete($id)
    {
        include("../Connexion.php");
        $requetePrep = $conn->prepare("delete from appareil where id=:id");
        $requetePrep->bindParam(':id', $id);
        $requetePrep->execute();
        if ($requetePrep->rowCount() == 0) {
            return false;
        } else {
            return true;
        }
    }
    public static function update($id, $type, $marque, $modele, $num_serie, $id_client)
    {
        include("../Connexion.php");
        $requetePrep = $conn->prepare("update appareil set type=:type, marque=:marque, modele=:modele, numserie=:num_serie, id_client=:id_client where id=:id");
        $requetePrep->bindParam(':id', $id);
        $requetePrep->bindParam(':type', $type);
        $requetePrep->bindParam(':marque', $marque);
        $requetePrep->bindParam(':modele', $modele);
        $requetePrep->bindParam(':num_serie', $num_serie);
        $requetePrep->bindParam(':id_client', $id_client);
        return $requetePrep->execute();
    }
    public static function add($type, $marque, $modele, $num_serie, $id_client)
    {
        include("../Connexion.php");
        $requetePrep = $conn->prepare("insert into appareil (type, marque, modele, numserie, id_client) values (:type, :marque, :modele, :num_serie, :id_client)");
        $requetePrep->bindParam(':type', $type);
        $requetePrep->bindParam(':marque', $marque);
        $requetePrep->bindParam(':modele', $modele);
        $requetePrep->bindParam(':num_serie', $num_serie);
        $requetePrep->bindParam(':id_client', $id_client);
        return $requetePrep->execute();
    }
    public function __tostring()
    {
        return "<td>$this->type</td><td>$this->marque</td><td>$this->modele</td><td>$this->num_serie</td>";
    }
} ?>
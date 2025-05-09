<?php
 error_reporting(E_ALL);
 ini_set('display_errors', '1');
class Reparation
{
    private $id;
    private $date_depot;
    private $date_debut;
    private $date_fin_prevue;
    private $date_fin_reelle;
    private $panne;
    private $cout;
    private $statut;
    private $id_appareil;
    private $id_technicien;
    public function __construct($id, $date_debut, $date_depot, $date_fin_prevue, $date_fin_reelle, $panne, $cout, $statut, $id_appareil, $id_technicien)
    {
        $this->id = $id;
        if ($date_debut == null) {
            $this->date_debut = "Non défini";
        } else {
            $this->date_debut = $date_debut;
        }
        
        $this->date_depot = $date_depot;
        if ($date_fin_prevue == null) {
            $this->date_fin_prevue = "Non défini";
        } else {
            $this->date_fin_prevue = $date_fin_prevue;
        }
        if ($date_fin_reelle == null) {
            $this->date_fin_reelle = "Non défini";
        } else {
            $this->date_fin_reelle = $date_fin_reelle;
        }
        if ($panne == null) {
            $this->panne = "Non défini";
        } else {
            $this->panne = $panne;
        }
        if ($cout == null) {
            $this->cout = "Non défini";
        } else {
            $this->cout = $cout;
        }
        if ($statut == 0) {
            $this->statut = "En attente";
        } else if ($statut == 1) {
            $this->statut = "En réparation";
           
        }else if ($statut == 2) {
            $this->statut = "Terminé";
        } else {
            $this->statut = "Non défini";
        }
      
        $this->id_appareil = $id_appareil;
        $this->id_technicien = $id_technicien;
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
    public static function findbyidApp($id_app)
    {
        include("../Connexion.php");
        $tab = [];
        
        $requetePrep = $conn->prepare("select * from reparation where id_appareil=:id_appareil");
        $requetePrep->bindParam(':id_appareil', $id_app);
        $requetePrep->execute();
        if ($requetePrep->rowCount() == 0) 
            return null;
        $resultApp = $requetePrep->fetchAll();
        foreach ($resultApp as $r) {
            
            $app = new Reparation($r['id'], $r['dateDebut'], $r['dateDepot'], $r['dateFinPrevue'], 
            $r['dateFinReelle'], $r['panne'], $r['cout'], $r['statut'], $r['id_appareil'], $r['id_technicien']);
           
            $tab[] = $app;
        }
        return $tab;

    }
    public static function findbyid($id)
    {
        include("../Connexion.php");
        $requetePrep = $conn->prepare("select * from reparation where id=:id");
        $requetePrep->bindParam(':id', $id);
        $requetePrep->execute();
        if ($requetePrep->rowCount() == 0) {
            return null;
        }else {
            $r = $requetePrep->fetch(PDO::FETCH_ASSOC);
            return new Reparation($r['id'],$r['dateDebut'], $r['dateDepot'], $r['dateFinPrevue'],
             $r['dateFinReelle'], $r['panne'], $r['cout'], $r['statut'], $r['id_appareil'], $r['id_technicien']);
        }

    }
    public static function ModifierReparation($id, $date_depot, $date_fin_prevue, $panne, $cout, $id_appareil, $id_technicien, $statut,$date_fin_reelle)
    {
        include("../Connexion.php");
        $requetePrep = $conn->prepare("UPDATE reparation SET dateDepot = :date_depot, dateFinPrevue = :date_fin_prevue, panne = :panne, cout = :cout, statut = :statut, id_appareil = :id_appareil, id_technicien = :id_technicien, dateFinReelle = :date_fin_reelle WHERE id = :id");
        $requetePrep->bindParam(':date_depot', $date_depot);
        $requetePrep->bindParam(':date_fin_prevue', $date_fin_prevue);
        $requetePrep->bindParam(':panne', $panne);
        $requetePrep->bindParam(':cout', $cout);
        $requetePrep->bindParam(':statut', $statut);
        $requetePrep->bindParam(':id_appareil', $id_appareil);
        $requetePrep->bindParam(':id_technicien', $id_technicien);
        $requetePrep->bindParam(':date_fin_reelle', $date_fin_reelle);
        $requetePrep->bindParam(':id', $id);
        return $requetePrep->execute();
    }
    public static function findbyidTech($id)
    {
        error_reporting(E_ALL);
        ini_set('display_errors', 1);
        include("../Connexion.php");
        $tab = [];
        $requetePrep = $conn->prepare("select * from reparation where id_technicien=:id");
        $requetePrep->bindParam(':id', $id);
        $requetePrep->execute();
        $resultApp = $requetePrep->fetchAll();
        foreach ($resultApp as $r) {
            //echo "slam i m in appareil<br>";
            $app = new Reparation($r['id'], $r['dateDebut'], $r['dateDepot'], $r['dateFinPrevue'], 
            $r['dateFinReelle'], $r['panne'], $r['cout'], $r['statut'], $r['id_appareil'], $r['id_technicien']);
            //echo $app ;
            $tab[] = $app;
        }
        return $tab;
      
    }
    public static function StartRepair($id_reparation)
    {
        include ("../Connexion.php");
        $requetePrep = $conn->prepare("UPDATE reparation SET statut = 1, dateDebut = :dateDebut WHERE id = :id");
        $requetePrep->bindParam(':dateDebut', date('Y-m-d H:i:s'));
        $requetePrep->bindParam(':id', $id_reparation);
        return $requetePrep->execute();
            
    }
   public static function FinaliserReparation($id_reparation, $date_fin_reelle, $panne, $cout)
    {
        include ("../Connexion.php");
        $requetePrep = $conn->prepare("UPDATE reparation SET dateFinReelle = :dateFinReelle, panne = :panne, cout = :cout, statut = 2 WHERE id = :id");
        $requetePrep->bindParam(':dateFinReelle', $date_fin_reelle);
        $requetePrep->bindParam(':panne', $panne);
        $requetePrep->bindParam(':cout', $cout);
        $requetePrep->bindParam(':id', $id_reparation);
        return $requetePrep->execute();
    }
    public static function findAll()
    {
        include("../Connexion.php");
        $tab = [];
        $requetePrep = $conn->prepare("select * from reparation");
        $requetePrep->execute();
        $resultApp = $requetePrep->fetchAll();
        foreach ($resultApp as $r) {
            //echo "slam i m in appareil<br>";
            $app = new Reparation($r['id'], $r['dateDebut'], $r['dateDepot'], $r['dateFinPrevue'], 
            $r['dateFinReelle'], $r['panne'], $r['cout'], $r['statut'], $r['id_appareil'], $r['id_technicien']);
            //echo $app ;
            $tab[] = $app;
        }
        return $tab;
    }
    public static function delete($id)
    {
        include("../Connexion.php");
        $requetePrep = $conn->prepare("DELETE FROM reparation WHERE id = :id");
        $requetePrep->bindParam(':id', $id);
        return $requetePrep->execute();
    }
    public function __tostring()
    {
        $status = "";
        switch($this->statut) {
            case 0: $status = "En attente"; break;
            case 1: $status = "En réparation"; break;
            case 2: $status = "Terminé"; break;
        }
        
        return "<td>$this->date_depot</td><td>$this->date_fin_prevue</td><td>$this->date_fin_reelle</td><td>$this->panne</td><td>$this->cout</td><td>$status</td>";
    }
    public static function AjouterReparation( $date_depot, $date_fin_prevue, $panne, $cout, $id_appareil,$id_technicien,$statut)
    {
        include("../Connexion.php");
        $requetePrep = $conn->prepare("INSERT INTO reparation (dateDepot, dateFinPrevue, panne, cout, id_appareil, id_technicien, statut) VALUES (:date_depot, :date_fin_prevue, :panne, :cout, :id_appareil, :id_technicien, :statut)");
        $requetePrep->bindParam(':date_depot', $date_depot);
        $requetePrep->bindParam(':date_fin_prevue', $date_fin_prevue);
        $requetePrep->bindParam(':panne', $panne);
        $requetePrep->bindParam(':cout', $cout);
        $requetePrep->bindParam(':id_appareil', $id_appareil);
        $requetePrep->bindParam(':id_technicien', $id_technicien);
        $requetePrep->bindParam(':statut', $statut);
        return $requetePrep->execute();
    }
}
<?php
namespace Medical;

use PDO;
include 'DataBase.php';
class Patient
{

    private $id;
    private $nom_prenom;
    private $date_naissance;
    private $sexe;
    private $email;
    private $tel;
    private $created_by;

    /**
     * Patient constructor.
     */
    public function __construct()
    {
    }

    /**
     * @return mixed
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @param mixed $id
     */
    public function setId($id)
    {
        $this->id = $id;
    }

    /**
     * @return mixed
     */
    public function getNomPrenom()
    {
        return $this->nom_prenom;
    }

    /**
     * @param mixed $nom_prenom
     */
    public function setNomPrenom($nom_prenom)
    {
        $this->nom_prenom = $nom_prenom;
    }

    /**
     * @return mixed
     */
    public function getDateNaissance()
    {
        return $this->date_naissance;
    }

    /**
     * @param mixed $date_naissance
     */
    public function setDateNaissance($date_naissance)
    {
        $this->date_naissance = $date_naissance;
    }

    /**
     * @return mixed
     */
    public function getSexe()
    {
        return $this->sexe;
    }

    /**
     * @param mixed $sexe
     */
    public function setSexe($sexe)
    {
        $this->sexe = $sexe;
    }

    /**
     * @return mixed
     */
    public function getEmail()
    {
        return $this->email;
    }

    /**
     * @param mixed $email
     */
    public function setEmail($email)
    {
        $this->email = $email;
    }

    /**
     * @return mixed
     */
    public function getTel()
    {
        return $this->tel;
    }

    /**
     * @param mixed $tel
     */
    public function setTel($tel)
    {
        $this->tel = $tel;
    }

    public function list_patient()
    {
        $stmt = DataBase::getConnection()->prepare("SELECT * FROM patients where created_by=:created_by");
        $stmt->execute(array(":created_by"=>$_SESSION['user']['id']));
        return $stmt->fetchAll();
    }
    public function add_patient($fields = array())
    {
        try {
            $query = "INSERT INTO patients(nom_prenom,date_naissance,sexe,email,tel,created_by) VALUES (:nom_prenom,:date_naissance,:sexe,:email,:tel,:created_by)";
            $stmt = DataBase::getConnection()->prepare($query);
            // posted values
            $this->nom_prenom = htmlspecialchars(strip_tags($fields['nom_prenom']));
            $this->date_naissance = htmlspecialchars(strip_tags($fields['date_naissance']));
            $this->sexe = htmlspecialchars(strip_tags($fields['sexe']));
            $this->email = htmlspecialchars(strip_tags($fields['email']));
            $this->tel = htmlspecialchars(strip_tags($fields['tel']));
            $this->created_by = $_SESSION['user']['id'];
            // bind values
            $stmt->bindParam(":nom_prenom", $this->nom_prenom);
            $stmt->bindParam(":date_naissance", $this->date_naissance);
            $stmt->bindParam(":sexe", $this->sexe);
            $stmt->bindParam(":email", $this->email);
            $stmt->bindParam(":tel", $this->tel);
            $stmt->bindParam(":created_by", $this->created_by);

            if ($stmt->execute()) {
                return true;
            } else {
                return false;
            }
        } catch (PDOException $e) {
            echo $e->getMessage();
            return false;
        }
    }
    public function update_patient($fields = array())
    {
        try {

            //write query
            $query = "UPDATE tables SET placement=:placement,category_id=:category_id,description=:description,guests=:guests,created_by=:created_by WHERE id=:table_id";
            $stmt = DataBase::getConnection()->prepare($query);
            // posted values
            $this->id = htmlspecialchars(strip_tags($fields['table_id']));
            $this->placement = htmlspecialchars(strip_tags($fields['placement']));
            $this->category_id = htmlspecialchars(strip_tags($fields['category_id']));
            $this->description = htmlspecialchars(strip_tags($fields['description']));
            $this->guests = htmlspecialchars(strip_tags($fields['guests']));
            $this->created_by = htmlspecialchars(strip_tags($_SESSION['user']['id']));
            // bind values
            $stmt->bindParam(":table_id", $this->id);
            $stmt->bindParam(":placement", $this->placement);
            $stmt->bindParam(":category_id", $this->category_id);
            $stmt->bindParam(":description", $this->description);
            $stmt->bindParam(":guests", $this->guests);
            $stmt->bindParam(":created_by", $this->created_by);

            if ($stmt->execute()) {
                return true;
            } else {
                return false;
            }
        } catch (PDOException $e) {
            echo $e->getMessage();
            return false;
        }
    }
    public function delete_patient($patient_id)
    {
        try {
            //write query
            $query = "DELETE FROM tables WHERE id=:table_id";
            $stmt = DataBase::getConnection()->prepare($query);
            // posted values
            $this->id = htmlspecialchars(strip_tags($patient_id));
            // bind values
            $stmt->bindParam(":table_id", $this->id);
            if ($stmt->execute()) {
                return true;
            } else {
                return false;
            }
        } catch (PDOException $e) {
            echo $e->getMessage();
            return false;
        }
    }
    public function find_patient($id)
    {
        $stmt = DataBase::getConnection()->prepare("SELECT * FROM patients WHERE id=:id");
        $stmt->execute(array(":id"=>$id));
        $editRow=$stmt->fetch(PDO::FETCH_ASSOC);
        return $editRow;
    }
    public function search_patient($key,$value)
    {
        $sql = "SELECT * FROM patients WHERE ".$key." LIKE '%".$value."%'";
        $stmt = DataBase::getConnection()->prepare($sql);
        $stmt->execute();
         return $stmt->fetchAll();
    }
    public function fiche_patient($fields = array())
    {
        try {
            $query = "INSERT INTO fiches(medecin_id,patient_id,created_at,created_by) VALUES (:medecin_id,:patient_id,:created_at,:created_by)";
            $stmt = DataBase::getConnection()->prepare($query);
            // posted values
            $this->id = $fields['patient_id'];
            $this->created_by = $_SESSION['user']['id'];
            // bind values
            $stmt->bindParam(":medecin_id", $fields['patient_id']);
            $stmt->bindParam(":patient_id", $this->id);
            $stmt->bindParam(":created_at", date("Y-m-d h:i:s"));
            $stmt->bindParam(":created_by", $this->created_by);



            if ($stmt->execute()) {
                return true;
            } else {
                return false;
            }
        } catch (PDOException $e) {
            echo $e->getMessage();
            return false;
        }
    }
    public function list_fiches()
    {
        $stmt = DataBase::getConnection()->prepare("SELECT fiches.id,patients.nom_prenom,CONCAT(medecins.prenom,' ', medecins.nom) AS docteur,services.nom_service, fiches.created_at FROM
 patients,medecins,services,fiches WHERE (fiches.patient_id=patients.id) AND (fiches.medecin_id=medecins.id) AND (services.id=medecins.service_id)
 AND fiches.created_by=:created_by");
        $stmt->execute(array(":created_by"=>$_SESSION['user']['id']));
        return $stmt->fetchAll();
    }

}
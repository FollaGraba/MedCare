<?php
namespace Medical;
use Medical\DataBase;
use PDO;
include 'IUser.php';

class Medecin implements IUser
{


    /**
     * Medecin constructor.
     */
    public function __construct()
    {
    }

    public function create($fields = array())
    {
        try
        {
            $pass= $this->encryptPass($fields['password']);

            $stmt = DataBase::getConnection()->prepare("INSERT INTO medecins (service_id,nom,prenom,email,tel,password) VALUES(:service_id,:nom, :prenom, :email,:tel,:password)");
            $stmt->bindparam(":service_id",$fields['service_id']);
            $stmt->bindparam(":nom",$fields['nom']);
            $stmt->bindparam(":prenom",$fields['prenom']);
            $stmt->bindparam(":email",$fields['email']);
            $stmt->bindparam(":tel",$fields['tel']);
            $stmt->bindparam(":password",$pass);

            if($stmt->execute())
                return true;
            else
                return false;
        }
        catch(PDOException $e)
        {
            echo $e->getMessage();
            return false;
        }
    }

    public function update($fields = array())
    {
        // TODO: Implement update() method.
    }

    public function delete($id)
    {
        // TODO: Implement delete() method.
    }

    public function existUser($email)
    {
        // TODO: Implement existUser() method.
    }
    public function login($email = null, $password = null)
    {
        try {
            $pass = $this->encryptPass($password);

            //Check Mail :
            $q = DataBase::getConnection()->prepare('SELECT * FROM medecins WHERE email=:email AND password=:password');
            $q->bindParam(':email', $email);
            $q->bindParam(':password', $pass);
            $q->execute();
            $row_count = $q->rowCount();

            if ($row_count == 0)
                return false;
            else {

                $row = $q->fetch(PDO::FETCH_ASSOC);
                session_status() == true ? '' : session_start();
                $_SESSION['user'] = $row;
                return true;
            }
        }
        catch(PDOException $e)
        {
            return $e->getMessage();
        }
    }
    public function logout()
    {
        session_destroy();
        unset($_SESSION);
        header('Location: ../login.php');
    }

    public function encryptPass($password) {
        $sSalt = '20adeb83e85f03cfc84d0fb7e5f4d290';
        $sSalt = substr(hash('sha256', $sSalt, true), 0, 32);
        $method = 'aes-256-cbc';

        $iv = chr(0x0) . chr(0x0) . chr(0x0) . chr(0x0) . chr(0x0) . chr(0x0) . chr(0x0) . chr(0x0) . chr(0x0) . chr(0x0) . chr(0x0) . chr(0x0) . chr(0x0) . chr(0x0) . chr(0x0) . chr(0x0);

        $encrypted = base64_encode(openssl_encrypt($password, $method, $sSalt, OPENSSL_RAW_DATA, $iv));
        return $encrypted;
    }
    public function decryptPass($password) {
        $sSalt = '20adeb83e85f03cfc84d0fb7e5f4d290';
        $sSalt = substr(hash('sha256', $sSalt, true), 0, 32);
        $method = 'aes-256-cbc';

        $iv = chr(0x0) . chr(0x0) . chr(0x0) . chr(0x0) . chr(0x0) . chr(0x0) . chr(0x0) . chr(0x0) . chr(0x0) . chr(0x0) . chr(0x0) . chr(0x0) . chr(0x0) . chr(0x0) . chr(0x0) . chr(0x0);

        $decrypted = openssl_decrypt(base64_decode($password), $method, $sSalt, OPENSSL_RAW_DATA, $iv);
        return $decrypted;
    }

    public function getServices()
    {
        try {
            $stmt = DataBase::getConnection()->prepare("SELECT * FROM services");
            $stmt->execute();
            return  $stmt->fetchAll();
        } catch (PDOException $e) {
            echo $e->getMessage();
            return null;
        }
    }
    public function getDoctors($service_id)
    {
        try {
            $stmt = DataBase::getConnection()->prepare("SELECT id, concat(nom,prenom) as name FROM medecins WHERE service_id=:service_id");
            $stmt->execute(array(":service_id"=>$service_id));
            return  $stmt->fetchAll();
        } catch (PDOException $e) {
            echo $e->getMessage();
            return null;
        }
    }
    public function getPatients()
    {
        $stmt = DataBase::getConnection()->prepare("SELECT fiches.id,patients.nom_prenom,patients.date_naissance,patients.sexe,fiches.created_at,fiches.joined_at,fiches.note_medecin FROM patients,fiches WHERE (fiches.patient_id=patients.id) AND (fiches.medecin_id=:medecin_id) ORDER BY fiches.created_at desc");
        $stmt->execute(array(":medecin_id"=>$_SESSION['user']['id']));
        return $stmt->fetchAll();
    }

}
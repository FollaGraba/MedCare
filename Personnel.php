<?php
namespace Medical;
include 'IUser.php';
use PDO;
class Personnel implements IUser
{
    private $id;
    private $nom;
    private $prenom;
    private $email;
    private $password;
    private $tel;

    /**
     * Personnel constructor.
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
    public function getNom()
    {
        return $this->nom;
    }

    /**
     * @param mixed $nom
     */
    public function setNom($nom)
    {
        $this->nom = $nom;
    }

    /**
     * @return mixed
     */
    public function getPrenom()
    {
        return $this->prenom;
    }

    /**
     * @param mixed $prenom
     */
    public function setPrenom($prenom)
    {
        $this->prenom = $prenom;
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
    public function getPassword()
    {
        return $this->password;
    }

    /**
     * @param mixed $password
     */
    public function setPassword($password)
    {
        $this->password = $password;
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





    public function create($fields = array())
    {
        try
        {
            $pass= $this->encryptPass($fields['password']);

            $stmt = DataBase::getConnection()->prepare("INSERT INTO personnels (nom,prenom,email,tel,password) VALUES(:nom, :prenom, :email,:tel,:password)");
            $stmt->bindparam(":nom",$fields['nom']);
            $stmt->bindparam(":prenom",$fields['prenom']);
            $stmt->bindparam(":email",$fields['email']);
            $stmt->bindparam(":tel",$fields['tel']);
            $stmt->bindparam(":password",$pass);
            if($stmt->execute())
                return true;
            else
                return true;
        }
        catch(PDOException $e)
        {
            echo $e->getMessage();
            return false;
        }
    }
    public function update($fields = array())
    {
        try
        {
            $pass= $this->encryptPass($fields['password']);
            $stmt = DataBase::getConnection()->prepare("UPDATE users SET username=:username,name=:name,profil=:profil,password=:password,created_by=:created_by WHERE id=:id");
            $stmt->bindparam(":id",$fields['id']);
            $stmt->bindparam(":username",$fields['username']);
            $stmt->bindparam(":name",$fields['name']);
            $stmt->bindparam(":profil",$fields['profil']);
            $stmt->bindparam(":password",$pass);
            $stmt->bindparam(":created_by",$fields['created_by']);

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
    public function delete($id)
    {
        try
        {
            $stmt = database::getConnection()->prepare("DELETE FROM users WHERE id=:id");
            $stmt->bindparam(":id",$id);
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
    public function existUser($email)
    {
        try
        {
        $stmt = $this->getConnection()->prepare("SELECT * FROM users WHERE email=:email");
        $stmt->bindparam(":email",$email);
        $stmt->execute();
        $row_count = $stmt->rowCount();
        if($row_count ==1)
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
    public function login($email = null, $password = null)
    {
        try {
            $pass = $this->encryptPass($password);

            //Check Mail :
            $q = DataBase::getConnection()->prepare('SELECT * FROM personnels WHERE email=:email AND password=:password');
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
}
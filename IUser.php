<?php
namespace Medical;
include 'DataBase.php';

interface IUser
{


    public function create($fields = array());
    public function update($fields = array()) ;
    public function delete($id);
    public function existUser($email);
    public function login($username = null, $password = null);
    public function logout();
    public function encryptPass($password);
    public function decryptPass($password);

}
<?php require_once 'bddLink/connexion.class.php'; ?>

<?php

class Users extends Connexion{
    protected $username;
    protected $passwordHash;
    protected $email;
    protected $profileBio;
    protected $profilePicture;
    
    public function __construct($username,$passwordHash,$email,$profileBio,$profilePicture){
        $this->username = $username;
        $this->passwordHash = $passwordHash;
        $this->email = $email;
        $this->profileBio = $profileBio;
        $this->profilePicture = $profilePicture;
    }
    // getter & setter
    public function getUsername(){
        return $this->username;
    }
    public function setUsername($username){
        $this->username = $username;
    }
    public function getPasswordHash(){
        return $this->passwordHash;
    }
    public function setPasswordHash($passwordHash){
        $this->passwordHash = $passwordHash;
    }
    public function getEmail(){
       return $this->email; 
    }
    public function setEmail($email){
        $this->email = $email;
    }
    public function getProfileBio(){
        return $this->profileBio;
    }
    public function setProfileBio($profileBio){
        $this->profileBio = $profileBio;
    }
    public function getProfilePicture(){
        return $this->profilePicture;
    }
    public function setProfilePicture($profilePicture){
        $this->profilePicture = $profilePicture;
    }


    public function addUser(){
            $db = Connexion::connection();
            $requete = "INSERT INTO Users (username,password_hash,email) VALUES (:username,:password_hash,:email)";
            $stmt = $db->prepare($requete);
            $stmt->bindParam(':username', $this->username);
            $stmt->bindParam(':password_hash', $this->passwordHash);
            $stmt->bindParam(':email', $this->email);
            $stmt->execute();
            $stmt->closeCursor();
    }
    }



     

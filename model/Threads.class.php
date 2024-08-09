<?php require_once 'bddlink/connexion.class.php'; ?>

<?php

class Threads extends Connexion{
    protected $username;
    protected $title;
    protected $category;
    protected $description;
    

    public function __construct($username,$title,$category,$description){
        $this->username = $username;
        $this->title = $title;
        $this->category = $category;
        $this->description = $description;

    }
    
    // getter & setter
    public function getUsername(){
        return $this->username;
    }
    public function setUsername($username){
        $this->username = $username;
    }
    public function getTitle(){
        return $this->title;
    }
    public function setTitle($title){
        $this->title = $title;
    }
    public function getCategory(){
        return $this->category;
    }
    public function setCategory($category){
        $this->category = $category;
    }
    public function getDescription(){
        return $this->description;
    }
    public function setDescription($description){
        $this->description = $description;
    }

    public function CreateThread(){
        $db = Connexion::connection();
        $requete = "INSERT INTO Threads(title,user_id,category_id,view_nb,description) VALUES 
        (:title,
        (SELECT user_id FROM Users WHERE username = :username),
        (SELECT category_id FROM Categories WHERE category_name = :category_name),
        :view_nb,:description)";
        $stmt = $db->prepare($requete);
        $view_nb = 0;
        $stmt->bindParam(':title', $this->title);
        $stmt->bindParam(':username', $this->username);
        $stmt->bindParam(':category_name', $this->category);
        $stmt->bindParam(':view_nb', $view_nb);
        $stmt->bindParam(':description', $this->description);
        $stmt->execute();
        $stmt->closeCursor();
    }
    public static function updateViewCount($ThreadId){
        $db = Connexion::connection();
        $stmt = $db->prepare("UPDATE Threads SET view_nb = view_nb + 1 WHERE thread_id = :thread_id");
        $stmt->bindParam(':thread_id', $ThreadId);
        $stmt->execute();
        $stmt->closeCursor();
    }
    }
    

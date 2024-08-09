<?php require_once 'bddlink/connexion.class.php'; ?>

<?php

class Posts extends Connexion{
    protected $threadId;
    protected $username;
    protected $content;

    public function __construct($threadId,$username,$content){
        $this->threadId = $threadId;
        $this->username = $username;
        $this->content = $content;
        
    }
    
    // getter & setter
    public function getThreadId(){
        return $this->threadId;
    }
    public function setThreadId($threadId){
        $this->threadId = $threadId;
    }
    public function getUsername(){
        return $this->username;
    }
    public function setUsername($username){
        $this->username = $username;
    }
    public function getContent(){
        return $this->content;
    }
    public function setContent($content){
        $this->content = $content;
    }
    
    public function CreatePost(){
        $db = Connexion::connection();
        $requete = "INSERT INTO Posts(thread_id,user_id,content) VALUES (:thread_id,(SELECT user_id FROM Users WHERE username = :username),:content)";
        $stmt = $db->prepare($requete);
        $stmt->bindParam(':thread_id', $this->threadId);
        $stmt->bindParam(':username', $this->username);
        $stmt->bindParam(':content', $this->content);
        $stmt->execute();
        $stmt->closeCursor();
    }
    
    
    
}
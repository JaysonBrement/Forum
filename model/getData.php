<?php require_once 'BDDlink/connexion.class.php'; ?>

<?php

class GetData extends Connexion{
    public static function getThreads(){
        $query = "SELECT Threads.thread_id, title, Threads.user_id, category_name,
        view_nb ,thread_date, description, profile_picture FROM Threads INNER JOIN
        Categories ON Threads.category_id = Categories.category_id INNER JOIN Users ON Users.user_id = Threads.user_id";
        $db = Connexion::connection();
        $stmt = $db->prepare($query);
        $stmt->execute();
        $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
        return $result;
    }
    public static function getPostHeader($threadId){
        $query = "SELECT Threads.title, Users.username, Threads.description FROM Threads INNER JOIN Users ON Threads.user_id = Users.user_id WHERE thread_id = :thread_id;
        ON Threads.category_id = Categories.category_id";
        $db = Connexion::connection();
        $stmt = $db->prepare($query);
        $stmt->bindParam(':thread_id', $threadId);
        $stmt->execute();
        $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
        return $result;
    }
    public static function getPostContent($threadId){
        $query = "SELECT username, content FROM Posts INNER JOIN Users ON Users.user_id = Posts.user_id WHERE thread_id = :thread_id";
        $db = Connexion::connection();
        $stmt = $db->prepare($query);
        $stmt->bindParam(':thread_id', $threadId);
        $stmt->execute();
        $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
        return $result;
    }
    public static function getAllUsers(){
        $query = "SELECT username FROM Users";
        $db = Connexion::connection();
        $stmt = $db->prepare($query);
        $stmt->execute();
        $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
        return $result;
    }
    public static function getPassword($username){
        $query = "SELECT password_hash FROM Users WHERE username = :username";
        $db = Connexion::connection();
        $stmt = $db->prepare($query);
        $stmt->bindParam(':username', $username);
        $stmt->execute();
        $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
        return $result;
    }
    public static function getCategory(){
        $query = "SELECT category_name FROM Categories ";
        $db = Connexion::connection();
        $stmt = $db->prepare($query);
        $stmt->execute();
        $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
        return $result;
    }
    public static function getThreadIdByUsernameAndTitleAndDescription($username,$title,$description){
        $query = "SELECT thread_id FROM Threads WHERE user_id = (SELECT user_id FROM Users WHERE username = :username) AND title = :title AND description = :description";
        $db = Connexion::connection();
        $stmt = $db->prepare($query);
        $stmt->bindParam(':description', $description);
        $stmt->bindParam(':title', $title);
        $stmt->bindParam(':username', $username);
        $stmt->execute();
        $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
        return $result;
    }
    public static function getThreadsByQuery($queried){
        $search = "%$queried%";
        $query = "SELECT Threads.thread_id, title, Threads.user_id, category_name,
        view_nb ,thread_date, description, profile_picture FROM Threads INNER JOIN
        Categories ON Threads.category_id = Categories.category_id INNER JOIN Users ON Users.user_id = Threads.user_id WHERE title LIKE :query";
        $db = Connexion::connection();
        $stmt = $db->prepare($query);
        $stmt->bindParam(':query', $search);
        $stmt->execute();
        $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
        return $result;
    }
    
}
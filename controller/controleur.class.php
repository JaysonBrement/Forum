<?php require_once './model/getData.php' ?>
<?php require_once './model/Users.class.php' ?>
<?php require_once './model/Threads.class.php' ?>
<?php require_once './model/Posts.class.php' ?>

<?php 
class Controleur{
    protected $action;

    public function __construct($action){
        $this->action = $action;


    }
    //getter & setter
    public function getAction(){
        return $this->action;
    }
    public function setAction($action){
        $this->action = $action;
    }

//--------------------------------------------------------------------------------------------------------------------------------------------------
    public function controlerAddUser(){
    if($this->action =='userSignIn'){
        $usernamePattern = "/^[a-zA-Z0-9_]+$/";
        $emailPattern = "/^[a-zA-Z0-9._-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,4}$/";
        $passwordPattern = "/^(?=.*[A-Z])(?=.*\d).{12,30}$/";
        if ((preg_match($usernamePattern, $_POST['username'])) AND (preg_match($emailPattern, $_POST['email'])) AND (preg_match($passwordPattern, $_POST['password']))) {
            $condition = 0;
            $table = getData::getAllUsers();
            foreach($table as $T){
                if($_POST['username'] === $T['username']){
                    $condition = 1;
                }
            }
            if($condition === 0){
                $username = $_POST['username'];
                $email = $_POST['email'];
                $hashedPassword = password_hash($_POST['password'], PASSWORD_BCRYPT);
                $controledUser = new Users($username,$hashedPassword,$email,null,null);
                $controledUser->addUser();
            }header('Location: /connexion');
        }
    }
    }
    public function controlerGetUserSession(){
        
        if($this->action == 'getSession'){
            echo "1ère boucle activé<br>";
            $condition = 0;
            $users = getData::getAllUsers();
            // echo $_POST['username'];
            
            foreach($users as $u){
                // echo $u['username'];
                if($_POST['username'] === $u['username']){
                    $condition = 1;
                }
            }
            if($condition === 1){
                $passwordDb = getData::getPassword($_POST['username']);
                // echo $passwordDb[0]['password_hash'];
                $passwordInput = $_POST['password'];
                if (password_verify($passwordInput, $passwordDb[0]['password_hash']) AND $condition===1) {
                    session_start();
                    $_SESSION['username'] = $_POST['username'];
                    header('Location: /');
                }else header('Location: /connexion?error=true');
            }else header('Location: /connexion?error=true');
        }
    }
    public function controlerCreateThread(){
        if($this->action == 'newThread'){
            session_start();
            $titlePattern = '/^[^<>]{2,100}$/u';
            $descriptionPattern = '/^[^<>]{2,250}$/u';
            $categoryPattern = '/^[^<>]{2,100}$/u';
            if(isset($_SESSION['username']) AND isset($_POST['title']) AND isset($_POST['description']) AND isset($_POST['category_name'])){
                // echo "contenu présent et session approuvé<br>";
                if(preg_match($titlePattern,$_POST['title']) AND preg_match($descriptionPattern,$_POST['description']) AND preg_match($categoryPattern,$_POST['category_name'])){
                    $controledThread = new Threads($_SESSION['username'],$_POST['title'],$_POST['category_name'],$_POST['description']);
                    $controledThread->createThread();
                    $id = getData::getThreadIdByUsernameAndTitleAndDescription($_SESSION['username'],$_POST['title'],$_POST['description']);
                    $tab = end($id);
                    sleep(1);
                    header("Location: /thread?id=". $tab['thread_id'] );
                    
                }
            }
        }
        

    }
    public function controlerCreatePost(){
        if($this->action == 'newPost'){
            session_start();
            $contentPattern = '/^[^<>]{2,250}$/u';
            if(isset($_SESSION['username']) AND isset($_POST['content']) AND filter_var($_POST['thread_id'],FILTER_VALIDATE_INT)){
                if(preg_match($contentPattern, $_POST['content'])){
                    $controledPost = new Posts($_POST['thread_id'],$_SESSION['username'],$_POST['content']);
                    $controledPost->createPost();
                    sleep(1);
                    header("Location: /thread?id=". $_POST['thread_id']);
                }else{
                    header("Location: /thread?id=". $_POST['thread_id']);
                }
            }
        }
    }
    public function controlerUpdateViewCount(){
        if($this->action == 'updateViewCount'){
                Threads::updateViewCount((int)$_POST['id']);
        }
    }
}
?>
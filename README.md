### Hello, this is a simple forum i made to learn php using a kind of custom framework i made.

This work uses the view/model/controller architecture.

Technologies used :
- Object oriented PHP 8.2.13
- Javascript, HTML5/CSS3
- MySQL

Basic Features include :
- creating an account
- connecting to account
- disconnecting from account 
- keeping tracks of session to allow using features
- using search bar to look for specific threads
- creating threads
- sending messages in threads
- counting views of threads when link is clicked


These explanation are destined mainly for me to arrange my ideas and track the changes in my way of coding.

The center of my application is my Router class. 
This class holds the following :

- A $routes public property containing the mapping of URL paths corresponding to their actions e.g. url /add telling the application to add data to database.
- A 'register' method storing the callable action in the $routes array with the path as the key.
- A 'resolve' method taking the current URI, comparing it with the content of the array to match to path to the action needed.
```
class Routeur{
    public array $routes;
    public function register(string $path,callable $action):void{
        $this->routes[$path] = $action;
    }

    public function resolve(string $uri){
        $path = explode('?', $uri)[0];
        $action = $this->routes[$path] ?? null;

        if(!is_callable($action)){
            header("HTTP/1.1 404 Not Found");
            include("view/404_real.php");
            throw new Exception('Cette route n\'existe pas');
        }
        return $action();
    }



}
```

```
$routeur->register('/new', function () {
    session_start();
    if(isset($_SESSION['username'])){
        include 'view/new_real.php';
    }else{
        header('Location: /');
    }
});
$routeur->resolve($_SERVER['REQUEST_URI']);
```

Using this method, when a link is clicked in the view, it sends the URL to the routeur wich chooses the appropriate action to take.
- If it just involves reading non sensible data like public pages, it will directly include the page and query the data
- If it involves writing to the database, or sensible data, it sends the request to the controller.

The controller's role in my application is to do verification and if criteria are met, use the model to make appropriate changes to the database, give the user his requested session or render a page.

user clicks on /connexion link-> router sends the page -> user enters ID and password -> controler queries the database and verifies if hashed passwords and username matches ->if passwords matches send php session data as cookies and redirects user ,if it doesn't, sends back an error message.

Here is an example :
```
$routeur->register('/controle', function () {
    switch ($_GET['action']){
        case 'userSignIn':
            $control = new Controleur($_GET['action']);
            $control->controlerAddUser();
            break;
        case 'getSession':
            $control = new Controleur($_GET['action']);
            $control->controlerGetUserSession();
            break;
        case 'newThread':
            $control = new Controleur($_GET['action']);
            $control->controlerCreateThread();
            break;
        
        case 'newPost':
            $control = new Controleur($_GET['action']);
            $control->controlerCreatePost();
            break;
        case 'updateViewCount':
            $control = new Controleur($_GET['action']);
            $control->controlerUpdateViewCount();
            break;
        }
        
});
```
    public function controlerGetUserSession(){
        
        if($this->action == 'getSession'){
            $condition = 0;
            $users = getData::getAllUsers();
            
            foreach($users as $u){
                if($_POST['username'] === $u['username']){
                    $condition = 1;
                }
            }
            if($condition === 1){
                $passwordDb = getData::getPassword($_POST['username']);
                $passwordInput = $_POST['password'];
                if (password_verify($passwordInput, $passwordDb[0]['password_hash']) AND $condition===1) {
                    session_start();
                    $_SESSION['username'] = $_POST['username'];
                    header('Location: /');
                }else header('Location: /connexion?error=true');
            }else header('Location: /connexion?error=true');
        }
    }

```

    public static function getPassword($username){
        $query = "SELECT password_hash FROM Users WHERE username = :username";
        $db = Connexion::connection();
        $stmt = $db->prepare($query);
        $stmt->bindParam(':username', $username);
        $stmt->execute();
        $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
        return $result;
    }


```


Things i need to improve :
- database connection is not singleton meaning, if i have a page that queries the database 4 times, it will open 4 different connections. Very bad.
- i have the feeling of violating a bit OOP principles by using a bit too many static methods, while not that extensive, this habit is to be taken seriously.
- CSS is poorly organized.
- get out of the 'inventing the wheel' mentality and start using dependency injections to make full use of the PHP work environnement, while good to learn how things works, it hinders productivity greatly.
- naming convention is fine but can be improved.

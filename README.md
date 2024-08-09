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


These explanation are detined mainly for me to arrange my ideas and track the changes is my way of coding.

The center of my application is my router class. 
This class holds the following :

- A $routes public property containing the mapping of URL paths corresponding to their actions e.g. url /add telling the application to add data to database.
- A 'register' method storing the callable action in the $routes array with the path as the key.
- A 'resolve' method taking the current URI, comparing it with the content of the array to match to path to the action needed.
  ``` class Routeur{
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

``` $routeur->register('/new', function () {
    session_start();
    if(isset($_SESSION['username'])){
        include 'view/new_real.php';
    }else{
        header('Location: /');
    }
});```
``` $routeur->resolve($_SERVER['REQUEST_URI']); ```

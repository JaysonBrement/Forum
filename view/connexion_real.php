
<?php ob_start() ?> 



    <div class="card">
        <div class="welcome">
            <img src="/public/Images/logotest3.png" alt="">
            <h3>Welcome to united forum</h3>
            <p>Log into your account to engage with the commoners</p>
        </div>
        <div class="horiline"></div>
        
        
        <form action="/controle?action=getSession" class="form-group" METHOD="POST">
            <label for="username">Username</label>
            <input class="log" type="text" name="username" id="username" placeholder="Pseudo">
            <label for="password">Password</label>
            <input class="log" type="password" name="password" id="password" placeholder="***********">
            <button class="connexionbutton" type="submit">Log in</button>
        </form>
        <?php 
    if(isset($_GET['error'])){
        if ($_GET['error']==='true'){
            include "view/assets/errorLogin.php";
            }
    }
     ?>
        <p class="noaccount">No account ? <a href="/inscription">Sign up here !</a></p>

    </div>
    







<?php
$content =ob_get_clean();
require "template.php";
?>  
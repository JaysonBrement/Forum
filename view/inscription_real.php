<?php ob_start() ?> 


    <div class="card">
        <div class="welcome">
            <img src="/public/Images/logotest3.png" alt="">
            <h3>Welcome to united forum</h3>
            <p>Gain a place in our wonderfull community.. For free !</p>
        </div>
        <div class="horiline"></div>
        
        
        <form action="/controle?action=userSignIn" class="form-group" method="POST">
            <label for="username">Username</label>
            <input class="log" type="text" name="username" id="username" placeholder="pseudo">
            <label for="email">Email</label>
            <input class="log" type="email" name="email" id="password" placeholder="Example@mail.com">
            <label for="password">Password</label>
            <input class="log" type="password" name="password" id="password" placeholder="1 uppercase, 1 number, between 12 and 30 signs">
            <button onclick="incrementViewCount(1);"class="connexionbutton" type="submit">Create my account</button>
        </form>
        <p class="noaccount">Already got an account ? <a href="/connexion">Log in here !</a></p>

    </div>










<?php
$content =ob_get_clean();
require "template.php";
?>  
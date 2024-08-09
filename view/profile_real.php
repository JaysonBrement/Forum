<?php ob_start() ?> 

<!-- <form action="/controle?action=" class="formprofile" method="POST" enctype="multipart/form-data">
        <div class="profilediv">
            <label for="nom" class="form-label">Bio :</label>
            <textarea name="" class="bio" cols="30" rows="10"></textarea>
        </div>
        <div class="profilediv">
            <label for="file">Fichier</label>
            <input class="" type="file" name="fichier">
        </div>



        <div class="">
            <button class="submitprofile" type="submit">Modifier</button>
        </div>
    </form> -->
    <div class="profile-container">
    <button class="update-profile"><a href="/profile_update">Update profile</a></button>
        <div class="profile-header">
            <img src="view/Images/logo3.png" alt="" class="profile-picture">
            <h1 class="username"><?=$_SESSION['username']?></h1>
        </div>
        <div class="profile-bio">
            <p>This is the bio of the user. It can contain information about interests, hobbies, work, etc.</p>
        </div>
    </div>

<?php
$content =ob_get_clean();
require "template.php";
?>
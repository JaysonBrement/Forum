<?php ob_start() ?>
<?php 
require_once 'service/function.affichage.php';
require_once 'model/getData.php'
?>

<main>
    <div class="containerpush"></div>
    <div class="containeraccueil">
        <div class="threadgroup">
            <div class="threadheader">
                <div class="titleheader"><h3 class="topic">Topic</h3></div>
                <div class="categoryheader"><h3>Category</h3></div>
                <div class="likesheader"><h3>Likes</h3></div>
                <div class="viewsheader"><h3>Views</h3></div>
                <div class="activityheader"><h3>Creation date</h3></div>
            </div>
           <?php 
           if(isset($_GET['query'])){
               threadDisplayMasher(GetData::getThreadsByQuery($_GET['query']));
           }else{
            threadDisplayMasher(GetData::getThreads());
           }
           
            ?>

            
        </div>
        
    </div>
    <div class="containerpush"></div>
</main>
<?php
$content =ob_get_clean();
require "template.php";
?>  

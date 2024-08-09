<?php require_once './service/function.affichage.php'; ?>
<?php session_start() ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../style.test.css">
    <title>Document</title>
</head>
<body>
<?php 
      echo "Au revoir !" . $_SESSION['username'] .'<br>';
      session_destroy();
      echo 'clique <a href="/">ici</a>pour partir !'
        
    
      
?> 

</body>
</html>
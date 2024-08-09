<?php

class Connexion {
    //-----------------------------------------------------------------------------
    public static function connection(){
    try {
        $dns = 'mysql:host=localhost;dbname=forum;charset=utf8';
        $user = 'root';
        $password = '';
        $con = new PDO($dns, $user, $password);
        return $con;
    } catch (PDOException $pe){
        
        var_dump(" mysql errors ");
        
        echo 'Erreur : ' . $pe->getMessage() . '<br />';
        
        echo 'N° : ' . $pe->getCode();
        
        die('Fin du script');
    }
}
}
// renvoie les information de connection à la base de données
// récupération par héritage de connection, require_once du fichier et initialisation de la variable $bdd = Connexion::connection();
?>
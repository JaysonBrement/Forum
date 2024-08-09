<?php require_once './BDDlink/connexion.class.php'; ?>

<?php

class GetData extends Connexion{
    protected $example;
    protected $example2;
    

    public function __construct($example,$example2){
        $this->example = $example;
        $this->example2 = $example2;
    }
    public function __tostring(){
        return "example 1 : $this->example , example 2: $this->example2 ";
    }
//getter & setter
    public function getExample(){
        return $this->example;
    }
    public function setExample($example){
        $this->example = $example;
    }
    public function getExample2(){
        return $this->example2;
    }
    public function setExample2($example2){
        $this->example2 = $example2;
    }
     
}
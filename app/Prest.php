<?php
namespace App;

class Prest {

    private $url;

    function __construct($url) {
       $this->url = $url;
    }
    //GETERS
    function getUrl(){
        return $this->url;
    }

    //SETTERS
    function setUrl($url){
        return $this->url = $url;
    }

    public function realizarPeticion(){
        $result = file_get_contents($this->url);
        return (json_decode($result, true));
    }

}

<?php

class View{

    function __construct(){
        //echo "<p>Vista base</p>";
    }

    function render($nombre){
        require_once 'views/' . $nombre . '.php';
    }

    function redirect($nombre=''){
    	header("Location: ".constant('URL').$nombre);
    }
}

?>
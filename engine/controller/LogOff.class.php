<?php
session_start();

class LogOff {
    public function __construct() {
        session_destroy();
        setcookie( "access", "", time()- 60, "/","", 0);
        
        $host = $_SERVER['HTTP_HOST'];
        $uri = ''; //folder
        $page = 'index.html';
        header("Location: http://$host/$page");
                
    }
}
?>
<?php
session_start();

$worker = new AuthorizationCheck();

class AuthorizationCheck {
    private $a1_nick;
    private $a1_pass;
    
    public function __construct() {
        $this->a1_nick = $_SESSION['a1_nick'];
        $this->a1_pass = $_SESSION['a1_pass'];
        
        $this->doCheck();
        
    }
    
    private function doCheck() {
        try {
            if(!isset($this->a1_nick) && !isset($this->a1_pass)) {
                $host = $_SERVER['HTTP_HOST'];
                $uri = ''; //folder
                $page = 'index.html';
                header("Location: http://$host/$page");
                exit;
                
            } else if(!isset($_COOKIE['access'])) {
                $host = $_SERVER['HTTP_HOST'];
                $uri = ''; //folder
                $page = 'index.html';
                header("Location: http://$host/$page");
                exit;
            }
            
        } catch (Exception $e) {
            print 'Something went wrong: ' . $e->getMessage();
            
        }
    }
}

?>
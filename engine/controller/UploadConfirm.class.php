<?php
session_start();

class UploadConfirm {
    public function __construct() {
        $_SESSION['step_3_next'] = $_POST['step_3_next'];
        
        $host = $_SERVER['HTTP_HOST'];
        $uri = ''; //folder
        $page = 'step_4.php';
        header("Location: http://$host/$page");
    }
}

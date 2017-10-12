<?php
session_start();
include_once '../db/UniversalConnect.class.php';

class EditProject {
    private $hookup;
    private $tableMaster1;
    private $tableMaster2;
    private $sql;
    
    private $b1_id;
    private $b2_id;
    
    public function __construct() {
        $this->hookup = UniversalConnect::doConnect();
        $this->tableMaster1 = "b1_firm";
        $this->tableMaster2 = "b2_project";
        
        $this->b1_id = $_REQUEST['b1_id'];
        $this->b2_id = $_REQUEST['b2_id'];
        
        $this->createEdit();
        $this->hookup->close();
        
    }
    
    private function createEdit() {
        $this->sql = "SELECT b1_name, b2_name, b2_folder FROM $this->tableMaster1, $this->tableMaster2 WHERE b1_id = $this->b1_id AND b2_id = $this->b2_id";
        
        try {
            $result = $this->hookup->query($this->sql);
            
            while($row = $result->fetch_assoc()) {
                $_SESSION['b1_name'] = $row['b1_name'];
                $_SESSION['b2_name'] = $row['b2_name'];
                $_SESSION['b2_folder'] = $row['b2_folder'];
                
                $_SESSION['b1_id'] = $this->b1_id;
                $_SESSION['b2_id'] = $this->b2_id;
                $_SESSION['step_3_next'] = '';
                
            }
            
            $host = $_SERVER['HTTP_HOST'];
            $uri = ''; //folder
            $page = 'step_4.php';
            header("Location: http://$host/$page");
            
            $result->close();
            
        } catch (Exception $e) {
            print 'Something went wrong: '.$e->getMessage();

        }
    }
}

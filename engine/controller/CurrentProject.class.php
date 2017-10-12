<?php
session_start();
include_once '../db/UniversalConnect.class.php';

class CurrentProject {
    private $hookup;
    private $tableMaster;
    private $sql;
    
    private $b2_id;
    
    public function __construct() {
        $this->hookup = UniversalConnect::doConnect();
        $this->tableMaster = "b2_project";
        
        $this->b2_id = $_POST['b2_id'];
        $_SESSION['b2_id'] = $this->b2_id;
        
        $this->viewProject();
        $this->hookup->close();
        
    }
    
    private function viewProject() {
        
        try {
            $this->sql = "SELECT b2_name, b2_folder FROM $this->tableMaster WHERE b2_id = '".$this->b2_id."'";
            $result = $this->hookup->query($this->sql);
            
            while($row = $result->fetch_assoc()) {
                $_SESSION['b2_name'] = $row['b2_name'];
                $_SESSION['b2_folder'] = $row['b2_folder'];
            }
            
            $host = $_SERVER['HTTP_HOST'];
            $uri = ''; //folder
            $page = 'step_3.php';
            header("Location: http://$host/$page");
            
        } catch (Exception $ex) {
            print "There is a problem: ".$e->getMessage();

        }
    }
}

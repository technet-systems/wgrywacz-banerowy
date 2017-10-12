<?php
session_start();
include_once '../db/UniversalConnect.class.php';

class ChangeName {
    private $hookup;
    private $tableMaster1;
    private $tableMaster2;
    private $sql;
    
    private $b1_id;
    private $b1_name;
    private $b2_id;
    private $b2_name;
    
    public function __construct() {
        $this->hookup = UniversalConnect::doConnect();
        
        
        if(isset($_REQUEST['b1_id'])) {
            $this->tableMaster1 = "b1_firm";
            $this->b1_id = $_REQUEST['b1_id'];
            $this->b1_name = $_POST['b1_name'];
                
            $this->changeFirm();
            $this->hookup->close();
        
        } else if(isset($_REQUEST['b2_id'])) {
            $this->tableMaster2 = "b2_project";
            $this->b2_id = $_REQUEST['b2_id'];
            $this->b2_name = $_POST['b2_name'];
                
            $this->changeProject();
            $this->hookup->close();
            
        }
        
    }
    
    private function changeFirm() {
        try {
            $this->sql = "UPDATE $this->tableMaster1 SET b1_name = '".$this->b1_name."' WHERE b1_id = $this->b1_id";
            $this->hookup->query($this->sql);
            
            $host = $_SERVER['HTTP_HOST'];
            $uri = ''; //folder
            $page = 'step_0.php';
            header("Location: http://$host/$page");
            
        } catch (Exception $e) {
            print "There is a problem: ".$e->getMessage();
            
        }
        
    }
    
    private function changeProject() {
        try {
            $this->sql = "UPDATE $this->tableMaster2 SET b2_name = '".$this->b2_name."' WHERE b2_id = $this->b2_id";
            $this->hookup->query($this->sql);
            
            $host = $_SERVER['HTTP_HOST'];
            $uri = ''; //folder
            $page = 'step_0.php';
            header("Location: http://$host/$page");
            
        } catch (Exception $e) {
            print "There is a problem: ".$e->getMessage();
            
        }
        
    }
    
}

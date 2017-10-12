<?php
session_start();
include_once '../db/UniversalConnect.class.php';

class ViewProject {
    private $hookup;
    private $tableMaster;
    private $sql;
    
    private $b1_id;
    private $b2_id;
    
    public function __construct() {
        $this->hookup = UniversalConnect::doConnect();
        $this->tableMaster = "b2_project";
        
        $this->b1_id = $_REQUEST['b1_id'];
        $this->b2_id = $_REQUEST['b2_id'];
        
        $this->createView();
        $this->hookup->close();
        
    }
    
    private function createView() {
        $this->sql = "SELECT b2_folder FROM $this->tableMaster WHERE b2_id = $this->b2_id";
        
        try {
            $result = $this->hookup->query($this->sql);
            
            while($row = $result->fetch_assoc()) {
                $_SESSION['b2_folder_check'] = $row['b2_folder'];

            }
            
            $host = $_SERVER['HTTP_HOST'];
            $uri = ''; //folder
            $page = 'step_0.php';
            header("Location: http://$host/$page");
            exit();
            
            $result->close();
            
        } catch (Exception $e) {
            print 'Something went wrong: '.$e->getMessage();
            
        }
    }
}

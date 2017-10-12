<?php
session_start();
include_once '../db/UniversalConnect.class.php';

class UpdateFileDescription {
    private $hookup;
    private $sql;
    private $tableMaster;
    
    private $c1_height;
    private $c1_width;
    private $c1_description;
    
    public function __construct() {
        $this->hookup = UniversalConnect::doConnect();
        $this->tableMaster = "c1_files";
        
        if(is_numeric($_POST['c1_height'])) {
            $this->c1_height = trim($_POST['c1_height']);
        } else {
            $this->c1_height = 200;
        }
        
        if(is_numeric($_POST['c1_width'])) {
            $this->c1_width = trim($_POST['c1_width']);
        } else {
            $this->c1_width = 200;
        }
        
        $this->c1_description = trim($_POST['c1_description']);
        
        $this->updateData();
        $this->hookup->close();
        
    }
    
    private function updateData() {
        
        try {
            $this->sql = "UPDATE $this->tableMaster "
                    . "SET c1_description = '".$this->c1_description."', "
                    . "c1_height = $this->c1_height, "
                    . "c1_width = $this->c1_width "
                    . "WHERE c1_id = '".$_REQUEST['c1_id']."'";
            $this->hookup->query($this->sql);
            
            $host = $_SERVER['HTTP_HOST'];
            $uri = ''; //folder
            $page = 'step_4.php';
            header("Location: http://$host/$page");
            exit();
            
        } catch (Exception $ex) {
            print 'Something went wrong: '.$e->getMessage();

        }
        
    }
    
}

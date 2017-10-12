<?php
session_start();
include_once '../db/UniversalConnect.class.php';

class DeleteFile {
    private $hookup;
    private $tableMaster;
    private $sql;
    
    private $c1_id;
    
    public function __construct() {
        $this->hookup = UniversalConnect::doConnect();
        $this->tableMaster = "c1_files";
        
        $this->c1_id = $_REQUEST['c1_id'];
        
        $this->deleteFile();
        $this->deleteData();
        $this->hookup->close();
        
    }
    
    private function deleteFile() {
        try {
            $this->sql = "SELECT c1_name FROM $this->tableMaster WHERE c1_id = $this->c1_id";
            $result = $this->hookup->query($this->sql);
            
            while($row = $result->fetch_assoc()) {
                unlink('../../examples/'.$_SESSION['b2_folder'].'/'.$row['c1_name']);
                
            }
            
            $result->close();
            
        } catch (Exception $e) {
            print 'Something went wrong: ' . $e->getMessage();

        }
        
    }
    
    private function deleteData() {
        try {
            $this->sql = "DELETE FROM $this->tableMaster WHERE c1_id = $this->c1_id";
            $this->hookup->query($this->sql);
            
            $host = $_SERVER['HTTP_HOST'];
            $uri = ''; //folder
            $page = 'step_4.php';
            header("Location: http://$host/$page");
            exit();
            
        } catch (Exception $e) {
            print 'Something went wrong: ' . $e->getMessage();

        }
        
    }
    
}

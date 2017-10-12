<?php
session_start();
include_once '../db/UniversalConnect.class.php';

class DeleteProject {
    private $hookup;
    private $tableMaster1;
    private $tableMaster2;
    private $sql;
    
    private $b2_id;
    private $b2_folder;
    
    public function __construct() {
        $this->hookup = UniversalConnect::doConnect();
        $this->tableMaster1 = "b2_project";
        $this->tableMaster2 = "c1_files";
        
        $this->b2_id = $_REQUEST['b2_id'];
        
        $this->deleteFileAndFolder();
        $this->deleteData();
        $this->hookup->close();
        
    }
    
    private function deleteFileAndFolder() {
        $this->sql = "SELECT b2_folder "
                . "FROM $this->tableMaster1 "
                . "WHERE b2_id = '".$this->b2_id."'";
        
        try {
            $result = $this->hookup->query($this->sql);
            
            if($result->num_rows > 0) {
                while($row = $result->fetch_assoc()) {
                    $this->b2_folder = $row['b2_folder'];
                    
                    //deleting all files in directory
                    $files = glob('../../examples/'.$this->b2_folder.'/*'); //get all file names
                    foreach($files as $file) { //interate files
                        if(is_file($file)) {
                            unlink($file); //delete file
                            
                        }
                        
                    }
                    
                }
                
                if(is_dir('../../examples/'.$this->b2_folder)) {
                    rmdir('../../examples/'.$this->b2_folder);
                
                }
                
            }
            
            $result->close();
            
        } catch (Exception $e) {
            print 'Something went wrong: '.$e->getMessage();

        }
        
    }
    
    private function deleteData() {
        try {
            //deleting files from DB
            $this->sql = "DELETE FROM $this->tableMaster2 "
                . "WHERE c1_b2_id = '".$this->b2_id."'";
            $this->hookup->query($this->sql);
            
            //deleting folder from DB
            $this->sql = "DELETE FROM $this->tableMaster1 WHERE b2_id = '".$this->b2_id."'";
            $this->hookup->query($this->sql);

            $host = $_SERVER['HTTP_HOST'];
            $uri = ''; //folder
            $page = 'step_0.php';
            header("Location: http://$host/$page");
            exit();
            
        } catch (Exception $e) {
            print 'Something went wrong: '.$e->getMessage();

        }
        
    }
}

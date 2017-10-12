<?php
session_start();
include_once '../db/UniversalConnect.class.php';

class UploadFile {
    private $hookup;
    private $tableMaster;
    private $sql;
    
    private $file_temp;
    private $file_name;
    private $file_type;
    private $file_size;
    private $file_error;
    private $file_allowed = array('swf', 'jpg', 'png', 'gif');
    
    public function __construct() {
        $this->hookup = UniversalConnect::doConnect();
        $this->tableMaster = "c1_files";
        
        $this->file_temp = $_FILES['step_3_new']['tmp_name'];
        $this->file_name = $_FILES['step_3_new']['name'];
        $this->file_type = $_FILES['step_3_new']['type'];
        $this->file_size = $_FILES['step_3_new']['size'];
        $this->file_error = $_FILES['step_3_new']['error'];
        
        $this->uploadFile();
        $this->hookup->close();
        
    }
    
    private function uploadFile() {
        $file_extension = pathinfo($this->file_name, PATHINFO_EXTENSION);
        $file_new_name = microtime();
        $file_new_complete = $file_new_name.'.'.$file_extension;
        
        if(in_array($file_extension, $this->file_allowed)) {
            move_uploaded_file($this->file_temp, '../../examples/'.$_SESSION['b2_folder'].'/'.$file_new_complete);
            
            $this->sql = "INSERT INTO $this->tableMaster (c1_id, c1_name, c1_old_name, c1_b2_id) VALUES (NULL, '".$file_new_complete."', '".$this->file_name."', '".$_SESSION['b2_id']."')";
            $this->hookup->query($this->sql);
            
            echo '{"status":"success"}';
            exit;
            
        } else {
            print '{"status":"error"}';
            exit;
            
        }
        
    }
}

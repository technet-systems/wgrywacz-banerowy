<?php
session_start();
include_once '../db/UniversalConnect.class.php';

class NewProject {
    private $hookup;
    private $tableMaster;
    private $sql;
    
    private $b2_name;
    private $b2_b1_id;
    
    public function __construct() {
        $this->hookup = UniversalConnect::doConnect();
        $this->tableMaster = "b2_project";
        
        $this->b2_name = trim($_POST['b2_name']);
        $this->b2_b1_id = $_SESSION['b1_id'];
        
        $this->createProject();
        $this->hookup->close();
        
    }
    
    private function createProject() {
        
        try {
            $folder = hash('md5',time());
            $this->sql = "INSERT INTO $this->tableMaster (b2_id, b2_name, b2_folder, b2_b1_id) VALUES (NULL, '".$this->b2_name."', '".$folder."', $this->b2_b1_id)";
            $this->hookup->query($this->sql);
            
            $this->sql = "SELECT b2_id, b2_folder FROM $this->tableMaster WHERE b2_id = (SELECT MAX(b2_id) FROM $this->tableMaster)";
            $result = $this->hookup->query($this->sql);
            
            while($row = $result->fetch_assoc()) {
                $_SESSION['b2_id'] = $row['b2_id'];
                $_SESSION['b2_folder'] = $row['b2_folder'];
            }
            
            // Everything for owner, read and execute for others http://php.net/manual/en/function.chmod.php
            mkdir("/examples/".$_SESSION['b2_folder'], 0755);
            
            $this->sql = "SELECT b2_name FROM $this->tableMaster WHERE b2_id = '".$_SESSION['b2_id']."' ";
            $result = $this->hookup->query($this->sql);
            
            while($row = $result->fetch_assoc()) {
                $_SESSION['b2_name'] = $row['b2_name'];
            }
            
            $host = $_SERVER['HTTP_HOST'];
            $uri = ''; //folder
            $page = 'step_3.php';
            header("Location: http://$host/$page");
            
            
        } catch (Exception $e) {
            print 'Something went wrong: ' . $e->getMessage();

        }
    }
    
}

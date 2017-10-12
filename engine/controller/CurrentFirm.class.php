<?php
session_start();
include_once '../db/UniversalConnect.class.php';

class CurrentFirm {
    private $hookup;
    private $tableMaster;
    private $sql;
    
    private $b1_id;
    
    public function __construct() {
        $this->hookup = UniversalConnect::doConnect();
        $this->tableMaster = "b1_firm";
        
        $this->b1_id = $_POST['b1_id'];
        $_SESSION['b1_id'] = $this->b1_id;
        
        $this->viewFirm();
        $this->hookup->close();
        
    }
    
    private function viewFirm() {
        
        try {
            $this->sql = "SELECT b1_name FROM $this->tableMaster WHERE b1_id = '".$_SESSION['b1_id']."' ";
            $result = $this->hookup->query($this->sql);
            
            while($row = $result->fetch_assoc()) {
                $_SESSION['b1_name'] = $row['b1_name'];
            }
            
            $host = $_SERVER['HTTP_HOST'];
            $uri = ''; //folder
            $page = 'step_2.php';
            header("Location: http://$host/$page");
            
        } catch (Exception $e) {
            print "There is a problem: ".$e->getMessage();

        }
    }

}

?>
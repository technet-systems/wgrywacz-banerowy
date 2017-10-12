<?php
session_start();
include_once '../db/UniversalConnect.class.php';

class NewFirm {
    private $hookup;
    private $tableMaster;
    private $sql;
    
    private $b1_name;
    
    public function __construct() {
        $this->hookup = UniversalConnect::doConnect();
        $this->tableMaster = "b1_firm";
        
        $this->b1_name = trim($_POST['b1_name']);
        
        $this->insertFirm();
        $this->hookup->close();
        
    }
    
    private function insertFirm() {
        
        try {
            $this->sql = "SELECT b1_name FROM $this->tableMaster WHERE b1_name = '".$this->b1_name."'";
            $result = $this->hookup->query($this->sql);

                if($result->num_rows == 0) {
                    $this->sql = "INSERT INTO $this->tableMaster (b1_id, b1_name, b1_a1_id) VALUES (NULL, '".$this->b1_name."', '".$_SESSION['a1_id']."')";
                    $this->hookup->query($this->sql);

                    $this->sql = "SELECT MAX(b1_id) FROM $this->tableMaster";
                    $result = $this->hookup->query($this->sql);

                    while($row = $result->fetch_assoc()) {
                        $_SESSION['b1_id'] = $row['MAX(b1_id)'];
                    }

                    $this->sql = "SELECT b1_name FROM $this->tableMaster WHERE b1_id = '".$_SESSION['b1_id']."' ";
                    $result = $this->hookup->query($this->sql);

                    while($row = $result->fetch_assoc()) {
                        $_SESSION['b1_name'] = $row['b1_name'];
                    }

                    $host = $_SERVER['HTTP_HOST'];
                    $uri = ''; //folder
                    $page = 'step_2.php';
                    header("Location: http://$host/$page");
                    exit();
                    
                } else {
                    $_SESSION['error'] = true;
                    
                    $host = $_SERVER['HTTP_HOST'];
                    $uri = ''; //folder
                    $page = 'step_1.php';
                    header("Location: http://$host/$page");
                    exit();
                    
                }
            //}
            
        } catch (Exception $e) {
            print "There is a problem: ".$e->getMessage();
        
        }
    }
}
?>
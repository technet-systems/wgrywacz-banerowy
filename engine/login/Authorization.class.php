<?php
session_start();
include_once '../db/UniversalConnect.class.php';

$worker = new Authorization();

class Authorization {
    private $hookup;
    private $tableMaster;
    private $sql;
    
    //Form fields
    private $a1_nick;
    
    private $remote_addr;
    
    public function __construct() {
        $this->a1_nick = $_POST['a1_nick'];
        $this->a1_pass = hash('sha256', $_POST['a1_pass']);
        $this->remote_addr = $_SERVER['REMOTE_ADDR'];
        
        $this->tableMaster = "a1_users";
        $this->hookup = UniversalConnect::doConnect();
        
        $this->doCheck();
        
        $this->hookup->close();
    }
    
    private function doCheck() {
        $this->sql = "SELECT a1_id, a1_nick, a1_pass FROM $this->tableMaster " . 
            "WHERE a1_nick = '".$this->a1_nick."' " . 
            "AND a1_pass = '".$this->a1_pass."'";
        
        try {
            $result = $this->hookup->query($this->sql);
            
            if($result->num_rows == 1) {
                while($row = $result->fetch_assoc()) {
                    $_SESSION['a1_id'] = $row['a1_id'];
                    $_SESSION['a1_nick'] = $row['a1_nick'];
                    
                }
                $_SESSION['a1_nick'] = $this->a1_nick;
                
                //http://www.tutorialspoint.com/php/php_sessions.htm
                setcookie("access", "$this->a1_nick", time()+3600, "/","", 0);
                
                $result->close();
                
                $host = $_SERVER['HTTP_HOST'];
                $uri = ''; //folder
                $page = 'step_0.php';
                header("Location: http://$host/$page");
                exit;
                
            } else {
                $result->close();
                
                $host = $_SERVER['HTTP_HOST'];
                $uri = ''; //folder
                $page = 'index.html';
                session_destroy();
                header("Location: http://$host/$page");
                exit;
                
            }
            
        } catch (Exception $e) {
            print 'Something went wrong: ' . $e->getMessage();
        }
    }
}

?>
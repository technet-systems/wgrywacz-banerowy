<?php
session_start();
include_once '../db/UniversalConnect.class.php';

$Test = new Test();

class Test {
    private $hookup;
    private $tableMaster;
    private $sql;
    
    private $name;
    private $profession;
    
    public function __construct() {
        $this->hookup = UniversalConnect::doConnect();
        $this->tableMaster = "test";
        
        $this->name = $_GET['name'];
        $this->profession = $_GET['profession'];
        
        $this->insertData();
        $this->hookup->close();
        
    }
    
    private function insertData() {
        $this->sql = "INSERT INTO $this->tableMaster (ID, Name, Profession) VALUES (NULL, '".$this->name."', '".$this->profession."')";
        $result = $this->hookup->query($this->sql);
        
    }
    
}

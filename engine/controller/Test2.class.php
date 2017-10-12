<?php
session_start();

include_once '../db/UniversalConnect.class.php';

$Test2 = new Test2();

class Test2 {
    private $hookup;
    private $tableMaster;
    private $sql;
    
    public function __construct() {
        $this->hookup = UniversalConnect::doConnect();
        $this->tableMaster = "test";
        
        $this->showData();
        $this->hookup->close();
        
    }
    
    private function showData() {
        try {
            $this->sql = "SELECT * FROM $this->tableMaster ORDER BY ID DESC";
            $result = $this->hookup->query($this->sql);

            while($row = $result->fetch_assoc()) {
                printf('
                    <tr>
                      <td>%s</td>
                      <td>%s</td>
                      <td>%s</td>
                    </tr>
                        ', $row['ID'], $row['Name'], $row['Profession']);
            }
            
            $result->close();
            
        } catch (Exception $ex) {
            print 'Something went wrong: '.$ex->getMessage();
            
        }
        
    }
    
}

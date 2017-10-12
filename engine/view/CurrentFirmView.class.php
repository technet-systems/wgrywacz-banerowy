<?php

class CurrentFirmView {
    private $hookup;
    private $sql;
    private $tableMaster;
    
    public function __construct() {
        $this->hookup = UniversalConnect::doConnect();
        $this->tableMaster = "b1_firm";
        
        $this->viewData();
        $this->hookup->close();
    }
    
    private function viewData() {
        $this->sql = "SELECT * FROM $this->tableMaster WHERE b1_a1_id = '".$_SESSION['a1_id']."'";
        
        try {
            $result = $this->hookup->query($this->sql);
            
            while($row = $result->fetch_assoc()) {
                printf('<option value="%s">%s</option>', $row['b1_id'], $row['b1_name']);
            }
            
            $result->close();
            
        } catch (Exception $ex) {
            print 'Something went wrong: '.$e->getMessage();
            
        }
    }
}

?>
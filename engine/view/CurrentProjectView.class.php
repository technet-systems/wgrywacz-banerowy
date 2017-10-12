<?php

class CurrentProjectView {
    private $hookup;
    private $sql;
    private $tableMaster;
    
    public function __construct() {
        $this->hookup = UniversalConnect::doConnect();
        $this->tableMaster = "b2_project";
        
        $this->viewData();
        $this->hookup->close();
    }
    
    private function viewData() {
        $this->sql = "SELECT * FROM $this->tableMaster WHERE b2_b1_id = '".$_SESSION['b1_id']."'";
        
        try {
            $result = $this->hookup->query($this->sql);
            
            while($row = $result->fetch_assoc()) {
                printf('<option value="%s">%s</option>', $row['b2_id'], $row['b2_name']);
            }
            
            $result->close();
            
        } catch (Exception $ex) {
            print 'Something went wrong: '.$e->getMessage();
            
        }
    }
}

?>
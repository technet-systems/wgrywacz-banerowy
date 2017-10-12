<?php

class FinalHeaderView {
    private $hookup;
    private $sql;
    private $tableMaster1;
    private $tableMaster2;
    private $tableMaster3;
    
    private $b2_folder;
    
    public function __construct() {
        $this->tableMaster1 = "b1_firm";
        $this->tableMaster2 = "b2_project";
        $this->tableMaster3 = "c1_files";
        
        if(isset($_SESSION['b2_folder'])) {
            $this->b2_folder = $_SESSION['b2_folder'];
            
        } else {
            $b2_folder = explode('/', $_SERVER['SCRIPT_FILENAME']);
            $this->b2_folder = $b2_folder[2];
            
        }
        
    }
    
    public function showFirm() {
        $this->hookup = UniversalConnect::doConnect();
        $this->sql = "SELECT b1_name "
                . "FROM $this->tableMaster1, $this->tableMaster2 "
                . "WHERE b2_folder = '".$this->b2_folder."' "
                . "AND b2_b1_id = b1_id";
        
        try {
            $result = $this->hookup->query($this->sql);
            
            while($row = $result->fetch_assoc()) {
                $b1_name = $row['b1_name'];
                
            }
            
            $result->close();
            $this->hookup->close();
            
            return $b1_name;
            
        } catch (Exception $e) {
            print 'Something went wrong: '.$e->getMessage();
            
        }
        
    }
    
    public function showCurrentProject() {
        $this->hookup = UniversalConnect::doConnect();
        $this->sql = "SELECT b2_name "
                . "FROM $this->tableMaster2 "
                . "WHERE b2_folder = '".$this->b2_folder."'";
        
        try {
            $result = $this->hookup->query($this->sql);
            
            while($row = $result->fetch_assoc()) {
                $b2_name = $row['b2_name'];
                
            }
            
            $result->close();
            $this->hookup->close();
            
            return $b2_name;
            
        } catch (Exception $e) {
            print 'Something went wrong: '.$e->getMessage();
            
        }
        
    }
    
    public function showOtherProject() {
        $this->hookup = UniversalConnect::doConnect();
        $this->sql = "SELECT b2_name, b2_folder "
                . "FROM $this->tableMaster2 "
                . "WHERE NOT b2_folder = '".$this->b2_folder."' "
                . "AND b2_b1_id = (SELECT b2_b1_id FROM $this->tableMaster2 WHERE b2_folder = '".$this->b2_folder."')";
        
        try {
            $result = $this->hookup->query($this->sql);
            
            if($result->num_rows == 0 ) {
                printf('
                        <li role="presentation" class="disabled"><a role="menuitem" tabindex="-1" href="#">Brak innych kreacji</a></li>
                        ');
                
            } else {
                while($row = $result->fetch_assoc()) {
                    printf('
                        <li><a href="../%s/">%s</a></li>
                        ', $row['b2_folder'], $row['b2_name']);

                }
            }
            
            $result->close();
            $this->hookup->close();
            
        } catch (Exception $e) {
            print 'Something went wrong: '.$e->getMessage();
            
        }
        
    }
    
    public function showOtherDimensions() {
        $this->hookup = UniversalConnect::doConnect();
        $this->sql = "SELECT c1_width, c1_height "
                . "FROM $this->tableMaster3 "
                . "WHERE c1_b2_id = (SELECT b2_id FROM $this->tableMaster2 "
                . "WHERE b2_folder = '".$this->b2_folder."')";
        
        try {
            $result = $this->hookup->query($this->sql);
            
            if($result->num_rows <= 1 ) {
                printf('
                        <li role="presentation" class="disabled"><a role="menuitem" tabindex="-1" href="#">Brak dostępnych wymiarów</a></li>
                        ');
                
            } else {
                $id = 0;
                
                while($row = $result->fetch_assoc()) {
                    printf('
                        <li><a href="#%s" class="show_banner">%sx%s</a></li>
                        ', $id, $row['c1_width'], $row['c1_height']);
                    
                    $id++;
                    
                }
            }
            
            $result->close();
            $this->hookup->close();
            
        } catch (Exception $e) {
            print 'Something went wrong: '.$e->getMessage();

        }
        
    }
    
}

$FinalHeaderView = new FinalHeaderView();

?>
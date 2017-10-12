<?php

class FinalBannersView {
    private $hookup;
    private $sql;
    private $tableMaster1;
    private $tableMaster2;
    private $tableMaster3;
    
    private $b2_folder;
    
    public function __construct() {
        $this->hookup = UniversalConnect::doConnect();
        $this->tableMaster1 = "b1_firm";
        $this->tableMaster2 = "b2_project";
        $this->tableMaster3 = "c1_files";
        
        if(isset($_SESSION['b2_folder'])) {
            $this->b2_folder = $_SESSION['b2_folder'];
            
        } else {
            $b2_folder = explode('/', $_SERVER['SCRIPT_FILENAME']);
            $this->b2_folder = $b2_folder[2];
            
        }
        
        $this->viewData();
        $this->hookup->close();
        
    }
    
    private function viewData() {
        $this->sql = "SELECT c1_name, c1_description, c1_height, c1_width "
                . "FROM $this->tableMaster3, $this->tableMaster2 "
                . "WHERE b2_folder = '".$this->b2_folder."' "
                . "AND b2_id = c1_b2_id";
        
        try {
            $result = $this->hookup->query($this->sql);
            $id = 0;
            
            while($row = $result->fetch_assoc()) {
                $extension_check = explode('.', $row['c1_name']);
                
                if($extension_check[2] == 'swf') {
                    printf('<div class="hide_banner" id="%s">
                            <div class="dimension_%sx%s" style="border: 2px dashed #ccc; padding: 15px; margin: 0 auto; height: %s; width: %s;"><center><embed src="../../examples/'.$this->b2_folder.'/%s" quality="high" allowscriptaccess="always" type="application/x-shockwave-flash" pluginspage="http://www.macromedia.com/go/getflashplayer" align="middle" height="%s" width="%s"></embed></center></div>
                            <div class="row dimension_%sx%s">
                                <div class="col-md-offset-4 col-md-4 col-md-offset-4">
                                    <div class="alert alert-success Margin-top-15 c1_description" role="alert">%s %sx%s</div>
                                </div>
                            </div>
                            <!--<hr class="banners">-->
                            </div>
                    ', $id, 
                       $row['c1_width'], $row['c1_height'], $row['c1_height'], $row['c1_width'], $row['c1_name'], $row['c1_height'], $row['c1_width'], 
                       $row['c1_width'], $row['c1_height'], 
                       $row['c1_description'], $row['c1_width'], $row['c1_height']);
                
                } else {
                    printf('<div class="hide_banner" id="%s">
                            <div id="dimension_%sx%s" style="border: 2px dashed #ccc; padding: 15px; margin: 0 auto; height: %s; width: %s;"><center><img src="../../examples/'.$this->b2_folder.'/%s" height="%s" width="%s"></center></div>
                            <div class="row dimension_%sx%s">
                                <div class="col-md-offset-4 col-md-4 col-md-offset-4">
                                    <div class="alert alert-success Margin-top-15 c1_description" role="alert">%s %sx%s</div>
                                </div>
                            </div>
                            <!--<hr class="banners">-->
                            </div>
                    ', $id, 
                       $row['c1_width'], $row['c1_height'], $row['c1_height'], $row['c1_width'], $row['c1_name'], $row['c1_height'], $row['c1_width'], 
                       $row['c1_width'], $row['c1_height'], 
                       $row['c1_description'], $row['c1_width'], $row['c1_height']);
                    
                }
                
                $id++;
                
            }
            
            $result->close();
            
        } catch (Exception $e) {
            print 'Something went wrong: '.$e->getMessage();

        }
        
    }
    
    
}

?>
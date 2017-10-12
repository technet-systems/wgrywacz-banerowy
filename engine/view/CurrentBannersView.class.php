<?php

class CurrentBannersView {
    private $hookup;
    private $sql;
    private $tableMaster;
    
    public function __construct() {
        $this->hookup = UniversalConnect::doConnect();
        $this->tableMaster = "c1_files";
        
        $this->viewData();
        $this->hookup->close();
    }
    
    private function viewData() {
        $this->sql = "SELECT * FROM $this->tableMaster WHERE c1_b2_id = '".$_SESSION['b2_id']."' ";
        
        try {
            $result = $this->hookup->query($this->sql);
            $_SESSION['step_4_next_check'] = $result->num_rows;

            while($row = $result->fetch_assoc()) {
                $extension_check = explode('.', $row['c1_name']);
                
                if($extension_check[2] == 'swf') {
                
                    printf('<div class="row">
                                <div class="col-md-12">
                                    <center><embed src="examples/'.$_SESSION['b2_folder'].'/%s" quality="high" allowscriptaccess="always" type="application/x-shockwave-flash" pluginspage="http://www.macromedia.com/go/getflashplayer" align="middle" height="%s" width="%s"></embed></center>
                                </div>
                                <div class="col-md-offset-4 col-md-4 col-md-offset-4">
                                    <form class="form-horizontal Margin-top-30" role="form" action="engine/controller/Access.class.php?c1_id=%s" method="POST">
                                        <div class="form-group has-success">
                                            <label for="inputName" class="col-sm-2 control-label">Nazwa</label>
                                                <div class="col-sm-10">
                                                <div class="input-group">
                                                <div class="input-group-addon"><span class="glyphicon glyphicon-tag"></span></div>
                                                    <input type="text" class="form-control" id="inputName" disabled value="%s">
                                                </div>
                                                </div>
                                        </div>

                                        <div class="form-group has-success">
                                            <label for="inputHeight" class="col-sm-2 control-label">Wysokość</label>
                                                <div class="col-sm-10">
                                                <div class="input-group">
                                                <div class="input-group-addon"><span class="glyphicon glyphicon-resize-vertical"></span></div>
                                                    <input type="number" name="c1_height" class="form-control" id="inputHeight" value="%s">
                                                </div>
                                                </div>
                                        </div>

                                        <div class="form-group has-success">
                                            <label for="inputWidth" class="col-sm-2 control-label">Szerokość</label>
                                                <div class="col-sm-10">
                                                <div class="input-group">
                                                <div class="input-group-addon"><span class="glyphicon glyphicon-resize-horizontal"></span></div>
                                                    <input type="number" name="c1_width" class="form-control" id="inputWidth" value="%s">
                                                </div>
                                                </div>
                                        </div>

                                        <div class="form-group has-success">
                                            <label for="inputDescription" class="col-sm-2 control-label">Opis</label>
                                                <div class="col-sm-10">
                                                <div class="input-group">
                                                <div class="input-group-addon"><span class="glyphicon glyphicon-pencil"></span></div>
                                                    <input type="text" name="c1_description" class="form-control" placeholder="Opis bannera" value="%s" id="inputDescription">
                                                </div>
                                                </div>
                                        </div>                                    

                                        <div class="form-group">
                                            <div class="col-sm-offset-2 col-sm-10">
                                                <div class="btn-group pull-right">
                                                    <button type="submit" name="step_4_update" class="btn btn-success">Aktualizuj</button>
                                                    <button type="submit" name="step_4_delete" class="btn btn-danger">Usuń</button>
                                                </div>
                                            </div>
                                        </div>
                                    </form>
                                    <hr class="banners">
                                </div>
                            </div>
                            ', $row['c1_name'], $row['c1_height'], $row['c1_width'], $row['c1_id'], $row['c1_old_name'], $row['c1_height'], $row['c1_width'], $row['c1_description']);

            } else {
                printf('<div class="row">
                                <div class="col-md-12">
                                    <center><img src="examples/'.$_SESSION['b2_folder'].'/%s" height="%s" width="%s"></center>
                                </div>
                                <div class="col-md-offset-4 col-md-4 col-md-offset-4">
                                    <form class="form-horizontal Margin-top-30" role="form" action="engine/controller/Access.class.php?c1_id=%s" method="POST">
                                        <div class="form-group has-success">
                                            <label for="inputName" class="col-sm-2 control-label">Nazwa</label>
                                                <div class="col-sm-10">
                                                <div class="input-group">
                                                <div class="input-group-addon"><span class="glyphicon glyphicon-tag"></span></div>
                                                    <input type="text" class="form-control" id="inputName" disabled value="%s">
                                                </div>
                                                </div>
                                        </div>

                                        <div class="form-group has-success">
                                            <label for="inputHeight" class="col-sm-2 control-label">Wysokość</label>
                                                <div class="col-sm-10">
                                                <div class="input-group">
                                                <div class="input-group-addon"><span class="glyphicon glyphicon-resize-vertical"></span></div>
                                                    <input type="number" name="c1_height" class="form-control" id="inputHeight" value="%s">
                                                </div>
                                                </div>
                                        </div>

                                        <div class="form-group has-success">
                                            <label for="inputWidth" class="col-sm-2 control-label">Szerokość</label>
                                                <div class="col-sm-10">
                                                <div class="input-group">
                                                <div class="input-group-addon"><span class="glyphicon glyphicon-resize-horizontal"></span></div>
                                                    <input type="number" name="c1_width" class="form-control" id="inputWidth" value="%s">
                                                </div>
                                                </div>
                                        </div>

                                        <div class="form-group has-success">
                                            <label for="inputDescription" class="col-sm-2 control-label">Opis</label>
                                                <div class="col-sm-10">
                                                <div class="input-group">
                                                <div class="input-group-addon"><span class="glyphicon glyphicon-pencil"></span></div>
                                                    <input type="text" name="c1_description" class="form-control" placeholder="Opis bannera" value="%s" id="inputDescription">
                                                </div>
                                                </div>
                                        </div>                                    

                                        <div class="form-group">
                                            <div class="col-sm-offset-2 col-sm-10">
                                                <div class="btn-group pull-right">
                                                    <button type="submit" name="step_4_update" class="btn btn-success">Aktualizuj</button>
                                                    <button type="submit" name="step_4_delete" class="btn btn-danger">Usuń</button>
                                                </div>
                                            </div>
                                        </div>
                                    </form>
                                    <hr class="banners">
                                </div>
                            </div>
                            ', $row['c1_name'], $row['c1_height'], $row['c1_width'], $row['c1_id'], $row['c1_old_name'], $row['c1_height'], $row['c1_width'], $row['c1_description']);
                
            }
            }
            
            $result->close();
            
        } catch (Exception $e) {
            print 'Something went wrong: '.$e->getMessage();

        }
        
    }
    
}

<?php

class TableView {
    private $hookup;
    private $sql;
    private $tableMaster1;
    private $tableMaster2;
    
    public function __construct() {
        $this->hookup = UniversalConnect::doConnect();
        $this->tableMaster1 = "b1_firm";
        $this->tableMaster2 = "b2_project";
        
        $this->viewTable();
        $this->hookup->close();
        
    }
    
    private function viewTable() {
        $this->sql = "SELECT b1_id, b1_name, b2_id, b2_name, b2_folder FROM $this->tableMaster1, $this->tableMaster2 WHERE b1_id = b2_b1_id AND b1_a1_id = '".$_SESSION['a1_id']."'";
        
        try {
            $result = $this->hookup->query($this->sql);
        
            while($row = $result->fetch_assoc()) {
                $url = '/examples/'.$row['b2_folder'].'/index.php';
                if (file_exists($url)) {
                    $filename = 1;
                } else {
                    $filename = 0;
                }
                
                printf('
                        <tr>
                            <td>%s <a href="#" style="float: right;"><i class="fa fa-pencil fa-fw" data-toggle="modal" data-target="#b1_name%s" id="modal"></i></a></td>
                            <td>%s <a href="#" style="float: right;"><i class="fa fa-pencil fa-fw" data-toggle="modal" data-target="#b2_name%s" id="modal"></i></a></td>
                            <td>
                            <form action="engine/controller/Access.class.php?b1_id=%s&b2_id=%s" method="POST" role="form">
                                <div class="btn-group btn-group-xs pull-right">
                                    <a href="http://%s/examples/%s" target="_blank" role="button" class="btn btn-success" %s><i class="fa fa-search"></i> Podgląd</a>
                                    <button type="submit" name="step_0_edit" class="btn btn-warning"><i class="fa fa-paint-brush"></i> Edycja</button>
                                    <a href="#" role="button" class="btn btn-danger" data-toggle="modal" data-target="#b2_name%sdelete" id="modal"><i class="fa fa-trash"></i> Usuń</a>
                                </div>
                            </form>
                            
                            <!-- Modal "zmiana nazwy Firmy" -->
                            <div class="modal fade" id="b1_name%s" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                                <div class="modal-dialog">
                                    <form role="form" action="engine/controller/Access.class.php?b1_id=%s" method="POST">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
                                            <h4 class="modal-title" id="myModalLabel">zmiana nazwy Firmy</h4>
                                        </div>
                                        <div class="modal-body">

                                            <div class="form-group has-success Margin-top-30">
                                                <input type="text" name="b1_name" class="form-control" value="%s" required title="wprowadź min. 3 znaki" pattern=".{3,}">
                                            </div>

                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-default Button_style" data-dismiss="modal">Anuluj</button>
                                            <button type="submit" name="step_0_change_name" class="btn btn-success Button_style">Zmień</button>
                                        </div>

                                    </div>
                                  </form>
                                </div>
                            </div>
                            
                            <!-- Modal "zmiana nazwy projektu" -->
                            <div class="modal fade" id="b2_name%s" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                                <div class="modal-dialog">
                                    <form role="form" action="engine/controller/Access.class.php?b2_id=%s" method="POST">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
                                            <h4 class="modal-title" id="myModalLabel">zmiana nazwy projektu</h4>
                                        </div>
                                        <div class="modal-body">

                                            <div class="form-group has-success Margin-top-30">
                                                <input type="text" name="b2_name" class="form-control" value="%s" required title="wprowadź min. 3 znaki" pattern=".{3,}">
                                            </div>

                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-default Button_style" data-dismiss="modal">Anuluj</button>
                                            <button type="submit" name="step_0_change_name" class="btn btn-success Button_style">Zmień</button>
                                        </div>

                                    </div>
                                  </form>
                                </div>
                            </div>
                            
                            <!-- Modal "usunięcie projektu" -->
                            <div class="modal fade" id="b2_name%sdelete" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                                <div class="modal-dialog">
                                    <form role="form" action="engine/controller/Access.class.php?b2_id=%s" method="POST">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
                                            <h4 class="modal-title" id="myModalLabel">Usunięcie projektu: <b>%s</b></h4>
                                        </div>
                                        <div class="modal-body">
                                            <i class="fa fa-warning fa-2x fa-fw Margin-top-15" style="color: #5dbb46;"></i> <b>UWAGA!</b> Czy na pewno chcesz usunąć projekt wraz ze wszystkimi plikami?
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-default Button_style" data-dismiss="modal">Anuluj</button>
                                            <button type="submit" name="step_0_delete" class="btn btn-danger Button_style">Usuń</button>
                                        </div>

                                    </div>
                                  </form>
                                </div>
                            </div>

                            </td>
                        </tr>
                        ', $row['b1_name'], $row['b1_id'], $row['b2_name'], $row['b2_id'], $row['b1_id'], $row['b2_id'], $_SERVER['HTTP_HOST'], $row['b2_folder'], $filename == 0 ? 'disabled="disabled"' : '', $row['b2_id'], $row['b1_id'], $row['b1_id'], $row['b1_name'], $row['b2_id'], $row['b2_id'], $row['b2_name'], $row['b2_id'], $row['b2_id'], $row['b2_name']);

            }

            $result->close();
            
        } catch (Exception $e) {
            print 'Something went wrong: '.$e->getMessage();
            
        }
        
        
        
    }
    
}

<?php
include 'header.php';
?>

        <div class="row">
            <div class="col-md-12 Margin-top-30">
                <p>wybór Klienta lub utworzenie nowego...</p>
                <hr>
            </div>
        </div>
        <div class="row">
            <div class="col-md-offset-4 col-md-4 col-md-offset-4">
                <form role="form" action="engine/controller/Access.class.php" method="POST">
                    <div class="form-group has-success">
                        
<!--                        <div class="ui-widget">
                                <select id="combobox" name="b1_id" class="form-control">
                                    <option value="#">Wybierz...</option>
                                </select>
                            </div>-->
                            <div class="Margin-top-30">
                                <?php if($_SESSION['error'] == TRUE) { ?>
                                <div class="alert alert-warning alert-dismissible" role="alert" id="error">
                                    <button type="button" class="close" data-dismiss="alert"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
                                    <i class="fa fa-warning fa-2x"></i> <strong>Uwaga!</strong> Nazwa Firmy już istnieje.
                                </div>
                                <?php unset($_SESSION['error']); } ?>
                            <select id="select" name="b1_id" class="form-control">
                                <option value="#">Wybierz...</option>
                                <?php
                                $CurrentFirmView = new CurrentFirmView();
                                ?>
                            </select>
                            </div>
                    </div>
                    <button type="submit" name="step_1_next" class="btn btn-success pull-right Button_style" id="next" disabled="disabled">Dalej</button>
                </form>
                <button class="btn btn-success pull-left Button_style" data-toggle="modal" data-target="#myModal" id="modal">Nowa Firma</button>
            </div>
        </div>
        
        <div class="row">
            <div class="col-md-offset-2 col-md-4 col-md-offset-4 col-md-offset-2">
                <!-- test AJAX -->
                <form role="form" action="engine/controller/Test.class.php" method="get">
                    <div class="form-group">
                      <label for="exampleInputName">Name</label>
                      <input type="text" class="form-control" id="InputName1" placeholder="Enter your name" name="name">
                    </div>
                    <div class="form-group">
                      <label for="exampleInputProfession">Profession</label>
                      <input type="text" class="form-control" id="InputProfession1" placeholder="Enter your profession" name="profession">
                    </div>
                    <button type="button" class="btn btn-default" id="submit1">Submit</button>
                </form>
                
            </div>
            
            <div class="col-md-4">
                <table class="table">
                        <thead>
                          <tr>
                            <th>#</th>
                            <th>Name</th>
                            <th>Profession</th>
                          </tr>
                        </thead>
                        <tbody id="table_test">
                
                            </tbody>
                    </table>
            </div>
        </div>
            
<!-- Modal 'Nowa Firma'-->
<div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <form role="form" action="engine/controller/Access.class.php" method="POST">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
        <h4 class="modal-title" id="myModalLabel">tworzenie nowej Firmy</h4>
      </div>
      <div class="modal-body">
        
        <div class="form-group has-success Margin-top-30">
            <input type="text" name="b1_name" class="form-control" placeholder="wpisz nazwę Firmy" required title="wprowadź min. 3 znaki" pattern=".{3,}">
        </div>
        
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default Button_style" data-dismiss="modal">Anuluj</button>
        <button type="submit" name="step_1_new" class="btn btn-success Button_style">Dalej</button>
      </div>
        
    </div>
    </form>
  </div>
</div>

<?php
include 'footer.php';
?>
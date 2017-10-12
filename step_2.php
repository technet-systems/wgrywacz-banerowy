<?php
include 'header.php';
?>

        <div class="row">
            <div class="col-md-12 Margin-top-30">
                <p><span><?php print $_SESSION['b1_name']; ?></span> <i class="fa fa-angle-double-right"></i> wybór projektu lub utworzenie nowego...</p>
                <hr>
            </div>
        </div>
        <div class="row">
            <div class="col-md-offset-4 col-md-4 col-md-offset-4">
                <form role="form" action="engine/controller/Access.class.php" method="POST">
                    <div class="form-group has-success">
                        
                        <div class="Margin-top-30">
                            <select id="select" name="b2_id" class="form-control">
                                <option value="#">Wybierz...</option>
                                <?php 
                                $CurrentProjectView = new CurrentProjectView();
                                ?>
                            </select>
                        </div>
                    </div>
                      <button type="submit" name="step_2_next" class="btn btn-success pull-right Button_style" id="next" disabled="disabled">Dalej</button>
                </form>
                <button class="btn btn-success pull-left Button_style" data-toggle="modal" data-target="#myModal" id="modal">Nowy projekt</button>
            </div>
        </div>
        <div class="row">
            <div class="col-md-12">


 

            </div>
        </div>
    </div>
    
<!-- Modal 'Nowa Firma'-->
<div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <form role="form" action="engine/controller/Access.class.php" method="POST">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
        <h4 class="modal-title" id="myModalLabel">tworzenie nowego projektu</h4>
      </div>
      <div class="modal-body">
        
        <div class="form-group has-success Margin-top-30">
            <input type="text" name="b2_name" class="form-control" placeholder="wpisz nazwę projektu">
        </div>
        
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default Button_style" data-dismiss="modal">Anuluj</button>
        <button type="submit" name="step_2_new" class="btn btn-success Button_style">Dalej</button>
      </div>
        
    </div>
    </form>
  </div>
</div>

<?php
include 'footer.php';
?>
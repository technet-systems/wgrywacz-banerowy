<?php
include 'header.php';
?>

        <div class="row">
            <div class="col-md-12 Margin-top-30">
                <p>wyszukiwacz Klientów i projektów...</p>
                <hr>
            </div>
        </div>

        <div class="row">
            <div class="col-md-offset-2 col-md-8 col-md-offset-2 has-success Margin-top-30">
                
                <table id="example" class="table table-striped table-bordered table-hover" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th>Klient</th>
                            <th>Projekt</th>
                            <th style="width: 171px;">Akcja</th>
                        </tr>
                    </thead>

                    <tfoot>
                        <tr>
                            <th>Klient</th>
                            <th>Projekt</th>
                            <th style="width: 171px;">Akcja</th>
                        </tr>
                    </tfoot>

                    <tbody>
                        <?php $TableView = new TableView(); ?>
                    </tbody>
                </table>
                
                <?php 
                if(isset($_SESSION['b2_folder_check'])) { ?>
                    <script>window.open("http://<?php print $_SERVER['HTTP_HOST'].'/examples/'.$_SESSION['b2_folder_check']; ?>");</script>
                <?php 
                unset($_SESSION['b2_folder_check']);
                } 
                ?>
                
<!-- Modal 'zmiana nazwy projektu'-->
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
                
            </div>
        </div>

<?php
include 'footer.php';
?>
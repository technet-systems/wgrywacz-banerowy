<?php
include 'header.php';
?>

        <div class="row">
            <div class="col-md-12 Margin-top-30">
                <p><span><?php print $_SESSION['b1_name']; ?></span> <i class="fa fa-angle-double-right"></i> <span><?php print $_SESSION['b2_name']; ?></span> <i class="fa fa-angle-double-right"></i> dodanie banerów...</p>
                <hr>
            </div>
        </div>
        <div class="row">
            <div class="col-md-offset-4 col-md-4 col-md-offset-4">
                <form role="form" action="engine/controller/Access.class.php" method="POST" id="upload" enctype="multipart/form-data">
                    
                    <div id="drop">
                        Przeciągnij

                        <a>Wyszukaj</a>
                        <input type="file" name="step_3_new" multiple>
                    </div>
                    <ul>
                            <!-- The file uploads will be shown here -->
                    </ul>

                </form>
                
                
            </div>
        </div>
        <div class="row">
            <div class="col-md-offset-4 col-md-4 col-md-offset-4">
                <form role="form" action="engine/controller/Access.class.php" method="POST" class="Margin-top-30">
                    <button type="submit" name="step_3_next" class="btn btn-success pull-right Button_style">Dalej</button>
                </form>
            </div>
        </div>
    </div>
    
<?php
include 'footer.php';
?>
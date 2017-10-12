<?php
include 'header.php';
?>

        <div class="row">
            <div class="col-md-12 Margin-top-30">
                <p><span><?php print $_SESSION['b1_name']; ?></span> <i class="fa fa-angle-double-right"></i> <span><?php print $_SESSION['b2_name']; ?></span> <i class="fa fa-angle-double-right"></i> edycja banerów...</p>
                <hr>
            </div>
        </div>

        <?php
        $CurrentBannersView = new CurrentBannersView();
        ?>

        <div class="row">
            <div class="col-md-offset-4 col-md-4 col-md-offset-4 Margin-bottom-15">
                <?php
                if($_SESSION['step_4_next_check'] > 0)
                    print '
                        <form role="form" action="engine/controller/Access.class.php" method="POST">
                            <button type="submit" name="step_4_next" class="btn btn-success pull-right Button_style">Generuj podgląd</button>
                        </form>
                    ';
                
                else {
                    print '
                        <div class="panel panel-success">
                            <div class="panel-heading">
                                <h3 class="panel-title"><i class="fa fa-warning fa-2x"></i></h3>
                            </div>
                            <div class="panel-body">
                                Brak bannerów do wyświetlenia...
                            </div>
                        </div>
                        
                        <a href="step_3.php" class="btn btn-default pull-right Button_style" role="button">Wstecz</a>
                    ';
                    
                }
                ?>
            </div>
        </div>
                
        </div>
        
    </div>
    
<?php
include 'footer.php';
?>
<?php
session_start();

class NewPage {
    private $step_4_next;
    
    public function __construct() {
        $this->step_4_next = $_POST['step_4_next'];
        
        $this->doConfirm();
        $this->createPage();
        
    }
    
    private function doConfirm() {
        try {
            $_SESSION['step_4_next'] = $this->step_4_next;
        
            $host = $_SERVER['HTTP_HOST'];
            $uri = ''; //folder
            $page = 'step_5.php';
            header("Location: http://$host/$page");
            
        } catch (Exception $e) {
            print 'Something went wrong: ' . $e->getMessage();

        }
        
    }
    
    private function createPage() {
        try {
            $file = fopen("index.php", "w+");
            $txt = '
            
<?php
include_once "../../engine/db/UniversalConnect.class.php";
include_once "../../engine/view/FinalBannersView.class.php";
include_once "../../engine/view/FinalHeaderView.class.php";
?>            
<!DOCTYPE html>
<html lang="pl">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Kreacja banerow do Sieci reklamowej Google dla <?php print $FinalHeaderView->showFirm(); ?></title>

    <!-- Bootstrap -->
    <link href="../../css/bootstrap.css" rel="stylesheet">
    
    <!-- Font Awesome -->
    <link rel="stylesheet" href="../../fonts/font-awesome-4.2.0/css/font-awesome.min.css">
    
    <!-- jQuery UI CSS -->
    <link rel="stylesheet" href="../../js/jquery-ui/jquery-ui.css">
    <link rel="stylesheet" href="../../js/jquery-ui/jquery-ui.structure.css">
    <link rel="stylesheet" href="../../js/jquery-ui/jquery-ui.theme.css">
    
    <!-- Google web fonts -->
    <link href="http://fonts.googleapis.com/css?family=PT+Sans+Narrow:400,700" rel="stylesheet">
    
    <!-- Style -->
    <link href="../../css/style.css" rel="stylesheet">
    
    <!-- Style only for display -->
    <link href="../../css/show_banner.css" rel="stylesheet">

    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesnt work if you view the page via file:// -->
    <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
      <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
    <style>
        /*
        [class*="col-"]{
            background-color: rgba(255,195,50,.3);
            border: 1px solid rgba(255,195,50,.4);
            padding: 10px;
        }
        */
    </style>

</head>
<body>
    
    <nav class="navbar navbar-default navbar-fixed-top" role="navigation" id="Header-nav">
        <div class="container-fluid">
            <img src="../../images/logo.png" class="pull-left" id="Header-img-link">
            
            <div id="Header-nav-link">
                
                <div class="btn-group navbar-right">
                    <button type="button" class="btn btn-default btn-lg" disabled="disabled"><?php print $FinalHeaderView->showFirm(); ?></button>

                    <div class="btn-group">
                        <button type="button" class="btn btn-default dropdown-toggle btn-lg" data-toggle="dropdown">
                        <?php print $FinalHeaderView->showCurrentProject(); ?>
                        <span class="caret"></span>
                        </button>
                        <ul class="dropdown-menu" role="menu">
                            <?php print $FinalHeaderView->showOtherProject(); ?>
                        </ul>
                    </div>
                    
                    <div class="btn-group">
                        <button type="button" class="btn btn-default dropdown-toggle btn-lg" data-toggle="dropdown">
                        Formaty reklam
                        <span class="caret"></span>
                        </button>
                        <ul class="dropdown-menu" role="menu">
                            <?php print $FinalHeaderView->showOtherDimensions(); ?>
                        </ul>
                    </div>
                    
                </div>
            </div>
        </div>
    </nav>
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12 Margin-top-95">
                <?php
                $FinalBannersView = new FinalBannersView();
                ?>
            </div>
        </div>
    </div>
    
    <footer>
        <div class="navbar-fixed-bottom"></div>
        <div id="bg-page-icons"></div>
        <nav class="navbar navbar-default" role="navigation" id="Header-nav-bottom">
            <div class="container-fluid">
              <!-- Brand and toggle get grouped for better mobile display -->
              <div class="navbar-header">
                <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
                  <a class="navbar-brand" href="http://4people.pl" target="_blank"><img src="../../images/page-footer-logo.png"></a>
              </div>

              <!-- Collect the nav links, forms, and other content for toggling -->
              <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
<!--                <ul class="nav navbar-nav">
                    <li><a href="mailto:napisz@4people.pl"><i class="fa fa-envelope-o"></i> Napisz</a></li>
                    <li class="dropup">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown"><i class="fa fa-users"></i> Znajdź nas <span class="caret"></span></a>
                      <ul class="dropdown-menu" role="menu">
                          <li><a href="https://www.facebook.com/4peoplepl" target="_blank"><i class="fa fa-facebook-square fa-fw"></i> Facebook</a></li>
                          <li><a href="https://twitter.com/4peoplepl" target="_blank"><i class="fa fa-twitter-square fa-fw"></i> Twitter</a></li>
                          <li><a href="https://twitter.com/4peoplepl" target="_blank"><i class="fa fa-google-plus-square fa-fw"></i> Google+</a></li>

                      </ul>
                    </li>
                </ul>-->
                <ul class="nav navbar-nav navbar-right">
                  <li><a href="mailto:napisz@4people.pl"><i class="fa fa-envelope-o"></i> Napisz</a></li>
                    <li class="dropup">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown"><i class="fa fa-users"></i> Znajdź nas <span class="caret"></span></a>
                      <ul class="dropdown-menu" role="menu">
                          <li><a href="https://www.facebook.com/4peoplepl" target="_blank"><i class="fa fa-facebook-square fa-fw"></i> Facebook</a></li>
                          <li><a href="https://twitter.com/4peoplepl" target="_blank"><i class="fa fa-twitter-square fa-fw"></i> Twitter</a></li>
                          <li><a href="https://twitter.com/4peoplepl" target="_blank"><i class="fa fa-google-plus-square fa-fw"></i> Google+</a></li>

                      </ul>
                    </li>
                </ul>
<!--                <ul class="nav navbar-nav navbar-right">
                  <li><a href="#">Link</a></li>
                  <li class="dropdown">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown">Dropdown <span class="caret"></span></a>
                    <ul class="dropdown-menu" role="menu">
                      <li><a href="#">Action</a></li>
                      <li><a href="#">Another action</a></li>
                      <li><a href="#">Something else here</a></li>
                      <li class="divider"></li>
                      <li><a href="#">Separated link</a></li>
                    </ul>
                  </li>
                </ul>-->
              </div><!-- /.navbar-collapse -->
            </div><!-- /.container-fluid -->
        </nav>
    </footer>
        
    <!-- jQuery (necessary for Bootstraps JavaScript plugins) -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
    <!-- Include all compiled plugins (below), or include individual files as needed -->
    <script src="../../js/bootstrap.min.js"></script>
    
    <!-- banner .js scripts -->
    <script src="../../js/banner_script.js"></script> 
    
</body>
</html>
                    
';
            
            fwrite($file, $txt);
            fclose($file);
            
            $file_old = '/engine/controller/index.php';
            $file_new = '/examples/'.$_SESSION['b2_folder'].'/index.php';
            
            rename($file_old, $file_new) or die('Unable to rename...');
            
        } catch (Exception $e) {
            print 'Something went wrong: '.$e->getMessage();

        }
    }
    
}

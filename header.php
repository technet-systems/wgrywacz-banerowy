<?php
session_start();
include_once 'engine/db/UniversalConnect.class.php';
include_once 'engine/login/AuthorizationCheck.class.php';
include_once 'engine/view/CurrentFirmView.class.php';
include_once 'engine/view/CurrentProjectView.class.php';
include_once 'engine/view/CurrentBannersView.class.php';
include_once 'engine/view/FinalBannersView.class.php';
include_once 'engine/view/TableView.class.php';
?>

<!DOCTYPE html>
<html lang="pl">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Wgrywacz banerowy</title>

    <!-- Bootstrap -->
    <link href="css/bootstrap.css" rel="stylesheet">
    
    <!-- Font Awesome -->
    <link rel="stylesheet" href="fonts/font-awesome-4.2.0/css/font-awesome.min.css">
    
    <!-- jQuery UI CSS -->
    <link rel="stylesheet" href="js/jquery-ui/jquery-ui.css">
    <link rel="stylesheet" href="js/jquery-ui/jquery-ui.structure.css">
    <link rel="stylesheet" href="js/jquery-ui/jquery-ui.theme.css">
    
    <!-- Google web fonts -->
    <link href="http://fonts.googleapis.com/css?family=PT+Sans+Narrow:400,700" rel="stylesheet">
    
    <!-- Style -->
    <link href="css/style.css" rel="stylesheet">
    
    <!-- Data Tables -->
    <link href="css/dataTables/jquery.dataTables.css" rel="stylesheet">
    <link href="http://cdn.datatables.net/plug-ins/725b2a2115b/integration/bootstrap/3/dataTables.bootstrap.css" rel="stylesheet">

    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
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
    
    <nav class="navbar navbar-default" role="navigation" id="Header-nav">
        <div class="container-fluid">
            <a href="step_1.php"><img src="images/logo.png" class="pull-left" id="Header-img"></a>
       
            <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
                <ul class="nav navbar-nav">
                    <li><a href="step_0.php">LISTA PROJEKTÓW</a></li>
                    <li class="active"><a href="step_1.php">DODAJ PROJEKT</a></li>
                </ul>
                <?php //print_r($_SESSION); ?>
                <ul class="nav navbar-nav navbar-right">
                    <li><a href="engine/controller/Access.class.php?LogOff=TRUE">Wyloguj</a></li>
                </ul>
            </div><!-- /.navbar-collapse -->
        </div>
    </nav>
    
    <div class="container-fluid">
        
        <?php
        if($_SERVER['PHP_SELF'] != '/step_0.php') {
        ?>
        <div class="row">
            <div class="col-md-12">
                <ul class="wizzardStep">
                    <li class="active"> <a href="step_1.php"
                    <?php
                    if($_SERVER['PHP_SELF'] == '/step_1.php') {
                        unset($_SESSION['b1_id']);
                        unset($_SESSION['b1_name']);
                        unset($_SESSION['b2_id']);
                        unset($_SESSION['b2_name']);
                        unset($_SESSION['b2_folder']);
                        unset($_SESSION['step_3_next']);
                        unset($_SESSION['step_4_next']);
                        unset($_SESSION['step_4_next_check']);
                    
                    }
                    ?>
                    ><i class="fa fa-users"></i><span>KLIENT</span></a></li>
                    
                    <li> <a href="step_2.php" 
                    <?php 
                    if(!isset($_SESSION['b1_id'])) {
                        print 'class="disabled"';
                    }
                    
                    if($_SERVER['PHP_SELF'] == '/step_2.php') {
                        unset($_SESSION['b2_id']);
                        unset($_SESSION['b2_name']);
                        unset($_SESSION['b2_folder']);
                        unset($_SESSION['step_3_next']);
                        unset($_SESSION['step_4_next']);
                        unset($_SESSION['step_4_next_check']);
                    
                    }
                    ?>
                    ><i class="fa fa fa-folder-open"></i> <span>PROJEKT</span></a></li>
                    
                    <li> <a href="step_3.php" 
                    <?php 
                    if(!isset($_SESSION['b2_id'])) {
                        print 'class="disabled"';
                    }
                    ?>
                    ><i class="fa fa-file-image-o"></i><span>BANNERY</span></a></li>
                    
                    <li> <a href="step_4.php" 
                    <?php 
                    if(!isset($_SESSION['step_3_next'])) {
                        print 'class="disabled"';
                    }
                    ?>
                    ><i class="fa fa-paint-brush"></i><span>EDYCJA</span></a></li>
                    
                    <li> <a href="step_5.php" 
                    <?php 
                    if(!isset($_SESSION['step_4_next'])) {
                        print 'class="disabled"';
                    }
                    ?>
                    ><i class="fa fa-search"></i><span>PODGLĄD</span></a></li>
                </ul>
                
            </div>
        </div>
        <?php } ?>
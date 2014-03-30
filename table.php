<?php

    include("helpers.php"); 
    session_start();

    if(!isset($_SESSION['user'])){
        header( 'Location: ./' ) ;
    }

    const API = "http://107.170.211.108/tutorvirtual/v1/api.php?rquest=";
    
    $login = array("token" => $_SESSION['token']);

    $result = json_decode(CallAPI("POST", API."getCarga", $login));

?>

<!DOCTYPE html>
<!--[if lt IE 7]>      <html class="no-js lt-ie9 lt-ie8 lt-ie7"> <![endif]-->
<!--[if IE 7]>         <html class="no-js lt-ie9 lt-ie8"> <![endif]-->
<!--[if IE 8]>         <html class="no-js lt-ie9"> <![endif]-->
<!--[if gt IE 8]><!--> <html class="no-js"> <!--<![endif]-->
<head>
    <title>Dashboard - Canvas Admin</title>
    <meta charset="utf-8">

    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <meta name="description" content="">
    <meta name="author" content="" />
    
    <link rel="stylesheet" href="http://fonts.googleapis.com/css?family=Open+Sans:400italic,600italic,800italic,400,600,800" type="text/css">

    <link rel="stylesheet" href="./css/font-awesome.min.css" type="text/css" />     
    <link rel="stylesheet" href="./css/bootstrap.min.css" type="text/css" />    
    <link rel="stylesheet" href="./js/libs/css/ui-lightness/jquery-ui-1.9.2.custom.css" type="text/css" />
        
    <link rel="stylesheet" href="./js/plugins/icheck/skins/minimal/blue.css" type="text/css" />
    <link rel="stylesheet" href="./js/plugins/select2/select2.css" type="text/css" />
    <link rel="stylesheet" href="./js/plugins/fullcalendar/fullcalendar.css" type="text/css" />
    
    <link rel="stylesheet" href="./css/App.css" type="text/css" />

    <link rel="stylesheet" href="./css/custom.css" type="text/css" />   
</head>

<body>

<div id="wrapper">

    <header id="header">

        <h1 id="site-logo">
            <a href="./">
                <img src="./img/logos/logo.png" alt="Site Logo" />
            </a>
        </h1>   

        <a href="javascript:;" data-toggle="collapse" data-target=".top-bar-collapse" id="top-bar-toggle" class="navbar-toggle collapsed">
            <i class="fa fa-cog"></i>
        </a>

        <a href="javascript:;" data-toggle="collapse" data-target=".sidebar-collapse" id="sidebar-toggle" class="navbar-toggle collapsed">
            <i class="fa fa-reorder"></i>
        </a>

    </header> <!-- header -->


    <nav id="top-bar" class="collapse top-bar-collapse">

        <ul class="nav navbar-nav pull-left">
            <li class="">
                <a href="./index.html">
                    <i class="fa fa-home"></i> 
                    Home
                </a>
            </li>

            <li class="dropdown hide">
                <a class="dropdown-toggle" data-toggle="dropdown" href="javascript:;">
                    Dropdown <span class="caret"></span>
                </a>

                <ul class="dropdown-menu" role="menu">
                    <li><a href="javascript:;"><i class="fa fa-user"></i>&nbsp;&nbsp;Example #1</a></li>
                    <li><a href="javascript:;"><i class="fa fa-calendar"></i>&nbsp;&nbsp;Example #2</a></li>
                    <li class="divider"></li>
                    <li><a href="javascript:;"><i class="fa fa-tasks"></i>&nbsp;&nbsp;Example #3</a></li>
                </ul>
            </li>
            
        </ul>

        <ul class="nav navbar-nav pull-right">
            <li class="dropdown">
                <a class="dropdown-toggle" data-toggle="dropdown" href="javascript:;">
                    <i class="fa fa-user"></i>
                    <?php echo $_SESSION['user'] ?>
                    <span class="caret"></span>
                </a>

                <ul class="dropdown-menu" role="menu">
                    <li class="hide">
                        <a href="./page-profile.html">
                            <i class="fa fa-user"></i> 
                            &nbsp;&nbsp;My Profile
                        </a>
                    </li>
                    <li class="hide">
                        <a href="./page-calendar.html">
                            <i class="fa fa-calendar"></i> 
                            &nbsp;&nbsp;My Calendar
                        </a>
                    </li>
                    <li class="hide">
                        <a href="./page-settings.html">
                            <i class="fa fa-cogs"></i> 
                            &nbsp;&nbsp;Settings
                        </a>
                    </li>
                    <li class="divider hide"></li>
                    <li>
                        <a href="./">
                            <i class="fa fa-sign-out"></i> 
                            &nbsp;&nbsp;Logout
                        </a>
                    </li>
                </ul>
            </li>
        </ul>

    </nav> <!-- /#top-bar -->


    <div id="sidebar-wrapper" class="collapse sidebar-collapse">
    
        <div id="search" class="">
            <form class="hide">
                <input class="form-control input-sm" type="text" name="search" placeholder="Search..." />

                <button type="submit" id="search-btn" class="btn "><i class="fa fa-search"></i></button>
            </form>     
        </div> <!-- #search -->
    
        <nav id="sidebar">      
            
            <ul id="main-nav" class="open-active hide">          

                <li class="active">             
                    <a href="./index.html">
                        <i class="fa fa-dashboard"></i>
                        Dashboard
                    </a>                
                </li>

            </ul>
                    
        </nav> <!-- #sidebar -->

    </div> <!-- /#sidebar-wrapper -->

    
    <div id="content">      
        
        <div id="content-header">
            <h1>Dashboard</h1>
        </div> <!-- #content-header --> 


        <div id="content-container">


            <div class="row">

                <div class="col-md-12">


                   <div class="row">

                    <div class="col-md-12">

                        <div class="portlet">

                            <div class="portlet-header">

                                <h3>
                                    <i class="fa fa-dashboard"></i>
                                    Materias que se cursaran este semestre
                                </h3>


                            </div> <!-- /.portlet-header -->

                            <div class="portlet-content">

                                <div class="table-responsive">
                                <table class="table">
                                    <thead>
                                        <tr>
                                            <th>Materia</th>
                                            <th>Modalidad</th>
                                        </tr>
                                    </thead>
                                    <tbody>

                                        <?php $hashing = array(); ?>

                                        <?php foreach ($result->Ordinarios as $value): ?>

                                        <?php if (!isset($hashing[$value->nombre])): ?>

                                        <?php $hashing[$value->nombre] =1 ?>

                                        <tr>
                                            <td><?php echo $value->nombre ?></td>
                                            <td>Ordinario</td>
                                        </tr>
                                            
                                        <?php endif ?>

                                        <?php endforeach ?>

                                        <?php foreach ($result->Extraoridnarios as $value): ?>

                                        <tr>
                                            <td><?php echo $value->nombre ?></td>
                                            <td>Extraordinario</td>
                                        </tr>
                                            
                                        

                                        

                                        
                                            
                                        <?php endforeach ?>
                                        
                                        
                                    </tbody>
                                </table>
                            </div> <!-- /.table-responsive -->

                                <hr />
                                

                            </div> <!-- /.portlet-content -->

                        </div> <!-- /.portlet -->


                    </div> <!-- /.col-md-4 -->



                    


                </div> <!-- /.row -->

                <div class="row">

                    <div class="col-md-12">

                        <div class="portlet">

                            <div class="portlet-header">

                                <h3>
                                    <i class="fa fa-clock"></i>
                                    Horario semestre
                                </h3>


                            </div> <!-- /.portlet-header -->

                            <div class="portlet-content">

                                <div class="table-responsive">
                                <table class="table">
                                    <thead>
                                        <tr>
                                            <th>Materia</th>
                                            <th>Lunes</th>
                                            <th>Martes</th>
                                            <th>Miercoles</th>
                                            <th>Jueves</th>
                                            <th>Viernes</th>
                                        </tr>
                                    </thead>
                                    <tbody>

                                        <?php foreach ($result->Ordinarios as $value): ?>
                                        <tr>
                                            <td><?php echo $value->nombre ?><br>Porf. <?php echo $value->profesor ?></td>
                                            <td><?php echo $value->lunes ?></td>
                                            <td><?php echo $value->martes ?></td>
                                            <td><?php echo $value->miercoles ?></td>
                                            <td><?php echo $value->jueves ?></td>
                                            <td><?php echo $value->viernes ?></td>
                                        </tr>
                                            
                                        <?php endforeach ?>

                                        
                                        
                                        
                                        
                                    </tbody>
                                </table>
                            </div> <!-- /.table-responsive -->

                                <hr />
                                

                            </div> <!-- /.portlet-content -->

                        </div> <!-- /.portlet -->


                    </div> <!-- /.col-md-4 -->



                    


                </div> <!-- /.row -->








                </div> <!-- /.col-md-12 -->





                </div> <!-- /.col -->

            </div> <!-- /.row -->

        </div> <!-- /#content-container -->
        

    </div> <!-- #content -->    
    
</div> <!-- #wrapper -->

<footer id="footer">
    <ul class="nav pull-right">
        <li>
            Copyright &copy; 2013, Jumpstart Themes.
        </li>
    </ul>
</footer>

<script src="./js/libs/jquery-1.9.1.min.js"></script>
<script src="./js/libs/jquery-ui-1.9.2.custom.min.js"></script>
<script src="./js/libs/bootstrap.min.js"></script>

<script src="./js/plugins/icheck/jquery.icheck.min.js"></script>
<script src="./js/plugins/select2/select2.js"></script>
<script src="./js/plugins/tableCheckable/jquery.tableCheckable.js"></script>

<script src="./js/App.js"></script>

<script src="./js/libs/raphael-2.1.2.min.js"></script>
<script src="./js/plugins/morris/morris.min.js"></script>

<script src="./js/demos/charts/morris/area.js"></script>
<script src="./js/demos/charts/morris/donut.js"></script>

<script src="./js/plugins/sparkline/jquery.sparkline.min.js"></script>

<script src="./js/plugins/fullcalendar/fullcalendar.min.js"></script>
<script src="./js/demos/calendar.js"></script>

<script src="./js/demos/dashboard.js"></script>

</body>
</html>

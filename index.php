<?php 
    include("helpers.php"); 
    session_start();

    const API = "http://107.170.211.108/tutorvirtual/v1/api.php?rquest=";
    

    if (!isset($_POST['matricula'])) {


        
    }else{

        $matricula = null;

        if (isset($_POST['matricula'])) {
            $matricula = $_POST['matricula'];
        }

        $pass = null;

        if (isset($_POST['pass'])) {
            $pass = $_POST['pass'];
        }

        $login = array("matricula" => $matricula, "pwd" => $pass);

        $result = json_decode(CallAPI("POST", API."login", $login));

        // print_r(CallAPI("POST", API."login", $login));

        if ($result->status == "Logged") {
            $_SESSION['token'] = $result->hash;
            $_SESSION['user'] = $result->nombre;

            header( 'Location: ./table.php' ) ;

        }else{
            $msg = "Error al iniciar sesión. Tu usuario o contraseña no coincide.";
        }

    }

?>


<!DOCTYPE html>
<!--[if lt IE 7]>      <html class="no-js lt-ie9 lt-ie8 lt-ie7"> <![endif]-->
<!--[if IE 7]>         <html class="no-js lt-ie9 lt-ie8"> <![endif]-->
<!--[if IE 8]>         <html class="no-js lt-ie9"> <![endif]-->
<!--[if gt IE 8]><!--> <html class="no-js"> <!--<![endif]-->
    <head>

    <title>Login - Canvas Admin</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <meta name="description" content="">
    <meta name="author" content="" />

    <link rel="stylesheet" href="http://fonts.googleapis.com/css?family=Open+Sans:400italic,600italic,800italic,400,600,800" type="text/css">
    <link rel="stylesheet" href="./css/font-awesome.min.css" type="text/css" />     
    <link rel="stylesheet" href="./css/bootstrap.min.css" type="text/css" />    
    <link rel="stylesheet" href="./js/libs/css/ui-lightness/jquery-ui-1.9.2.custom.css" type="text/css" />  
    
    <link rel="stylesheet" href="./css/App.css" type="text/css" />
    <link rel="stylesheet" href="./css/Login.css" type="text/css" />

    <link rel="stylesheet" href="./css/custom.css" type="text/css" />
    
</head>

<body>

<div id="login-container">

    <div id="logo">
        <a href="./login.html">
            <img src="./img/logos/logo-login.png" alt="Logo" />
        </a>
    </div>

    <div id="login">

        <h3>Bienvenido a tu Tutor Virtual.</h3>

        <h5>Inicia sesíon para obtener tu carga.</h5>

        <?php if (isset($msg)): ?>
            <h6 style="color:#e5412d"><?php echo $msg ?></h6>
            
        <?php endif ?>

        

        <form id="login-form" method="POST" action="<?php echo $_SERVER['PHP_SELF']; ?>" class="form">

            <div class="form-group">
                <label for="login-username">Matricula</label>
                <input type="text" name="matricula" class="form-control" id="login-username" placeholder="Username">
            </div>

            <div class="form-group">
                <label for="login-password">Password</label>
                <input type="password" name="pass" class="form-control" id="login-password" placeholder="Password">
            </div>

            <div class="form-group">

                <button type="submit" id="login-btn" class="btn btn-primary btn-block">Signin &nbsp; <i class="fa fa-play-circle"></i></button>

            </div>
        </form>



    </div> <!-- /#login -->




</div> <!-- /#login-container -->

<script src="./js/libs/jquery-1.9.1.min.js"></script>
<script src="./js/libs/jquery-ui-1.9.2.custom.min.js"></script>
<script src="./js/libs/bootstrap.min.js"></script>

<script src="./js/App.js"></script>

<script src="./js/Login.js"></script>

</body>
</html>

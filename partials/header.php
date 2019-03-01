<?php 
if (session_id() == '') {
     session_start();
} 
?>
<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <!-- <link rel="shortcut icon" type="image/png" href="/imgs/favicon.png" /> -->
        <title>CMS</title>

        <!-- inject:css -->
        <link rel="stylesheet" href="assets/css/jquery-ui.css">
        <link rel="stylesheet" href="bower_components/bootstrap/dist/css/bootstrap.min.css">
        <link rel="stylesheet" href="bower_components/font-awesome/css/font-awesome.min.css">
        <link rel="stylesheet" href="bower_components/simple-line-icons/css/simple-line-icons.css">
        <link rel="stylesheet" href="bower_components/weather-icons/css/weather-icons.min.css">
        <link rel="stylesheet" href="bower_components/themify-icons/css/themify-icons.css">
        <!-- Select2 Dependencies -->
        <link rel="stylesheet" href="bower_components/select2/dist/css/select2.min.css">
        
        <link type="text/css" href="assets/css/dataTables.checkboxes.css" rel="stylesheet" />
        <link type="text/css" href="assets/css/select.dataTables.min.css" rel="stylesheet" />
        <!-- endinject -->
            
        <!-- Main Style  -->
        
        <!-- Bootstrap DatePicker Dependencies -->
        <link rel="stylesheet" href="bower_components/bootstrap-datepicker/dist/css/bootstrap-datepicker3.min.css">
        <link rel="stylesheet" href="assets/css/jquery.dataTables.min.css">
        <link rel="stylesheet" href="assets/css/buttons.dataTables.min.css">
        <link rel="stylesheet" href="dist/css/main.css">

        <script src="assets/js/modernizr-custom.js"></script>	<style>	.navbar-collapse .toggle-btn{display:none;}	@media (min-width: 768px)	{	.ui-content{	margin-left: 200px;	}	}	</style>
    </head>
    <body>
   <div id="ui" class="ui">

            <!--header start-->
            <header id="header" class="ui-header">

                <div class="navbar-header">
                    <!--logo start-->
                    <a href="index.php" class="navbar-brand">
                        <span class="logo">
                            <!-- <img src="imgs/logo-dark.png" alt="logo"/> -->
                        </span>
                            <p>Logo ici</p>
                        <!-- <span class="logo-compact"><img src="imgs/logo-icon-dark.png" alt="logo"/></span> -->
                    </a>
                    <!--logo end-->
                </div>

                <div class="search-dropdown dropdown pull-right visible-xs">
                    <button type="button" class="btn dropdown-toggle" data-toggle="dropdown" aria-expanded="true"><i class="fa fa-search"></i></button>
                    <div class="dropdown-menu">
                        <form action="">
                            <input class="form-control" placeholder="Cherche ici..." type="text">
                        </form>
                    </div>
                </div>

                <div class="navbar-collapse nav-responsive-disabled">

                    <!--toggle buttons start-->
                    <ul class="nav navbar-nav">
                        <li>
                            <a class="toggle-btn" data-toggle="ui-nav" href="">
                                <i class="fa fa-bars"></i>
                            </a>
                        </li>
                    </ul>
                    <!-- toggle buttons end -->

                    <!--search start-->
                    <!-- <form class="search-content hidden-xs" action="">
                        <button type="submit" name="search" class="btn srch-btn">
                            <i class="fa fa-search"></i>
                        </button>
                        <input type="text" class="form-control" name="keyword" placeholder="Search here...">
                    </form> -->
                    <!--search end-->

                    <!--notification start-->
                    <ul class="nav navbar-nav navbar-right">
                        <li class="dropdown dropdown-usermenu">
                            <a href="#" class=" dropdown-toggle" data-toggle="dropdown" aria-expanded="true">
                                <?php 
                                    $userId = $_SESSION['id'];
                                    // var_dump($userId);
                                    $currentuser = mysqli_query($connect, "SELECT * FROM user WHERE  id = '$userId'");
                                    $result = mysqli_fetch_array($currentuser);
                                 ?>
                                <!-- <div class="user-avatar"><img src="imgs/a0.jpg" alt="..."></div> -->
                                <span class="hidden-sm hidden-xs"><?= $result['fullname'] ?></span>
                                <!--<i class="fa fa-angle-down"></i>-->
                                <span class="caret hidden-sm hidden-xs"></span>
                            </a>
                            <ul class="dropdown-menu dropdown-menu-usermenu pull-right">
                                <li><a href="edit_admin.php?id=<?= $result['id'] ?>"><i class="fa fa-user"></i>  Profil</a></li>
                                <li class="divider"></li>
                                <li><a href="logout.php"><i class="fa fa-sign-out"></i>Connectez - Out</a></li>
                            </ul>
                        </li>
                    </ul>
                    <!--notification end-->

                </div>

            </header>
            <!--header end-->
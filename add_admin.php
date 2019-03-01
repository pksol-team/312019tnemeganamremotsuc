<?php 
    require('config/db.php');
?>
<?php 
    require('config/guard.php');
?>
<?php 
        // session_start();
        if (isset($_POST['is_submit'])) {
            $fullname = $_POST['fullname'];
            $email = $_POST['email'];
            $phone = $_POST['phone'];
            $password = $_POST['password'];
            $status = 'Active';
            $role = 'Admin';


            $emailCheck = "SELECT * FROM user WHERE email =  '$email'";

            $result = $connect->query($emailCheck);
            if ($result->num_rows > 0) {
                $_SESSION['msg'] = "Email existe déjà Essayez un autre email";
            }            
            else {
       $query = mysqli_query($connect , "INSERT INTO user(fullname, email, phone, password, status, role ) VALUES('$fullname', '$email', '$phone', '$password', '$status', '$role' )");
                if ($query == true) {
                    $_SESSION['msg'] = "Enregistrement d'administrateur avec succès";
                    header('Location:view_admin.php');
                }
                else{
                    $_SESSION['error'] = "Erreur:" . $query . "<br>" . $connect->error;
                }                
            }            
         }
?>

<?php require 'partials/header.php'; ?>

<?php require 'partials/sidebar.php';
    // var_dump($connect);
 ?>

            <!--main content start-->
            <div id="content" class="ui-content ">
                <div class="ui-content-body">

                    <div class="ui-container">

                        <div class="row">
                            <div class="col-md-12">
                                <div class="panel profile-wrap">
                                 <!--    <header class="panel-heading clearfix">
                                        <h3 class="profile-title pull-left"><?= $printdata['fullname'] ?></h3>
                                        <div class="pull-right">
                                            <a href="#" class="btn btn-sm btn-info"><i class="fa fa-pencil"></i></a>
                                            <a href="#" class="btn btn-sm btn-danger"><i class="fa fa-trash-o"></i></a>
                                        </div>
                                    </header> -->
                                    <div class="panel-body row">
                                      <div class="col-md-12">
                                            <div class="profile-tabs">
                                                <ul class="nav nav-tabs">
                                                    <li class="active"> <a href="#tab2"data-toggle="tab">Ajouter un nouveau</a></li>
                                                </ul>
                                                <div class="tab-content">
                                                    <div id="tab2" class="tab-pane fade in active">
                                                        <?php if (isset($_SESSION['msg'])) : ?>
                                                            <div class="alert alert-success">
                                                                <strong>Profile! </strong><?= $_SESSION['msg']; ?>.
                                                            </div>
                                                         <?php unset($_SESSION['msg']); ?>   
                                                        <?php endif ?>  
                                                        <?php if (isset($_SESSION['error'])) : ?>
                                                            <div class="alert alert-danger">
                                                                <strong>Error! </strong><?= $_SESSION['error']; ?>.
                                                            </div>
                                                         <?php unset($_SESSION['error']); ?>   
                                                        <?php endif ?>    
                                                        <form class="form-horizontal" method="post" action="<?php $_SERVER['PHP_SELF']; ?>">
                                                            <?php if (isset($_SESSION['msg'])) : ?>
                                                                <div class="alert alert-success">
                                                                    <strong>Profile! </strong><?= $_SESSION['msg']; ?>.
                                                                </div>
                                                             <?php unset($_SESSION['msg']); ?>   
                                                            <?php endif ?>  
                                                            <?php if (isset($_SESSION['error'])) : ?>
                                                                <div class="alert alert-danger">
                                                                    <strong>Error! </strong><?= $_SESSION['error']; ?>.
                                                                </div>
                                                             <?php unset($_SESSION['error']); ?>   
                                                            <?php endif ?>  

                                                            <div class="form-group">
                                                                <label class="col-sm-3 control-label">Nom complet de l'administrateur</label>
                                                                <div class="col-sm-5"><input name="fullname" type="text" class="form-control" placeholder="Nom complet" required=""></div>
                                                            </div>
                                                            <div class="form-group">
                                                                <label class="col-sm-3 control-label">Email</label>
                                                                <div class="col-sm-5">
                                                                    <input name="email" type="email" class="form-control" placeholder="Email" required="">
                                                                </div>
                                                            </div>
                                                            <div class="form-group">
                                                                <label class="col-sm-3 control-label">Téléphone</label>
                                                                <div class="col-sm-5">
                                                                   <input name="phone" type="text" class="form-control" placeholder="Numéro de téléphone" required="">
                                                                </div>
                                                            </div>
                                                            <div class="form-group">
                                                                <label class="col-sm-3 control-label">Mot de passe</label>
                                                                <div class="col-sm-5">
                                                                   <input name="password" type="password" class="form-control" placeholder="Mot de passe" required="">
                                                                </div>
                                                            </div>
                                                            <div class="form-group">
                                                                <div class="col-sm-offset-3 col-sm-5">
                                                                    <button type="submit" name="is_submit" class="btn btn-sm btn-primary">
                                                                        Registre
                                                                    </button>
                                                                </div>
                                                            </div>
                                                        </form>
                                                    </div>

                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                    </div>
                </div>
            </div>
            <!--main content end-->

            <!--footer start-->
            <?php include 'partials/copy_right.php'; ?>
            <!--footer end-->

        </div>
<?php 
    require('partials/footer.php');
?>
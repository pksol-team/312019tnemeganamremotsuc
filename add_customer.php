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
            $address = $_POST['address'];
            $trade_register = $_POST['trade_register'];
            $vat = $_POST['vat'];
            $status = 'Active';
            $role = 'Customer';


            $emailCheck = "SELECT * FROM user WHERE email =  '$email'";

            $result = $connect->query($emailCheck);
            if ($result->num_rows > 0) {
                $_SESSION['msg'] = "Email existe déjà Essayez un autre email";
            }            
            else {
                $query = mysqli_query($connect , "INSERT INTO user(fullname, email, phone, address, trade_register, vat, status, role ) VALUES('$fullname', '$email', '$phone', '$address', '$trade_register', '$vat', '$status', '$role' )");
                if ($query == true) {
                    $_SESSION['msg'] = "Enregistrement du client réussi";
                    header('Location:view_customer.php');
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
                                                                <label class="col-sm-3 control-label">Nom complet du client</label>
                                                                <div class="col-sm-5"><input name="fullname" type="text" class="form-control" placeholder="Nom complet" required=""></div>
                                                            </div>
                                                            <div class="form-group">
                                                                <label class="col-sm-3 control-label">Email</label>
                                                                <div class="col-sm-5">
                                                                    <input name="email" type="email" class="form-control" placeholder="Email" required="">
                                                                </div>
                                                            </div>
                                                            <div class="form-group">
                                                                <label class="col-sm-3 control-label">Contact</label>
                                                                <div class="col-sm-5">
                                                                   <input name="phone" type="text" class="form-control" placeholder="Contact" required="">
                                                                </div>
                                                            </div>
                                                            <div class="form-group">
                                                                <label class="col-sm-3 control-label">Adresse</label>
                                                                <div class="col-sm-5">
                                                                   <input name="address" type="text" class="form-control" placeholder="Adresse" required="">
                                                                </div>
                                                            </div>
                                                            <div class="form-group">
                                                                <label class="col-sm-3 control-label">Registre du commerce</label>
                                                                <div class="col-sm-5">
                                                                   <input name="trade_register" type="text" class="form-control" placeholder="Registre du commerce" required="">
                                                                </div>
                                                            </div>
                                                            <div class="form-group">
                                                                <label class="col-sm-3 control-label">T.V.A</label>
                                                                <div class="col-sm-5">
                                                                   <input name="vat" type="text" class="form-control" placeholder="T.V.A" required="">
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
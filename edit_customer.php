<?php 
    require('config/db.php');
?>
<?php 
    require('config/guard.php');
?>

<?php 
    // session_start();
    $id = $_GET['id'];
    $fetchdata = mysqli_query($connect, "SELECT * FROM user WHERE id = '$id'");
    $printdata = mysqli_fetch_assoc($fetchdata);
    // var_dump($printdata['confirm_password']);


    if (isset($_POST['is_submit'])) {
        $name = $_POST['fullname'];
        $email = $_POST['email'];
        $phone = $_POST['phone'];
        $address = $_POST['address'];
        $trade_register = $_POST['trade_register'];
        $vat = $_POST['vat'];
        $status = 'Active';
        $role = 'Customer';
        $emailCheck = "SELECT * FROM user WHERE id != '$id'  AND email = '$email'";
        $result = $connect->query($emailCheck);
        if ($result->num_rows > 0 ) {
            $_SESSION['msg'] = "Email existe déjà Essayez un autre email";
        }
        else{

            $query = mysqli_query($connect, "UPDATE user SET fullname='$name', email='$email', phone='$phone', address='$address', trade_register='$trade_register', vat='$vat', status='$status', role='$role' WHERE id ='$id' ");
            if ($query == true) {
                $_SESSION['msg'] = "Mise à jour réussie";
                header('Location:view_customer.php');

            }
            else{
                $_SESSION['error'] = "Erreur:" .$query ."<br>". $connect->error;
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
                                    <header class="panel-heading clearfix">
                                        <h3 class="profile-title pull-left"><?= $printdata['fullname'] ?></h3>
                                      <!--   <div class="pull-right">
                                            <a href="#" class="btn btn-sm btn-info"><i class="fa fa-pencil"></i></a>
                                            <a href="#" class="btn btn-sm btn-danger"><i class="fa fa-trash-o"></i></a>
                                        </div> -->
                                    </header>
                                    <div class="panel-body row">
                                      <div class="col-md-12">
                                            <div class="profile-tabs">
                                                <ul class="nav nav-tabs">
                                                    <li class="active"> <a href="#tab2"data-toggle="tab">Editer le profil</a></li>
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
                                                                <label class="col-sm-3 control-label">Nom de profil</label>
                                                                <div class="col-sm-5"><input name="fullname" type="text" class="form-control" value="<?= $printdata['fullname'] ?>" placeholder="Nom de profil" required=""></div>
                                                            </div>
                                                            <div class="form-group">
                                                                <label class="col-sm-3 control-label">Email</label>
                                                                <div class="col-sm-5">
                                                                    <input name="email" type="text" placeholder="Email" value="<?= $printdata['email'] ?>" class="form-control" required="">
                                                                </div>
                                                            </div>
                                                            <div class="form-group">
                                                                <label class="col-sm-3 control-label">Contact</label>
                                                                <div class="col-sm-5">
                                                                   <input name="phone" type="text" class="form-control" value="<?= $printdata['phone'] ?>" placeholder="Contact" required="">
                                                                </div>
                                                            </div>
                                                            <div class="form-group">
                                                                <label class="col-sm-3 control-label">Adresse</label>
                                                                <div class="col-sm-5">
                                                                   <input name="address" type="text" class="form-control" value="<?= $printdata['address'] ?>" placeholder="Adresse" required="">
                                                                </div>
                                                            </div>
                                                            <div class="form-group">
                                                                <label class="col-sm-3 control-label">Registre du commerce</label>
                                                                <div class="col-sm-5">
                                                                   <input name="trade_register" type="text" class="form-control" value="<?= $printdata['trade_register'] ?>" placeholder="Registre du commerce" required="">
                                                                </div>
                                                            </div>
                                                            <div class="form-group">
                                                                <label class="col-sm-3 control-label">T.V.A</label>
                                                                <div class="col-sm-5">
                                                                   <input name="vat" type="text" class="form-control" value="<?= $printdata['vat'] ?>" placeholder="T.V.A" required="">
                                                                </div>
                                                            </div>
                                                            <div class="form-group">
                                                                <div class="col-sm-offset-3 col-sm-5">
                                                                    <button type="submit" name="is_submit" class="btn btn-sm btn-primary">
                                                                        Mettre à jour
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

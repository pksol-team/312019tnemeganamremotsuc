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
        $newpassword = $_POST['confirm_password'];
        $status = 'Active';
        $role = 'Admin';
        $emailCheck = "SELECT * FROM user WHERE id != '$id'  AND email = '$email'";
        $result = $connect->query($emailCheck);
        if ($result->num_rows > 0 ) {
            $_SESSION['msg'] = "Email existe déjà Essayez un autre email";
        }
        else{

            $query = mysqli_query($connect, "UPDATE user SET fullname='$name', email='$email', phone='$phone', password='$newpassword', status='$status', role='$role' WHERE id ='$id' ");
            if ($query == true) {
                $_SESSION['msg'] = "Mise à jour réussie";
                header('Location:view_admin.php');

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
                                                                <div class="col-sm-5"><input name="fullname" placeholder="Nom de profil" type="text" class="form-control" value="<?= $printdata['fullname'] ?>" required=""></div>
                                                            </div>
                                                            <div class="form-group">
                                                                <label class="col-sm-3 control-label">Email</label>
                                                                <div class="col-sm-5">
                                                                    <input name="email" type="text" placeholder="Email" value="<?= $printdata['email'] ?>" class="form-control" required="">
                                                                </div>
                                                            </div>
                                                            <div class="form-group">
                                                                <label class="col-sm-3 control-label">Téléphone</label>
                                                                <div class="col-sm-5">
                                                                    <input name="phone" type="text" placeholder="Téléphone" value="<?= $printdata['phone'] ?>" class="form-control" required="">
                                                                </div>
                                                            </div>
                                                            <div class="form-group">
                                                                <label class="col-sm-3 control-label">Mot de passe</label>
                                                                <div class="col-sm-5">
                                                                    <input name="password" id="password" placeholder="Mot de passe" type="text" class="form-control" required="">
                                                                </div>
                                                            </div>
                                                            <div class="form-group">
                                                                <label class="col-sm-3 control-label">Confirmez le mot de passe</label>
                                                                <div class="col-sm-5">
                                                                    <input name="confirm_password" placeholder="Confirmez le mot de passe" id="confirm_password" type="text" class="form-control" onChange="checkPasswordMatch();" required="">
                                                                </div>
                                                            </div>
                                                            <div class="form-group">
                                                                
                                                                <div class="col-sm-offset-3 col-sm-5">
                                                                    <div class="registrationFormAlert" id="divCheckPasswordMatch"></div>
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

<script>
    function checkPasswordMatch() {
        var password = $("#password").val();
        var confirmPassword = $("#confirm_password").val();

        if (password != confirmPassword)
            $("#divCheckPasswordMatch").html("Les mots de passe ne correspondent pas!");
        // else
        //     $("#divCheckPasswordMatch").html("Passwords match.");
    }
</script>
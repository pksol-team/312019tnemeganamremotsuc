<?php require 'config/db.php'; 

    require('config/guard_login.php');

    ?>


<?php 
    if (isset($_POST['is_submit']))
    {
        $email = $_POST['email'];
        $password = $_POST['password'];
        
        $checkinguseravailability = mysqli_query($connect, "SELECT * FROM user WHERE email = '$email' AND password = '$password' AND status = 'Active' AND role = 'Admin'");
        
        $result = $checkinguseravailability;

        if ($result->num_rows > 0) {
            $row = mysqli_fetch_array($result);

            $_SESSION['Is_Valid'] = true;
            $_SESSION['id'] = $row['id'];
            $_SESSION['role'] = $row['role'];
            $_SESSION['password'] = $row['password'];
            $_SESSION['fullname'] = $row['fullname'];
            $_SESSION['email'] = $row['email'];
            header('Location:dashboard.php');
        }
        else{
            $_SESSION['error'] = "Email ou mot de passe invalide";
        }
    } 
?>
    


<?php require 'partials/header.php'; ?>
<style>
    header#header {
    display: none;
}
</style>
        <div class="sign-in-wrapper">
            <div class="sign-container">
                <div class="text-center">
                    <!-- <h2 class="logo"><img src="imgs/logo-dark.png" width="130px" alt=""/></h2> -->
                    <h4>Connexion à l'administrateur</h4>
                </div>
                <?php if (isset($_SESSION['error'])): ?>
                    <div class="alert alert-danger">
                      <strong>Error! </strong><?= $_SESSION['error']; ?>.
                    </div>
                    <?php unset($_SESSION['error']); ?>
                <?php endif ?>


                <form class="sign-in-form" role="form" method="post" action="<?php $_SERVER['PHP_SELF']; ?>">
                    <div class="form-group">
                        <input type="text" name="email" class="form-control" placeholder="Email" required="">
                    </div>
                    <div class="form-group">
                        <input type="password" name="password" class="form-control" placeholder="Mot de passe" required="">
                    </div>
                    <!-- <div class="form-group text-center">
                        <label class="i-checks">
                            <input type="checkbox">
                            <i></i>
                        </label>
                        Remember me
                    </div> -->
                    <button type="submit" name="is_submit" class="btn btn-info btn-block">S'identifier</button>
                    <!-- <div class="text-center help-block"> -->
                        <!-- <a href="forgot-password.html"><small>Forgot password?</small></a> -->
                        <!-- <p class="text-muted help-block"><small>Do not have an account?</small></p> -->
                    <!-- </div> -->
                    <!-- <a class="btn btn-md btn-default btn-block" href="registration.php">Create an account</a> -->
                </form>
                <?php // include 'partials/copy_right.php'; ?>
            </div>
        </div>

<?php require 'partials/footer.php'; ?>
        
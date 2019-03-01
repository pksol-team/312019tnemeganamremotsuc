<?php 
    require('config/db.php');
?>
<?php 
    require('config/guard.php');
?>
<?php 
        // session_start();
            $n = range(0, 200);
            shuffle($n);
            $key = '';
            for ($x=0; $x < 10; $x++)
            {
                $key .= $n[$x];
            }
            $order_no = substr($key, 0, 5);
            $currentdate = date('m/d/y');

        if (isset($_POST['is_submit'])) {
            $name = $_POST['name'];
            $user_id = $_POST['user_id'];
            $order_no = $_POST['order_no'];
            $date = $_POST['currentdate'];
            $placeorder_date = $_POST['placeorder_date'];
            $prix_unitaire_ht = $_POST['prix_unitaire_ht'];
            $montant_total_ht = $_POST['montant_total_ht'];
            $quantity = $_POST['quantity'];
            $status = $_POST['status'];
            $date_of_payment = $_POST['date_of_payment'];
            $payment_status = $_POST['payment_status'];
            $down_payment = $_POST['down_payment'];
            $observation = $_POST['observation'];

            $quantity_delivered = $_POST['quantity_delivered'];
            $delivered_date = $_POST['delivered_date'];

           
            $query = mysqli_query($connect , "INSERT INTO orders(name, user_id, order_date, order_no, placeorder_date, quantity, prix_unitaire_ht, montant_total_ht, date_of_payment, payment_status, observation, down_payment, status) VALUES('$name', '$user_id', '$date', '$order_no', '$placeorder_date', '$quantity', '$prix_unitaire_ht', '$montant_total_ht', '$date_of_payment', '$payment_status', '$observation', '$down_payment', '$status')");

            $last_insert_id = mysqli_insert_id($connect);

            
            if ($query == true) {
                foreach ($quantity_delivered as $key => $single_quantity) {
                    if ($single_quantity != '') {
                        $single_date = $delivered_date[$key];
                         mysqli_query($connect , "INSERT INTO order_qunatity (order_id, quantity_delivered, delivered_date) VALUES('$last_insert_id', '$single_quantity', '$single_date')");  
                    }
                }
                $_SESSION['msg'] = "Commander avec succès Ajouter";
                header('Location:orders_view.php');
            }
            else{
                $_SESSION['error'] = "Erreur:" . $query . "<br>" . $connect->error;
            }                
                        
         }
?>

<?php require 'partials/header.php'; ?>
<?php require 'partials/sidebar.php'; ?>

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
                                                                <label class="col-sm-2">Numéro de commande</label>
                                                                <div class="col-sm-5"><input name="order_no" type="text" class="form-control"  value="<?php echo $order_no ?>" readonly=""></div>
                                                            </div>
                                                            <div class="form-group">
                                                                <label class="col-sm-2">Rendez-vous amoureux</label>
                                                                <div class="col-sm-5">
                                                                    <input name="currentdate" type="text" class="form-control" value="<?php echo $currentdate ?>" readonly="">  
                                                                </div>
                                                            </div>
                                                            <div class="form-group">
                                                                <label class="col-sm-2">Nom de la commande</label>
                                                                <div class="col-sm-5"><input name="name" type="text" class="form-control" placeholder="Prénom" required=""></div>
                                                            </div>  
                                                            <div class="form-group">
                                                                <label class="col-sm-2">Nom d'utilisateur</label>
                                                                <div class="col-sm-5">
                                                                    <select class="form-control user-select_option" name="user_id">
                                                                        <?php 
                                                                            $query = mysqli_query($connect, "SELECT * FROm user WHERE role != 'Admin'");
                                                                        ?>
                                                                        <?php while ($user_details = mysqli_fetch_array($query)) : ?>
                                                                            <option value="<?= $user_details['id']  ?>" ><?= $user_details['fullname']  ?></option>
                                                                        <?php endwhile; ?>   
                                                                    </select>
                                                                </div>
                                                            </div>  
                                                            <div class="form-group">
                                                                <label class="col-sm-2">Date de la commande</label>
                                                                <div class="col-sm-5">
                                                                    <div class="input-group date">
                                                                        <input name="placeorder_date" type="text" class="form-control" placeholder="mm/dd/yyyy" required="" readonly>
                                                                        <span class="input-group-addon" ><i class="fa fa-calendar"></i></span>
                                                                    </div>
                                                                </div>
                                                            </div>                                                            
                                                            <div class="form-group">
                                                                <label class="col-sm-2">Prix ​​unitaire HT</label>
                                                                <div class="col-sm-5">
                                                                    <input name="prix_unitaire_ht" type="number" class="form-control" id="prix_unitaire_ht" placeholder="Prix ​​unitaire HT" onkeyup="amount_calculate();" required="">
                                                                </div>
                                                            </div>

                                                            
                                                            <div class="form-group">
                                                                <label class="col-sm-2">Quantité</label>
                                                                <div class="col-sm-5">
                                                                    <input name="quantity" type="number" class="form-control" id="quantityn" placeholder="Quantité" required="" onkeyup="amount_calculate();">
                                                                </div>
                                                            </div> 
                                                            <div class="form-group">
                                                                <label class="col-sm-2">Montant total HT</label>
                                                                <div class="col-sm-5">
                                                                    <input name="montant_total_ht" type="number" class="form-control" id="montant_total_ht" placeholder="Montant total HT"  readonly="">
                                                                </div>
                                                            </div>


                                                            <div class="delivered_div">                                                               
                                                                <div class="form-group">
                                                                    <label class="col-sm-2"></label>
                                                                    <div class="col-sm-5">
                                                                        <input type="button" value="Add livrée Quantité" id="addmore-btn" class="btn btn-sm btn-success">
                                                                    </div>
                                                                </div>
                                                            </div>   
                                                            <div class="form-group">
                                                                <label class="col-sm-2">Statut de commande</label>
                                                                <div class="col-sm-5">
                                                                    <select class="form-control" name="status">
                                                                        <option value="<?=  'in_progress' ?>" ><?=  'En cours'  ?></option>
                                                                        <option value="<?=  'not_delivered' ?>" ><?=  'Non livrés'  ?></option>
                                                                        <option value="<?=  'delivered' ?>" ><?=  'Livré'  ?></option>
                                                                    </select>
                                                                </div>
                                                            </div>
                                                            <div class="form-group">
                                                                <label class="col-sm-2">Date de règlement</label>
                                                                <div class="col-sm-5">
                                                                    <div class="input-group date">
                                                                        <input name="date_of_payment" type="text" class="form-control" placeholder="mm/dd/yyyy" readonly>
                                                                        <span class="input-group-addon" ><i class="fa fa-calendar"></i></span>
                                                                    </div>
                                                                </div>
                                                            </div> 
                                                            <div class="form-group">
                                                                <label class="col-sm-2">Statut de paiement</label>
                                                                <div class="col-sm-5">
                                                                    <select class="form-control" name="payment_status">
                                                                        <option value="<?=  'un-paid' ?>" ><?=  'Non payé'  ?></option>
                                                                        <option value="<?=  'paid' ?>" ><?=  'Payé'  ?></option>
                                                                    </select>
                                                                </div>
                                                            </div>
                                                            <div class="form-group">
                                                                <label class="col-sm-2">Montant de l'acompte</label>
                                                                <div class="col-sm-5">
                                                                    <input name="down_payment" type="number" class="form-control" placeholder="Montant de l'acompte">
                                                                </div>
                                                            </div>
                                                            <div class="form-group">
                                                                <label class="col-sm-2">Obervation</label>
                                                                <div class="col-sm-5">
                                                                    <input name="observation" type="text" class="form-control" placeholder="Remarques">
                                                                </div>
                                                            </div>
                                                            <div class="form-group">
                                                                <div class="col-sm-offset-2 col-sm-5">
                                                                    <button type="submit" name="is_submit" class="btn btn-sm btn-primary">
                                                                        Ajouter une commande
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
    function amount_calculate() {  
        var prix_unitaire_ht = $("#prix_unitaire_ht").val();
        var quantityn = $("#quantityn").val();

        var total = prix_unitaire_ht*quantityn;
        $("#montant_total_ht").val(total);
    }
</script>
<script>
    jQuery(document).ready(function($) {
        $('.user-select_option').select2();
    });
</script>
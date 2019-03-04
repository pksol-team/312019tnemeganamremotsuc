<?php 
    require('config/db.php');
?>

<?php 
    // session_start();
    $id = $_GET['id'];
    $fetchdata = mysqli_query($connect, "SELECT * FROM orders WHERE id = '$id'");
    $printdata = mysqli_fetch_assoc($fetchdata);
//    $quantity_delivered = '';
 //   $delivered_date = '';

    if (isset($_POST['is_submit'])) {
        $name = $_POST['name'];
        $user_id = $_POST['user_id'];
        $placeorder_date = $_POST['placeorder_date'];
        $prix_unitaire_ht = $_POST['prix_unitaire_ht'];
        $montant_total_ht = $_POST['montant_total_ht'];
        $quantity = $_POST['quantity'];
        $date_of_payment = $_POST['date_of_payment'];
        $payment_status = $_POST['payment_status'];
        $observation = $_POST['observation'];
        $down_payment = $_POST['down_payment'];
        $status = $_POST['status'];

        $quantity_delivered = $_POST['quantity_delivered'];
        $delivered_date = $_POST['delivered_date'];

        $query = mysqli_query($connect, "UPDATE orders SET name='$name', user_id = '$user_id', placeorder_date='$placeorder_date', prix_unitaire_ht = '$prix_unitaire_ht', montant_total_ht='$montant_total_ht',  quantity='$quantity', date_of_payment='$date_of_payment', payment_status='$payment_status',  observation = '$observation', down_payment = '$down_payment',  status = '$status' WHERE id ='$id' ");
        
        if ($query == true) {
            if ($quantity_delivered != NULL) {
                foreach ($quantity_delivered as $key => $single_quantity) {
                    if ($single_quantity != '') {
                        $single_date = $delivered_date[$key];
                         mysqli_query($connect , "INSERT INTO order_qunatity (order_id, quantity_delivered, delivered_date) VALUES('$id', '$single_quantity', '$single_date')");  
                    }
                }
            }
        $_SESSION['msg'] = "Commander avec succès Ajouter";
        $update_url = 'orders_view.php';
        echo "<script>window.location.href = '$update_url'</script>";
        }
        else{
            $_SESSION['error'] = "Erreur:" .$query ."<br>". $connect->error;
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
                                        <h3 class="profile-title pull-left"><?= $printdata['name'] ?></h3>
                                    </header>
                                    <div class="panel-body row">
                                      <div class="col-md-12">
                                            <div class="profile-tabs">
                                                <ul class="nav nav-tabs">
                                                    <li class="active"> <a href="#tab2"data-toggle="tab">Modifier la commande</a></li>
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
                                                            <br>
                                                            <br>
                                                            <div class="form-group">
                                                                <label class="col-sm-2 ">Numéro de commande</label>
                                                                <div class="col-sm-5"><input type="text" class="form-control"  value="<?= $printdata['order_no'] ?>" readonly=""></div>
                                                            </div>
                                                            <div class="form-group">
                                                                <label class="col-sm-2 ">Rendez-vous amoureux</label>
                                                                <div class="col-sm-5"><input class="form-control"  value="<?= $printdata['order_date'] ?>" readonly=""></div>
                                                            </div>
                                                            <div class="form-group">
                                                                <label class="col-sm-2  ">Nom de la commande</label>
                                                                <div class="col-sm-5"><input name="name" placeholder="Nom de la commande" type="text" class="form-control" value="<?= $printdata['name'] ?>" required=""></div>
                                                            </div>
                                                            <div class="form-group">
                                                                <label class="col-sm-2 ">Nom d'utilisateur</label>
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
                                                                <label class="col-sm-2  ">Date de la commande</label>
                                                                <div class="col-sm-5">
                                                                    <div class="input-group date">
                                                                        <input name="placeorder_date" type="text" class="form-control" value="<?= $printdata['placeorder_date'] ?>" required readonly>
                                                                        <span class="input-group-addon" ><i class="fa fa-calendar"></i></span>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="form-group">
                                                                <label class="col-sm-2  ">Prix ​​unitaire HT</label>
                                                                <div class="col-sm-5">
                                                                    <input name="prix_unitaire_ht" type="number" placeholder="Prix ​​unitaire HT" value="<?= $printdata['prix_unitaire_ht'] ?>" class="form-control" id="prix_unitaire_ht" onkeyup="amount_calculate();" required="">
                                                                </div>
                                                            </div>
                                                            <div class="form-group">
                                                                <label class="col-sm-2  ">Quantité</label>
                                                                <div class="col-sm-5">
                                                                    <input name="quantity" type="number" placeholder="Quantité"  id="quantityn" onkeyup="amount_calculate();" value="<?= $printdata['quantity'] ?>" class="form-control" required="">
                                                                </div>
                                                            </div>
                                                            <div class="form-group">
                                                                <label class="col-sm-2  ">Montant total HT</label>
                                                                <div class="col-sm-5">
                                                                    <input name="montant_total_ht" type="number" placeholder="Montant total HT" id="montant_total_ht" value="<?= $printdata['montant_total_ht'] ?>" class="form-control" readonly="" >
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
                                                                <label class="col-sm-2 ">Statut de commande</label>
                                                                <div class="col-sm-5">
                                                                    <select class="form-control" name="status">
                                                                        <option <?= ($printdata['status']  == 'in_progress') ? 'selected' : '' ; ?> value="<?= 'in_progress' ?>" ><?= 'En cours'  ?></option>
                                                                        <option <?= ($printdata['status']  == 'not_delivered') ? 'selected' : '' ; ?> value="<?= 'not_delivered' ?>" ><?= 'Non livrés'  ?></option>
                                                                        <option <?= ($printdata['status']  == 'delivered') ? 'selected' : '' ; ?> value="<?= 'delivered' ?>" ><?= 'Livré'  ?></option>
                                                                    </select>
                                                                </div>
                                                            </div> 
                                                            <div class="form-group">
                                                                <label class="col-sm-2 ">Date de règlement</label>
                                                                <div class="col-sm-5">
                                                                    <div class="input-group date">
                                                                        <input name="date_of_payment" type="text" class="form-control" placeholder="mm/dd/yyyy" value="<?= $printdata['date_of_payment'] ?>" readonly>
                                                                        <span class="input-group-addon" ><i class="fa fa-calendar"></i></span>
                                                                    </div>
                                                                </div>
                                                            </div> 
                                                            <div class="form-group">
                                                                <label class="col-sm-2 ">Statut de paiement</label>
                                                                <div class="col-sm-5">
                                                                    <select class="form-control" name="payment_status">
                                                                         <option <?= ($printdata['payment_status']  == 'un_paid') ? 'selected' : '' ; ?> value="<?= 'un_paid' ?>" ><?= 'Non payé' ?></option>
                                                                        <option <?= ($printdata['payment_status']  == 'paid') ? 'selected' : '' ; ?> value="<?= 'paid' ?>" ><?= 'Payé'  ?></option>
                                                                    </select>
                                                                </div>
                                                            </div>
                                                            <div class="form-group">
                                                                <label class="col-sm-2  ">Montant de l'acompte</label>
                                                                <div class="col-sm-5">
                                                                    <input name="down_payment" type="number" class="form-control" placeholder="Montant de l'acompte" value="<?= $printdata['down_payment'] ?>">
                                                                </div>
                                                            </div> 
                                                            <div class="form-group">
                                                                <label class="col-sm-2  ">Observation</label>
                                                                <div class="col-sm-5">
                                                                    <input name="observation" type="text" class="form-control" placeholder="Remarques" value="<?= $printdata['observation'] ?>">
                                                                </div>
                                                            </div> 
                                                            <div class="form-group">
                                                                <div class="col-sm-offset-2 col-sm-5">
                                                                    <button type="submit" name="is_submit" class="btn btn-sm btn-primary">
                                                                        Mettre à jour
                                                                    </button>
                                                                </div>
                                                            </div>
                                                        </form>
                                                    </div>

                                                </div>
                                            </div>
                                           <table id="quantity-delievered" class="table table-striped table-bordered">
                                               <thead>
                                               <tr>
                                                   <th><strong>Quantité livrée</strong> </th>
                                                   <th><strong>Date de livraison</strong> </th>
                                               </tr>
                                               </thead>
                                               <tbody>
                                                   <?php 
                                                       $query = mysqli_query($connect, "SELECT * FROM order_qunatity WHERE order_id = '$id' ");
                                                   ?>
                                                   <?php while ($quantity_details = mysqli_fetch_array($query)) : ?>
                                               <tr>
                                                   <td class="qty-delivered"><?= $quantity_details['quantity_delivered'] ?></td>
                                                   <td><?= $quantity_details['delivered_date'] ?></td>                                                               
                                               </tr>
                                           <?php endwhile; ?>
                                               </tbody>
                                           </table>
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
        <script>
            function amount_calculate() {  
                var prix_unitaire_ht = $("#prix_unitaire_ht").val();
                var quantityn = $("#quantityn").val();

                var total = prix_unitaire_ht*quantityn;
                $("#montant_total_ht").val(total);
            }
        </script>

<?php 
    require('partials/footer.php');
?>

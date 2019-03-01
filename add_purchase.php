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
            $purchase_no = substr($key, 0, 5);

        if (isset($_POST['is_submit'])) {
            $purchase_no = $_POST['purchase_no'];
            $purchase_date = $_POST['purchase_date'];
            $product_name = $_POST['product_name'];
            $settlement_date = $_POST['settlement_date'];            
            $amount = $_POST['amount'];
            $unit_price = $_POST['unit_price'];
            $quantity = $_POST['quantity'];
            $total_ht = $_POST['total_ht'];
            $total_ttc = $_POST['total_ttc'];
            $observation = $_POST['observation'];
            $status = $_POST['status'];
           
            $query = mysqli_query($connect , "INSERT INTO purchase(purchase_no, purchase_date, product_name, settlement_date, amount, unit_price, total_ht, total_ttc, observation, status, quantity) 
                VALUES('$purchase_no', '$purchase_date', '$product_name', '$settlement_date', '$amount', '$unit_price', '$total_ht', '$total_ttc', '$observation', '$status', '$quantity')");
            if ($query == true) {
                $_SESSION['msg'] = "Acheter un article avec succès Ajouter";
                header('Location:purchase_view.php');
            }
            else{
                $_SESSION['error'] = "Erreur:" . $query . "<br>" . $connect->error;
            }                
                        
         }
?>

<?php require 'partials/header.php'; ?>
<style>
    
</style>

<?php require 'partials/sidebar.php';
    
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
                                                                <label class="col-sm-2">Numéro d'achat</label>
                                                                <div class="col-sm-5"><input name="purchase_no" type="text" class="form-control"  value="<?= $purchase_no ?>" readonly=""></div>
                                                            </div>
                                                            <div class="form-group">
                                                                <label class="col-sm-2">Date d'achat</label>
                                                                <div class="col-sm-5">
                                                                    <div class="input-group date">
                                                                        <input name="purchase_date" type="text" class="form-control" placeholder="mm/dd/yyyy">
                                                                        <span class="input-group-addon" ><i class="fa fa-calendar"></i></span>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="form-group">
                                                                <label class="col-sm-2">Nom du produit</label>
                                                                <div class="col-sm-5"><input name="product_name" type="text" class="form-control" placeholder="Nom du produit"></div>
                                                            </div>   
                                                            <div class="form-group">
                                                                <label class="col-sm-2">Date de règlement</label>
                                                                <div class="col-sm-5">
                                                                    <div class="input-group date">
                                                                        <input name="settlement_date" type="text" class="form-control" placeholder="mm/dd/yyyy">
                                                                        <span class="input-group-addon" ><i class="fa fa-calendar"></i></span>
                                                                    </div>
                                                                </div>
                                                            </div>                                                                                                             
                                                            <div class="form-group">
                                                                <label class="col-sm-2">Prix ​​unitaire HT</label>
                                                                <div class="col-sm-5">
                                                                    <input name="unit_price" type="number" class="form-control" id="prix_unitaire_ht" onkeyup="amount_calculate();" placeholder="Prix ​​unitaire HT" required="">
                                                                </div>
                                                            </div> 
                                                            <div class="form-group">
                                                                <label class="col-sm-2">Quantité </label>
                                                                <div class="col-sm-5">
                                                                    <input name="quantity" type="number" class="form-control" id="quantityn" onkeyup="amount_calculate();" placeholder="Quantité" required="">
                                                                </div>
                                                            </div>
                                                            <div class="form-group">
                                                                <label class="col-sm-2">Montant</label>
                                                                <div class="col-sm-5">
                                                                    <input name="amount" type="number" class="form-control" id="montant_total_ht" placeholder="Montant" readonly="">
                                                                </div>
                                                            </div>
                                                            <div class="form-group">
                                                                <label class="col-sm-2">Total HT</label>
                                                                <div class="col-sm-5">
                                                                    <input name="total_ht" type="number" class="form-control" placeholder="Total HT" required="">
                                                                </div>
                                                            </div>
                                                            <div class="form-group">
                                                                <label class="col-sm-2">Total TTC</label>
                                                                <div class="col-sm-5">
                                                                    <input name="total_ttc" type="number" class="form-control" placeholder="Total TTC" required="">
                                                                </div>
                                                            </div> 
                                                            <div class="form-group">
                                                                <label class="col-sm-2">Observation  </label>
                                                                <div class="col-sm-5">
                                                                    <input name="observation" type="text" class="form-control" placeholder="Remarques">
                                                                </div>
                                                            </div>
                                                            <div class="form-group">
                                                                <label class="col-sm-2">Statut</label>
                                                                <div class="col-sm-5">
                                                                    <select class="form-control" name="status">
                                                                        <option value="<?=  'not_set' ?>" ><?=  'Non reglé'  ?></option>
                                                                        <option value="<?=  'set' ?>" ><?=  'Case réglé'  ?></option>
                                                                    </select>
                                                                </div>
                                                            </div>
                                                            <div class="form-group">
                                                                <div class="col-sm-offset-2 col-sm-5">
                                                                    <button type="submit" name="is_submit" class="btn btn-sm btn-primary">
                                                                        Ajouter un item
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
<script>
    jQuery(document).ready(function($) {
        $('.user-select_option').select2();
    });
</script>
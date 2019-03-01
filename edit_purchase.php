<?php 
    require('config/db.php');
?>
<?php 
    require('config/guard.php');
    // var_dump(session_id());
?>

<?php 
    // session_start();
    $id = $_GET['id'];
    $fetchdata = mysqli_query($connect, "SELECT * FROM purchase WHERE id = '$id'");
    $printdata = mysqli_fetch_assoc($fetchdata);

    if (isset($_POST['is_submit'])) {
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

        $query = mysqli_query($connect, "UPDATE purchase SET purchase_date = '$purchase_date', product_name = '$product_name', settlement_date = '$settlement_date', unit_price = '$unit_price', amount = '$amount', total_ht = '$total_ht', total_ttc = '$total_ttc', observation = '$observation', status = '$status', quantity = '$quantity' WHERE id ='$id' ");
        if ($query == true) {
            $_SESSION['msg'] = "Mise à jour réussie";
            header('Location:purchase_view.php');

        }
        else{
            $_SESSION['error'] = "Erreur:" .$query ."<br>". $connect->error;
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
                                    <header class="panel-heading clearfix">
                                        <h3 class="profile-title pull-left"><?= $printdata['product_name'] ?></h3>
                                      <!--   <div class="pull-right">
                                            <a href="#" class="btn btn-sm btn-info"><i class="fa fa-pencil"></i></a>
                                            <a href="#" class="btn btn-sm btn-danger"><i class="fa fa-trash-o"></i></a>
                                        </div> -->
                                    </header>
                                    <div class="panel-body row">
                                      <div class="col-md-12">
                                            <div class="profile-tabs">
                                                <ul class="nav nav-tabs">
                                                    <li class="active"> <a href="#tab2"data-toggle="tab">Modifier un article d'achat</a></li>
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
                                                                <label class="col-sm-3 control-label">Numéro d'achat</label>
                                                                <div class="col-sm-5"><input type="text" class="form-control"  value="<?= $printdata['purchase_no'] ?>" readonly=""></div>
                                                            </div>
                                                            <div class="form-group">
                                                                <label class="col-sm-3 control-label">Date d'achat</label>
                                                                <div class="col-sm-5">
                                                                    <div class="input-group date">
                                                                        <input name="purchase_date" type="text" class="form-control" value="<?= $printdata['purchase_date'] ?>" placeholder="mm/dd/yyyy">
                                                                        <span class="input-group-addon" ><i class="fa fa-calendar"></i></span>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="form-group">
                                                                <label class="col-sm-3 control-label ">Nom du produit</label>
                                                                <div class="col-sm-5">
                                                                    <input name="product_name" placeholder="Nom du produit" type="text" class="form-control" value="<?= $printdata['product_name'] ?>" required="">
                                                                </div>
                                                            </div>
                                                            <div class="form-group">
                                                                <label class="col-sm-3 control-label">Date de règlement</label>
                                                                <div class="col-sm-5">
                                                                    <div class="input-group date">
                                                                        <input name="settlement_date" type="text" class="form-control" value="<?= $printdata['settlement_date'] ?>" placeholder="mm/dd/yyyy">
                                                                        <span class="input-group-addon" ><i class="fa fa-calendar"></i></span>
                                                                    </div>
                                                                </div>
                                                            </div>  
                                                            <div class="form-group">
                                                                <label class="col-sm-3 control-label">Prix ​​unitaire HT</label>
                                                                <div class="col-sm-5">
                                                                    <input name="unit_price" type="number" class="form-control" id="prix_unitaire_ht" onkeyup="amount_calculate();" value="<?= $printdata['unit_price'] ?>" placeholder="Prix ​​unitaire HT" required="">
                                                                </div>
                                                            </div> 
                                                            <div class="form-group">
                                                                <label class="col-sm-3 control-label ">Quantité</label>
                                                                <div class="col-sm-5">
                                                                    <input name="quantity" placeholder="Quantité" type="number"  id="quantityn" onkeyup="amount_calculate();" value="<?= $printdata['quantity'] ?>" class="form-control" required="">
                                                                </div>
                                                            </div>
                                                            <div class="form-group">
                                                                <label class="col-sm-3 control-label ">Montant</label>
                                                                <div class="col-sm-5">
                                                                    <input name="amount" placeholder="Montant" type="number"  id="montant_total_ht" value="<?= $printdata['amount'] ?>" class="form-control" readonly="">
                                                                </div>
                                                            </div>
                                                            <div class="form-group">
                                                                <label class="col-sm-3 control-label">Total HT</label>
                                                                <div class="col-sm-5">
                                                                    <input name="total_ht" type="number" class="form-control" value="<?= $printdata['total_ht'] ?>" placeholder="Total HT" required="">
                                                                </div>
                                                            </div>
                                                            <div class="form-group">
                                                                <label class="col-sm-3 control-label">Total TTC</label>
                                                                <div class="col-sm-5">
                                                                    <input name="total_ttc" type="number" class="form-control" value="<?= $printdata['total_ttc'] ?>" placeholder="Total TTC" required="">
                                                                </div>
                                                            </div> 
                                                            <div class="form-group">
                                                                <label class="col-sm-3 control-label">Observation</label>
                                                                <div class="col-sm-5">
                                                                    <input name="observation" type="text" value="<?= $printdata['observation'] ?>" class="form-control" placeholder="Remarques">
                                                                </div>
                                                            </div>
                                                            <div class="form-group">
                                                                <label class="col-sm-3 control-label">Statut</label>
                                                                <div class="col-sm-5">                                                                    
                                                                    <select class="form-control" name="status">
                                                                         <option <?= ($printdata['status']  == 'not_set') ? 'selected' : '' ; ?> value="<?= 'not_set' ?>" ><?= 'Non reglé' ?></option>
                                                                        <option <?= ($printdata['status']  == 'set') ? 'selected' : '' ; ?> value="<?= 'set' ?>" ><?= 'Case réglé'  ?></option>
                                                                    </select>
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

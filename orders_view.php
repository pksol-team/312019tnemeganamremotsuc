<?php 
    require('config/db.php');
?>
<?php 
    require('config/guard.php');
?>
<?php 

?>
<?php require 'partials/header.php'; ?>
<?php require 'partials/sidebar.php'; ?>

            <!--main content start-->
            <div id="content" class="ui-content">
                <div class="ui-content-body">

                    <div class="ui-container">

                        <!--page title and breadcrumb start -->
                        <div class="row">
                            <div class="col-md-8">
                                <h1 class="page-title"> Tous les ordres <br> <br> <a href="add_orders.php"><button type="submit" class="btn btn-info">Ajouter un nouveau</button></a>
                                </h1>
                            </div>
                            <div class="col-md-4">
                                <ul class="breadcrumb pull-right">
                                    <li>Accueil</li>
                                    <li><a href="orders_view.php" class="active">Ordres</a></li>
                                </ul>
                            </div>
                        </div>
                        <!--page title and breadcrumb end -->

                        <!-- <a href="add_user.php" class="btn btn-info" style="margin-bottom: 20px;">User</a> -->
                        <div class="row">
                            <div class="col-md-12">
                                <div class="panel">
                                    <header class="panel-heading panel-border">
                                        Liste des commandes
                                    </header>
                                    <div class="panel-body">
                                        <div class="table-responsive">
                                            <table id="order-pagination" class="table table-striped table-bordered">
                                                <thead>
                                                <tr>
                                                    <th><strong>Numéro de commande</strong></th>
                                                    <th><strong>Rendez-vous amoureux</strong></th>
                                                    <th><strong>Nom de la commande</strong></th>
                                                    <th><strong>Nom du client</strong></th>
                                                    <th><strong>Quantité</strong></th>
                                                    <th><strong>Prix ​​unitaire HT</strong></th>
                                                    <th><strong>Montant total HT</strong></th>
                                                    <th><strong>Quantité livrée</strong></th>
                                                    <th><strong>Date de la commande</strong></th>
                                                    <th><strong>quantité restante</strong></th>
                                                    <th><strong>Date de livraison</strong></th>
                                                    <th><strong>Statut de commande</strong></th>
                                                    <th><strong>Date de règlement</strong></th>
                                                    <th><strong>Statut de paiement</strong></th>
                                                    <th><strong>Montant de l'acompte</strong></th>
                                                    <th><strong>Observation</strong></th>
                                                    <th><strong>Action</strong></th>
                                                </tr>
                                                </thead>
                                                <tbody>
                                                    <?php $orders = mysqli_query($connect, "SELECT * FROM orders"); ?>
                                                    <?php while ($orders_details = mysqli_fetch_array($orders)) : ?>
                                                    <?php $orderID = $orders_details['id']; ?>
                                                <tr>
                                                    <td><?= $orders_details['order_no'] ?></td>
                                                    <td><?= $orders_details['order_date'] ?></td>
                                                    <td><?= $orders_details['name'] ?></td>
                                                    <td>
                                                        <?php 
                                                            $user_id = $orders_details['user_id']; 
                                                            $query = mysqli_query($connect, "SELECT * FROM user WHERE id = $user_id");
                                                            if ($query != true) {
                                                                echo 'No User select';
                                                            } else{
                                                                $result = mysqli_fetch_array($query);
                                                                echo $result['fullname'];
                                                            }
                                                         ?>
                                                    </td>
                                                    <td><?= $orders_details['quantity'] ?></td>
                                                    <td><?= $orders_details['prix_unitaire_ht'] ?></td>
                                                    <td><?= $orders_details['montant_total_ht'] ?></td>
                                                    <td>
                                                    <?php
                                                        $remainingQty = 0;
                                                        $ordersQty = mysqli_query($connect, "SELECT * FROM order_qunatity WHERE order_id = '$orderID'"); ?>
                                                        <?php  while ($ordersqty_count = mysqli_fetch_array($ordersQty)) : ?>
                                                            <?php echo '<u>'.$ordersqty_count['quantity_delivered'].'<u><br>'; ?>
                                                           <?php $remainingQty = $remainingQty + (int)$ordersqty_count['quantity_delivered']?> 
                                                        <?php  endwhile; ?>
                                                    </td>
                                                    <td>
                                                    <?php $ordersQty = mysqli_query($connect, "SELECT * FROM order_qunatity WHERE order_id = '$orderID'"); ?>
                                                        <?php  while ($ordersqty_date = mysqli_fetch_array($ordersQty)) : ?>
                                                            <?php  echo '<u>'.$ordersqty_date['delivered_date'].'<u><br>'; ?>
                                                        <?php  endwhile; ?>
                                                    </td>
                                                    <td><?= (int)$orders_details['quantity'] - $remainingQty ?></td>
                                                    <td><?= $orders_details['placeorder_date'] ?></td>
                                                    <td>
                                                        <?php if ($orders_details['status'] == "delivered") : ?>
                                                            <span class="label label-success">Livré</span>
                                                        <?php elseif ($orders_details['status'] == "not_delivered") :  ?>
                                                            <span class="label label-danger">Non livrés</span>    
                                                        <?php else: ?>
                                                            <span class="label label-info">En cours</span>
                                                        <?php endif ?>                                                        
                                                    </td>
                                                    <td><?= $orders_details['date_of_payment'] ?></td>
                                                    <td>
                                                        <?php if ($orders_details['payment_status'] == "paid") : ?>
                                                            <span class="label label-success">Payé</span>
                                                        <?php else: ?>
                                                            <span class="label label-danger">Non payé</span>    
                                                        <?php endif ?>                
                                                    </td>
                                                    
                                                    <td>
                                                        <?php if ($orders_details['down_payment'] == NULL OR $orders_details['down_payment'] == '0'): ?>
                                                            <?php echo "Aucun paiement de dépôt" ?>
                                                        <?php else: ?>   
                                                            <?=  $orders_details['down_payment'] ?>
                                                        <?php endif ?>                                                       
                                                    </td>
                                                    <td class="text-center">
                                                      <?php if ($orders_details['observation'] == NULL): ?>
                                                          <?php echo "-" ?>
                                                      <?php else: ?>   
                                                          <?=  $orders_details['observation'] ?>
                                                      <?php endif ?>   
                                                    </td>
                                                    <td>
                                                        <a href="edit_order.php?id=<?= $orders_details['id'] ?>" class="btn btn-sm btn-primary"><i class="fa fa-pencil-square-o" aria-hidden="true"></i></a>
                                                        <a href="delete_order.php?id=<?= $orders_details['id'] ?>" class="btn btn-sm btn-danger" onclick="return confirm('Etes-vous sûr que vous voulez supprimer?');"><i class="fa fa-trash" aria-hidden="true"></i></a>
                                                    </td>
                                                </tr>
                                            <?php  endwhile; ?>
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
            <?php include 'partials/copy_right.php'; ?>
            <!--main content end-->
            <?php require 'partials/footer.php'; ?>>

<script>
$(document).ready(function() {
    $('#order-pagination').DataTable( {
        "language": {
            "lengthMenu": "Spectacle _MENU_ les entrées",
            "zeroRecords": "Rien trouvé - désolé",
            "info": "Montrant page _PAGE_ de _PAGES_",
            "infoEmpty": "Aucun enregistrement disponible",
            "search": "Chercher",
            "infoFiltered": "(filtré de _MAX_ nombre total d'enregistrements)",
            "paginate": {
              "previous": "Page précédente",
              "next": "Suivant"
            }
        },
        initComplete: function () {
            this.api().columns().every( function () {
                var column = this;
                var select = $('<select><option value=""></option></select>')
                    .appendTo( $(column.footer()).empty() )
                    .on( 'change', function () {
                        var val = $.fn.dataTable.util.escapeRegex(
                            $(this).val()
                        );
 
                        column
                            .search( val ? '^'+val+'$' : '', true, false )
                            .draw();
                    } );
 
                column.data().unique().sort().each( function ( d, j ) {
                    select.append( '<option value="'+d+'">'+d+'</option>' )
                } );
            } );
        }
    } );
} );
</script>
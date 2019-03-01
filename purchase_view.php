<?php 
    require('config/db.php');
?>
<?php 
    require('config/guard.php');
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
                                <h1 class="page-title">Tout achat <br> <br> <a href="add_purchase.php"><button type="submit" class="btn btn-info">Ajouter un nouveau</button></a>
                                </h1>
                            </div>
                            <div class="col-md-4">
                                <ul class="breadcrumb pull-right">
                                    <li>Accueil</li>
                                    <li><a href="purchase_view.php" class="active">Achat</a></li>
                                </ul>
                            </div>
                        </div>
                        <!--page title and breadcrumb end -->

                        <!-- <a href="add_user.php" class="btn btn-info" style="margin-bottom: 20px;">User</a> -->
                        <div class="row">
                            <div class="col-md-12">
                                <div class="panel">
                                    <header class="panel-heading panel-border">
                                        Liste d'achat
                                    </header>
                                    <div class="panel-body">
                                        <div class="table-responsive">
                                            <table id="purchase-pagination" class="table table-striped table-bordered">
                                                <thead>
                                                <tr>
                                                    <th><strong>Numéro d'achat</strong></th>
                                                    <th><strong>Date d'achat</strong></th>
                                                    <th><strong>Date de règlement</strong></th>
                                                    <th><strong>Nom du produit</strong></th>
                                                    <th><strong>Montant</strong></th>
                                                    <th><strong>Prix ​​unitaire HT</strong></th>
                                                    <th><strong>Quantité</strong></th>
                                                    <th><strong>Total HT</strong></th>
                                                    <th><strong>Total TTC</strong></th>
                                                    <th><strong>Observation</strong></th>
                                                    <th><strong>Statut</strong></th>
                                                    <th><strong>Action</strong></th>
                                                </tr>
                                                </thead>
                                                <tbody>
                                                    <?php 
                                                        $purchase = mysqli_query($connect, "SELECT * FROM purchase");
                                                    ?>
                                                    <?php  while ($purchase_details = mysqli_fetch_array($purchase)) : ?>
                                                <tr>
                                                    <td><?= $purchase_details['purchase_no'] ?></td>
                                                    <td><?= $purchase_details['purchase_date'] ?></td>
                                                    <td><?= $purchase_details['product_name'] ?></td>                                                    
                                                    <td><?= $purchase_details['settlement_date'] ?></td>
                                                    <td><?= $purchase_details['amount'] ?></td>
                                                    <td><?= $purchase_details['unit_price'] ?></td>
                                                    <td><?= $purchase_details['quantity'] ?></td>
                                                    <td><?= $purchase_details['total_ht'] ?></td>
                                                    <td><?= $purchase_details['total_ttc'] ?></td>
                                                    <td><?= $purchase_details['observation'] ?></td>
                                                    <td>
                                                        <?php if ($purchase_details['status'] == "set") : ?>
                                                            <span class="label label-success">Non reglé </span>
                                                        <?php else: ?>
                                                            <span class="label label-danger">Case réglé</span>    
                                                        <?php endif ?>                
                                                    </td>
                                                    
                                                    <td>
                                                        <a href="edit_purchase.php?id=<?= $purchase_details['id'] ?>" class="btn btn-sm btn-primary"><i class="fa fa-pencil-square-o" aria-hidden="true"></i></a>
                                                        <a href="delete_purchase.php?id=<?= $purchase_details['id'] ?>" class="btn btn-sm btn-danger" onclick="return confirm('Etes-vous sûr que vous voulez supprimer?');"><i class="fa fa-trash" aria-hidden="true"></i></a>
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
    $('#purchase-pagination').DataTable( {
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
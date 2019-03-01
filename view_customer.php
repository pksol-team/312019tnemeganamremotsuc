<?php 
    require('config/db.php');
?>
<?php 
    require('config/guard.php');
?>
<?php require 'partials/header.php'; ?>
<style>
    th.sorting_disabled select {
        display: block;
        width: 100%;
        margin-top: 9px;
        border-color: #ddd;
        border-radius: 4px;
        padding: 2px 0;
        font-size: 12px;
    }
</style>
<?php require 'partials/sidebar.php'; ?>

            <!--main content start-->
            <div id="content" class="ui-content">
                <div class="ui-content-body">

                    <div class="ui-container">

                        <!--page title and breadcrumb start -->
                        <div class="row">
                            <div class="col-md-8">
                                <h1 class="page-title"> Tous les clients <br> <br> <a href="add_customer.php"><button type="submit" class="btn btn-info">Ajouter un nouveau</button></a>
                                </h1>
                            </div>
                            <div class="col-md-4">
                                <ul class="breadcrumb pull-right">
                                    <li>Accueil</li>
                                    <li><a href="view_user.php" class="active">Client</a></li>
                                </ul>
                            </div>
                        </div>
                        <!--page title and breadcrumb end -->

                        <!-- <a href="add_user.php" class="btn btn-info" style="margin-bottom: 20px;">User</a> -->
                        <div class="row">
                            <div class="col-md-12">
                                <div class="panel">
                                    <header class="panel-heading panel-border">
                                        Liste de clients
                                    </header>
                                    <div class="panel-body">
                                        <div class="table-responsive">
                                            <table id="pagination" class="table table-striped table-bordered">
                                                <thead>
                                                <tr>
                                                    <th><strong>Prénom</strong> </th>
                                                    <th><strong>Email</strong> </th>
                                                    <th><strong>Contact</strong> </th>
                                                    <th><strong>Adresse</strong> </th>
                                                    <th><strong>Registre du commerce</strong> </th>
                                                    <th><strong>T.V.A</strong> </th>
                                                    <th ><strong>Statut</strong> </th>
                                                    <th ><strong>Action</strong> </th>
                                                </tr>
                                                </thead>
                                                <tbody>
                                                    <?php 
                                                        $query = mysqli_query($connect, "SELECT * FROM user WHERE role != 'Admin' ORDER BY id DESC");
                                                    ?>
                                                    <?php while ($user_details = mysqli_fetch_array($query)) : ?>
                                                <tr>
                                                    <td><?= $user_details['fullname'] ?></td>
                                                    <td><?= $user_details['email'] ?></td>
                                                    <td><?= $user_details['phone'] ?></td>
                                                    <td><?= $user_details['address'] ?></td>
                                                    <td><?= $user_details['trade_register'] ?></td>
                                                    <td><?= $user_details['vat'] ?></td>
                                                    <td>
                                                        <?php if ($user_details['status'] == "Deactive") : ?>
                                                            <a href="user_status.php?id=<?= $user_details['id'] ?>" class="label label-warning">Désactivé</a>
                                                        <?php else:?>
                                                            <a href="user_status.php?id=<?= $user_details['id'] ?>" class="label label-success">Actif</a>
                                                        <?php endif ?>
                                                    </td>
                                                    <td>
                                                        <a href="edit_customer.php?id=<?= $user_details['id'] ?>" class="btn btn-sm btn-primary"><i class="fa fa-pencil-square-o" aria-hidden="true"></i></a>
                                                        <a href="delete_customer.php?id=<?= $user_details['id'] ?>" class="btn btn-sm btn-danger" onclick="return confirm('Etes-vous sûr que vous voulez supprimer?');"><i class="fa fa-trash" aria-hidden="true"></i></a>
                                                    </td>
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
            <?php include 'partials/copy_right.php'; ?>
            <?php require 'partials/footer.php'; ?>>
<script>
$(document).ready(function() {
    $('#pagination').DataTable( {
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
        "columnDefs": [
            { "orderable": false, "targets": 6 }
          ],
        initComplete: function () {
            // console.log(this.api().columns(0));
            this.api().columns(6).every( function () {
                var column = this;
                var select = $('<select><option value="">Tout</option></select>')
                    .appendTo( $(column.header()))
                    .on( 'change', function () {
                        var val = $.fn.dataTable.util.escapeRegex(
                            $(this).val()
                        );
                        column
                            .search( val ? '^'+val+'$' : '', true, false )
                            .draw();
                    } );
                    select.append( '<option value="Actif">Actif</option><option value="Désactivé">Désactivé</option>' )
            } );
        }
    } );
} );
</script>
<?php 
    require('config/db.php');
?>
<?php 
    // require('config/guard.php');
?>
<?php require 'partials/header.php'; ?>
<?php require 'partials/sidebar.php'; ?>

<?php 

    $get_orders = mysqli_query($connect, "SELECT * FROM orders");
    $count_orders = mysqli_num_rows($get_orders);


    $get_Customer = mysqli_query($connect, "SELECT * FROM user WHERE role = 'Customer'");
    $count_customers = mysqli_num_rows($get_Customer);

    $orders_revenue = mysqli_query($connect, "SELECT * FROM orders");
    
    while ($fetch_orders_rows = mysqli_fetch_array($orders_revenue)) {
        $unit = $fetch_orders_rows['prix_unitaire_ht'];
        $quantity = $fetch_orders_rows['quantity'];
        
        $total = $unit * $quantity;

        $count_amount += $total; 
    }


    $spending = mysqli_query($connect, "SELECT * FROM purchase");
    
    while ($fetch_purchase_rows = mysqli_fetch_array($spending)) {
        $unit_price = $fetch_purchase_rows['unit_price'];
        $quantity = $fetch_purchase_rows['quantity'];
        
        $total = $unit_price * $quantity;
        
        $count_purchase_amount += $total; 
    }
?>

            <!--main content start-->
            <div id="content" class="ui-content ui-content-aside-overlay">
                <div class="ui-content-body">

                    <div class="ui-container">

                        <div class="row w-states">
                            <div class="col-md-3 col-sm-6">
                                <div class="panel text-center">
                                    <div class="state-title">
                                        <span class="value"><?= $count_orders;  ?></span>
                                        <span class="info">Total de commandes</span>
                                    </div>

                                    <div class="progress-info">
                                        <div class="progress mbot-0">
                                            <span style="width: 100%;" class="progress-bar progress-bar-success">
                                                <span>&nbsp;</span>
                                            </span>
                                        </div>

                                    </div>
                                </div>
                            </div>
                            <div class="col-md-3 col-sm-6">
                                <div class="panel text-center">
                                    <div class="state-title">
                                        <span class="value"><?= $count_customers;  ?></span>
                                        <span class="info">Nombre total de clients</span>
                                    </div>

                                    <div class="progress-info">
                                        <div class="progress mbot-0">
                                            <span style="width: 100%;" class="progress-bar progress-bar-danger">
                                                <span>&nbsp;</span>
                                            </span>
                                        </div>

                                    </div>
                                </div>
                            </div>
                            <div class="col-md-3 col-sm-6">
                                <div class="panel text-center">
                                    <div class="state-title">
                                        <span class="value">$<?= $count_amount; ?></span>
                                        <span class="info">Montant total de toutes les commandes</span>
                                    </div>

                                    <div class="progress-info">
                                        <div class="progress mbot-0">
                                            <span style="width: 100%;" class="progress-bar progress-bar-info">
                                                <span>&nbsp;</span>
                                            </span>
                                        </div>

                                    </div>
                                </div>
                            </div>
                            <div class="col-md-3 col-sm-6">
                                <div class="panel text-center">
                                    <div class="state-title">
                                        <span class="value">$<?= $count_purchase_amount; ?></span>
                                        <span class="info">Quantité d'achat de tous les temps</span>
                                    </div>

                                    <div class="progress-info">
                                        <div class="progress mbot-0">
                                            <span style="width: 100%;" class="progress-bar progress-bar-warning">
                                                <span>&nbsp;</span>
                                            </span>
                                        </div>

                                    </div>
                                </div>
                            </div>
                        </div>

                        

                        <!--task distribution start-->
                        <div class="row">

                            <!-- <div class="col-md-6">
                                <div class="panel">
                                    <header class="panel-heading">
                                        Profit Database
                                        <span class="tools pull-right">
                                            <a class="close-box fa fa-times" href="javascript:;"></a>
                                        </span>
                                    </header>
                                    <div class="panel-body">
                                        <div class="table-responsive">
                                            <table class="table  table-hover general-table">
                                                <thead>
                                                <tr>
                                                    <th> Company</th>
                                                    <th class="hidden-phone">Descrition</th>
                                                    <th>Profit</th>
                                                    <th>Status</th>
                                                </tr>
                                                </thead>
                                                <tbody>
                                                <tr>
                                                    <td><a href="#">Graphics</a></td>
                                                    <td class="hidden-phone">Lorem Ipsum dorolo imit</td>
                                                    <td>1320.00$ </td>
                                                    <td><span class="label label-info label-mini">Due</span></td>
                                                </tr>
                                                <tr>
                                                    <td>
                                                        <a href="#">
                                                            ThemeBucket
                                                        </a>
                                                    </td>
                                                    <td class="hidden-phone">Lorem Ipsum dorolo</td>
                                                    <td>556.00$ </td>
                                                    <td><span class="label label-warning label-mini">Due</span></td>
                                                </tr>
                                                <tr>
                                                    <td>
                                                        <a href="#">
                                                            XYZ
                                                        </a>
                                                    </td>
                                                    <td class="hidden-phone">Lorem Ipsum dorolo</td>
                                                    <td>13240.00$ </td>
                                                    <td><span class="label label-success label-mini">Paid</span></td>
                                                </tr>
                                                <tr>
                                                    <td>
                                                        <a href="#">
                                                            BCSE
                                                        </a>
                                                    </td>
                                                    <td class="hidden-phone">Lorem Ipsum dorolo</td>
                                                    <td>3455.50$ </td>
                                                    <td><span class="label label-danger label-mini">Paid</span></td>
                                                </tr>
                                                <tr>
                                                    <td><a href="#">AVC Ltd</a></td>
                                                    <td class="hidden-phone">Lorem Ipsum dorolo imit</td>
                                                    <td>110.00$ </td>
                                                    <td><span class="label label-primary label-mini">Due</span></td>
                                                </tr>
                                                <tr>
                                                    <td>
                                                        <a href="#">
                                                            Themeforest
                                                        </a>
                                                    </td>
                                                    <td class="hidden-phone">Lorem Ipsum dorolo</td>
                                                    <td>456.00$ </td>
                                                    <td><span class="label label-warning label-mini">Due</span></td>
                                                </tr>
                                                <tr>
                                                    <td><a href="#">AVC Ltd</a></td>
                                                    <td class="hidden-phone">Lorem Ipsum dorolo imit</td>
                                                    <td>110.00$ </td>
                                                    <td><span class="label label-primary label-mini">Due</span></td>
                                                </tr>
                                                <tr>
                                                    <td>
                                                        <a href="#">
                                                            BCSE
                                                        </a>
                                                    </td>
                                                    <td class="hidden-phone">Lorem Ipsum dorolo</td>
                                                    <td>3455.50$ </td>
                                                    <td><span class="label label-danger label-mini">Paid</span></td>
                                                </tr>
                                                <tr>
                                                    <td><a href="#">AVC Ltd</a></td>
                                                    <td class="hidden-phone">Lorem Ipsum dorolo imit</td>
                                                    <td>110.00$ </td>
                                                    <td><span class="label label-primary label-mini">Due</span></td>
                                                </tr>
                                                <tr>
                                                    <td>
                                                        <a href="#">
                                                            Themeforest
                                                        </a>
                                                    </td>
                                                    <td class="hidden-phone">Lorem Ipsum dorolo</td>
                                                    <td>456.00$ </td>
                                                    <td><span class="label label-warning label-mini">Due</span></td>
                                                </tr>

                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                </div>
                            </div> -->
                            <!-- <div class="col-md-6">
                                <div class="panel">
                                    <header class="panel-heading panel-border">
                                        Task Summary
                                        <span class="tools pull-right">
                                            <a class="close-box fa fa-times" href="javascript:;"></a>
                                        </span>
                                    </header>
                                    <div class="panel-body">
                                        <ul class="task-sum-list">
                                            <li>
                                                <div class="tsk-cehck">
                                                    <div class="checkbox">
                                                        <label class="i-checks">
                                                            <input value="" type="checkbox" >
                                                            <i></i>
                                                        </label>
                                                    </div>
                                                </div>
                                                <div class="tsk-title">
                                                    Stunning Dashboard 2107. Huge possibilities. <label class="label label-warning">Minor</label>
                                                </div>
                                                <div class="tsk-action">
                                                    <div class="btn-group">
                                                        <button data-toggle="dropdown" class="btn btn-default dropdown-toggle" type="button" aria-expanded="false"> <i class="fa fa-cog"></i> <span class="caret"></span></button>
                                                        <ul role="menu" class="dropdown-menu dropdown-menu-right">
                                                            <li><a href="#"><i class="fa fa-check"></i> Done</a></li>
                                                            <li><a href="#"><i class="fa fa-pencil"></i> Edit</a></li>
                                                            <li><a href="#"><i class="fa fa-ban"></i> Cancel</a></li>
                                                        </ul>
                                                    </div>
                                                </div>
                                            </li>

                                            <li>
                                                <div class="tsk-cehck">
                                                    <div class="checkbox">
                                                        <label class="i-checks">
                                                            <input value="" type="checkbox" >
                                                            <i></i>
                                                        </label>
                                                    </div>
                                                </div>
                                                <div class="tsk-title">
                                                    Contrary to popular belief, Lorem Ipsum is not simply text.  <label class="label label-danger">Important</label>
                                                </div>
                                                <div class="tsk-action ">
                                                    <div class="btn-group">
                                                        <button data-toggle="dropdown" class="btn btn-default dropdown-toggle" type="button" aria-expanded="false"> <i class="fa fa-cog"></i> <span class="caret"></span></button>
                                                        <ul role="menu" class="dropdown-menu dropdown-menu-right">
                                                            <li><a href="#"><i class="fa fa-check"></i> Done</a></li>
                                                            <li><a href="#"><i class="fa fa-pencil"></i> Edit</a></li>
                                                            <li><a href="#"><i class="fa fa-ban"></i> Cancel</a></li>
                                                        </ul>
                                                    </div>
                                                </div>
                                            </li>

                                            <li>
                                                <div class="tsk-cehck">
                                                    <div class="checkbox">
                                                        <label class="i-checks">
                                                            <input value="" type="checkbox" >
                                                            <i></i>
                                                        </label>
                                                    </div>
                                                </div>
                                                <div class="tsk-title">
                                                    There are many variations of passages of Lorem Ipsum available. <label class="label label-success">Minor</label>
                                                </div>
                                                <div class="tsk-action ">
                                                    <div class="btn-group">
                                                        <button data-toggle="dropdown" class="btn btn-default dropdown-toggle" type="button" aria-expanded="false"> <i class="fa fa-cog"></i> <span class="caret"></span></button>
                                                        <ul role="menu" class="dropdown-menu dropdown-menu-right">
                                                            <li><a href="#"><i class="fa fa-check"></i> Done</a></li>
                                                            <li><a href="#"><i class="fa fa-pencil"></i> Edit</a></li>
                                                            <li><a href="#"><i class="fa fa-ban"></i> Cancel</a></li>
                                                        </ul>
                                                    </div>
                                                </div>
                                            </li>

                                            <li>
                                                <div class="tsk-cehck">
                                                    <div class="checkbox">
                                                        <label class="i-checks">
                                                            <input value="" type="checkbox" >
                                                            <i></i>
                                                        </label>
                                                    </div>
                                                </div>
                                                <div class="tsk-title">
                                                    It uses a dictionary of over 200 Latin words. <label class="label label-danger">Important</label>
                                                </div>
                                                <div class="tsk-action ">
                                                    <div class="btn-group">
                                                        <button data-toggle="dropdown" class="btn btn-default dropdown-toggle" type="button" aria-expanded="false"> <i class="fa fa-cog"></i> <span class="caret"></span></button>
                                                        <ul role="menu" class="dropdown-menu dropdown-menu-right">
                                                            <li><a href="#"><i class="fa fa-check"></i> Done</a></li>
                                                            <li><a href="#"><i class="fa fa-pencil"></i> Edit</a></li>
                                                            <li><a href="#"><i class="fa fa-ban"></i> Cancel</a></li>
                                                        </ul>
                                                    </div>
                                                </div>
                                            </li>

                                            <li>
                                                <div class="tsk-cehck">
                                                    <div class="checkbox">
                                                        <label class="i-checks">
                                                            <input value="" type="checkbox" >
                                                            <i></i>
                                                        </label>
                                                    </div>
                                                </div>
                                                <div class="tsk-title">
                                                    It was popularised in the 1960s with the release of Letraset sheets. <label class="label label-info">Minor</label>
                                                </div>
                                                <div class="tsk-action ">
                                                    <div class="btn-group">
                                                        <button data-toggle="dropdown" class="btn btn-default dropdown-toggle" type="button" aria-expanded="false"> <i class="fa fa-cog"></i> <span class="caret"></span></button>
                                                        <ul role="menu" class="dropdown-menu dropdown-menu-right">
                                                            <li><a href="#"><i class="fa fa-check"></i> Done</a></li>
                                                            <li><a href="#"><i class="fa fa-pencil"></i> Edit</a></li>
                                                            <li><a href="#"><i class="fa fa-ban"></i> Cancel</a></li>
                                                        </ul>
                                                    </div>
                                                </div>
                                            </li>

                                            <li>
                                                <div class="tsk-cehck">
                                                    <div class="checkbox">
                                                        <label class="i-checks">
                                                            <input value="" type="checkbox" >
                                                            <i></i>
                                                        </label>
                                                    </div>
                                                </div>
                                                <div class="tsk-title">
                                                    Publishing software like Aldus PageMaker including versions. <label class="label label-danger">Important</label>
                                                </div>
                                                <div class="tsk-action ">
                                                    <div class="btn-group">
                                                        <button data-toggle="dropdown" class="btn btn-default dropdown-toggle" type="button" aria-expanded="false"> <i class="fa fa-cog"></i> <span class="caret"></span></button>
                                                        <ul role="menu" class="dropdown-menu dropdown-menu-right">
                                                            <li><a href="#"><i class="fa fa-check"></i> Done</a></li>
                                                            <li><a href="#"><i class="fa fa-pencil"></i> Edit</a></li>
                                                            <li><a href="#"><i class="fa fa-ban"></i> Cancel</a></li>
                                                        </ul>
                                                    </div>
                                                </div>
                                            </li>

                                            <li>
                                                <div class="tsk-cehck">
                                                    <div class="checkbox">
                                                        <label class="i-checks">
                                                            <input value="" type="checkbox" >
                                                            <i></i>
                                                        </label>
                                                    </div>
                                                </div>
                                                <div class="tsk-title">
                                                    Many desktop publishing packages and web page editors. <label class="label label-warning">Minor</label>
                                                </div>
                                                <div class="tsk-action ">
                                                    <div class="btn-group">
                                                        <button data-toggle="dropdown" class="btn btn-default dropdown-toggle" type="button" aria-expanded="false"> <i class="fa fa-cog"></i> <span class="caret"></span></button>
                                                        <ul role="menu" class="dropdown-menu dropdown-menu-right">
                                                            <li><a href="#"><i class="fa fa-check"></i> Done</a></li>
                                                            <li><a href="#"><i class="fa fa-pencil"></i> Edit</a></li>
                                                            <li><a href="#"><i class="fa fa-ban"></i> Cancel</a></li>
                                                        </ul>
                                                    </div>
                                                </div>
                                            </li>

                                        </ul>
                                    </div>
                                </div>
                            </div> -->

                        </div>
                        <!--task distribution end-->

                    </div>

                    <!--right side widget start-->
                    
                    <!--right side widget end-->

                </div>
            </div>
            <!--main content end-->

            <!--footer start-->
            <?php include 'partials/copy_right.php'; ?>
            <!--footer end-->

        </div>
<?php require 'partials/footer.php'; ?>
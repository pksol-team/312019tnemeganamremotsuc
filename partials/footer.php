<!-- inject:js -->
        <script src="bower_components/jquery/dist/jquery.min.js"></script>
        <script src="assets/js/jquery.dataTables.min.js"></script>
        <script src="assets/js/dataTables.bootstrap.min.js"></script>
        <script src="bower_components/bootstrap/dist/js/bootstrap.min.js"></script>
        <script src="bower_components/jquery.nicescroll/dist/jquery.nicescroll.min.js"></script>
        <script src="bower_components/autosize/dist/autosize.min.js"></script>
        <!-- endinject -->
        <!-- Select2 Dependencies -->
        <script src="bower_components/select2/dist/js/select2.min.js"></script>
        <script src="assets/js/init-select2.js"></script>
        <!-- Bootstrap Date Range Picker Dependencies -->
        <script src="bower_components/moment/min/moment.min.js"></script>
        <script src="bower_components/bootstrap-daterangepicker/daterangepicker.js"></script>
        <script src="assets/js/init-daterangepicker.js"></script>

        <!-- Bootstrap Date Range Picker Dependencies -->
        <script src="bower_components/bootstrap-datepicker/dist/js/bootstrap-datepicker.min.js"></script>
        <script src="assets/js/init-datepicker.js"></script>
        <!-- Common Script   -->
        <script src="dist/js/main.js"></script>

        <script>
            $(document).ready(function() {  

                $(document).on('click', '.date-icon', function(e) {
                    $(this).prev('input').trigger('focus');
                });

                var quantityFields = ' <div class="form-group appendedQty"><label class="col-sm-2">Quantité livrée</label><div class="col-sm-5"><input name="quantity_delivered[]" type="number" placeholder="Quantité livrée" class="form-control split_quantity"></div></div><div class="form-group appendedQty"><label class="col-sm-2">Date de livraison</label><div class="col-sm-5"><div class="input-group date"><input readonly name="delivered_date[]" type="text" class="form-control custom_datepicker" placeholder="mm/dd/yyyy"><span class="input-group-addon date-icon" ><i class="fa fa-calendar"></i></span></div></div></div>  ';

                var totalquantity = 0;
                var newTotalQuantity = 0;

                $('#addmore-btn').on('click', function(e) {

                    var quantity = $('#quantityn').val();
                    var splitteddiv = $(document).find('.split_quantity');
                    var splittedquantity = splitteddiv.val();
                    var qty_delivered = $(document).find('.qty-delivered');

                    if (quantity != '') {
                        var totalQty = count_qty();

                        if (totalQty > parseInt(quantity)) {
                            alert('Quantité limite dépassée');
                        } 

                        else if(totalQty != parseInt(quantity)) 
                            if ($('.split_quantity').length > 0) {

                                var LastAppended = $('.split_quantity').last();

                                if (LastAppended.val() != '' && LastAppended.val() != '0') {
                                    $(quantityFields).appendTo('.delivered_div');
                                }
                            } else {
                                $(quantityFields).appendTo('.delivered_div');
                            }
                            $('.custom_datepicker').datepicker();

                    } else {
                        alert('Veuillez taper la quantité');
                    }

                });

                $(document).on('keyup', '.split_quantity', function(e) {

                    var $this = $(this);
                    var quantity = $('#quantityn').val();
                    var totalquantity = count_qty();

                    if (parseInt(quantity) < totalquantity) {
                        alert("La quantité n'est pas supérieure à la quantité");
                        $this.val('');
                    }

                });

                function count_qty() {
                 
                    var totalquantity = 0;
                    
                    var splitteddiv = $(document).find('.split_quantity');
                    var ordered_qty = $(document).find('.qty-delivered');

                    if (splitteddiv.length > 0) {
                        splitteddiv.each(function(index, el) {
                            var elementValue = $(el).val();
                            if (elementValue != '') {
                                totalquantity += parseInt(elementValue);
                            }
                        });
                    }

                    if (ordered_qty.length > 0) {
                        ordered_qty.each(function(index, el) {
                            var elementValue = $(el).html();

                            if (elementValue != '') {
                                totalquantity += parseInt(elementValue);
                            }
                        });
                    }

                    return totalquantity;
                }

                $('#quantityn').on('change', function(e) {
                    $('.appendedQty').remove();
                });

            });
        </script>
    </body>
</html>

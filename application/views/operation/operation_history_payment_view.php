<!-- order tab -->
<?php
    $transaction=[
        "0" => "Manual",
        "1" => "Bank Transfer",
        "2" => "Online Payment"
    ];
?>
<div class="right_col" role="main">
    <div class="operation_order_stationary">
        <div class="page-title">
            <div class="title_left">
                <h3>History - Payment</h3>
            </div>
            <div class="operation_title_right">
                <p>*click on Payment ID to view payment invoice <br> *click on Transaction Type to payment receipt</p>
            </div>
        </div>

        <div class="clearfix"></div>

        <div class="row">
            <div class="col-md-12 col-sm-12 col-xs-12">
                <div class="x_panel">
                    <div class="x_title">
                        <div class="clearfix"></div>
                    </div>
                    <div class="x_content">
                        <table id="directoryView" class="table table-striped table-bordered">
                            <thead>
                            <tr>
                                <th>Payment Date</th>
                                <th>Payment ID</th>
                                <th>Student Name</th>
                                <th>Value</th>
                                <th>Transaction Type</th>
                            </tr>
                            </thead>
                            <tbody>
                            <?php
                            if($orders){
                                $index = 0;
                                foreach($orders as $order){ ?>
                                    <tr role="row" class="<?php if ($index % 2 == 0) {echo "odd";} else{echo "even";}?>">
                                        <td><?php echo $order['paymentdate'] ?></td>
                                        <td><a href="<?php echo base_url() ?>index.php/operation/invoice/<?php echo $order['paymentid']?>"  style="color: cornflowerblue;"  role="button" class="open-modal"><?php echo $order['paymentid'] ?></a></td>
                                        <td><?php echo $order['firstname'] ?> <?php echo $order['lastname'] ?></td>
                                        <td><?php echo $order['value'] ?></td>
                                        <td><a href="<?php echo base_url() ?>index.php/operation/receipt/<?php echo $order['paymentid']?>" style="color: cornflowerblue;"><?php echo $transaction[$order['transactiontype']]?></a></td>
                                    </tr>
                                    <?php $index += 1; }}
                            else {?>
                                <tr>
                                    <td colspan="3"><?php echo 'No payment history, please check again later' ?></td>
                                </tr>
                            <?php } ?>
                            </tbody>

                            <div id="invoice" class="operation_invoice modal fade bs-example-modal-lg" tabindex="-1" role="dialog" aria-hidden="true">
                                <div class="modal-dialog modal-lg">
                                    <div class="modal-content">

                                        <div class="modal-header">
                                            <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">×</span>
                                            </button>
                                            <h4 class="modal-title" id="myModalLabel">Confirm Transfer Receipt</h4>
                                        </div>
                                        <div class="modal-body modal-body-text">
                                        <form class="ui form">
                                            <div class="form-group">
                                                <div class="logo-text">XYZ International School<br>
                                                    <span>Add: XXXXXXXXXXXXXXXXX<br>
                                                        Phone: XXX-XXXXXXX<br>
                                                        Fax: XXX-XXXXXXX<br>
                                                        Email: info@xyzinternationaschool.com
                                                    </span>
                                                </div>
                                                <div class="divider-dashed"></div>
                                                <label class="control-label col-md-3 col-sm-3 col-xs-12">Name</label>
                                                <div class="col-md-9 col-sm-9 col-xs-12 set-margin-bottom">
                                                    <input type="hidden" name="idT" id="idT"/>
                                                    <span class="control-label col-md-3 col-sm-3 col-xs-12" id="name">Name</span>
                                                </div>
                                                <label class="control-label col-md-3 col-sm-3 col-xs-12">Description</label>
                                                <div class="col-md-9 col-sm-9 col-xs-12 set-margin-bottom">
                                                    <span class="control-label col-md-3 col-sm-3 col-xs-12" id="description">Description</span>
                                                </div>
                                                <label class="control-label col-md-3 col-sm-3 col-xs-12">Charge</label>
                                                <div class="col-md-9 col-sm-9 col-xs-12 set-margin-bottom">
                                                    <span class="control-label col-md-3 col-sm-3 col-xs-12" id="value">Value</span>
                                                </div>

                                                <label><br>
                                                    Payment Method:<br><br>
                                                    (1) Online Payment: Please access the school website to use the online payment method (www.rumputilmu.com/sms)<br>
                                                    (2) Offline Payment: (XYZ International School)<br>
                                                    BCA     - XXXXXXXXXX<br>
                                                    BNI     - XXXXXXXXXX<br>
                                                    Mandiri - XXXXXXXXXX
                                                </label>
                                            </div>
                                        </form>
                                        </div>
                                        <div class="modal-footer">
                                            <button type="submit" id="create_pdf" class="btn btn-success"><i class="fa fa-download"></i> Download PDF</button>
                                        </div>
                                        <?php echo form_close(); ?>
                                    </div>
                                </div>
                            </div>
                        </table>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!--<script>-->
<!--    $(document).on("click", ".open-modal", function () {-->
<!--        var name = $(this).data('name');-->
<!--        var description = $(this).data('description');-->
<!--        var value = $(this).data('value');-->
<!--        document.getElementById('name').innerHTML = name;-->
<!--        document.getElementById('description').innerHTML = description;-->
<!--        document.getElementById('value').innerHTML = value;-->
<!--    });-->
<!--</script>-->
<!-- page content -->
<div class="right_col" role="main">
    <div class="">
        <div class="page-title">
            <div class="title_left">
                <h3>Payment Receipt</h3>
            </div>
        </div>

        <?php
        $transaction=[
            "1" => "Bank Transfer",
            "2" => "Credit Card"
        ];
        $status=[
            "0" => "Pending",
            "1" => "Done"
        ];
        ?>

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
                            <tr role="row">
                                <th>Update Date</th>
                                <th>Name</th>
                                <th>Description</th>
                                <th>Charge</th>
                                <th>Transaction Type</th>
                                <th>Status</th>
                            </tr>
                            </thead>
                            <tbody>
                            <?php
                            if($payments){
                                foreach($payments as $payment){ ?>
                                    <tr>
                                        <td><?php echo $payment['paymentdate'] ?></td>
                                        <td><?php echo $payment['firstname'] ?> <?php echo $payment['lastname'] ?></td>
                                        <td><?php echo $payment['description'] ?></td>
                                        <td><?php echo $payment['value'] ?></td>
                                        <td><?php echo $transaction[$payment['transactiontype']] ?></td>
                                        <td><?php echo $status[$payment['status']] ?></td>
                                    </tr>
                                <?php }}
                            else {?>
                                <tr>
                                    <td colspan="6"><?php echo 'no receipt found' ?></td>
                                </tr>
                            <?php } ?>

                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- /page content -->
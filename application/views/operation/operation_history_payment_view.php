<!-- order tab -->
<?php
    $transaction=[
        "1" => "Bank Transfer",
        "2" => "Credit Card"
    ];
?>
<div class="right_col" role="main">
    <div class="operation_order_stationary">
        <div class="page-title">
            <div class="title_left">
                <h3>History - Payment</h3>
            </div>
            <div class="operation_title_right">
                <p>*click on Payment ID to view payment receipt <br> *click on Transaction Type to view attachment</p>
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
                                        <td><a href="#" style="color: cornflowerblue;"><?php echo $order['paymentid'] ?></a></td>
                                        <td><?php echo $order['firstname'] ?> <?php echo $order['lastname'] ?></td>
                                        <td><?php echo $order['value'] ?></td>
                                        <td><a href="#" style="color: cornflowerblue;"><?php echo $transaction[$order['transactiontype']]?></a></td>
                                    </tr>
                                    <?php $index += 1; }}
                            else {?>
                                <tr>
                                    <td colspan="3"><?php echo 'No payment history, please check again later' ?></td>
                                </tr>
                            <?php } ?>
                            </tbody>
                        </table>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
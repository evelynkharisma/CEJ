<!-- order tab -->
<div class="right_col" role="main">
    <div class="operation_order_stationary">
        <div class="page-title">
            <div class="title_left">
                <h3>History - Book</h3>
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
                                <th>ID</th>
                                <th>Borrowed Date</th>
                                <th>Returned Date</th>
                                <th>Name</th>
                                <th>User Type</th>
                                <th>Value</th>
                            </tr>
                            </thead>
                            <tbody>
                            <?php
                            if($orders){
                                $index = 0;
                                foreach($orders as $order){
                                    ?>

                                    <tr role="row" class="<?php if ($index % 2 == 0) {echo "odd";} else{echo "even";}?>">
                                        <td><?php echo $order['lbid'] ?></td>
                                        <td><?php echo $order['borrowed_date'] ?></td>
                                        <td><?php echo $order['returned_date'] ?></td>
                                        <td><?php echo $order['firstname'] ?> <?php echo $order['lastname'] ?></td>
                                        <td><?php echo $order['usertype'] ?></td>
                                        <td><?php echo $order['fine'] ?></td>
                                        <!--                                            <a data-toggle="modal" --><?php //if($order['transactiontype']==1 OR $order['transactiontype']==0){echo'data-id="'.$order['paymentid'].'" data-name="'. $order['firstname'].' '. $order['lastname'].'" data-description="'. $order['description'] .'" data-value="'. $order['value'].'" data-picture="'. $pictures['attachment'].'"';}?><!-- data-target="#--><?php //if($order['transactiontype']==1){echo'confirm';} else{echo 'receipt';}?><!--" role="button" class="open-modal btn btn-success">--><?php //if($order['transactiontype']==1){echo 'Confirm Payment';} else{echo'Manual Receipt';}?><!--</a>-->
                                        <!--                                            <a data-toggle="modal" --><?php //if($order['transactiontype']==1){echo'onclick="viewTransfer('; echo '"'. $order['paymentid'].'","'. $order['firstname'].' '. $order['lastname'] .'","'. $order['description'] .'","'. $order['value'].'","'. $pictures['attachment'] .'")"';}?><!-- data-target="#--><?php //if($order['transactiontype']==1){echo'confirm';} else{echo 'receipt';}?><!--" role="button" class="btn btn-success">--><?php //if($order['transactiontype']==1){echo 'Confirm Payment';} else{echo'Manual Receipt';}?><!--</a></td>-->
                                    </tr>
                                    <?php $index += 1; }}
                            else {?>
                                <tr>
                                    <td colspan="3"><?php echo 'No outstanding request, please check again later' ?></td>
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
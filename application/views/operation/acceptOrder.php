<!-- order tab -->
<?php
$redirect = 'operation/'.$from.'/'.$dateO;
echo form_open_multipart($redirect); ?>
    <div class="right_col" role="main">
        <div class="operation_order_stationary">
            <div class="page-title">
                <div class="title_left">
                    <h3>Stationary Order - History</h3>
                </div>
            </div>
            <button type="submit" class="order-accept-all btn btn-success">Proceed</button>

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
                                    <th>Item Name</th>
                                    <th>Requested</th>
                                    <th>Remaining</th>
                                    <th>Bought</th>
                                </tr>
                                </thead>
                                <tbody>
                                <?php
                                if($orders){
                                    $index = 0;
                                    foreach($orders as $order){ ?>
                                        <tr role="row" class="<?php if ($index % 2 == 0) {echo "odd";} else{echo "even";}?>">
                                            <td><input type="hidden" name="itemid[]" value="<?php if(!empty($order['itemid'])){ echo $order['itemid'];}else {echo $order['isbn'];}?>">
                                            <?php echo $order['name'] ?>
                                            </td>
                                            <td><?php echo $order['number'] ?></td>
                                            <td><?php echo $order['remains'] ?></td>
                                            <td><input type="number" name="bought[]" value="<?php echo $order['remains'] ?>"></td>
                                        </tr>
                                        <?php $index += 1; }}?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
<?php echo form_close(); ?>
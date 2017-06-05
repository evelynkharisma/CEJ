<!-- order tab -->
<div class="right_col" role="main">
    <div class="operation_order_stationary">
        <div class="page-title">
            <div class="title_left">
                <h3>Resource Order (Original) - History</h3>
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
                                <th>Completion</th>
                                <th>Total Quantity</th>
                                <th>Action</th>
                            </tr>
                            </thead>
                            <tbody>
                            <?php
                            if($orders){
                                $index = 0;
                                foreach($orders as $order){ ?>
                                    <tr role="row" class="<?php if ($index % 2 == 0) {echo "odd";} else{echo "even";}?>">
                                        <td><a href=""><?php echo $order['completion'] ?></a></td>
                                        <td><?php echo $order['remains'] ?></td>
                                        <td><a href="<?php echo base_url() ?>index.php/operation/completeOrder/<?php echo $order['completion'] ?>" class="btn btn-success">Finish Order</a></td>
                                    </tr>
                                    <?php $index += 1; }}
                            else {?>
                                <tr>
                                    <td colspan="3"><?php echo 'No book history request, please check again later' ?></td>
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
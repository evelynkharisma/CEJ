<!-- page content -->
<div class="right_col" role="main">
    <div class="">
        <div class="page-title">
            <div class="title_left">
                <h3>Payment</h3>
            </div>
        </div>

        <div class="clearfix"></div>

        <div class="row">
            <div class="col-md-12 col-sm-12 col-xs-12">
                <div class="x_panel">
                    <div class="x_title">
                        <a class="btn btn-danger set-right"><i class="fa fa-bell-o"></i> Notify All</a>
                        <div class="clearfix"></div>
                    </div>
                    <div class="x_content">
                        <table id="directoryView" class="table table-striped table-bordered">
                            <thead>
                            <tr>
                                <th>Inquiry Date</th>
                                <th>Student Name</th>
                                <th>Payment Description</th>
                                <th>Value</th>
                                <th>Action</th>
                            </tr>
                            </thead>
                            <tbody>
                            <?php
                            if($orders){
                                $index = 0;
                                foreach($orders as $order){ ?>
                                    <tr role="row" class="<?php if ($index % 2 == 0) {echo "odd";} else{echo "even";}?>">
                                        <td><?php echo $order['inquirydate'] ?></td>
                                        <td><?php echo $order['firstname'] ?> <?php echo $order['lastname'] ?></td>
                                        <td><?php echo $order['description'] ?></td>
                                        <td><?php echo $order['value'] ?></td>
                                        <td><a href="<?php echo base_url() ?>index.php/operation/notify/<?php echo $order['paymentid'] ?>" class="btn <?php if ($order['transactiontype']=='1'){echo 'btn-default disabled';} else{echo 'btn-danger';}?>"><i class="fa fa-bell-o"></i> Notify</a></td>
                                    </tr>
                                    <?php $index += 1; }}
                            else {?>
                                <tr>
                                    <td colspan="3"><?php echo 'No outstanding request, please check again later' ?></td>
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
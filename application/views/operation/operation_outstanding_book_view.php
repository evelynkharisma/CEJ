<!-- order tab -->
<div class="right_col" role="main">
    <div class="operation_order_book">
        <div class="page-title">
            <div class="title_left">
                <h3>Outstanding - Book</h3>
            </div>
            <a href="<?php echo base_url() ?>index.php/operation/notifyallbook" class="order-accept-all btn btn-danger">Notify All</a>
        </div>

        <div class="clearfix"></div>

        <?php if ($this->nativesession->get('error')): ?>
            <div  class="alert alert-warning">
                <?php echo $this->nativesession->get('error'); $this->nativesession->delete('error');?>
            </div>
        <?php endif; ?>
        <?php if ($this->nativesession->get('success')): ?>
            <div  class="alert alert-success">
                <?php echo $this->nativesession->get('success'); $this->nativesession->delete('success');?>
            </div>
        <?php endif; ?>
        <?php if (validation_errors()): ?>
            <div  class="alert alert-error">
                <?php echo validation_errors(); ?>
            </div>
        <?php endif; ?>

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
                                <th>Due Date</th>
                                <th>Name</th>
                                <th>User Type</th>
                                <th>Value</th>
                                <th>Action</th>
                            </tr>
                            </thead>
                            <tbody>
                            <?php
                            if($orders){
                                $index = 0;
                                foreach($orders as $order){
                                    $time = $this->Library_model->getBorrowingSettingByID($order['borrowCategory']);
                                    $time = date('Y-m-d', strtotime($order['borrowed_date']. ' + '.$time['borrowingPeriod'].' days'));
                                    ?>

                                    <tr role="row" class="<?php if ($index % 2 == 0) {echo "odd";} else{echo "even";}?>">
                                        <td><?php echo $order['lbid'] ?></td>
                                        <td><?php echo $order['borrowed_date'] ?></td>
                                        <td><?php echo $time ?></td>
                                        <td><?php echo $order['firstname'] ?> <?php echo $order['lastname'] ?></td>
                                        <td><?php echo $order['usertype'] ?></td>
                                        <td><?php echo $order['fine'] ?></td>
                                        <td class="action"><a href="<?php echo base_url() ?>index.php/operation/notifyBook/<?php echo $order['lbid'] ?>" class="btn <?php if ($order['notify']==(date('Y-m-d', now()))){echo 'btn-default disabled';} else{echo 'btn-danger';}?>">Notify</a></td>
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
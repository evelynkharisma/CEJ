<!-- order tab -->
<div class="right_col" role="main">
    <div class="operation_order_stationary">
        <div class="page-title">
            <div class="title_left">
                <h3>Resource Order (Photocopy) - History</h3>
            </div>
        </div>

        <div class="clearfix"></div>

        <?php if ($this->nativesession->get('success')): ?>
            <div  class="alert alert-success">
                <?php echo $this->nativesession->get('success'); $this->nativesession->delete('success');?>
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
                                <th>Date Accepted</th>
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
                                        <td><?php echo $order['completion'] ?></td>
                                        <td><?php echo $order['remains'] ?></td>
                                        <td><a href="<?php echo base_url() ?>index.php/operation/completeCopyOrder/<?php echo $order['completion'] ?>" class="btn <?php if ($order['status']=='2'){echo 'btn-default disable';}else{echo "btn-success";}?>"><?php if ($order['status']=='2'){echo "View Order";}else{echo "Finish Order";}?></a></td>
                                    </tr>
                                    <?php $index += 1; }}
                            else {?>
                                <tr>
                                    <td colspan="3"><?php echo 'No copy history request, please check again later' ?></td>
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
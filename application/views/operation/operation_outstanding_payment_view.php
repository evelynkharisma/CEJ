<!-- order tab -->
<div class="right_col" role="main">
    <div class="operation_order_stationary">
        <div class="page-title">
            <div class="title_left">
                <h3>Outstanding - Payment</h3>
            </div>
            <a href="<?php echo base_url() ?>index.php/operation/notifyall" class="order-accept-all btn btn-danger">Notify All</a>
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
                                foreach($orders as $order){
                                    $pictures = $this->Operation_model->getPaymentFile($order['paymentid']);
                                    ?>

                                    <tr role="row" class="<?php if ($index % 2 == 0) {echo "odd";} else{echo "even";}?>">
                                        <td><?php echo $order['inquirydate'] ?></td>
                                        <td><?php echo $order['firstname'] ?> <?php echo $order['lastname'] ?></td>
                                        <td><?php echo $order['description'] ?></td>
                                        <td><?php echo $order['value'] ?></td>
                                        <td class="action"><a href="<?php echo base_url() ?>index.php/operation/notify/<?php echo $order['paymentid'] ?>" class="btn <?php if (($order['transactiontype']=='1') OR ($order['notify']==(date('Y-m-d', now())))){echo 'btn-default disabled';} else{echo 'btn-danger';}?>">Notify</a>
                                            <a data-toggle="modal" <?php if($order['transactiontype']==1 OR $order['transactiontype']==0){echo'data-id="'.$order['paymentid'].'" data-name="'. $order['firstname'].' '. $order['lastname'].'" data-description="'. $order['description'] .'" data-value="'. $order['value'].'" data-picture="'. $pictures['attachment'].'"';}?> data-target="#<?php if($order['transactiontype']==1){echo'confirm';} else{echo 'receipt';}?>" role="button" class="open-modal btn btn-success"><?php if($order['transactiontype']==1){echo 'Confirm Payment';} else{echo'Manual Receipt';}?></a></td>
<!--                                            <a data-toggle="modal" --><?php //if($order['transactiontype']==1){echo'onclick="viewTransfer('; echo '"'. $order['paymentid'].'","'. $order['firstname'].' '. $order['lastname'] .'","'. $order['description'] .'","'. $order['value'].'","'. $pictures['attachment'] .'")"';}?><!-- data-target="#--><?php //if($order['transactiontype']==1){echo'confirm';} else{echo 'receipt';}?><!--" role="button" class="btn btn-success">--><?php //if($order['transactiontype']==1){echo 'Confirm Payment';} else{echo'Manual Receipt';}?><!--</a></td>-->
                                    </tr>
                                    <?php $index += 1; }}
                            else {?>
                                <tr>
                                    <td colspan="3"><?php echo 'No outstanding request, please check again later' ?></td>
                                </tr>
                            <?php } ?>
                            </tbody>
                            <div id="confirm" class="modal fade bs-example-modal-lg" tabindex="-1" role="dialog" aria-hidden="true">
                                <div class="modal-dialog modal-lg">
                                    <div class="modal-content">

                                        <div class="modal-header">
                                            <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">×</span>
                                            </button>
                                            <h4 class="modal-title" id="myModalLabel">Confirm Transfer Receipt</h4>
                                        </div>
                                        <div class="modal-body modal-body-text">
                                            <?php echo form_open_multipart('operation/approveTransfer'); ?>
                                            <div class="form-group">
                                                <label class="control-label col-md-3 col-sm-3 col-xs-12">Name</label>
                                                <div class="col-md-9 col-sm-9 col-xs-12 set-margin-bottom">
                                                    <input type="hidden" name="idT" id="idT"/>
                                                    <input type="text" disabled="disabled" name="name" id="name" />
                                                </div>
                                                <label class="control-label col-md-3 col-sm-3 col-xs-12">Description</label>
                                                <div class="col-md-9 col-sm-9 col-xs-12 set-margin-bottom">
                                                    <input type="text" disabled="disabled" name="description" id="description" />
                                                </div>
                                                <label class="control-label col-md-3 col-sm-3 col-xs-12">Value</label>
                                                <div class="col-md-9 col-sm-9 col-xs-12 set-margin-bottom">
                                                    <input type="text" disabled="disabled"  name="value" id="value" />
                                                </div>
                                                <label class="control-label col-md-3 col-sm-3 col-xs-12">Attachment</label>
                                                <div class="col-md-9 col-sm-9 col-xs-12 set-margin-bottom">
                                                    <img src="" name='attachment' id="attachment"/>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="modal-footer">
                                            <button type="submit" class="btn btn-success"><i class="fa fa-upload"></i> Accept Payment</button>
                                        </div>
                                        <?php echo form_close(); ?>
                                    </div>
                                </div>
                            </div>
                            <div id="receipt" class="modal fade bs-example-modal-lg" tabindex="-1" role="dialog" aria-hidden="true">
                                <div class="modal-dialog modal-lg">
                                    <div class="modal-content">

                                        <div class="modal-header">
                                            <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">×</span>
                                            </button>
                                            <h4 class="modal-title" id="myModalLabel">Confirm Manual Receipt</h4>
                                        </div>
                                        <div class="modal-body modal-body-text1">
                                            <?php echo form_open_multipart('operation/approveManual'); ?>
                                            <div class="form-group">
                                                <label class="control-label col-md-3 col-sm-3 col-xs-12">Name</label>
                                                <div class="col-md-9 col-sm-9 col-xs-12 set-margin-bottom">
                                                    <input type="hidden" name="idM" id="idM"/>
                                                    <input type="text" disabled="disabled" name="name" id="nameM" />
                                                </div>
                                                <label class="control-label col-md-3 col-sm-3 col-xs-12">Description</label>
                                                <div class="col-md-9 col-sm-9 col-xs-12 set-margin-bottom">
                                                    <input type="text" disabled="disabled" name="description" id="descriptionM" />
                                                </div>
                                                <label class="control-label col-md-3 col-sm-3 col-xs-12">Value</label>
                                                <div class="col-md-9 col-sm-9 col-xs-12 set-margin-bottom">
                                                    <input type="text" disabled="disabled"  name="value" id="valueM" />
                                                </div>
                                                <label class="control-label col-md-3 col-sm-3 col-xs-12">Attachment</label>
                                                <div class="col-md-9 col-sm-9 col-xs-12 set-margin-bottom">
                                                    <input type="file" name='attachmentM' id="attachmentM">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="modal-footer">
                                            <button type="submit" class="btn btn-success"><i class="fa fa-upload"></i> Accept Payment</button>
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
<script>
    $(document).on("click", ".open-modal", function () {
        var id = $(this).data('id');
        var name = $(this).data('name');
        var description = $(this).data('description');
        var value = $(this).data('value');
        var picture = "<?php echo base_url() ?>assets/file/payment/"+$(this).data('picture');
        var pic = document.getElementById('attachment');
        $(".modal-body-text #idT").val( id );
        $(".modal-body-text1 #idM").val( id );
        $(".modal-body-text #name").val( name );
        $(".modal-body-text1 #nameM").val( name );
        $(".modal-body-text #description").val( description);
        $(".modal-body-text1 #descriptionM").val( description);
        $(".modal-body-text #value").val( value );
        $(".modal-body-text1 #valueM").val( value );
        pic.src = picture;
    });
</script>
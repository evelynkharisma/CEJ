<?php
$type=[
    "0" => "Manual",
    "1" => "Bank Transfer",
    "2" => "Online Payment"
];
?>
<div class="right_col" role="main">
    <div class="operation_order_stationary invoice">
        <div class="page-title">
            <div class="title_left">
                <h3>Receipt</h3>
            </div>
        </div>

        <div class="clearfix"></div>

        <div class="row">
            <div class="col-md-12 col-sm-12 col-xs-12">
                <div class="x_panel">
                    <div class="x_title">
                        <div class="clearfix"></div>
                    </div>
                    <?php
                    if($payment){?>
                    <div class="ui page grid">
                        <div class="wide column">
                            <div class="ui">
                                <div class="modal-body modal-body-text">
                                    <form class="ui form">
                                        <div class="form-group ui header">
                                            <div class="ui dividing header logo-text">XYZ International School<br>
                                                        <span>Address: XXXXXXXXXXXXXXXXX<br>
                                                            Phone: XXX-XXXXXXX<br>
                                                            Fax: XXX-XXXXXXX<br>
                                                            Email: info@xyzinternationalschool.com
                                                        </span>
                                            </div>
                                            <div class="divider-dashed"></div>
                                            <label class="control-label col-md-3 col-sm-3 col-xs-12">Inquiry Date</label>
                                            <div class="col-md-9 col-sm-9 col-xs-12 set-margin-bottom">
                                                <span class="control-label" id="value"><?php echo $payment['inquirydate'];?></span>
                                            </div>
                                            <label class="control-label col-md-3 col-sm-3 col-xs-12">Name</label>
                                            <div class="col-md-9 col-sm-9 col-xs-12 set-margin-bottom">
                                                <span class="control-label" id="name"><?php echo $payment['firstname'];?> <?php echo $payment['lastname'];?></span>
                                            </div>
                                            <label class="control-label col-md-3 col-sm-3 col-xs-12">Description</label>
                                            <div class="col-md-9 col-sm-9 col-xs-12 set-margin-bottom">
                                                <span class="control-label" id="description"><?php echo $payment['description'];?></span>
                                            </div>
                                            <label class="control-label col-md-3 col-sm-3 col-xs-12">Charge</label>
                                            <div class="col-md-9 col-sm-9 col-xs-12 set-margin-bottom">
                                                <span class="control-label" id="value"><?php echo $payment['value'];?></span>
                                            </div>
                                            <label class="control-label col-md-3 col-sm-3 col-xs-12">Payment Date</label>
                                            <div class="col-md-9 col-sm-9 col-xs-12 set-margin-bottom">
                                                <span class="control-label" id="value"><?php echo $payment['paymentdate'];?></span>
                                            </div>
                                            <label class="control-label col-md-3 col-sm-3 col-xs-12">Transaction Type</label>
                                            <div class="col-md-9 col-sm-9 col-xs-12 set-margin-bottom">
                                                <span class="control-label" id="value"><?php echo $type[$payment['transactiontype']];?></span>
                                            </div>
                                            <?php if($payment['transactiontype']==1){
                                                $pictures = $this->Operation_model->getPaymentFile($payment['paymentid']);
                                                ?>
                                                <label class="control-label col-md-3 col-sm-3 col-xs-12">Attachment</label>
                                                <div class="col-md-9 col-sm-9 col-xs-12 set-margin-bottom">
                                                    <img src="<?php echo base_url() ?>assets/file/payment/<?php echo $pictures['attachment'];?>" alt="attachment">
                                                </div>
                                            <?php } ?>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div><?php }?>
                    <div class="modal-footer">
                        <button type="submit" id="create_pdf" class="btn btn-success"><i class="fa fa-download"></i> Download PDF</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
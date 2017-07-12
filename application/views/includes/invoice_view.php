
<div class="right_col" role="main">
    <div class="operation_order_stationary invoice">
        <div class="page-title">
            <div class="title_left">
                <h3>Invoice</h3>
            </div>
        </div>

        <div class="clearfix"></div>
        <?php if ($type=='parents'){
        if($payments){
            ?>
            <div class="row">
                <div class="col-md-12 col-sm-12 col-xs-12">
                    <div class="x_panel">
                        <div class="x_title">
                            <div class="clearfix"></div>
                        </div>
                        <?php
                        if($payments){?>
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
                                                <?php
                                                $sum = 0;
                                                foreach($payments as $payment) { ?>

                                                    <label class="control-label col-md-3 col-sm-3 col-xs-12">Name</label>
                                                    <div class="col-md-9 col-sm-9 col-xs-12 set-margin-bottom">
                                                    <span class="control-label" id="name"><?php echo $payment['firstname']; ?> <?php echo $payment['lastname']; ?></span>
                                                    </div>

                                                    <label class="control-label col-md-3 col-sm-3 col-xs-12">Description</label>
                                                    <div class="col-md-9 col-sm-9 col-xs-12 set-margin-bottom">
                                                    <span class="control-label" id="description"><?php echo $payment['description']; ?></span>
                                                    </div>

                                                    <label class="control-label col-md-3 col-sm-3 col-xs-12">Charge</label>
                                                    <div class="col-md-9 col-sm-9 col-xs-12 set-margin-bottom">
                                                    <span class="control-label" id="value">$ <?php echo $payment['value']; ?></span>
                                                    </div>

                                                    <div class="clearfix"></div>
                                                    <div style="border-bottom: 1px gray dotted; margin-bottom: 1%"></div>
                                                    <?php
                                                    $sum+=$payment['value'];
                                                }
                                                ?>
                                                <br>
                                                <label style="font-weight: bold" class="control-label col-md-3 col-sm-3 col-xs-12">Total</label>
                                                <div class="col-md-9 col-sm-9 col-xs-12 set-margin-bottom">
                                                        <span class="control-label" id="value">$ <?php echo $sum; ?></span>
                                                </div>
                                                <div class="payment-method">
                                                    Payment Method:<br><br>
                                                    <span style="font-weight: bold">(1) Online Payment:</span> <br>Please access the school website to use the online payment method (www.rumputilmu.com/sms)<br><br>
                                                    <span style="font-weight: bold">(2) Offline Payment:</span> <br>(XYZ International School)<br>
                                                    BCA     - XXXXXXXXXX<br>
                                                    BNI     - XXXXXXXXXX<br>
                                                    Mandiri - XXXXXXXXXX
                                                </div>
                                            </div>
                                        </form>
                                    </div>
                                </div><?php }?>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="submit" id="create_pdf" class="btn btn-success"><i class="fa fa-download"></i> Download PDF</button>
                        </div>
                    </div>
                </div>
            </div>
        <?php
        }}
        else{
            ?>
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

                                            <div class="payment-method">
                                                Payment Method:<br><br>
                                                <span style="font-weight: bold">(1) Online Payment:</span> <br>Please access the school website to use the online payment method (www.rumputilmu.com/sms)<br><br>
                                                <span style="font-weight: bold">(2) Offline Payment:</span> <br>(XYZ International School)<br>
                                                BCA     - XXXXXXXXXX<br>
                                                BNI     - XXXXXXXXXX<br>
                                                Mandiri - XXXXXXXXXX
                                            </div>
                                        </div>
                                    </form>
                                </div>
                            </div><?php }?>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="submit" id="create_pdf" class="btn btn-success"><i class="fa fa-download"></i> Download PDF</button>
                    </div>
                 </div>
            </div>
        </div>
        <?php }?>
    </div>
</div>
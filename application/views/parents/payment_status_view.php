<!-- page content -->
<div class="right_col" role="main">
    <div class="payment-status">
        <div class="page-title">
            <div class="title_left">
                <h3>Payment Status</h3>
            </div>
        </div>

        <div class="clearfix"></div>

        <?php if ($this->nativesession->get('error')): ?>
            <div  class="alert alert-error">
                <?php echo $this->nativesession->get('error');$this->nativesession->delete('error'); ?>
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
                <table id="directoryView" class="table table-striped table-bordered">
                    <thead>
                    <tr role="row">
                        <th>Inquiry Date</th>
                        <th>Name</th>
                        <th>Description</th>
                        <th>Charge</th>
                    </tr>
                    </thead>
                    <tbody>
                    <?php
                    if($payments){
                        $description='';
                        $sum = 0;
                        foreach($payments as $payment){ ?>
                            <tr>
                                <td><?php echo $payment['inquirydate'] ?></td>
                                <td><?php echo $payment['firstname'] ?> <?php echo $payment['lastname'] ?></td>
                                <td><?php echo $payment['description'] ?></td>
                                <td>$ <?php
                                    $priceAfter = number_format($payment['value'], 0, ',', '.');
                                    echo $priceAfter;
                                    ?></td>
                            </tr>
                        <?php
                            if($sum==0){
                                $description =  $payment['firstname'].' '.$payment['lastname'].'\'s '.$payment['description'];
                            }
                            else{
                                $description = $description.', '.$payment['firstname'].' '.$payment['lastname'].'\'s '.$payment['description'];
                            }
                            $sum+=$payment['value'];}?>
                    <tr>
                        <td colspan="3"><h2><b>Total Charge: </b></h2></td>
                        <td><h2><b>$ <?php
                            $priceAfter = number_format($sum, 0, ',', '.');
                            echo $priceAfter;
                            ?></b></h2></td>
                    </tr>

                    <?php } else {?>
                        <tr>
                            <td colspan="4"><?php echo 'no charges' ?></td>
                        </tr>
                    <?php } ?>
                    </tbody>
                </table>
                <?php if($payments){?>
                    <div class="col-md-6 col-sm-6 col-xs-12">
                        <div class="pricing offline">
                            <div class="title">
                                <h2>Bank Transfer</h2>
                                <h1>OFFLINE</h1>
                            </div>
                            <div class="x_content">
                                <div class="">
                                    <div class="pricing_features">
                                        <ul class="list-unstyled text-left">
                                            <h3 style="text-align: center; padding-bottom: 3vw">XYZ International School</h3>
                                            <div class="bank-transfer-section">
                                                <h2>BCA - <strong>2779101996</strong></h2>
                                            </div>
                                            <div class="bank-transfer-section">
                                                <h2>BNI - <strong>2779101996</strong></h2>
                                            </div>
                                            <div class="bank-transfer-section">
                                                <h2>Mandiri - <strong>2779101996</strong></h2>
                                            </div>
                                        </ul>
                                    </div>
                                </div>
                                <div class="pricing_footer">
                                    <a data-toggle="modal" data-target="#upload" class="btn btn-success btn-block buttonForm" role="button">Upload Transfer Receipt</span></a>
                                </div>
                                <div id="upload" class="modal fade bs-example-modal-lg" tabindex="-1" role="dialog" aria-hidden="true">
                                    <div class="modal-dialog modal-lg">
                                        <div class="modal-content">

                                            <div class="modal-header">
                                                <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">×</span>
                                                </button>
                                                <h4 class="modal-title" id="myModalLabel">Upload Transfer Receipt</h4>
                                            </div>
                                            <div class="modal-body">
                                                <?php echo form_open_multipart('parents/payment_status'); ?>
                                                <div class="form-group">
                                                    <?php
                                                    $paymentArray = array();
                                                    foreach($payments as $payment){?>
                                                        <input type="hidden" name="paymentid[]" value="<?php echo $payment['paymentid']?>"/>
                                                        <?php
                                                    }
                                                    ?>
                                                    <label class="control-label col-md-3 col-sm-3 col-xs-12">File</label>
                                                    <div class="col-md-9 col-sm-9 col-xs-12 set-margin-bottom">
                                                        <input class="btn btn-yellow" type="file" name="userfile" />
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="modal-footer">
                                                <button type="submit" class="btn btn-success"><i class="fa fa-upload"></i> Upload</button>
                                            </div>
                                            <?php echo form_close(); ?>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6 col-sm-6 col-xs-12">
                        <div class="pricing online">
                            <div class="title">
                                <h2>Online Payment Gateway</h2>
                                <h1>ONLINE</h1>
                            </div>
                            <div class="x_content">
                                <div class="">
                                    <form action="https://www.paypal.com/cgi-bin/webscr" method="post">
                                        <input type="hidden" name="cmd" value="_xclick">
                                        <input type="hidden" name="business" value="test@rumputilmu.com">
                                        <input type="hidden" name="item_name" value="<?php echo $description?>">
                                        <input type="hidden" name="amount" value="<?php echo $sum?>">
                                        <input type="hidden" name="quantity" value="1">
                                        <input type="hidden" name="currency_code" value="USD">
                                        <input type='hidden' name='cancel_return' value='<?php echo base_url() ?>index.php/parents/payment_status'>
                                        <input type='hidden' name='return' value='<?php echo base_url() ?>index.php/parents/payment_accepted/<?php echo $parent['parentid'];?>'>
                                        <!--                                    <input type="hidden" name="hosted_button_id" value="CHVXG5VSM2LVJ">-->
                                        <input type="image" src="http://www.dermitech.com/image/PayPal-PayNow-Button.png" border="0" name="submit" alt="PayPal - The safer, easier way to pay online!">
                                        <img alt="" border="0" src="https://www.paypalobjects.com/en_US/i/scr/pixel.gif" width="1" height="1">
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                <?php }?>
            </div>
        </div>
    </div>
</div>
<!-- /page content -->
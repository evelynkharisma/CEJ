<!-- page content -->
<div class="right_col" role="main">
    <div class="payment-status">
        <div class="page-title">
            <div class="title_left">
                <h3>Payment Status</h3>
            </div>
        </div>

        <div class="clearfix"></div>

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
                        $sum = 0;
                        foreach($payments as $payment){ ?>
                            <tr>
                                <td><?php echo $payment['inquirydate'] ?></td>
                                <td><?php echo $payment['firstname'] ?> <?php echo $payment['lastname'] ?></td>
                                <td><?php echo $payment['description'] ?></td>
                                <td>Rp <?php
                                    $priceAfter = number_format($payment['value'], 0, ',', '.');
                                    echo $priceAfter;
                                    ?></td>
                            </tr>
                        <?php $sum+=$payment['value'];}?>
                    <tr>
                        <td colspan="3"><h2><b>Total Charge: </b></h2></td>
                        <td><h2><b>Rp <?php
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
                                <a href="javascript:void(0);" class="btn btn-success btn-block" role="button">Upload Transfer Receipt</span></a>
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
                                <form action="https://www.paypal.com/cgi-bin/webscr" method="post" target="_top" class="paypal">
                                    <input type="hidden" name="cmd" value="_s-xclick">
                                    <input type="hidden" name="hosted_button_id" value="CHVXG5VSM2LVJ">
                                    <input type="image" src="http://www.dermitech.com/image/PayPal-PayNow-Button.png" border="0" name="submit" alt="PayPal - The safer, easier way to pay online!">
                                    <img alt="" border="0" src="https://www.paypalobjects.com/en_US/i/scr/pixel.gif" width="1" height="1">
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- /page content -->
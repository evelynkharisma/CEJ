<!-- page content -->
<div class="right_col" role="main">
    <div class="">
        <div class="page-title">
            <div class="title_left">
                <h3>Payment - Paypal</h3>
            </div>
        </div>

        <div class="clearfix"></div>
        <div class="row">
            <div class="col-md-12 col-sm-12 col-xs-12">
                <div class="x_panel">
                    <div class="x_content">
                        Your transaction is <span style="color: green;">SUCCESSFUL</span>. <br> Thank you for using the online payment gateway <br> This page will be redirected back in 5 seconds.
                    </div>
                    <?php header( "refresh:5;url=".base_url()."index.php/parents/payment_status" );?>
                </div>
            </div>
        </div>
    </div>
</div>
</div>
<!-- /page content -->
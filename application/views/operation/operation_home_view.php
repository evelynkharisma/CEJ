<!-- page content -->
<div class="right_col" role="main">
    <div class="">
        <div class="page-title">
            <div class="title_left">
                <h3>Dashboard</h3>
            </div>
        </div>
        <div class="clearfix"></div>
                <div class="row">
                    <div class="col-md-12 col-sm-12 col-xs-12">
                        <div class="x_panel">
                            <div class="row top_tiles parent_dashboard_top_tile">
                                <h1>Outstanding</h1>
                                <div class="animated flipInY col-lg-4 col-md-4 col-sm-4 col-xs-12">
                                    <a href="<?php echo base_url() ?>index.php/parents/parent_announcement">
                                        <div class="tile-stats">
                                            <div class="icon"><i class="fa fa-credit-card"></i></div>
                                            <div class="count"><?php echo $outstandingPayment?></div>
                                            <h3 class="announcement_top_tile">Outstanding Payment</h3>
                                        </div>
                                    </a>
                                </div>
                                <div class="animated flipInY col-lg-4 col-md-4 col-sm-4 col-xs-12">
                                    <a href="<?php echo base_url() ?>index.php/parents/parent_correspond">
                                        <div class="tile-stats">
                                            <div class="icon"><i class="fa fa-question"></i></div>
                                            <div class="count"><?php echo $confirmation?></div>
                                            <h3 class="message_top_tile">Confirmation Request</h3>
                                        </div>
                                    </a>
                                </div>
                                <div class="animated flipInY col-lg-4 col-md-4 col-sm-4 col-xs-12">
                                    <a href="<?php echo base_url() ?>index.php/parents/payment_status">
                                        <div class="tile-stats">
                                            <div class="icon"><i class="fa fa-book"></i></div>
                                            <div class="count"><?php echo $borrowedBook?></div>
                                            <h3 class="invoice_top_tile">Outstanding Book</h3>
                                        </div>
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-12 col-sm-12 col-xs-12">
                        <div class="x_panel">
                            <div class="row top_tiles parent_dashboard_top_tile">
                                <h1>Order</h1>
                                <div class="animated flipInY col-lg-4 col-md-4 col-sm-4 col-xs-12">
                                    <a href="<?php echo base_url() ?>index.php/parents/parent_announcement">
                                        <div class="tile-stats">
                                            <div class="icon"><i class="fa fa-pencil"></i></div>
                                            <div class="count"><?php echo $stationary?></div>
                                            <h3 class="announcement_top_tile">Stationary Order</h3>
                                        </div>
                                    </a>
                                </div>
                                <div class="animated flipInY col-lg-4 col-md-4 col-sm-4 col-xs-12">
                                    <a href="<?php echo base_url() ?>index.php/parents/parent_correspond">
                                        <div class="tile-stats">
                                            <div class="icon"><i class="fa fa-book"></i></div>
                                            <div class="count"><?php echo $book?></div>
                                            <h3 class="message_top_tile">Original Book Order</h3>
                                        </div>
                                    </a>
                                </div>
                                <div class="animated flipInY col-lg-4 col-md-4 col-sm-4 col-xs-12">
                                    <a href="<?php echo base_url() ?>index.php/parents/payment_status">
                                        <div class="tile-stats">
                                            <div class="icon"><i class="fa fa-copy"></i></div>
                                            <div class="count"><?php echo $copy?></div>
                                            <h3 class="invoice_top_tile">Photocopy Book Order</h3>
                                        </div>
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
    </div>
</div>
<!-- /page content -->
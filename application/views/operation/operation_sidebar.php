<div class="navbar nav_title" style="border: 0;">
    <a href="<?php echo base_url() ?>index.php/operation/home" class="site_title"><i class="fa fa-scribd"></i> <span>SMS</span></a>
</div>

<div class="clearfix"></div>

<!-- menu profile quick info -->
<div class="profile clearfix">
    <div class="profile_pic">
        <img src="<?php echo base_url() ?>assets/img/operation/profile/<?php echo $this->nativesession->get('photo') ?>" alt="..." class="img-circle profile_img">
    </div>
    <div class="profile_info">
        <span>Welcome,</span>
        <h2><?php echo $this->nativesession->get('name') ?></h2>
    </div>
</div>
<!-- /menu profile quick info -->

<br />


<!-- sidebar menu -->
<div id="sidebar-menu" class="main_menu_side hidden-print main_menu">
    <div class="menu_section">
        <ul class="nav side-menu">
            <li><a><i class="fa fa-exclamation-circle"></i> Outstanding <span class="fa fa-chevron-down"></span></a>
                <ul class="nav child_menu">
                    <li><a>Payment<span class="fa fa-chevron-down"></span></a>
                        <ul class="nav child_menu">
                            <li><a href="<?php echo base_url() ?>index.php/operation/outstanding_payment">Outstanding</a>
                            </li>
                            <li><a href="<?php echo base_url() ?>index.php/operation/history_payment">History</a>
                            </li>
                        </ul>
                    </li>
                    <li><a>Book<span class="fa fa-chevron-down"></span></a>
                        <ul class="nav child_menu">
                            <li><a href="<?php echo base_url() ?>index.php/operation/outstanding_book">Outstanding</a>
                            </li>
                            <li><a href="<?php echo base_url() ?>index.php/operation/history_book">History</a>
                            </li>
                        </ul>
                    </li>
                </ul>
            </li>
            <li><a><i class="fa fa-shopping-cart"></i> Order <span class="fa fa-chevron-down"></span></a>
                <ul class="nav child_menu">
                    <li><a>Stationary Order<span class="fa fa-chevron-down"></span></a>
                        <ul class="nav child_menu">
                            <li><a href="<?php echo base_url() ?>index.php/operation/order_stationary_new">New Order</a>
                            </li>
                            <li><a href="<?php echo base_url() ?>index.php/operation/order_stationary_history">Order History</a>
                            </li>
                        </ul>
                    </li>
                    <li><a>Resource Order<span class="fa fa-chevron-down"></span></a>
                        <ul class="nav child_menu">
                            <li><a>Original<span class="fa fa-chevron-down"></span></a>
                                <ul class="nav child_menu">
                                    <li><a href="<?php echo base_url() ?>index.php/operation/order_resource_original_new">New Order</a>
                                    </li>
                                    <li><a href="<?php echo base_url() ?>index.php/operation/order_resource_original_history">Order History</a>
                                    </li>
                                </ul>
                            </li>
                            <li><a>Photocopy<span class="fa fa-chevron-down"></span></a>
                                <ul class="nav child_menu">
                                    <li><a href="<?php echo base_url() ?>index.php/operation/order_resource_photocopy_new">New Order</a>
                                    </li>
                                    <li><a href="<?php echo base_url() ?>index.php/operation/order_resource_photocopy_history">Order History</a>
                                    </li>
                                </ul>
                            </li>
                        </ul>
                    </li>
                </ul>
            </li>
<!--            <li><a><i class="fa fa-child"></i> Student List <span class="fa fa-chevron-down"></span></a>-->
<!--                <ul class="nav child_menu">-->
<!--                    <li><a href="--><?php //echo base_url() ?><!--index.php/operation/outstanding_book">Grade 10</a>-->
<!--                    <li><a href="--><?php //echo base_url() ?><!--index.php/operation/outstanding_book">Grade 11</a>-->
<!--                    <li><a href="--><?php //echo base_url() ?><!--index.php/operation/outstanding_book">Grade 12</a>-->
<!--                </ul>-->
<!--            </li>-->
        </ul>
    </div>

</div>
<!-- /sidebar menu -->

<!-- /menu footer buttons -->
<div class="sidebar-footer hidden-small">
    <a data-toggle="tooltip" data-placement="top" title="Settings">
        <span class=" fa fa-cog" aria-hidden="true"></span>
    </a>
    <a data-toggle="tooltip" data-placement="top" title="Settings">
        <span class=" fa fa-cog" aria-hidden="true"></span>
    </a>
    <a data-toggle="tooltip" data-placement="top" title="Settings">
        <span class=" fa fa-cog" aria-hidden="true"></span>
    </a>
    <a data-toggle="tooltip" data-placement="top" title="Logout">
        <span class=" fa fa-power-off" aria-hidden="true"></span>
    </a>
</div>
<!-- /menu footer buttons -->
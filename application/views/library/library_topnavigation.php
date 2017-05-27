
<!--<div class="banner" id="home">-->
    <!-- header -->
    <header>
        <div class="container">

            <!-- navigation -->
            <nav class="navbar navbar-default">
                <!-- Brand and toggle get grouped for better mobile display -->
                <div class="">
                    <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1" aria-expanded="false">
                        <span class="sr-only">Toggle navigation</span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                    </button>
                    <div class="w3-logo">
                        <h1><a href="<?php echo base_url() ?>index.php/library/home">Library</a></h1>
<!--                        <label></label>-->
                    </div>
                </div>

                <!-- Collect the nav links, forms, and other content for toggling -->
                <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
                    <ul class="nav navbar-nav">
                        <li><a href="<?php echo base_url() ?>index.php/library/home" id="libmenu_home">Home</a></li>
                        <li><a href="<?php echo base_url() ?>index.php/library/collection" id="libmenu_collection">Collection</a></li>
                        <li><a href="<?php echo base_url() ?>index.php/library/about" id="libmenu_about">About</a></li>
                        <li><a href="<?php echo base_url() ?>index.php/library/contact" id="libmenu_contact">Contact</a></li>
                    </ul>

                    <ul class="nav navbar-nav navbar-right">

                        <?php if($this->nativesession->get('is_login_library')) {
                        ?>
                            <li class="dropdown">
                                <a href="#" class="dropdown-toggle active" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false"><?php echo $user['firstname']?><span class="caret"></span></a>
                                <ul class="dropdown-menu">
                                    <li><a href="<?php echo base_url() ?>index.php/library/profile">Profile</a></li>
                                    <li><a href="<?php echo base_url() ?>index.php/library/borrowing_history">My Borrowing History</a></li>
                                    <li><a href="<?php echo base_url() ?>index.php/library/obligation">My Obligation</a></li>
                                    <li><a href="<?php echo base_url() ?>index.php/library/logout">Log Out</a></li>
                                </ul>
                            </li>
                        <?php
                        } else {
                        ?>
                            <li><a href="<?php echo base_url() ?>index.php/library/login"><span ></span> Sign In</a></li>
                        <?php
                        }
                        ?>
                    </ul>


            </nav>
            <div class="clearfix"></div>
            <!-- //navigation -->
        </div>
    </header>
    <!-- //header -->
    <!-- banner-text -->

<!--</div>-->



<div id="jssor_1" style="position:relative;margin:0 auto;top:0px;left:0px;width:1500px;height:600px;overflow:hidden;visibility:hidden;">
    <!-- Loading Screen -->
    <div data-u="loading" class="jssorl-oval" style="position:absolute;top:0px;left:0px;text-align:center;background-color:rgba(0,0,0,0.7);">
        <img style="margin-top:-19.0px;position:relative;top:50%;width:38px;height:38px;" src="<?php echo base_url() ?>assets/img/library/oval.svg" />
    </div>
    <div data-u="slides" style="cursor:default;position:relative;top:0px;left:0px;width:1500px;height:600px;overflow:hidden;">
        <div style="background-image: url('<?php echo base_url() ?>assets/img/library/home1.jpg'); background-size: cover"></div>
        <div style="background-image: url('<?php echo base_url() ?>assets/img/library/home2.jpg'); background-size: cover"></div>
        <div style="background-image: url('<?php echo base_url() ?>assets/img/library/home1.jpg'); background-size: cover"></div>
    </div>
    <!-- Bullet Navigator -->
    <div data-u="navigator" class="jssorb05" style="bottom:16px;right:16px;" data-autocenter="1">
        <!-- bullet navigator item prototype -->
        <div data-u="prototype" style="width:16px;height:16px;"></div>
    </div>
    <!-- Arrow Navigator -->
    <span data-u="arrowleft" class="jssora22l" style="top:0px;left:8px;width:40px;height:58px;" data-autocenter="2"></span>
    <span data-u="arrowright" class="jssora22r" style="top:0px;right:8px;width:40px;height:58px;" data-autocenter="2"></span>
</div>

<!-------------------------------------------  SERVICE ----------------------------------->
<div class="services-w3layouts" id="services">
    <div class="container">
        <h5 class="title-w3">Services</h5>
        <div class="w3-agileits-our-advantages-grids">
            <div class="col-md-4 w3layouts-our-advantages-grid">
                <div class="col-xs-3 w3l-our-advantages-grd-left">
                    <i class="fa fa-search"></i>
                </div>
                <div class="col-xs-9">
                    <h4><a class="library-home-service" href="<?php echo base_url() ?>index.php/library/searchCollection">Search Collection</a></h4>
                </div>
                <div class="clearfix"> </div>
            </div>
            <div class="col-md-4 w3layouts-our-advantages-grid">
                <div class="col-xs-3 w3l-our-advantages-grd-left">
                    <i class="material-icons">gavel</i>
                </div>
                <div class="col-xs-9">
                    <h4><a class="library-home-service" href="<?php echo base_url() ?>index.php/library/circulation">Circulation</a></h4>
                </div>
                <div class="clearfix"> </div>
            </div>
            <div class="col-md-4 w3layouts-our-advantages-grid">
                <div class="col-xs-3 w3l-our-advantages-grd-left">
                    <i class="material-icons">record_voice_over</i></button>
                </div>
                <div class="col-xs-9">
                    <h4><a class="library-home-service" href="<?php echo base_url() ?>index.php/library/currentAwareness">Current Awareness</a></h4>
                </div>
                <div class="clearfix"> </div>
            </div>
            <div class="col-md-4 w3layouts-our-advantages-grid">
                <div class="col-xs-3 w3l-our-advantages-grd-left">
                    <i class="material-icons">cloud_upload</i>
                </div>
                <div class="col-xs-9">
                    <h4><a class="library-home-service" href="<?php echo base_url() ?>index.php/library/requestMaterials">Request Materials</a></h4>
<!--                    <p>Vel illum qui dolorem eum fugiat quo voluptas-->
<!--                        nulla pariatur eum iure reprehenderit.</p>-->
<!--                    <a href="single.html" data-toggle="modal" data-target="#myModal1" >More details<span class="glyphicon glyphicon glyphicon-arrow-right" aria-hidden="true"></span></a>-->
                </div>
                <div class="clearfix"> </div>
            </div>
            <div class="col-md-4 w3layouts-our-advantages-grid">
                <div class="col-xs-3 w3l-our-advantages-grd-left">
                    <i class="fa fa-book" aria-hidden="true"></i>
                </div>
                <div class="col-xs-9">
                    <h4><a class="library-home-service" href="<?php echo base_url() ?>index.php/library/lostAndFound">Lost And Found</a></h4>
                </div>
                <div class="clearfix"> </div>
            </div>
            <div class="col-md-4 w3layouts-our-advantages-grid">
                <div class="col-xs-3 w3l-our-advantages-grd-left">
                    <i class="material-icons">dvr</i>
                </div>
                <div class="col-xs-9">
                    <h4><a class="library-home-service" href="">Facilities</a></h4>
<!--                    <p>Vel illum qui dolorem eum fugiat quo voluptas-->
<!--                        nulla pariatur eum iure reprehenderit.</p>-->
<!--                    <a href="single.html" data-toggle="modal" data-target="#myModal1" >More details<span class="glyphicon glyphicon glyphicon-arrow-right" aria-hidden="true"></span></a>-->
                </div>
                <div class="clearfix"> </div>
            </div>

            <div class="clearfix"> </div>
        </div>
    </div>
    <div class="clearfix"></div>
</div>
<!-------------------------------------------  END OF SERVICE  ----------------------------------->

<!-------------------------------------------  NEWS ----------------------------------->
<div class="gallery" id="facilities">
    <div class="container">
        <?php $privilege = $this->general->checkPrivilege($this->nativesession->get('librole'), 'p0043');
        if($privilege == 1){?>
            <div class="row" style="margin-bottom: 3vw">
                <div class="col-md-12 col-sm-12 col-xs-12">
                    <div class="x_panel">
                        <div class="x_content">
                            <a href="<?php echo base_url() ?>index.php/library/allNews" class="btn-primary btn set-right"><i class="fa fa-edit"></i>Edit News</a>
                        </div>
                    </div>
                </div>
            </div>
        <?php } ?>
        <h5 class="title-w3">what’s New on Library & Knowledge Center</h5>

        <div class="col-md-1"></div>
        <div class="col-md-10" style=" margin: auto;">
            <ul class="list-group wow fadeInUp animated" data-wow-delay=".5s">
                <?php
                if($news){
                    $i = 0;
                    foreach($news as $new){
                ?>
                        <li class="list-group-item"">
                            <a href="#" data-toggle="modal" data-target="#myModalNews<?php echo $i?>" ><?php echo ucwords($new['title'])?></a>
                            <div class="modal fade" id="myModalNews<?php echo $i?>" tabindex="-1" role="dialog">
                                <div class="modal-dialog">
                                    <!-- Modal content-->
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <button type="button" class="close" data-dismiss="modal">&times;</button>
                                            <h4><?php echo ucwords($new['title'])?></h4>

    <!--                                        <h5>Lorem ipsum dolor sit amet</h5>-->
                                            <p><?php echo ucwords($new['content'])?></p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </li>
                <?php

                        $i++;
                    }
                }
                ?>
            </ul>
        </div>

    </div>
</div>
<!-------------------------------------------  END OF NEWS  ----------------------------------->



<!-------------------------------------------  USEFUL LINKS  ----------------------------------->
    <div class="services-w3layouts" id="useful_link">
        <div class="container">
            <?php $privilege = $this->general->checkPrivilege($this->nativesession->get('librole'), 'p0045');
            if($privilege == 1){?>
                <div class="row" style="margin-bottom: 3vw">
                    <div class="col-md-12 col-sm-12 col-xs-12">
                        <div class="x_panel">
                            <div class="x_content">
                                <a href="<?php echo base_url() ?>index.php/library/allUsefulLink" class="btn-primary btn set-right"><i class="fa fa-edit"></i>Edit Useful Link</a>
                            </div>
                        </div>
                    </div>
                </div>
            <?php } ?>
            <h5 class="title-w3">useful links</h5>
            <div class="col-md-1"></div>
            <div class="col-md-10">
                <div class="panel-group" id="accordion">
                    <?php
                    if($useful_link_categories) {
                        $i =0;
                        foreach ($useful_link_categories as $useful_link_category) {
                            ?>
                            <div class="panel panel-default">
                                <div class="panel-heading">
                                    <h4 class="panel-title">
                                        <a data-toggle="collapse" data-parent="#accordion" href="#collapse<?php echo $i?>"><?php echo $useful_link_category['name']?></a>
                                    </h4>
                                </div>
                                <div id="collapse<?php echo $i?>" class="panel-collapse collapse">
                                    <div class="panel-body">
                                        <ul style="margin-left: 20px">
                                            <?php
                                            if($useful_links) {
                                                foreach ($useful_links as $useful_link) {
                                                    if($useful_link['category'] == $useful_link_category['category']) {
                                                        ?>
                                                        <li>
                                                            <a href="<?php echo $useful_link['link'] ?>" target="_blank"><?php echo $useful_link['name'] ?></a>
                                                        </li>
                                                        <?php

                                                    }
                                                }

                                            }
                                            ?>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                            <?php
                            $i++;
                        }

                    }
                    ?>
                </div>
            </div>


        </div>
    </div>
</div>
<!-------------------------------------------  END OF USEFUL LINKS  ----------------------------------->




<!-------------------------------------------  QUOTE ----------------------------------->
<!--<div class="signup" id="quote">
    <div class="container">
        <div class="head-top-w3ls"><i class="fa fa-graduation-cap" aria-hidden="true"></i></div>
        <h5 class="title-w3">Explore and Learn.</h5>
        <p style="color: white;;">
            <i>"A library is the delivery room for the birth of ideas, a place where history comes to life."</i><br><br><br>
            <b>Norman Cousins</b>
        </p>
    </div>
</div>-->
<!-- Footer -->

<div class="copyright-wthree">
    <p>&copy; copyright </a></p>
</div>
<!-- //Footer -->

<!--<a href="#home" class="scroll" id="toTop" style="display: block;"> <span id="toTopHover" style="opacity: 1;"> </span></a>-->
<!-- //smooth scrolling -->


<script type="text/javascript" src="js/jquery-2.1.4.min.js"></script>
<script src="js/responsiveslides.min.js"></script>
<script>
    // You can also use "$(window).load(function() {"
    $(function () {
        // Slideshow 4
        $("#slider3").responsiveSlides({
            auto: true,
            pager:true,
            nav:false,
            speed: 500,
            namespace: "callbacks",
            before: function () {
                $('.events').append("<li>before event fired.</li>");
            },
            after: function () {
                $('.events').append("<li>after event fired.</li>");
            }
        });

    });
</script>


<script>
    // You can also use "$(window).load(function() {"
    $(function () {
        // Slideshow 4
        $("#slider1").responsiveSlides({
            auto: true,
            pager:false,
            nav:true,
            speed: 500,
            namespace: "callbacks",
            before: function () {
                $('.events').append("<li>before event fired.</li>");
            },
            after: function () {
                $('.events').append("<li>after event fired.</li>");
            }
        });

    });
</script>
<!--gallery-->

<script type="text/javascript">
    $(window).load(function() {
        $("#flexiselDemo1").flexisel({
            visibleItems:3,
            animationSpeed: 1000,
            autoPlay: true,
            autoPlaySpeed: 3000,
            pauseOnHover: true,
            enableResponsiveBreakpoints: true,
            responsiveBreakpoints: {
                portrait: {
                    changePoint:480,
                    visibleItems: 1
                },
                landscape: {
                    changePoint:640,
                    visibleItems:2
                },
                tablet: {
                    changePoint:768,
                    visibleItems: 2
                }
            }
        });

    });
</script>
<script type="text/javascript" src="js/jquery.flexisel.js"></script>
<!--gallery-->



<!-- start-smoth-scrolling -->
<script type="text/javascript" src="js/move-top.js"></script>
<script type="text/javascript" src="js/easing.js"></script>
<script type="text/javascript">
    jQuery(document).ready(function($) {
        $(".scroll").click(function(event){
            event.preventDefault();
            $('html,body').animate({scrollTop:$(this.hash).offset().top},1000);
        });
    });
</script>
<!-- start-smoth-scrolling -->
<!-- here stars scrolling icon -->
<script type="text/javascript">
    $(document).ready(function() {
        /*
         var defaults = {
         containerID: 'toTop', // fading element id
         containerHoverID: 'toTopHover', // fading element hover id
         scrollSpeed: 1200,
         easingType: 'linear'
         };
         */

        $().UItoTop({ easingType: 'easeOutQuart' });

    });
</script>
<!-- //here ends scrolling icon -->
<!--js for bootstrap working-->
<script src="js/bootstrap.js"></script>
<!-- //for bootstrap working -->


<!-- script-for-menu -->
<script>
    $("span.menu").click(function(){
        $(".top-nav ul").slideToggle("slow" , function(){
        });
    });
</script>


<!-- script change the active class in menu -->
<script>
    document.getElementById("libmenu_home").className = "active";
</script>


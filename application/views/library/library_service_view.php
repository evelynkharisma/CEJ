<div class="banner about-banner-w3ls " id="home">
    <h2> <?php echo ucwords($service['title'])?></h2>
</div>
<div class="wthree-main-content">
    <!-- About-page -->
    <div class="container">
        <div class="row">
            <div class="col-md-12 col-sm-12 col-xs-12">
                <?php echo $service['content']?>
            </div>
        </div>
    </div>
</div>
<!-- script change the active class in menu -->
<script>
    document.getElementById("libmenu_home").className = "active";
</script>

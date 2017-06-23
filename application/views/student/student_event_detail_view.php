<!-- page content -->
<div class="right_col" role="main">
    <div class="">
        <div class="page-title">
            <div class="title_left">
                <span class="media event">
                    <a class="pull-left date <?php echo isset($event['teacherid']) && $event['teacherid'] != '0' ? 'quizandassignment' : '' ?>">
                        <p class="month"><?php echo date('F', strtotime($event['date'])) ?></p>
                        <p class="day"><?php echo date('d', strtotime($event['date'])) ?></p>
                    </a>
                </span>
                <h3><?php echo $event['title'] ?></h3>
            </div>
        </div>

        <div class="clearfix"></div>

        <div class="row">
            <div class="col-md-12 col-sm-12 col-xs-12">
                <div class="x_panel">
                    <div class="x_title">
                        <div class="clearfix"></div>
                    </div>
                    <div class="x_content">
                        <p><?php echo $event['description'] ?></p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- /page content -->
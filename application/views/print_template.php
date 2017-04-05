<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?><!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <title>SMS</title>


    <link rel="stylesheet" type="text/css" href="<?php echo base_url() ?>assets/css/bootstrap.min.css"/>
    <link rel="stylesheet" type="text/css" href="<?php echo base_url() ?>assets/css/dataTables.bootstrap.min.css"/>
    <link rel="stylesheet" type="text/css" href="<?php echo base_url() ?>assets/css/font-awesome/css/font-awesome.min.css"/>
    <link rel="stylesheet" type="text/css" href="<?php echo base_url() ?>assets/css/font-awesome/css/font-awesome.css"/>
    <!-- bootstrap-daterangepicker -->
    <link rel="stylesheet" type="text/css" href="<?php echo base_url() ?>assets/css/daterangepicker.css">
    <!-- jQuery custom content scroller -->
    <link rel="stylesheet" type="text/css" href="<?php echo base_url() ?>assets/css/jquery.mCustomScrollbar.css"/>
    <!-- FullCalendar -->
    <link rel="stylesheet" type="text/css" href="<?php echo base_url() ?>assets/css/fullcalendar.min.css">
    <link rel="stylesheet" type="text/css" href="<?php echo base_url() ?>assets/css/fullcalendar.print.css" media="print">


    <!-- NProgress -->
    <link rel="stylesheet" type="text/css" href="<?php echo base_url() ?>assets/css/nprogress.css">
    <!-- bootstrap-wysiwyg -->
    <link rel="stylesheet" type="text/css" href="<?php echo base_url() ?>assets/css/prettify.min.css">

    <!-- Custom Theme Style -->
    <link rel="stylesheet" type="text/css" href="<?php echo base_url() ?>assets/css/custom.min.css">
    <link rel="stylesheet" type="text/css" href="<?php echo base_url() ?>assets/css/teacher_style.css">
    <link rel="stylesheet" type="text/css" href="<?php echo base_url() ?>assets/css/parent_style.css">
    <link rel="stylesheet" type="text/css" href="<?php echo base_url() ?>assets/css/operation_style.css">


</head>
<body class="nav-md">
    <div class="container body">
        <div class="main_container">
            <?php if (!empty($content)): ?>
                <?php $this->load->view($content); ?>
            <?php else: ?>
                Page not found !
            <?php endif; ?>

            <!-- footer content -->
            <footer>
                <div class="pull-right">
<!--                    Gentelella - Bootstrap Admin Template by <a href="https://colorlib.com">Colorlib</a>-->
                </div>
                <div class="clearfix"></div>
            </footer>
            <!-- /footer content -->
        </div>
    </div>



</body>
</html>
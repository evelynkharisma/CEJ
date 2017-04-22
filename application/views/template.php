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

    <script src="https://cloud.tinymce.com/stable/tinymce.min.js"></script>
    <script>tinymce.init({
            selector:'#long-text',
            plugins: [
                "advlist autolink lists link image charmap print preview anchor",
                "searchreplace visualblocks code fullscreen",
                "insertdatetime media table contextmenu paste"
            ],
            toolbar: "insertfile undo redo | styleselect | bold italic | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | link image",
        });</script>



    <!-- iCheck -->
<!--    <link href="../vendors/iCheck/skins/flat/green.css" rel="stylesheet">-->
    <!-- bootstrap-progressbar -->
<!--    <link href="../vendors/bootstrap-progressbar/css/bootstrap-progressbar-3.3.4.min.css" rel="stylesheet">-->
    <!-- JQVMap -->
<!--    <link href="../vendors/jqvmap/dist/jqvmap.min.css" rel="stylesheet"/>-->
    <!-- bootstrap-daterangepicker -->
<!--    <link href="../vendors/bootstrap-daterangepicker/daterangepicker.css" rel="stylesheet">-->

</head>
<body class="nav-md">
    <div class="container body">
        <div class="main_container">
            <div class="col-md-3 left_col menu_fixed scrollbar-inner">
                <div class="left_col scroll-view">
                    <?php if (!empty($sidebar)): ?>
                        <?php $this->load->view($sidebar); ?>
                    <?php else: ?>
                        Sidebar not found !
                    <?php endif; ?>
                </div>
            </div>

            <?php if (!empty($topnavigation)): ?>
                <?php $this->load->view($topnavigation); ?>
            <?php else: ?>
                Sidebar not found !
            <?php endif; ?>
            
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

    <!-- jQuery -->
    <script src="<?php echo base_url() ?>assets/js/jquery.min.js"></script>
    <!-- Bootstrap -->
    <script src="<?php echo base_url() ?>assets/js/bootstrap.min.js"></script>
    <script src="<?php echo base_url() ?>assets/js/jquery.dataTables.min.js"></script>
    <!-- bootstrap-daterangepicker -->
    <script src="<?php echo base_url() ?>assets/js/moment.min.js"></script>
    <script src="<?php echo base_url() ?>assets/js/daterangepicker.js"></script>
    <!-- jQuery custom content scroller -->
    <script src="<?php echo base_url() ?>assets/js/jquery.mCustomScrollbar.concat.min.js"></script>
    <script src="<?php echo base_url() ?>assets/js/jquery.easypiechart.min.js"></script>
    <!-- FullCalendar -->
    <script src="<?php echo base_url() ?>assets/js/moment.min.js"></script>
    <script src="<?php echo base_url() ?>assets/js/fullcalendar.min.js"></script>
    <!-- Custom Theme Scripts -->
    <script src="<?php echo base_url() ?>assets/js/custom.min.js"></script>



    <!-- FastClick -->
    <script src="<?php echo base_url() ?>assets/js/fastclick.js"></script>
    <!-- NProgress -->
    <script src="<?php echo base_url() ?>assets/js/nprogress.js"></script>
    <!-- bootstrap-wysiwyg -->
    <script src="<?php echo base_url() ?>assets/js/bootstrap-wysiwyg.min.js"></script>
    <script src="<?php echo base_url() ?>assets/js/jquery.hotkeys.js"></script>
    <script src="<?php echo base_url() ?>assets/js/prettify.js"></script>


    <!-- Datatables -->
    <script>
        $(document).ready(function() {
            TableManageButtons = function() {
                "use strict";
                return {
                    init: function() {
                        handleDataTableButtons();
                    }
                };
            }();

            $('#attendance').dataTable({
                paging: false
            });

            $('#directoryView').dataTable();

            $('#duedate, #pick-date').daterangepicker({
                singleDatePicker: true,
                calender_style: "picker_4",
                locale: {
                    format: 'YYYY-MM-DD'
                }
            }, function(start, end, label) {
                console.log(start.toISOString(), end.toISOString(), label);
            });

            $('.chart').easyPieChart({
                easing: 'easeOutElastic',
                delay: 3000,
                barColor: '#26B99A',
                trackColor: '#fff',
                scaleColor: false,
                lineWidth: 20,
                trackWidth: 16,
                lineCap: 'butt',
                onStep: function(from, to, percent) {
                    $(this.el).find('.percent').text(Math.round(percent));
                }
            });

            var date = new Date(),
                d = date.getDate(),
                m = date.getMonth(),
                y = date.getFullYear(),
                started,
                categoryClass;

            var events_array = [
                {
                    title: 'English',
                    start: new Date(y, m, d, 10, 30),
                    tip: ' Grade 12-C (Room 301)'
                }
            ];

            $('#calendar').fullCalendar({
                header: {
                    left: 'prev,next today',
                    center: 'title',
                    right: 'month,agendaWeek,agendaDay'
                },
                selectable: true,
                events: events_array,
                eventRender: function(event, element) {
                    element.attr('title', event.tip);
                }
            });

            TableManageButtons.init();

            $('.scrollbar-inner').scrollbar();
        });
    </script>
    <script>
        $('.toAdd').hide();

        var count = 0;
        $('.addPlan').on('click',function(){
            $('.toAdd:eq('+count+')').show();
            count++;
        });
//        $('#addPlan').click(function(){
//            var newEl = '<tr><td><input type="text" class="form-control set-margin-bottom set-margin-top" name="chapter[]" placeholder="ex: 1,2,3"/></td> <td><textarea class="form-control set-margin-bottom" name="objective[]" rows="3"></textarea></td> <td><textarea class="form-control set-margin-bottom" name="activities[]" rows="3"></textarea></td> <td><textarea class="form-control set-margin-bottom" name="material[]" rows="3"></textarea></td> </tr>';
//            $('#plan_wrapper').append(newEl);
//        });
    </script>
    <!-- /Datatables -->

</body>
</html>
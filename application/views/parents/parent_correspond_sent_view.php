<!-- page content -->
<div class="right_col" role="main">
    <div class="">

        <div class="page-title">
            <div class="title_left">
                <h3>Correspond</h3>
            </div>
        </div>

        <div class="clearfix"></div>

        <div class="row">
            <div class="col-md-12">
                <div class="x_panel">
                    <div class="x_title">
                        <h2>Parent's Mail</h2>
                        <div class="clearfix"></div>
                    </div>

                    <div class="container">
                        <div class="row inbox">
                            <div class="col-md-3 col-xs-12">
                                <div class="panel panel-default">
                                    <div class="panel-body inbox-menu">
                                        <a href="<?php echo base_url() ?>index.php/parents/parent_correspond_compose"><button id="compose" class="btn btn-sm btn-success btn-block" type="button">COMPOSE</button></a>
                                        <ul>
                                            <li>
                                                <a href="<?php echo base_url() ?>index.php/parents/parent_correspond"><i class="fa fa-inbox"></i> Inbox <span class="label label-danger">5</span></a>
                                            </li>
                                            <li>
                                                <a href="<?php echo base_url() ?>index.php/parents/parent_correspond_sent"><i class="fa fa-rocket"></i> Sent</a>
                                            </li>
                                        </ul>
                                    </div>
                                </div>
                            </div><!--/.col-->

                            <div class="col-md-9 col-xs-12">
                                <div class="panel panel-default">
                                    <div class="panel-body message">
                                        <table id="correspond" class="table table-hover">
                                            <thead>
                                            <tr>
                                                <th>
                                                    <div class="inbox-name">To</div>
                                                    <div class="inbox-attachment"></div>
                                                    <div class="inbox-subjects">Subject</div>
                                                    <div class="inbox-date">Date</div>
                                                </th>
                                            </tr>
                                            </thead>
                                            <tbody>
                                            <tr>
                                                <td>
                                                    <a href="#a">
                                                        <div class="inbox-name">Evelyn Kharisma</div>
                                                        <div class="inbox-attachment"><i class="fa fa-paperclip"></i></div>
                                                        <div class="inbox-subjects">Question A<small> - Dear Student, You are close to completing your study in the Even Semester 2016/2017. Put in your best efforts in the upcoming final exams and earn the grades you deserve! please check your Binusmaya for the data of attendance and exam schedule detail.</small></div>
                                                        <div class="inbox-date">June 12</div>
                                                    </a>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td>
                                                    <a href="#b">
                                                        <div class="inbox-name">Janis Giovani Tan</div>
                                                        <div class="inbox-attachment transparent"><i class="fa fa-paperclip"></i></div>
                                                        <div class="inbox-subjects">Hi<small> - hello.</small></div>
                                                        <div class="inbox-date">June 12</div>
                                                    </a>
                                                </td>
                                            </tr>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div><!--/.col-->
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- /page content -->

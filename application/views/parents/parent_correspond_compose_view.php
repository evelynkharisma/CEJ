<!-- page content -->
<div class="right_col" role="main">
    <div class="">

        <div class="page-title">
            <div class="title_left inbox_title_left">
                <h3>Correspond</h3>
            </div>

            <div class="title_right">
                <div class="col-md-5 col-sm-5 col-xs-12 form-group pull-right top_search">
                    <div class="input-group">
                        <input type="text" class="form-control" placeholder="Search for...">
                    <span class="input-group-btn">
                      <button class="btn btn-default" type="button">Go!</button>
                    </span>
                    </div>
                </div>
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
                                        <p class="text-center">New Message</p>
                                        <form class="form-horizontal" role="form">
                                            <div class="form-group">
                                                <label for="to" class="col-sm-1 control-label">To:</label>
                                                <div class="col-sm-11">
                                                    <input type="email" class="form-control select2-offscreen" id="to" tabindex="-1">
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <label for="to" class="col-sm-1 control-label">Subject:</label>
                                                <div class="col-sm-11">
                                                    <input type="email" class="form-control select2-offscreen" id="to" tabindex="-1">
                                                </div>
                                            </div>
                                        </form>

                                        <div class="col-sm-11 col-sm-offset-1">
                                            <br>

                                            <div class="form-group">
                                                <textarea class="form-control" id="message" name="body" rows="12"></textarea>
                                            </div>

                                            <div class="form-group">
                                                <button type="submit" class="btn btn-success">Send</button>
                                                <button class="btn btn-danger" onclick="if(confirm('Are you sure you want to discard this message?'))window.location.href='<?php echo base_url() ?>index.php/parents/parent_correspond';">Discard</button>
                                                <input type="file" style="display: none" name="file-2[]" id="file-2" class="inputfile inputfile-2" data-multiple-caption="{count} files selected" multiple />
                                                <label for="file-2"><svg xmlns="http://www.w3.org/2000/svg" width="20" height="17" viewBox="0 0 20 17"><path d="M10 0l-5.2 4.9h3.3v5.1h3.8v-5.1h3.3l-5.2-4.9zm9.3 11.5l-3.2-2.1h-2l3.4 2.6h-3.5c-.1 0-.2.1-.2.1l-.8 2.3h-6l-.8-2.2c-.1-.1-.1-.2-.2-.2h-3.6l3.4-2.6h-2l-3.2 2.1c-.4.3-.7 1-.6 1.5l.6 3.1c.1.5.7.9 1.2.9h16.3c.6 0 1.1-.4 1.3-.9l.6-3.1c.1-.5-.2-1.2-.7-1.5z"/></svg> <span>Choose a file&hellip;</span></label>
                                            </div>
                                        </div>
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

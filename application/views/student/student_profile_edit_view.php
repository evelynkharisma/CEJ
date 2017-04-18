<!-- page content -->
<div class="right_col" role="main">
    <div class="">
        <div class="page-title">
            <div class="title_left">
                <h3>Edit User Profile</h3>
            </div>
        </div>

        <div class="clearfix"></div>

        <div class="row">
            <div class="col-md-12 col-sm-12 col-xs-12">
                <div class="x_panel">
                    <div class="x_content">
                        <div class="col-md-4 col-sm-4 col-xs-12 profile_left">
                            <div class="profile_img">
                                <div class="teacher_profile_crop">
                                    <!-- Current avatar -->
                                    <img class="img-responsive avatar-view student_profile_img" src="<?php echo base_url() ?>assets/img/student/janis.jpg" alt="Avatar" title="Change the avatar">
                                </div>
                            </div>
                            <h3>Janis Giovani Tan</h3>
                            <a class="btn btn-success"><i class="fa fa-edit m-right-xs"></i>Change Profile</a>
                            <br />

                        </div>
                        <div class="col-md-8 col-sm-8 col-xs-12">
                            <div class="profile_title">
                                <div class="col-md-11 col-sm-12 col-xs-12">
                                    <ul class="nav nav-tabs">
                                        <li class="active"><a href="#student_personal-info" data-toggle="tab" >Personal Information</a></li>
                                        <li><a href="#student_academic-info" data-toggle="tab" >Academic Information</a></li>
                                        <li><a href="#student_account-info" data-toggle="tab" >Account Information</a></li>
                                    </ul>
                                </div>
                            </div>
                            <div class="tab-content">
                                <div id="student_personal-info" class="col-md-11 col-sm-12 col-xs-12 tab-pane fade in active">
                                    <div class="col-md-8">
                                        <form>
                                            <div class="form-group">
                                                <br>Name
                                                <input type="text" class="form-control" placeholder="Name">
                                            </div>
                                            <div class="form-group">
                                                Date of Birth
                                                <input type="date" class="form-control" placeholder="Date of Birth">
                                            </div>
                                            <div class="form-group">
                                                Place of Birth
                                                <input type="text" class="form-control" placeholder="Place of Birth">
                                            </div>
                                            <div class="form-group">
                                                Gender
                                                <div class="form-check">
                                                    <input type="radio" class="form-check-input" name="optionsRadios" id="optionsRadios1" value="female" checked>female
                                                </div>
                                                <div class="form-check">
                                                    <input type="radio" class="form-check-input" name="optionsRadios" id="optionsRadios2" value="male">male
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                Place of Birth
                                                <input type="date" class="form-control" placeholder="Password">
                                            </div>
                                            <div class="form-group">
                                                Mobile Phone
                                                <input type="number" class="form-control" placeholder="Mobile Phone">
                                            </div>
                                            <div class="form-group">
                                                Email
                                                <input type="email" class="form-control" placeholder="Email">
                                            </div>
                                            <div class="form-group">
                                                Address
                                                <textarea class="form-control" placeholder="Address"></textarea>
                                            </div>
                                            <button type="submit" class="btn btn-primary">Submit</button>
                                        </form>
                                    </div>

                                </div>
                                <div id="student_academic-info" class="col-md-12 tab-pane fade">
                                    <div class="col-md-8">
                                        <form>
                                            <div class="form-group">
                                                <br>Major
                                                <input type="text" class="form-control" placeholder="Major">
                                            </div>
                                            <div class="form-group">
                                                <br>Graduate
                                                <input type="text" class="form-control" placeholder="Graduate">
                                            </div>
                                            <div class="form-group">
                                                <br>Undergraduate
                                                <input type="text" class="form-control" placeholder="Undergraduate">
                                            </div>
                                            <div class="form-group">
                                                <br>High School
                                                <input type="text" class="form-control" placeholder="High School">
                                            </div>
                                            <div class="form-group">
                                                <br>Junior High School
                                                <input type="text" class="form-control" placeholder="Junior High School">
                                            </div>
                                            <div class="form-group">
                                                <br>Elementary School
                                                <input type="text" class="form-control" placeholder="Elementary Scoo">
                                            </div>
                                            <button type="submit" class="btn btn-primary">Submit</button>
                                        </form>
                                    </div>

                                </div>
                                <div id="student_account-info" class="col-md-12 tab-pane fade">
                                    <div class="col-md-8">
                                        <form>
                                            <div class="form-group">
                                                <br>Username
                                                <input type="text" class="form-control" placeholder="Username" contenteditable="false">
                                            </div>
                                            <div class="form-group">
                                                <br>Password
                                                <input type="password" class="form-control" placeholder="Password">
                                            </div>
                                            <div class="form-group">
                                                <br>Confirm Password
                                                <input type="password" class="form-control" placeholder="Password">
                                            </div>
                                            <button type="submit" class="btn btn-primary">Submit</button>
                                        </form>
                                    </div>

                                </div>

                            </div>

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- /page content -->
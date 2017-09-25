<nav class="navbar navbar-default navbar-static-top m-b-0">
    <div class="navbar-header"> <a class="navbar-toggle hidden-sm hidden-md hidden-lg " href="javascript:void(0)" data-toggle="collapse" data-target=".navbar-collapse"><i class="ti-menu"></i></a>
        <div class="top-left-part">
            <a class="logo" href="">
                <b>
                    <img src="assets/images/publyfe_logo.png" style="width: 70%;" alt="login">
                </b>
                <span class="hidden-xs"></span>
            </a>
        </div>
        <ul class="nav navbar-top-links navbar-left hidden-xs">
            <li><a href="javascript:void(0)" class="open-close hidden-xs waves-effect waves-light"><i class="icon-arrow-left-circle ti-menu"></i></a></li>
        </ul>
        <ul class="nav navbar-top-links navbar-right pull-right">
            <li class="dropdown"> 
                <a class="dropdown-toggle profile-pic" data-toggle="dropdown" href="#">
                    <span class="glyphicon glyphicon-user"></span> 
                    <!--<img src="<?php echo base_url(); ?>assets/admin/images/users/varun.jpg" alt="user-img" width="36" class="img-circle">-->
                    <b class="hidden-xs"><?php echo $this->session->userdata('name')?></b> 
                </a>
                <ul class="dropdown-menu dropdown-user scale-up">
                    <!--<li><a href="super_admin/accountSettings"><i class="ti-settings"></i>My Profile</a></li>-->
                    <!--<li><a href="super_admin/changePassword"><i class="fa fa-unlock-alt"></i> Change Password</a></li>-->
                    <li role="separator" class="divider"></li>
                    <li><a href="admin/logout"><i class="fa fa-power-off"></i> Logout</a></li>
                </ul>
                <!-- /.dropdown-user -->
            </li>
            <!-- /.dropdown -->
        </ul>
    </div>
    <!-- /.navbar-header -->
    <!-- /.navbar-top-links -->
    <!-- /.navbar-static-side -->
</nav>
<nav class="navbar navbar-default navbar-static-top m-b-0">
    <div class="navbar-header"> <a class="navbar-toggle hidden-sm hidden-md hidden-lg " href="javascript:void(0)" data-toggle="collapse" data-target=".navbar-collapse"><i class="ti-menu"></i></a>
        <div class="top-left-part"><div style="height: 50px; padding: 15px 15px; font-size: 18px; line-height: 20px; background-color: transparent;"><a style="color: #fff;" class="navbar-brand" href="index.html"><i class="fa fa-times" aria-hidden="true"></i> PUBLYFE</a></div></div>
        <ul class="nav navbar-top-links navbar-left hidden-xs">
            <li><a href="javascript:void(0)" class="open-close hidden-xs waves-effect waves-light"><i class="icon-arrow-left-circle ti-menu"></i></a></li>
        </ul>
        <?php if(isset($_SESSION['member_id'])){
            $user_info = $this->MembersModel->memberinfo($_SESSION['member_id']);
        $user_name = $user_info->name; 
        } 
        ?>
        <ul class="nav navbar-top-links navbar-right pull-right">
            <?php if(isset($_SESSION['member_id'])){ ?>
            <li class="dropdown"> <a class="dropdown-toggle profile-pic" data-toggle="dropdown" href="#"> <img src="<?php echo base_url(); ?>assets/front/images/icon-user.svg" alt="user-img" width="36" class="img-circle"><b class="hidden-xs"><?php if(isset($user_name)) { echo $user_name; } ?></b> </a>
                <ul class="dropdown-menu dropdown-user scale-up">
                    <li><a href="<?php echo base_url() ?>editaccount/<?php echo $_SESSION['member_id']; ?>"><i class="ti-settings"></i>My Profile</a></li>
<!--                    <li><a href="super_admin/changePassword"><i class="fa fa-unlock-alt"></i> Change Password</a></li>-->
                    <li role="separator" class="divider"></li>
                    <li><a href="<?php echo base_url() ?>memberlogout"><i class="fa fa-power-off"></i> Logout</a></li>
                </ul>
                <!-- /.dropdown-user -->
            </li>
            <?php } ?>
            <!-- /.dropdown -->
        </ul>
    </div>
    <!-- /.navbar-header -->
    <!-- /.navbar-top-links -->
    <!-- /.navbar-static-side -->
</nav>
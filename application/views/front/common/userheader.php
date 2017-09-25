<nav class="navbar navbar-default navbar-static-top m-b-0">
    <div class="navbar-header" style="background: #fff;"> 
        <a class="navbar-toggle hidden-sm hidden-md hidden-lg " href="javascript:void(0)" data-toggle="collapse" data-target=".navbar-collapse">
            <i class="ti-menu"></i>
        </a>
        <div class="top-left-part" style="background-color: #fff"">
            <a class="logo" href="">
                <b><img style="width: 70%;" src="<?php echo base_url()?>assets/publyfe_logo.png"></b>
                <span class="hidden-xs"></span>
            </a>
        </div>
        <ul class="nav navbar-top-links navbar-left hidden-xs">
            <li>
                <a href="javascript:void(0)" class="open-close hidden-xs waves-effect waves-light">
                    <i class="icon-arrow-left-circle ti-menu" style="color: black;"></i>
                </a>
            </li>
        </ul>
<!--        <div class="top-left-part">
            <div style="height: 65px; padding: 15px 15px; font-size: 18px; line-height: 20px; background-color: #fff">
                <a style="color: #fff;" class="navbar-brand" href="<?php echo base_url()?>"> 
                    <img style="width: 130px; margin-top: -17px;" src="<?php echo base_url()?>assets/publyfe_logo.png">
                </a>
                <br><br>
            </div>
        </div>-->
<!--        <ul class="nav navbar-top-links navbar-left hidden-xs">
            <li>
                <a href="<?php echo base_url()?>">
                    <span style="color:#6F7C8A; font-weight: bold;">
                        <?php if(isset($page_title)){ echo $page_title; }?>
                    </span>
                </a>
            </li>
                    
        </ul>-->
        <?php if(isset($_SESSION['member_id'])){
            $user_info = $this->MembersModel->memberinfo($_SESSION['member_id']);
            // print_r($user_info);die;
            $user_name = $user_info->name; 
        } 
        ?>
        <ul class="nav navbar-top-links navbar-right pull-right">
            <?php if(isset($_SESSION['member_id'])){ ?>
            <li class="dropdown"> 
                <a class="dropdown-toggle profile-pic" data-toggle="dropdown" href="#">  
                    <i class="fa fa-user" aria-hidden="true" style="color: #6F7C8A;"></i> 
                    <b class="hidden-xs" style="color: #6F7C8A;">
                        <?php if(isset($user_name)) { echo $user_name; } ?>
                    </b>
                </a>
                <ul class="dropdown-menu dropdown-user scale-up">
                    <li>
                        <a href="<?php echo base_url() ?>accounteditform">
                            <i class="ti-settings"></i> My Account
                        </a>
                    </li>
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


<script>
    $(window).bind('scroll', function () {
    if ($(window).scrollTop() > 30) {
        $('.navbar').addClass('fixed');
    } else {
        $('.navbar').removeClass('fixed');
    }
    });
</script>


<style>
    .navbar-fixed-left {
        width: 210px;
        /*position: fixed; */
        border-radius: 0;
        height: 657px;
        margin-left: -3px;
    }

    .navbar-fixed-left .navbar-nav > li {
        float: none;  /* Cancel default li float: left */
        width: 139px;
    }

    .navbar-fixed-left + .container {
        padding-left: 160px;
    }

    /* On using dropdown menu (To right shift popuped) */
    .navbar-fixed-left .navbar-nav > li > .dropdown-menu {
        margin-top: -50px;
        margin-left: 140px;
    }
</style>
<!-- Page Content -->
<div id="page-content-wrapper">
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-2">
                <div class="navbar navbar-inverse navbar-fixed-left">
                    <a class="navbar-brand" href="#"><img style="width: 84px; margin-left: 15px; margin-top: 14px;" src="<?php echo base_url() ?>assets/front/images/template/sitelogo.png"></a>
                    <ul class="nav navbar-nav" style="margin-left: 7px;">
                        <li style="margin-top: 33px; margin-bottom: -55px;"><a href="<?php echo base_url() ?>home"><i class="fa fa-home" aria-hidden="true"></i>  HOME</a></li>
                        <li style="margin-top: 33px; margin-bottom: -21px;"><a href="<?php echo base_url() ?>userhome"><i class="fa fa-home" aria-hidden="true"></i> USER HOME</a></li>
                        <li style="margin-top: -19px; margin-bottom: -21px;"><a href="<?php echo base_url() ?>allbannerstest"><i class="fa fa-credit-card" aria-hidden="true"></i>  BANNERS</a></li>
                        <li style="margin-top: -19px; margin-bottom: -21px;"><a href="<?php echo base_url()?>affiliatefeed"><i class="fa fa-cubes" aria-hidden="true"></i>  OFFERS</a></li>
                        <li style="margin-top: -19px; margin-bottom: -21px;"><a href="<?php echo base_url()?>affiliatefeed""><i class="fa fa-credit-card" aria-hidden="true"></i>  LANDING PAGES</a></li>
                        <li style="margin-top: -19px; margin-bottom: -21px;"><a href="<?php echo base_url()?>network"><i class="fa fa-signal" aria-hidden="true"></i>  NETWORKING</a></li>
                        <li style="margin-top: -19px; margin-bottom: -21px;"><a href="#"><i class="fa fa-wifi" aria-hidden="true"></i>  TRAFFIC</a></li>
                        <li style="margin-top: -19px; margin-bottom: -21px;"><a href="<?php echo base_url()?>affiliatefeed"><i class="fa fa-cog" aria-hidden="true"></i>  AFFILIATE FEED</a></li>
                        <li style="margin-top: -19px; margin-bottom: -21px;"><a href="<?php echo base_url() ?>editaccount/<?php echo $_SESSION['member_id']; ?>"><i class="fa fa-cog" aria-hidden="true"></i>  SETTINGS</a></li>
<!--                    <li style="margin-top: -19px; margin-bottom: -21px;"><a href="<?php echo base_url() ?>netivAddSec"><i class="fa fa-cog" aria-hidden="true"></i>  NETIV ADs SECTION</a></li>-->
                        <li style="margin-top: -19px; margin-bottom: -21px;"><a href="<?php echo base_url() ?>netivAddSec"><i class="fa fa-cog" aria-hidden="true"></i>  NETIV ADs SECTION</a></li>
                        <li style="margin-top: -19px; margin-bottom: -21px;"><a href="<?php echo base_url() ?>showdirectory"><i class="fa fa-cog" aria-hidden="true"></i>  DIRECTORY</a></li>
                        <!--<li style="margin-top: -19px; margin-bottom: -21px;"><a href="<?php echo base_url() ?>registrationform"><i class="fa fa-user-plus" aria-hidden="true"></i>  REGISTRATION</a></li>
                        <li style="margin-top: -19px; margin-bottom: -21px;"><a href="<?php echo base_url() ?>loginform"><i class="fa fa-sign-in" aria-hidden="true"></i>  LOGIN</a></li>
                        <li style="margin-top: -19px; margin-bottom: -21px;"><a href="<?php echo base_url() ?>editaccount/1"><i class="fa fa-sign-in" aria-hidden="true"></i>  PROFILE</a></li>-->
                    </ul>
                    <br><br>
                    <button class="btn btn-info" style="float: left; border-radius: 5%; margin-top: 137px; margin-left: 40px;"><a style="color:#fff;" href="<?php echo base_url() ?>memberlogout">Log Out</a></button>
                </div>
            </div>
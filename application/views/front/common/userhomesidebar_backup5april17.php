<div class="navbar-default sidebar" role="navigation">
    <div class="sidebar-nav navbar-collapse slimscrollsidebar" style="position: fixed;">
        <?php if($_SESSION['package_id'] == '1'){ ?>
        <ul class="nav" id="side-menu" style="width: 220px !important">
            <li><a href="<?php echo base_url() ?>userhome" class="waves-effect"><i class="fa-fw fa fa-users" ></i><span class="hide-menu"> HOME</span></a></li>
            <li><a href="<?php echo base_url() ?>allbannerstest" class="waves-effect"><i class="fa-fw fa fa-users" ></i><span class="hide-menu">BANNERS Ads</span></a></li>
            <li><a href="<?php echo base_url() ?>favbannerbyuser" class="waves-effect"><i class="fa-fw fa fa-users" ></i><span class="hide-menu">FAVORITE BANNERS</span></a></li>
            <li><a href="<?php echo base_url() ?>netivAddSec" class="waves-effect"><i class="fa-fw fa fa-sort-amount-asc" ></i><span class="hide-menu">NETIV ADs</span></a></li>
            <li><a href="<?php echo base_url() ?>landingpage" class="waves-effect"><i class="fa-fw fa fa-tags" ></i><span class="hide-menu">LANDING PAGES</span></a></li>
            <li><a href="<?php echo base_url() ?>ppvAddSec" class="waves-effect"><i class="fa-fw fa fa-sort-amount-asc" ></i><span class="hide-menu">PPV Ads</span></a></li>
            <li><a href="<?php echo base_url() ?>facebookSec" class="waves-effect"><i class="fa-fw fa fa-sort-amount-asc" ></i><span class="hide-menu">FaceBook Ads</span></a></li>
            <li><a href="<?php echo base_url() ?>faceecomerceSec" class="waves-effect"><i class="fa-fw fa fa-sort-amount-asc" ></i><span class="hide-menu">FaceBook Ecommerce Ads</span></a></li>
            <li>
                <a href="" class="waves-effect" id="mainresource">
                    <i class="fa-fw fa fa-share-alt" ></i>
                    <span class="hide-menu">Resources
                        <span class="fa arrow"></span>
                    </span>
                </a>
                <ul class="nav nav-second-level" id="extrapage" style="display:none">
                    <li> <a href="<?php echo base_url()?>showaffiliatenetwork">Affiliate Networks</a> </li>
                    <li> <a href="<?php echo base_url()?>showaddnetwork">Ad Networks</a> </li>
                    <li> <a href="<?php echo base_url()?>showhosting">Hosting</a></li>
                    <li> <a href="<?php echo base_url()?>showtraking">Tracking</a></li>
                    <li> <a href="<?php echo base_url()?>showcoaching">Coaching</a></li>
                    <li> <a href="<?php echo base_url()?>showforums">Forums</a></li>
                    <li> <a href="<?php echo base_url()?>showblogs">Blogs</a></li>
                </ul>
            </li>
            <li>
                <a href="" class="waves-effect" id="mainservice">
                    <i class="fa-fw fa fa-share-alt" ></i>
                    <span class="hide-menu">Services
                        <span class="fa arrow"></span>
                    </span>
                </a>
                <ul class="nav nav-second-level" id="servicepage" style="display:none">
                    <li> <a href="<?php echo base_url()?>showbandesign">Banner Design</a> </li>
                    <li> <a href="<?php echo base_url()?>showprogramming">Programming</a> </li>
                    <li> <a href="<?php echo base_url()?>showmanagement">Management</a></li>
                    <li> <a href="<?php echo base_url()?>showtranslation">Translations</a></li>
                </ul>
            </li>
            <?php if (isset($_SESSION['member_id'])) { ?>
                <li><a href="<?php echo base_url() ?>editaccount/<?php echo $_SESSION['member_id']; ?>" class="waves-effect"><i class="fa-fw fa fa-share-alt" ></i><span class="hide-menu">SETTINGS</span></a></li>
            <?php } ?>
                <br><br>
        </ul>
        <?php } else if($_SESSION['package_id'] == '2'){ ?>
        <ul class="nav" id="side-menu" style="width: 220px !important">
            <li><a href="<?php echo base_url() ?>userhome" class="waves-effect"><i class="fa-fw fa fa-users" ></i><span class="hide-menu"> HOME</span></a></li>
            <li><a href="<?php echo base_url() ?>affiliatefeed" class="waves-effect"><i class="fa-fw fa fa-users" ></i><span class="hide-menu">AFFILIATE FEED</span></a></li>
            <li><a href="<?php echo base_url() ?>offerfeed" class="waves-effect"><i class="fa-fw fa fa-users" ></i><span class="hide-menu">OFFER FEED</span></a></li>
            <!--<li><a href="<?php echo base_url() ?>netivAddSec" class="waves-effect"><i class="fa-fw fa fa-sort-amount-asc" ></i><span class="hide-menu">WHOIS</span></a></li>-->

            <?php if (isset($_SESSION['member_id'])) { ?>
                <li><a href="<?php echo base_url() ?>editaccount/<?php echo $_SESSION['member_id']; ?>" class="waves-effect"><i class="fa-fw fa fa-share-alt" ></i><span class="hide-menu">SETTINGS</span></a></li>
            <?php } ?>
                <br><br>
        </ul>
        <?php } ?>
    </div>
</div>
<script type="text/javascript">
   $('#mainresource').click(function(){
       $('#extrapage').toggle();
   });
   
   $('#mainservice').click(function(){
       $('#servicepage').toggle();
   });
</script>

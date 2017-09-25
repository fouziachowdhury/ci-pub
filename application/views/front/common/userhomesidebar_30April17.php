<div class="navbar-default sidebar" role="navigation">
    <div class="sidebar-nav navbar-collapse slimscrollsidebar" style="position: fixed;">
        <ul class="nav" id="side-menu">
            <li><a href="<?php echo base_url() ?>userhome" class="waves-effect"><i class="fa-fw fa fa-users" ></i><span class="hide-menu"> HOME</span></a></li>
            <li><a href="<?php echo base_url() ?>allbannerstest" class="waves-effect"><i class="fa-fw fa fa-users" ></i><span class="hide-menu">BANNERS</span></a></li>
            <li><a href="<?php echo base_url() ?>favbannerbyuser" class="waves-effect"><i class="fa-fw fa fa-users" ></i><span class="hide-menu">FAVORITE BANNERS</span></a></li>
            <li><a href="<?php echo base_url() ?>affiliatefeed" class="waves-effect"><i class="fa-fw fa fa-users" ></i><span class="hide-menu">OFFERS</span></a></li>
            <li><a href="<?php echo base_url() ?>landingpage" class="waves-effect"><i class="fa-fw fa fa-tags" ></i><span class="hide-menu">LANDING PAGES</span></a></li>
            <li><a href="<?php echo base_url() ?>network" class="waves-effect"><i class="fa-fw fa fa-indent" ></i><span class="hide-menu">NETWORKING</span></a></li>
            <li><a href="<?php echo base_url()?>" class="waves-effect"><i class="fa-fw fa fa-bookmark" ></i><span class="hide-menu">TRAFFIC</span></a></li>
            <li><a href="<?php echo base_url() ?>affiliatefeed" class="waves-effect"><i class="fa-fw fa fa-facebook" ></i><span class="hide-menu">AFFILIATE FEED</span></a></li>
            <li><a href="<?php echo base_url() ?>netivAddSec" class="waves-effect"><i class="fa-fw fa fa-sort-amount-asc" ></i><span class="hide-menu">NETIV ADs SECTION</span></a></li>
            <li><a href="<?php echo base_url() ?>facebookSec" class="waves-effect"><i class="fa-fw fa fa-sort-amount-asc" ></i><span class="hide-menu">FaceBook Ads</span></a></li>
            <li><a href="<?php echo base_url() ?>faceecomerceSec" class="waves-effect"><i class="fa-fw fa fa-sort-amount-asc" ></i><span class="hide-menu">FaceBook Ecommerce Ads</span></a></li>
            <li><a href="<?php echo base_url() ?>ppvAddSec" class="waves-effect"><i class="fa-fw fa fa-sort-amount-asc" ></i><span class="hide-menu">PPV Ads</span></a></li>
            <li><a href="<?php echo base_url() ?>showdirectory" class="waves-effect"><i class="fa-fw fa fa-sort-amount-asc" ></i><span class="hide-menu">DIRECTORY<span class="fa arrow"></span></span></a></li>
            <?php if (isset($_SESSION['member_id'])) { ?>
                <li><a href="<?php echo base_url() ?>editaccount/<?php echo $_SESSION['member_id']; ?>" class="waves-effect"><i class="fa-fw fa fa-share-alt" ></i><span class="hide-menu">SETTINGS</span></a></li>
            <?php } ?>
                <li><a href="<?php echo base_url()?>" class="waves-effect"><i class="fa-fw fa fa-cog" ></i><span class="hide-menu">SUPPORT</span></a></li>
        </ul>
    </div>
</div>


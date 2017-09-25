<?php //echo '<pre>';print_r($testpage);die;?>

<div class="navbar-default sidebar user_sidebar" role="navigation">
    <div class="sidebar-nav navbar-collapse slimscrollsidebar" style="/*position: fixed;*/">
        <ul class="nav" id="side-menu">
            <li class="sidebar-search hidden-sm hidden-md hidden-lg">
                <!-- input-group -->
                <div class="input-group custom-search-form">
                    <input type="text" class="form-control" placeholder="Search...">
                    <span class="input-group-btn">
                        <button class="btn btn-default" type="button"> <i class="fa fa-search"></i> </button>
                    </span> </div>
                <!-- /input-group -->
            </li>
            
            <li> 
                <a href="<?php echo base_url() ?>userhome" class="waves-effect">
                    <i class="" ><img src="<?php echo base_url() ?>assets/home.png"></i>
                    <span class="hide-menu"> HOME</span>
                </a>

            </li>
            
            <?php if(isset($testpage[1])|| isset($testpage[11])){?>
            <li>
                <a href="<?php echo base_url() ?>allbannerstest" class="waves-effect">
                    <i><img src="<?php echo base_url() ?>assets/banners.png"></i> 
                    <span class="hide-menu">Banner ADs</span>
                </a>
            </li>
            <?php }?>
            <?php if(isset($testpage[2])|| isset($testpage[11])){?>
            <li>
                <a href="<?php echo base_url() ?>netivAddSec" class="waves-effect">
                    <img src="<?php echo base_url() ?>assets/native-ads.png"> 
                    <span class="hide-menu">NATIVE ADs</span>
                </a>
            </li>
            <?php }?>
            
            <?php if(isset($testpage[3]) || isset($testpage[4])|| isset($testpage[11])){?>
            <li>
                <a href="<?php echo base_url(); ?>facebookSec" class="waves-effect" id="facebookid">
                    <i class="" ><img src="<?php echo base_url() ?>assets/services.png"></i>
                    <span class="hide-menu">FACEBOOK
                        <span class="fa arrow"></span>
                    </span>
                </a>
                <ul class="nav nav-second-level" id="facebookecomid">
                    <?php if (isset($testpage[3])|| isset($testpage[11])) { ?>
                        <li> <a href="<?php echo base_url() ?>facebookSec">FaceBook Ads</a> </li>
                    <?php } ?>
                    <?php if (isset($testpage[4])|| isset($testpage[11])) { ?>
                        <li> <a href="<?php echo base_url() ?>faceecomerceSec">FaceBook Ecommerce Ads</a> </li>
                    <?php }?>
                        
                </ul>
            </li>
            <?php }?>
            <?php if(isset($testpage[5])|| isset($testpage[11])){?>
            <li><a href="<?php echo base_url() ?>ppvAddSec" class="waves-effect">
                    <img src="<?php echo base_url() ?>assets/ppv-ads.png"> 
                    <span class="hide-menu">PPV Ads</span>
                </a>
            </li>
            <?php }?>
            
            <?php if(isset($testpage[13])){?>
            <li>
                <a href="<?php echo base_url() ?>landingpage" class="waves-effect">
                    <img src="<?php echo base_url() ?>assets/landing-pages.png"> 
                    <span class="hide-menu">LANDING PAGES</span>
                </a>
            </li>
            <?php }?>
            <?php if(isset($testpage[6])|| isset($testpage[12])){?>
            <li>
                <a href="<?php echo base_url() ?>affiliatefeed" class="waves-effect">
                    <img src="<?php echo base_url() ?>assets/home.png">
                    <span class="hide-menu">AFFILIATE FEED</span>
                </a>
            </li>
            <?php }?>
            <?php if(isset($testpage[7])|| isset($testpage[12])){?>
            <li><a href="<?php echo base_url() ?>offerfeed" class="waves-effect">
                    <img src="<?php echo base_url() ?>assets/offer-feed.png"> 
                    <span class="hide-menu">OFFER FEED</span>
                </a>
            </li>
            <?php }?>
            
            <?php if(isset($testpage[8]) || isset($testpage[9]) || isset($testpage[10]) || isset($testpage[19])|| isset($testpage[12])){?>
            <li>
                <a href="<?php echo base_url() ?>viewWhois/<?php if(isset($testpage[8])){
                    echo $testpage[8];
                    }
                    if(isset($testpage[9])){
                        echo $testpage[9];
                    }if(isset($testpage[10])){
                        echo $testpage[10];
                    }if(isset($testpage[19])){
                        echo $testpage[19];
                    }if(isset($testpage[12])){
                        echo $testpage[12];
                    }?>" 
                   class="waves-effect">
                    <i class="fa-fw fa fa-sort-amount-asc" ></i>
                    <span class="hide-menu">WHOIS</span>
                </a>
            </li>
            <?php }?>
            
            <?php if(isset($testpage[14])){?>
            <li>
                <a href="<?php echo base_url() ?>netivAddSec" class="waves-effect">
                    <i class="fa-fw fa fa-sort-amount-asc" ></i>
                    <span class="hide-menu">WHOIS</span>
                </a>
            </li>
            <?php }?>
            
            <li>
                <a href="resourceAdmin/showaffiliateresource" class="waves-effect" id="mainresource">
                    <i><img src="<?php echo base_url() ?>assets/resources.png"></i>
                    <span class="hide-menu">Resources
                        <span class="fa arrow"></span>
                    </span>
                </a>
                <ul class="nav nav-second-level" id="extrapage">
                    <li> <a href="<?php echo base_url() ?>showaffiliatenetwork">Affiliate Networks</a> </li>
                    <li> <a href="<?php echo base_url() ?>showaddnetwork">Ad Networks</a> </li>
                    <li> <a href="<?php echo base_url() ?>showhosting">Hosting</a></li>
                    <li> <a href="<?php echo base_url() ?>showtraking">Tracking</a></li>
                    <li> <a href="<?php echo base_url() ?>showcoaching">Coaching</a></li>
                    <li> <a href="<?php echo base_url() ?>showforums">Forums</a></li>
                    <li> <a href="<?php echo base_url() ?>showblogs">Blogs</a></li>
                </ul>
            </li>

            <li>
                <a href="<?php echo base_url() ?>showbandesign" class="waves-effect" id="mainservice">
                    <i class="" ><img src="<?php echo base_url() ?>assets/services.png"></i>
                    <span class="hide-menu">Services
                        <span class="fa arrow"></span>
                    </span>
                </a>
                <ul class="nav nav-second-level" id="servicepage">
                    <li> <a href="<?php echo base_url() ?>showbandesign">Banner Design</a> </li>
                    <li> <a href="<?php echo base_url() ?>showprogramming">Programming</a> </li>
                    <li> <a href="<?php echo base_url() ?>showmanagement">Management</a></li>
                    <li> <a href="<?php echo base_url() ?>showtranslation">Translations</a></li>
                </ul>
            </li>
            <?php if (isset($_SESSION['member_id'])) { ?>
                <li><a href="<?php echo base_url() ?>accounteditform/<?php //echo $_SESSION['member_id'];  ?>" class="waves-effect"><img src="<?php echo base_url() ?>assets/settings.png"> <span class="hide-menu">SETTINGS</span></a></li>
            <?php } ?>
            
        </ul>
<!--            <ul class="nav" id="side-menu" style="width: 220px !important">
                <li> 
                    <a href="<?php echo base_url() ?>userhome" class="waves-effect">
                        <i class="" ><img src="<?php echo base_url() ?>assets/home.png"></i>
                        <span class="hide-menu"> HOME</span>
                    </a>

                </li>
                <?php if (isset($testpage[1]) && ($testpage[1] == '1')) { ?>
                    <li>
                        <a href="<?php echo base_url() ?>allbannerstest" class="waves-effect">
                            <i><img src="<?php echo base_url() ?>assets/banners.png"></i> 
                            <span class="hide-menu">BANNERS Ads</span>
                        </a>
                    </li>
                <?php } else { ?>
                    <li>
                        <a href="<?php echo base_url() ?>userhome/1" class="waves-effect">
                            <i><img src="<?php echo base_url() ?>assets/banners.png"></i> 
                            <span class="hide-menu">BANNERS Ads</span>
                        </a>
                    </li>
                <?php } ?>
                <?php //if (isset($testpage[1]) && ($testpage[1] == '1')) { ?>
                        <li><a href="<?php echo base_url() ?>favbannerbyuser" class="waves-effect"><i class="fa-fw fa fa-users" ></i><span class="hide-menu">FAVORITE BANNERS</span></a></li>
                <?php //} else { ?>
                        <li><a href="<?php echo base_url() ?>userhome/1" class="waves-effect"><i class="fa-fw fa fa-users" ></i><span class="hide-menu">FAVORITE BANNERS</span></a></li>
                <?php //} ?>
                <?php if (isset($testpage[2]) && ($testpage[2] == '1')) { ?>
                    <li>
                        <a href="<?php echo base_url() ?>netivAddSec" class="waves-effect">
                            <img src="<?php echo base_url() ?>assets/native-ads.png"> 
                            <span class="hide-menu">NATIVE ADs</span>
                        </a>
                    </li>
                <?php } else { ?>
                    <li>
                        <a href="<?php echo base_url() ?>userhome/2" class="waves-effect">
                            <img src="<?php echo base_url() ?>assets/native-ads.png"> 
                            <span class="hide-menu">NATIVE ADs</span>
                        </a>
                    </li>
                <?php } ?>
                <?php if (isset($testpage[13]) && ($testpage[13] == '1')) { ?>
                    <li>
                        <a href="<?php echo base_url() ?>landingpage" class="waves-effect">
                            <img src="<?php echo base_url() ?>assets/landing-pages.png"> 
                            <span class="hide-menu">LANDING PAGES</span>
                        </a>
                    </li>
                <?php } else { ?>
                    <li>
                        <a href="<?php echo base_url() ?>userhome/13" class="waves-effect">
                            <img src="<?php echo base_url() ?>assets/landing-pages.png"> 
                            <span class="hide-menu">LANDING PAGES</span>
                        </a>
                    </li>
                <?php } ?>
                <?php if (isset($testpage[5]) && ($testpage[5] == '1')) { ?>
                    <li><a href="<?php echo base_url() ?>ppvAddSec" class="waves-effect"><img src="<?php echo base_url() ?>assets/ppv-ads.png"> <span class="hide-menu">PPV Ads</span></a></li>
                <?php } else { ?>
                    <li><a href="<?php echo base_url() ?>userhome/5" class="waves-effect"><img src="<?php echo base_url() ?>assets/ppv-ads.png"> <span class="hide-menu">PPV Ads</span></a></li>
                <?php } ?>

                <li>
                    <a href="<?php echo base_url(); ?>facebookSec" class="waves-effect" id="facebookid">
                        <i class="" ><img src="<?php echo base_url() ?>assets/services.png"></i>
                        <span class="hide-menu">FACEBOOK
                            <span class="fa arrow"></span>
                        </span>
                    </a>
                    <ul class="nav nav-second-level" id="facebookecomid">
                        <?php if (isset($testpage[3]) && ($testpage[3] == '1')) { ?>
                            <li> <a href="<?php echo base_url() ?>facebookSec">FaceBook Ads</a> </li>
                        <?php } else { ?>
                            <li> <a href="<?php echo base_url() ?>userhome/3">FaceBook Ads </a> </li>
                        <?php } ?>
                        <?php if (isset($testpage[4]) && ($testpage[4] == '1')) { ?>
                            <li> <a href="<?php echo base_url() ?>faceecomerceSec">FaceBook Ecommerce Ads</a> </li>
                        <?php } else { ?>
                            <li> <a href="<?php echo base_url() ?>userhome/4">FaceBook Ecommerce Ads</a> </li>
                        <?php } ?>
                    </ul>
                </li>



                <li>
                    <a href="resourceAdmin/showaffiliateresource" class="waves-effect" id="mainresource">
                        <i><img src="<?php echo base_url() ?>assets/resources.png"></i>
                        <span class="hide-menu">Resources
                            <span class="fa arrow"></span>
                        </span>
                    </a>
                    <ul class="nav nav-second-level" id="extrapage">
                        <li> <a href="<?php echo base_url() ?>showaffiliatenetwork">Affiliate Networks</a> </li>
                        <li> <a href="<?php echo base_url() ?>showaddnetwork">Ad Networks</a> </li>
                        <li> <a href="<?php echo base_url() ?>showhosting">Hosting</a></li>
                        <li> <a href="<?php echo base_url() ?>showtraking">Tracking</a></li>
                        <li> <a href="<?php echo base_url() ?>showcoaching">Coaching</a></li>
                        <li> <a href="<?php echo base_url() ?>showforums">Forums</a></li>
                        <li> <a href="<?php echo base_url() ?>showblogs">Blogs</a></li>
                    </ul>
                </li>

                <li>
                    <a href="<?php echo base_url() ?>showaffiliatenetwork" class="waves-effect" id="mainresource">
                        <img src="<?php echo base_url() ?>assets/resources.png">
                        <span class="hide-menu">Resources
                            <span class="fa arrow"></span>
                        </span>
                    </a>
                    <ul class="nav nav-second-level" id="extrapage" style="display:none">

                    </ul>
                </li>

                <li>
                    <a href="<?php echo base_url() ?>showbandesign" class="waves-effect" id="mainservice">
                        <i class="" ><img src="<?php echo base_url() ?>assets/services.png"></i>
                        <span class="hide-menu">Services
                            <span class="fa arrow"></span>
                        </span>
                    </a>
                    <ul class="nav nav-second-level" id="servicepage">
                        <li> <a href="<?php echo base_url() ?>showbandesign">Banner Design</a> </li>
                        <li> <a href="<?php echo base_url() ?>showprogramming">Programming</a> </li>
                        <li> <a href="<?php echo base_url() ?>showmanagement">Management</a></li>
                        <li> <a href="<?php echo base_url() ?>showtranslation">Translations</a></li>
                    </ul>
                </li>
                <?php if (isset($_SESSION['member_id'])) { ?>
                    <li><a href="<?php echo base_url() ?>accounteditform/<?php //echo $_SESSION['member_id']; ?>" class="waves-effect"><img src="<?php echo base_url() ?>assets/settings.png"> <span class="hide-menu">SETTINGS</span></a></li>
                <?php } ?>
                <br><br>
            </ul>-->
            
<!--            <ul class="nav" id="side-menu" style="width: 220px !important">

                <li><a href="<?php echo base_url() ?>userhome" class="waves-effect"><img src="<?php echo base_url() ?>assets/home.png"> <span class="hide-menu"> HOME</span></a></li>

                <?php if (isset($testpage[6]) && ($testpage[6] == '1')) { ?>
                    <li><a href="<?php echo base_url() ?>affiliatefeed" class="waves-effect"><i class="fa-fw fa fa-users" ></i><span class="hide-menu">AFFILIATE FEED</span></a></li>
                <?php } else { ?>
                    <li><a href="<?php echo base_url() ?>userhome/6" class="waves-effect"><i class="fa-fw fa fa-users" ></i><span class="hide-menu">AFFILIATE FEED</span></a></li>
                <?php } ?>
                <?php if (isset($testpage[7]) && ($testpage[7] == '1')) { ?>
                    <li><a href="<?php echo base_url() ?>offerfeed" class="waves-effect"><img src="<?php echo base_url() ?>assets/offer-feed.png"> <span class="hide-menu">OFFER FEED</span></a></li>
                <?php } else { ?>
                    <li><a href="<?php echo base_url() ?>userhome/7" class="waves-effect"><img src="<?php echo base_url() ?>assets/offer-feed.png"> <span class="hide-menu">OFFER FEED</span></a></li>
                <?php } ?>
                    <li><a href="<?php echo base_url() ?>netivAddSec" class="waves-effect"><i class="fa-fw fa fa-sort-amount-asc" ></i><span class="hide-menu">WHOIS</span></a></li>

                <?php if (isset($_SESSION['member_id'])) { ?>
                    <li><a href="<?php echo base_url() ?>accounteditform/<?php //echo $_SESSION['member_id']; ?>" class="waves-effect"><img src="<?php echo base_url() ?>assets/settings.png"> <span class="hide-menu">SETTINGS</span></a></li>
                        <?php } ?>
                <br><br>
            </ul>-->
    </div>
</div>
<script type="text/javascript">
    $('#mainresource').click(function () {
        $('#extrapage').toggle();
    });

    $('#mainservice').click(function () {
        $('#servicepage').toggle();
    });

    $('#facebookid').click(function () {
        $('#facebookecomid').toggle();
    });

</script>

<div class="navbar-default sidebar" role="navigation">
    <div class="sidebar-nav navbar-collapse slimscrollsidebar">
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
                <a href="admin" class="waves-effect">
                    <i class="fa-fw fa fa-users" ></i>
                    <span class="hide-menu"> Dashboard</span>
                </a>

            </li>
            
            <li>
                <a href="admin/allUser" class="waves-effect">
                    <i class="fa-fw fa fa-users" ></i>
                    <span class="hide-menu">Users
                        <span class="fa arrow"></span>
                    </span>
                </a>
                <ul class="nav nav-second-level">
                    <!--<li> <a href="<?php echo base_url(); ?>super_admin/addUser">Add User</a> </li>-->
                    <li> <a href="admin/allUser">All User</a> </li>
                    <li> <a href="admin/addUser">Add User</a> </li>
                </ul>
            </li>
            
            <li>
                <a href="admin/allCategory" class="waves-effect">
                    <i class="fa-fw fa fa-users" ></i>
                    <span class="hide-menu">Category
                        <span class="fa arrow"></span>
                    </span>
                </a>
                <ul class="nav nav-second-level">
                    <li> <a href="admin/allCategory">All Category</a> </li>
                </ul>
            </li>
            
            <li>
                <a href="admin/allHeadline" class="waves-effect">
                    <i class="fa-fw fa fa-tags" ></i>
                    <span class="hide-menu">Headline Tagging
                        <span class="fa arrow"></span>
                    </span>
                </a>
                <ul class="nav nav-second-level">
                    <li> <a href="admin/allHeadline">All Headline</a> </li>
                </ul>
            </li>
            
            <li>
                <a href="admin/banner" class="waves-effect">
                    <i class="fa-fw fa fa-indent" ></i>
                    <span class="hide-menu">Banner Ads
                        <span class="fa arrow"></span>
                    </span>
                </a>
                <ul class="nav nav-second-level">
                    <!--<li> <a href="<?php echo base_url(); ?>super_admin/addUser">Add User</a> </li>-->
                    <li> <a href="admin/banner">Add Banner Ads</a> </li>
                    <li> <a href="admin/bannerSettings">Settings</a> </li>
<!--                    <ul class="nav nav-second-level">
                        <li> <a href="javascript:void(0)" class="waves-effect">Settings<span class="fa arrow"></span></a>
                            <ul class="nav nav-third-level">
                                <li> <a href="admin/monthlyBanner">Settings</a> </li>
                                <li> <a href="admin/bannerTrial">Trial Permission</a> </li>
                            </ul>
                        </li>
                    </ul>-->
                    <li> <a href="admin/allBanner">All Banner Ads</a> </li>
                </ul>

            </li>
            
            <li>
                <a href="admin/native" class="waves-effect">
                    <i class="fa-fw fa fa-bookmark" ></i>
                    <span class="hide-menu">Native Ads
                        <span class="fa arrow"></span>
                    </span>
                </a>
                <ul class="nav nav-second-level">
                    <li> <a href="admin/native">Add Native Ads</a> </li>
                    <li> <a href="admin/nativeSettings">Settings</a> </li>
                    <li> <a href="admin/allNative">All Native Ads</a> </li>
                </ul>
            </li>
            
            <li>
                <a href="admin/addFacebook" class="waves-effect">
                    <i class="fa-fw fa fa-facebook" ></i>
                    <span class="hide-menu">Facebook Ads
                        <span class="fa arrow"></span>
                    </span>
                </a>
                <ul class="nav nav-second-level">
                    <!--<li> <a href="<?php echo base_url(); ?>super_admin/addUser">Add User</a> </li>-->
                    <li> <a href="admin/addFacebook">Add Facebook Ads</a> </li>
                    <li> <a href="admin/facebookSettings">Settings</a> </li>
                    <li> <a href="admin/allFacebook">All Facebook Ads</a> </li>
                    <!--<li> <a href="admin/allEmbedFacebookAds">All Facebook Embedded Ads</a> </li>-->
                </ul>
            </li>
            
            <li>
                <a href="admin/addFbEcom" class="waves-effect">
                    <i class="fa-fw fa fa-facebook" ></i>
                    <span class="hide-menu">Facebook E-commerce Ads
                        <span class="fa arrow"></span>
                    </span>
                </a>
                <ul class="nav nav-second-level">
                    <li> <a href="admin/addFbEcom">Add E-commerce Ads</a> </li>
                    <li> <a href="admin/fbEcomSettings">Settings</a> </li>
                    <li> <a href="admin/allFbEcom">All E-commerce Ads</a> </li>
                </ul>
            </li>
            
            <li>
                <a href="admin/addLanding" class="waves-effect">
                    <i class="fa-fw fa fa-sort-amount-asc" ></i>
                    <span class="hide-menu">Landing Pages
                        <span class="fa arrow"></span>
                    </span>
                </a>
                <ul class="nav nav-second-level">
                    <!--<li> <a href="<?php echo base_url(); ?>super_admin/addUser">Add User</a> </li>-->
                    <li> <a href="landingPageAdmin/addLanding">Add Landing</a> </li>
                    <li> <a href="landingPageAdmin/landingSettings">Settings</a> </li>
                    <li> <a href="landingPageAdmin/allLandingPages">All Landing</a> </li>
                </ul>
            </li>
            
            <li>
                <a href="admin/addAffiliateLanding" class="waves-effect">
                    <i class="fa-fw fa fa-sort-amount-asc" ></i>
                    <span class="hide-menu">Affiliate Landing Page Feed
                        <span class="fa arrow"></span>
                    </span>
                </a>
                <ul class="nav nav-second-level">
                    <li> <a href="admin/addAffiliateLanding">Add Affiliate Landing</a> </li>
                    <li> <a href="admin/affiliateSettings">Settings</a> </li>
                    <li> <a href="admin/allAffiliateLandingPages">All Affiliate Landing</a> </li>
                </ul>
            </li>
            
            <li>
                <a href="admin/addPpvAds" class="waves-effect">
                    <i class="fa-fw fa fa-sort-amount-asc" ></i>
                    <span class="hide-menu">PPV Ads
                        <span class="fa arrow"></span>
                    </span>
                </a>
                <ul class="nav nav-second-level">
                    <li> <a href="admin/addPpvAds">Add PPV Ads</a> </li>
                    <li> <a href="admin/ppvSettings">Settings</a> </li>
                    <li> <a href="admin/allPpvAds">All PPV Ads</a> </li>
                </ul>
            </li>
            
            <li>
                <a href="admin/addAdvertiserOffer" class="waves-effect">
                    <i class="fa-fw fa fa-sort-amount-asc" ></i>
                    <span class="hide-menu">Advertiser Offer Feed
                        <span class="fa arrow"></span>
                    </span>
                </a>
                <ul class="nav nav-second-level">
                    <li> <a href="admin/addAdvertiserOffer">Add Advertiser Offer Feed</a> </li>
                    <li> <a href="admin/advertiserOfferSettings">Settings</a> </li>
                    <li> <a href="admin/allAdvertiserOffer">All Advertiser Offer Feed</a> </li>
                </ul>
            </li>
            
            <li>
                <a href="admin/addWhois" class="waves-effect">
                    <i class="fa-fw fa fa-sort-amount-asc" ></i>
                    <span class="hide-menu">Whois
                        <span class="fa arrow"></span>
                    </span>
                </a>
                <ul class="nav nav-second-level">
                    <li> <a href="WhoisAdmin/freeWhois">Free Settings</a></li>
                    <li> <a href="WhoisAdmin/silverWhois">Silver Settings</a></li>
                    <li> <a href="WhoisAdmin/goldWhois">Gold Settings</a></li>
                    <li> <a href="WhoisAdmin/platinumWhois">Platinum Settings</a></li>
                </ul>
            </li>
            
            <li>
                <a href="resourceAdmin/showaffiliateresource" class="waves-effect">
                    <i class="fa-fw fa fa-share-alt" ></i>
                    <span class="hide-menu">Resources
                        <span class="fa arrow"></span>
                    </span>
                </a>
                <ul class="nav nav-second-level">
                    <li> <a href="resourceAdmin/showaffiliateresource">Affiliate Networks</a> </li>
                    <li> <a href="admin/resourceAdNetworks">Ad Networks</a> </li>
                    <li> <a href="admin/resourceHosting">Hosting</a></li>
                    <li> <a href="admin/resourceTracking">Tracking</a></li>
                    <li> <a href="admin/resourceCoaching">Coaching</a></li>
                    <li> <a href="admin/resourceFulfilment">Fulfilment</a></li>
                    <li> <a href="admin/resourceCallCenters">Call Centers</a></li>
                    <li> <a href="admin/resourceForums">Forums</a></li>
                    <li> <a href="admin/resourceBlogs">Blogs</a></li>
                </ul>
            </li>
            
            <li>
                <a href="#" class="waves-effect">
                    <i class="fa-fw fa fa-cog" ></i>
                    <span class="hide-menu">Services
                        <span class="fa arrow"></span>
                    </span>
                </a>
                <ul class="nav nav-second-level">
                    <li> <a href="serviceAdmin/showservicebanner">Banner/Creative Design</a> </li>
                     <li> <a href="serviceAdmin/showProgrammingIntegration">Programming and Integrations</a> </li>
                    <li> <a href="serviceAdmin/translation">Translations</a> </li>
                </ul>
            </li>
            
            <li>
                <a href="admin/trial" class="waves-effect">
                    <i class="fa-fw fa fa-cog" ></i>
                    <span class="hide-menu">Settings
                        <span class="fa arrow"></span>
                    </span>
                </a>
                <ul class="nav nav-second-level">
                    <li> <a href="admin/paypal">Paypal</a> </li>
                    <li> <a href="admin/stripe">Stripe</a> </li>
                    <li> <a href="admin/trial">Trial</a> </li>
                </ul>
            </li>
            
            <li>
                <a href="admin/addSponsorMsg" class="waves-effect">
                    <i class="fa-fw fa fa-cog" ></i>
                    <span class="hide-menu">Sponsor Messages 
                        <span class="fa arrow"></span>
                    </span>
                </a>
                <ul class="nav nav-second-level">
                    <li> <a href="admin/addSponsorMsg">Add Sponsor Messages </a> </li>
                </ul>
            </li>
            
            <li>
                <a href="admin/news" class="waves-effect">
                    <i class="fa-fw fa fa-cog" ></i>
                    <span class="hide-menu">News
                        <span class="fa arrow"></span>
                    </span>
                </a>
                <ul class="nav nav-second-level">
                    <li> <a href="admin/news">Add News</a> </li>
                </ul>
            </li>
        </ul>
    </div>
</div>


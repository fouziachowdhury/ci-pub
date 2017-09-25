<div class="mobile-menu-wrap">
        <ul class="clearfix">
            <li><a href="home">Home</a></li>
            <li><a href="network">Network</a></li>
            <li><a href="affiliate">Affiliate</a></li>
            <li class="active"><a href="whois">Whois</a></li>
        </ul>
        <div class="mobile-menu-btn">
            <?php if (isset($_SESSION['member_id']) != '') { ?>
                <a href="<?php echo base_url() ?>userhome">User Home</a>
            <?php } else { ?>
                <a href="loginform" class="btn btn-outline">Login</a>
                <a href="registrationform" class="btn">Join for Free</a>
            <?php } ?>
        </div>
    </div>

    <div class="main-wrapper">
        <!-- Header start -->
        <div class="header-wrap">
            <div class="top-navbar">
                <div class="container">
                    <div class="logo">
                        <a href="home"><img src="assets/images/logo_1.png" alt="Publyfe" /></a>
                    </div>
                    <div class="menu-bar">
                        <ul class="clearfix">
                            <li><a href="home">Home</a></li>
                            <li><a href="network">Network</a></li>
                            <li><a href="affiliate">Affiliate</a></li>
                            <li class="active"><a href="whois">Whois</a></li>
                        </ul>
                    </div>
                    <div class="top-btns">
                        <?php if (isset($_SESSION['member_id']) != '') { ?>
                            <a class="btn" href="<?php echo base_url() ?>userhome">User Home</a>
                        <?php } else { ?>
                            <a href="loginform" class="btn btn-outline">Login</a>
                            <a href="registrationform" class="btn">Join for Free</a>
                        <?php } ?>
                    </div>
                    <div class="top-social-icon">
                        <ul class="social-icon clearfix">
                            <li><a href="https://www.facebook.com/publyfe"><i class="fa fa-facebook"></i></a></li>
                            <li><a href="#"><i class="fa fa-twitter"></i></a></li>
                            <li><a href="#"><i class="fa fa-google-plus"></i></a></li>
                            <li><a href="#"><i class="fa fa-pinterest"></i></a></li>
                        </ul>
                    </div>
                    <div class="mobile-menu">
                        <a href="#" class="mobile-menu-icon navicon"><i class="fa fa-bars"></i></a>
                    </div>
                    <div class="clearfix"></div>
                </div>
            </div>
            <div class="banner-page">
                <div class="container">
                    <div class="banner-text-whois">
                        <div class="main-banner-text">Whois History</div>
                        <div class="sub-banner-text">
                            Show Historical Website Data and Ownership Information
                        </div>
                        <div class="banner-img">
                            <img src="assets/images/whois.png" alt="Publyfe">
                        </div>
                    </div>
                    <div class="clearfix"></div>
                </div>
            </div>
        </div>
        <!-- Header end -->

        <div class="section-wrap section-whois">
            <div class="container">
                <div class="section-title">
                    <h2>Publyfe Whois IP Lookup Tool</h2>
                    <div class="section-sub-title">
                        The Lookup tool displays as much information as possible for a given IP address
                    </div>
                </div>
                <div class="check-list-wrap">
                    <div class="row clearfix">
                        <div class="col-sm-6">
                            <div class="per-check-list">
                                <i class="fa fa-check-square-o" aria-hidden="true"></i>
                                <div class="check-list-text">
                                    <strong>Domain / IP Whois</strong>
                                    <span>Lookup information on a domain or ip address.</span>
                                </div>
                                <div class="clearfix"></div>
                            </div>
                        </div>
                        <div class="col-sm-6">
                            <div class="per-check-list">
                                <i class="fa fa-check-square-o" aria-hidden="true"></i>
                                <div class="check-list-text">
                                    <strong>IP History</strong>
                                    <span>Show historical IP addresses for a domain.</span>
                                </div>
                                <div class="clearfix"></div>
                            </div>
                        </div>
                    </div>
                    <div class="row clearfix">
                        <div class="col-sm-6">
                            <div class="per-check-list">
                                <i class="fa fa-check-square-o" aria-hidden="true"></i>
                                <div class="check-list-text">
                                    <strong>Whois History</strong>
                                    <span>Show historical website data and ownership information</span>
                                </div>
                                <div class="clearfix"></div>
                            </div>
                        </div>
                        <div class="col-sm-6">
                            <div class="per-check-list">
                                <i class="fa fa-check-square-o" aria-hidden="true"></i>
                                <div class="check-list-text">
                                    <strong>Reverse NS Lookup</strong>
                                    <span>Find all sites that use given nameserver</span>
                                </div>
                                <div class="clearfix"></div>
                            </div>
                        </div>
                    </div>
                    <div class="row clearfix">
                        <div class="col-sm-6">
                            <div class="per-check-list">
                                <i class="fa fa-check-square-o" aria-hidden="true"></i>
                                <div class="check-list-text">
                                    <strong>Reverse IP Lookup</strong>
                                    <span>Find all sites hosted on a given server.</span>
                                </div>
                                <div class="clearfix"></div>
                            </div>
                        </div>
                        <div class="col-sm-6">
                            <div class="per-check-list">
                                <i class="fa fa-check-square-o" aria-hidden="true"></i>
                                <div class="check-list-text">
                                    <strong>IP Location Finder</strong>
                                    <span>Find the geographic location of an IP address</span>
                                </div>
                                <div class="clearfix"></div>
                            </div>
                        </div>
                    </div>
                    <div class="row clearfix">
                        <div class="col-sm-6">
                            <div class="per-check-list">
                                <i class="fa fa-check-square-o" aria-hidden="true"></i>
                                <div class="check-list-text">
                                    <strong>Reverse Whois Lookup</strong>
                                    <span>Find domain names owned by an individual or company.</span>
                                </div>
                                <div class="clearfix"></div>
                            </div>
                        </div>
                        <div class="col-sm-6">&nbsp;</div>
                    </div>
                </div>
                <div class="tools-join-btn">
                    <a href="registrationform" class="join-btn">Join Now for FREE!</a>
                    <span>FREE Trial No Credit Card Needed</span>
                </div>
            </div>
        </div>

        <div class="section-wrap section-plan">
            <div class="container">
                <div class="section-title">
                    <h2>CHOOSE YOUR PLAN</h2>
                    <div class="section-sub-title">
                        Affiliate plan is our most popular with full access that allows you
                    </div>
                </div>
                <div class="tools-join-btn">
                    <?php if (isset($_SESSION['member_id']) && $_SESSION['member_id'] != '') { ?>
                        <a href="" onclick="networkfree()" class="join-btn join-btn-green" role="button">FREE TRIAL</a>
                    <?php } else { ?>
                        <a href="<?php echo base_url() ?>freepack/3" class="join-btn join-btn-green" role="button">FREE TRIAL</a>
                    <?php } ?>
                    <!--<a href="#" class="join-btn join-btn-green">FREE TRIAL</a>-->
                </div>
                <div class="plan-container">
                    <div class="col-md-4">
                        <div class="per-plan plan-blue">
                            <div class="plan-header">
<!--                                <div class="plan-banner">
                                    <span>FREE TRIAL</span>
                                </div>-->
                                <div class="plan-title">
                                    Whois Silver
                                </div>
                                <div class="plan-subtitle">
                                    <strong>100% FREE No Credit Card Required!</strong>
                                    <span>Select from Package Below</span>
                                </div>
                            </div>
                            <div class="plan-pricing">
                                <div class="plan-amount">
                                    <span class="dollar-sign">$</span>
                                    <?php echo $whoisS->mothly_membership_price;?>
                                </div>
                                <div class="plan-month">/month</div>
                            </div>
                            <div class="plan-type"><span>Full Access</span></div>
                            <div class="plan-features">
                                <div class="plan-checklist">
                                    <?php if($whoisS->dns_record_lookup != 0){?>
                                    <div class="per-plan-checklist clearfix">
                                        <div class="per-plan-checkbox"><div class="per-plan-checkbox-box check-green"><i class="fa fa-check"></i></div></div>
                                        <span>DNS Record Lookup</span>
                                    </div>
                                    <?php }?>
                                    <?php if($whoisS->domain_iP_whois != 0){?>
                                    <div class="per-plan-checklist clearfix">
                                        <div class="per-plan-checkbox">
                                            <div class="per-plan-checkbox-box check-green">
                                                <i class="fa fa-check"></i>
                                            </div>
                                        </div>
                                        <span>Domain / IP Whois</span>
                                    </div>
                                    <?php }?>
                                    <?php if($whoisS->reverse_mx_lookup != 0){?>
                                    <div class="per-plan-checklist clearfix">
                                        <div class="per-plan-checkbox"><div class="per-plan-checkbox-box check-green"><i class="fa fa-check"></i></div></div>
                                        <span>Reverse MX Lookup</span>
                                    </div>
                                    <?php }?>
                                    <?php if($whoisS->reverse_ip_lookup != 0){?>
                                    <div class="per-plan-checklist clearfix">
                                        <div class="per-plan-checkbox"><div class="per-plan-checkbox-box check-green"><i class="fa fa-check"></i></div></div>
                                        <span>Reverse IP Lookup</span>
                                    </div>
                                    <?php }?>
                                    <?php if($whoisS->reverse_whois_lookup != 0){?>
                                    <div class="per-plan-checklist clearfix">
                                        <div class="per-plan-checkbox"><div class="per-plan-checkbox-box check-green"><i class="fa fa-check"></i></div></div>
                                        <span>Reverse Whois Lookup</span>
                                    </div>
                                    <?php }?>
                                    <?php if($whoisS->ip_history != 0){?>
                                    <div class="per-plan-checklist clearfix">
                                        <div class="per-plan-checkbox"><div class="per-plan-checkbox-box check-green"><i class="fa fa-check"></i></div></div>
                                        <span>IP History</span>
                                    </div>
                                    <?php }?>
                                    <?php if($whoisS->reverse_dns_lookup != 0){?>
                                    <div class="per-plan-checklist clearfix">
                                        <div class="per-plan-checkbox"><div class="per-plan-checkbox-box check-green"><i class="fa fa-check"></i></div></div>
                                        <span>Reverse DNS Lookup</span>
                                    </div>
                                    <?php }?>
                                    <?php if($whoisS->reverse_ns_lookup != 0){?>
                                    <div class="per-plan-checklist clearfix">
                                        <div class="per-plan-checkbox"><div class="per-plan-checkbox-box check-green"><i class="fa fa-check"></i></div></div>
                                        <span>Reverse NS Lookup</span>
                                    </div>
                                    <?php }?>
                                    <?php if($whoisS->ip_location_finder != 0){?>
                                    <div class="per-plan-checklist clearfix">
                                        <div class="per-plan-checkbox"><div class="per-plan-checkbox-box check-green"><i class="fa fa-check"></i></div></div>
                                        <span>IP Location Finder</span>
                                    </div>
                                    <?php }?>
                                </div>
                                <div class="tools-join-btn">
                                    <a href="<?php echo base_url()?>activewhoissilver/<?php echo $whoisS->mothly_membership_price;?>" class="join-btn" role="button">Join Now</a>
                                    <!--<a href="#" class="join-btn">Join Now</a>-->
                                    <span>100% FREE No Credit Card Required!</span>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="per-plan plan-green">
                            <div class="plan-header">
<!--                                <div class="plan-banner">
                                    <span>FREE TRIAL</span>
                                </div>-->
                                <div class="plan-title">
                                    Whois Gold
                                </div>
                                <div class="plan-subtitle">
                                    <strong>100% FREE No Credit Card Required!</strong>
                                    <span>Select from Package Below</span>
                                </div>
                            </div>
                            <div class="plan-pricing">
                                <div class="plan-amount">
                                    <span class="dollar-sign">$</span>
                                    <?php echo $whoisG->mothly_membership_price;?>
                                </div>
                                <div class="plan-month">/month</div>
                            </div>
                            <div class="plan-type"><span>Full Access</span></div>
                            <div class="plan-features">
                                <div class="plan-checklist">
                                    <?php if($whoisG->dns_record_lookup != 0){?>
                                    <div class="per-plan-checklist clearfix">
                                        <div class="per-plan-checkbox"><div class="per-plan-checkbox-box check-green"><i class="fa fa-check"></i></div></div>
                                        <span>DNS Record Lookup</span>
                                    </div>
                                    <?php }?>
                                    <?php if($whoisS->domain_iP_whois != 0){?>
                                    <div class="per-plan-checklist clearfix">
                                        <div class="per-plan-checkbox">
                                            <div class="per-plan-checkbox-box check-green">
                                                <i class="fa fa-check"></i>
                                            </div>
                                        </div>
                                        <span>Domain / IP Whois</span>
                                    </div>
                                    <?php }?>
                                    <?php if($whoisG->reverse_mx_lookup != 0){?>
                                    <div class="per-plan-checklist clearfix">
                                        <div class="per-plan-checkbox"><div class="per-plan-checkbox-box check-green"><i class="fa fa-check"></i></div></div>
                                        <span>Reverse MX Lookup</span>
                                    </div>
                                    <?php }?>
                                    <?php if($whoisG->reverse_ip_lookup != 0){?>
                                    <div class="per-plan-checklist clearfix">
                                        <div class="per-plan-checkbox"><div class="per-plan-checkbox-box check-green"><i class="fa fa-check"></i></div></div>
                                        <span>Reverse IP Lookup</span>
                                    </div>
                                    <?php }?>
                                    <?php if($whoisG->reverse_whois_lookup != 0){?>
                                    <div class="per-plan-checklist clearfix">
                                        <div class="per-plan-checkbox"><div class="per-plan-checkbox-box check-green"><i class="fa fa-check"></i></div></div>
                                        <span>Reverse Whois Lookup</span>
                                    </div>
                                    <?php }?>
                                    <?php if($whoisG->ip_history != 0){?>
                                    <div class="per-plan-checklist clearfix">
                                        <div class="per-plan-checkbox"><div class="per-plan-checkbox-box check-green"><i class="fa fa-check"></i></div></div>
                                        <span>IP History</span>
                                    </div>
                                    <?php }?>
                                    <?php if($whoisG->reverse_dns_lookup != 0){?>
                                    <div class="per-plan-checklist clearfix">
                                        <div class="per-plan-checkbox"><div class="per-plan-checkbox-box check-green"><i class="fa fa-check"></i></div></div>
                                        <span>Reverse DNS Lookup</span>
                                    </div>
                                    <?php }?>
                                    <?php if($whoisG->reverse_ns_lookup != 0){?>
                                    <div class="per-plan-checklist clearfix">
                                        <div class="per-plan-checkbox"><div class="per-plan-checkbox-box check-green"><i class="fa fa-check"></i></div></div>
                                        <span>Reverse NS Lookup</span>
                                    </div>
                                    <?php }?>
                                    <?php if($whoisG->ip_location_finder != 0){?>
                                    <div class="per-plan-checklist clearfix">
                                        <div class="per-plan-checkbox"><div class="per-plan-checkbox-box check-green"><i class="fa fa-check"></i></div></div>
                                        <span>IP Location Finder</span>
                                    </div>
                                    <?php }?>
                                </div>
                                <div class="tools-join-btn">
                                    <a href="<?php echo base_url()?>activewhoisgold/<?php echo $whoisG->mothly_membership_price; ?>" class="join-btn" role="button">Join Now</a>
                                    <!--<a href="#" class="join-btn">Join Now</a>-->
                                    <span>100% FREE No Credit Card Required!</span>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="per-plan plan-red">
                            <div class="plan-header">
                                <div class="plan-title">
                                    Whois Platinum
                                </div>
                                <div class="plan-subtitle">
                                    <strong class="highlight">Save $50</strong>
                                </div>
                            </div>
                            <div class="plan-pricing">
                                <div class="plan-amount">
                                    <span class="dollar-sign">$</span>
                                    <?php echo $whoisP->mothly_membership_price;?>
                                </div>
                                <div class="plan-month">/month</div>
                            </div>
                            <div class="plan-type"><span>Customized Package</span></div>
                            <div class="plan-features">
                                <div class="plan-checklist">
                                    <?php if($whoisP->dns_record_lookup != 0){?>
                                    <div class="per-plan-checklist clearfix">
                                        <div class="per-plan-checkbox"><div class="per-plan-checkbox-box check-green"><i class="fa fa-check"></i></div></div>
                                        <span>DNS Record Lookup</span>
                                    </div>
                                    <?php }?>
                                    <?php if($whoisP->domain_iP_whois != 0){?>
                                    <div class="per-plan-checklist clearfix">
                                        <div class="per-plan-checkbox">
                                            <div class="per-plan-checkbox-box check-green">
                                                <i class="fa fa-check"></i>
                                            </div>
                                        </div>
                                        <span>Domain / IP Whois</span>
                                    </div>
                                    <?php }?>
                                    <?php if($whoisP->reverse_mx_lookup != 0){?>
                                    <div class="per-plan-checklist clearfix">
                                        <div class="per-plan-checkbox"><div class="per-plan-checkbox-box check-green"><i class="fa fa-check"></i></div></div>
                                        <span>Reverse MX Lookup</span>
                                    </div>
                                    <?php }?>
                                    <?php if($whoisP->reverse_ip_lookup != 0){?>
                                    <div class="per-plan-checklist clearfix">
                                        <div class="per-plan-checkbox"><div class="per-plan-checkbox-box check-green"><i class="fa fa-check"></i></div></div>
                                        <span>Reverse IP Lookup</span>
                                    </div>
                                    <?php }?>
                                    <?php if($whoisP->reverse_whois_lookup != 0){?>
                                    <div class="per-plan-checklist clearfix">
                                        <div class="per-plan-checkbox"><div class="per-plan-checkbox-box check-green"><i class="fa fa-check"></i></div></div>
                                        <span>Reverse Whois Lookup</span>
                                    </div>
                                    <?php }?>
                                    <?php if($whoisP->ip_history != 0){?>
                                    <div class="per-plan-checklist clearfix">
                                        <div class="per-plan-checkbox"><div class="per-plan-checkbox-box check-green"><i class="fa fa-check"></i></div></div>
                                        <span>IP History</span>
                                    </div>
                                    <?php }?>
                                    <?php if($whoisP->reverse_dns_lookup != 0){?>
                                    <div class="per-plan-checklist clearfix">
                                        <div class="per-plan-checkbox"><div class="per-plan-checkbox-box check-green"><i class="fa fa-check"></i></div></div>
                                        <span>Reverse DNS Lookup</span>
                                    </div>
                                    <?php }?>
                                    <?php if($whoisP->reverse_ns_lookup != 0){?>
                                    <div class="per-plan-checklist clearfix">
                                        <div class="per-plan-checkbox"><div class="per-plan-checkbox-box check-green"><i class="fa fa-check"></i></div></div>
                                        <span>Reverse NS Lookup</span>
                                    </div>
                                    <?php }?>
                                    <?php if($whoisP->ip_location_finder != 0){?>
                                    <div class="per-plan-checklist clearfix">
                                        <div class="per-plan-checkbox"><div class="per-plan-checkbox-box check-green"><i class="fa fa-check"></i></div></div>
                                        <span>IP Location Finder</span>
                                    </div>
                                    <?php }?>
                                </div>
                                <div class="tools-join-btn">
                                    <a href="<?php echo base_url()?>activewhoisplatinum/<?php echo $whoisP->mothly_membership_price; ?>" class="join-btn" role="button">Join Now</a>
                                    <!--<a href="#" class="join-btn">Join Now</a>-->
                                    <span>Save $50</span>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="clearfix"></div>
                </div>
            </div>
        </div>
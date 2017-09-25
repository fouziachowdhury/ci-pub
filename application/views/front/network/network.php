<div class="mobile-menu-wrap">
    <ul class="clearfix">
        <li><a href="home">Home</a></li>
        <li class="active"><a href="networks">Network</a></li>
        <li><a href="affiliate">Affiliate</a></li>
        <li><a href="whois">Whois</a></li>
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
    <div class="header-wrap network-header">
        <div class="top-navbar">
            <div class="container">
                <div class="logo">
                    <a href="home"><img src="assets/images/logo_1.png" alt="Publyfe" /></a>
                </div>
                <div class="menu-bar">
                    <ul class="clearfix">
                        <li><a href="home">Home</a></li>
                        <li class="active"><a href="network">Network</a></li>
                        <li><a href="affiliate">Affiliate</a></li>
                        <li><a href="whois">Whois</a></li>
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
                <div class="banner-text-network">
                    <div class="main-banner-text">Networks</div>
                    <div class="sub-banner-text">
                        Grow your Networks reach and advertising revenue
                    </div>
                    <div class="banner-text-info">
                        <p>Turbocharge your publisher development and advertising sales teams. Quickly prospect new publishers and grow your networks reach. Identify high value advertisers that are not yet spending money with you.</p>
                        <div class="banner-btns">
                            <a href="registrationform">Join for FREE Today!</a>
                        </div>
                    </div>
                </div>
                <div class="clearfix"></div>
            </div>
        </div>
    </div>
    <!-- Header end -->

    <div class="section-wrap section-network">
        <div class="per-section-network">
            <div class="container">
                <div class="section-title">
                    <h2>Daily Affiliate Landing Page Feed</h2>
                    <div class="section-sub-title">
                        Thousands of landing pages organized by categories with easy who is domain access and contact info.
                    </div>
                    <div class="row clearfix">
                        <div class="col-md-4">
                            <img src="assets/images/network-laptop.png" alt="Publyfe">
                        </div>
                        <div class="col-md-8">
                            <div class="network-text">
                                <div class="per-network-text clearfix">
                                    <div class="check-circle">
                                        <i class="fa fa-check"></i>
                                    </div>
                                    <div class="network-text-info">
                                        <strong>See where an advertisement is running.</strong> We show you which advertising network and which placements are gainful for the advertiser.
                                    </div>
                                </div>
                                <div class="per-network-text clearfix">
                                    <div class="check-circle">
                                        <i class="fa fa-check"></i>
                                    </div>
                                    <div class="network-text-info">
                                        <strong>Find out how frequently a landing page was seen.</strong> The ‘times seen’ count is a strong indicator if a campaign has mass-appeal or not. Seeing an ad running on 100s arrangements? It's most likely a genuine champ.
                                    </div>
                                </div>
                                <div class="per-network-text clearfix">
                                    <div class="check-circle">
                                        <i class="fa fa-check"></i>
                                    </div>
                                    <div class="network-text-info">
                                        <strong>Find worldwide campaigns.</strong> Curious if the same ad is profitable in other countries too? If there’s the same advertisement running in a different country, we’ll show it right on the results page.
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="per-section-network">
            <div class="container">
                <div class="section-title">
                    <h2>Daily Offer Feed</h2>
                    <div class="section-sub-title">
                        Thousands of offers organized by categories with easy who is domain search
                    </div>
                    <div class="row clearfix">
                        <div class="col-md-8">
                            <div class="network-text">
                                <div class="per-network-text clearfix">
                                    <div class="check-circle">
                                        <i class="fa fa-check"></i>
                                    </div>
                                    <div class="network-text-info">
                                        <strong>Accurate results.</strong> Distinctive to other research tools, we do both, filtering by algorithms alongside a manual endorsement process.
                                    </div>
                                </div>
                                <div class="per-network-text clearfix">
                                    <div class="check-circle">
                                        <i class="fa fa-check"></i>
                                    </div>
                                    <div class="network-text-info">
                                        <strong>Global coverage.</strong> The list is still growing and we can already guarantee to show you more results than some other spy tool in the mobile pop & redirect research landscape.
                                    </div>
                                </div>
                                <div class="per-network-text clearfix">
                                    <div class="check-circle">
                                        <i class="fa fa-check"></i>
                                    </div>
                                    <div class="network-text-info">
                                        <strong>Huge number of sites checked every day.</strong> We're gathering advertisements from well more than 200.000 destinations every day. If there’s a landing page running on a network we support, you will be able to find it.
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <img src="assets/images/network-browser.png" alt="Publyfe">
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="per-section-network">
            <div class="container">
                <div class="section-title">
                    <h2>Whois Domain Tools</h2>
                    <div class="section-sub-title">
                        Research Domain Whois Info, IP Whois, Reverse IP Lookup, Reverse Whois Lookup, IP and Domain History
                    </div>
                    <div class="row clearfix">
                        <div class="col-md-4">
                            <img src="assets/images/network-server.png" alt="Publyfe">
                        </div>
                        <div class="col-md-8">
                            <div class="network-text">
                                <div class="per-network-text clearfix">
                                    <div class="check-circle">
                                        <i class="fa fa-check"></i>
                                    </div>
                                    <div class="network-text-info">
                                        <strong>Go Beyond Ordinary Whois.</strong> Discover the people or organizations behind a domain name or IP address.
                                    </div>
                                </div>
                                <div class="per-network-text clearfix">
                                    <div class="check-circle">
                                        <i class="fa fa-check"></i>
                                    </div>
                                    <div class="network-text-info">
                                        <strong>Connect The Dots.</strong> Discovering connections between domains, persons, organizations, IP addresses, etc.
                                    </div>
                                </div>
                                <div class="per-network-text clearfix">
                                    <div class="check-circle">
                                        <i class="fa fa-check"></i>
                                    </div>
                                    <div class="network-text-info">
                                        <strong>Defend Your Brand.</strong> Find connections between domains and other DNS assets to discover ownership or map associations.
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
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
            
            <div class="alert alert-success alert-dismissable" id="packagenetsuccess" style="display:none;width: 80%; margin: 0 auto;margin-bottom: 20px;">
                <i class="fa fa-check-square-o"></i>
                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                <div id="shownetmessage"></div>
            </div>
            
            <div class="tools-join-btn">
                <?php if (isset($_SESSION['member_id']) && $_SESSION['member_id'] != '') { ?>
                    <a onclick="networkfree()" class="join-btn join-btn-green" role="button">FREE TRIAL</a>
                <?php } else { ?>
                    <a href="<?php echo base_url() ?>freepack/2" class="join-btn join-btn-green" role="button">FREE TRIAL</a>
                <?php } ?>
                <!--<a href="#" class="join-btn join-btn-green">FREE TRIAL</a>-->
            </div>
            <div class="plan-container">
                <div class="col-md-6">
                    <div class="per-plan plan-blue">
                        <div class="plan-header">
                            <div class="plan-title">
                                super Networks
                            </div>
                            <div class="plan-subtitle">
                                <strong>100% FREE No Credit Card Required!</strong>
                                <span>Select from Package Below</span>
                            </div>
                        </div>
                        <div class="plan-pricing">
                            <div class="plan-amount">
                                <span class="dollar-sign">$</span>
                                <?php echo $superpackageinfo->option_price;?>
                            </div>
                            <div class="plan-month">/month</div>
                        </div>
                        <div class="plan-type"><span>Full Access</span></div>
                        <div class="plan-features">
                            <div class="plan-checklist">
                                <div class="per-plan-checklist clearfix">
                                    <div class="per-plan-checkbox">
                                        <div class="per-plan-checkbox-box check-green">
                                            <i class="fa fa-check"></i>
                                        </div>
                                    </div>
                                    <span>Affiliate Landing Page Feed</span>
                                </div>
                                <div class="per-plan-checklist clearfix">
                                    <div class="per-plan-checkbox">
                                        <div class="per-plan-checkbox-box check-green">
                                            <i class="fa fa-check"></i>
                                        </div>
                                    </div>
                                    <span>Offer Feed</span>
                                </div>
                                <div class="per-plan-checklist clearfix">
                                    <div class="per-plan-checkbox">
                                        <div class="per-plan-checkbox-box check-green">
                                            <i class="fa fa-check"></i>
                                        </div>
                                    </div>
                                    <span>Whois Platinium</span>
                                </div>
                                <div class="per-plan-checklist clearfix">
                                    <div class="per-plan-checkbox">
                                        <div class="per-plan-checkbox-box check-green"></div>
                                    </div>
                                    <span><span class="empty-feature"></span></span>
                                </div>
                                <div class="per-plan-checklist clearfix">
                                    <div class="per-plan-checkbox">
                                        <div class="per-plan-checkbox-box check-green"></div>
                                    </div>
                                    <span><span class="empty-feature"></span></span>
                                </div>
                            </div>
                            <div class="tools-join-btn">
                                <a href="approveNetworkPackage/285" class="join-btn">Join Now</a>
                                <span>100% FREE No Credit Card Required!</span>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="per-plan plan-red">
                        <div class="plan-header">
                            <div class="plan-title">
                                Custom Package
                            </div>
                            <div class="plan-subtitle">
                                <strong class="highlight">Save $135</strong>
                            </div>
                        </div>
                        <div class="plan-pricing">
                            <div class="plan-amount">
                                <span class="dollar-sign">$</span>
                                <?php $net_sum = 0; 
                                foreach ($membership_options as $option) { 
                                    $net_sum = $net_sum + $option['option_price'];
                                }?>
                                <?php $whois_sum = 0; 
                                foreach ($mem_opt as $opt) {
                                    $whois_sum = $whois_sum + $opt['option_price'];
                                }?>
                                <?php echo $net_sum + $whois_sum?>
                            </div>
                            <div class="plan-month">/month</div>
                        </div>
                        <div class="plan-type"><span>Customized Package</span></div>
                        <form action="selectcustompackageoption" method="post" id="frm1">
                            
                            <div class="plan-features">
                                <div class="plan-checklist">
                                    <?php foreach ($membership_options as $option) { ?>
                                        <div class="per-plan-checklist clearfix">
                                            <div class="per-plan-checkbox toggle-check">
                                                <div class="per-plan-checkbox-box check-red" onclick="optionValue('<?php echo $option['option_id'] ?>')">
                                                    <i class="fa fa-check" data-attr="<?php echo $option['option_id'] ?>"></i>
                                                </div>
                                            </div>
                                            <span><?php echo $option['option_name'] ?></span>
                                            <span class="-plan-feature-price"><?php echo $option['option_price'] ?></span>
                                        </div>
                                    <?php } ?>
                                    <div id="case_id" style="display: none">
                                    </div>
                                    <!--                                <div class="per-plan-checklist clearfix">
                                                                        <div class="per-plan-checkbox toggle-check">
                                                                            <div class="per-plan-checkbox-box check-red">
                                                                                <i class="fa fa-check "></i>
                                                                            </div>
                                                                        </div>
                                                                        <span>Offer Feed</span>
                                                                        <span class="-plan-feature-price">$195</span>
                                                                    </div>-->
                                    <?php foreach ($mem_opt as $opt) { ?>
                                        <div class="per-plan-checklist clearfix">
                                            <div class="per-plan-checkbox toggle-check">
                                                <input getradiocheck="1" optinval="<?php echo $opt['option_price']; ?>" class="networkoptionValue" 
                                                       value="<?php echo $opt['option_id']?>" type="radio" name="option_id[]">
                                                <!--<div class="per-plan-checkbox-box check-red">
                                                        <i class="fa fa-check"></i>
                                                </div>-->
                                            </div>
                                            <span><?php echo $opt['option_name']; ?></span>
                                            <span class="-plan-feature-price">$<?php echo $opt['option_price']; ?></span>
                                        </div>
                                    <?php } ?>
                                    <!--<div class="per-plan-checklist clearfix">
                                            <div class="per-plan-checkbox toggle-check">
                                                <div class="per-plan-checkbox-box check-red">
                                                    <i class="fa fa-check "></i>
                                                </div>
                                            </div>
                                            <span>Whois Gold</span>
                                            <span class="-plan-feature-price">$125</span>
                                        </div>
                                        <div class="per-plan-checklist clearfix">
                                            <div class="per-plan-checkbox toggle-check">
                                                <div class="per-plan-checkbox-box check-red">
                                                    <i class="fa fa-check "></i>
                                                </div>
                                            </div>
                                            <span>Whois Platinum</span>
                                            <span class="-plan-feature-price">$195</span>
                                    </div>-->
                                </div>
                                <div class="tools-join-btn">
                                    <button type="submit" class="join-btn">Join Now</button>
                                    <!--<a ></a>-->
                                    <span>Save $50</span>
                                </div>
                            </div>
                            
                        </form>
                        
                    </div>
                </div>
                <div class="clearfix"></div>
            </div>
        </div>
    </div>
    
    
<script>
    $(document).ready(function () {
        $.ajax({
            type: 'POST',
            url: '<?php echo base_url() ?>pagecount',
            data: {'page_id': 2},
            success: function (data) {
            }
        });
    });

    function networkfree() {
        $.ajax({
            type: 'POST',
            url: '<?php echo base_url() ?>activefreepackage',
            data: {
                'package_id': 2,
                'package': 'Netowrk'
            },
            success: function (data) {
                var hhh = JSON.parse(data);
                $('#shownetmessage').html(hhh.insertmessage);
                $("#packagenetsuccess").show();
                //setTimeout(function(){ 
                // $("#packagesuccess").hide();   
                //}, 180000);
            }
        });
    }

</script>    
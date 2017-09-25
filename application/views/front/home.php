
<div class="mobile-menu-wrap">
    <ul class="clearfix">
        <li class="active"><a href="home">Home</a></li>
        <li><a href="networks">Network</a></li>
        <li><a href="affiliate">Affiliate</a></li>
        <li><a href="whois">Whois</a></li>
    </ul>
    <div class="mobile-menu-btn">
        <?php if (isset($_SESSION['member_id']) != '') { ?>
            <!--<a href="<?php echo base_url() ?>memberprofile/<?php echo $_SESSION['member_id']; ?>">Profile</a>-->
            <a href="<?php echo base_url() ?>userhome">User Home</a>
        <?php } else { ?>
            <a href="loginform" class="btn btn-outline">Login</a>
            <a href="registrationform" class="btn">Join for Free</a>
        <?php } ?>
        
    </div>
</div>

<div class="main-wrapper">
    <!-- Header start -->
    <div class="header-wrap index">
        <div class="top-navbar">
            <div class="container">
                <div class="logo">
                    <a href="home"><img src="assets/images/logo_1.png" alt="Publyfe" /></a>
                </div>
                <div class="menu-bar">
                    <ul class="clearfix">
                        <li class="active"><a href="home">Home</a></li>
                        <li><a href="network">Network</a></li>
                        <li><a href="affiliate">Affiliate</a></li>
                        <li><a href="whois">Whois</a></li>
                    </ul>
                </div>
                <div class="top-btns">
                    <?php if (isset($_SESSION['member_id']) != '') { ?>
                        <!--<a class="btn btn-outline" href="<?php echo base_url() ?>memberprofile/<?php echo $_SESSION['member_id']; ?>">Profile</a>-->
                        <a class="btn" href="<?php echo base_url() ?>userhome">User Home</a>
                    <?php } else { ?>
                        <a href="loginform" class="btn btn-outline">Login</a>
                        <a href="registrationform" class="btn">Join for Free</a>
                    <?php } ?>
<!--                    <a href="loginform" class="btn btn-outline">Login</a>
                    <a href="#" class="btn">Join for Free</a>-->
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
        <div class="banner-page index">
            <div class="container">
                <div class="banner-text">
                    <div class="main-banner-text">Spy on your Competitors’<br />Marketing Campaigns</div>
                    <div class="sub-banner-text">
                        Uncover your competitor's campaign creatives,<br />landing pages and traffic sources
                    </div>
                    <div class="banner-btns">
                        <a href="#">What's Inside</a>
                        <a href="registrationform">Join for FREE</a>
                    </div>
                </div>
                <div class="clearfix"></div>
            </div>
        </div>
    </div>
    <!-- Footer end -->

    <div class="networks-wrap">
        <div class="container">
            <div class="spy-label">
                Spy on <span>20+</span> Networks:
            </div>
            <div class="spy-scroller">
                <div class="spy-scoller-container">
                    <a href="#"><img src="assets/images/spy/taboola.png" alt="Publyfe"></a>
                    <a href="#"><img src="assets/images/spy/mgid.png" alt="Publyfe"></a>
                    <a href="#"><img src="assets/images/spy/outbrain.png" alt="Publyfe"></a>
                    <a href="#"><img src="assets/images/spy/revcontent.png" alt="Publyfe"></a>
                    <a href="#"><img src="assets/images/spy/ayboll.png" alt="Publyfe"></a>
                    <a href="#"><img src="assets/images/spy/zergnet.png" alt="Publyfe"></a>
                    <a href="#"><img src="assets/images/spy/gravity.png" alt="Publyfe"></a>
                </div>
                <div class="scroller-arrow">
                    <a href="#"><i class="fa fa-angle-left"></i></a>
                    <a href="#"><i class="fa fa-angle-right"></i></a>
                </div>
            </div>
            <div class="clearfix"></div>
        </div>
    </div>
    <div class="section-wrap first-section-wrap">
        <div class="container">
            <div class="section-title">
                <h2>WE HELP YOU MAKE MONEY</h2>
                <div class="section-sub-title">
                    Easily find what products super affiliates are promoting on display & native networks. Access thousand of creatives and landing pages filtered by vertical and country. 
                </div>
            </div>
            <div class="services-box-wrap clearfix">
                <div class="per-boxes">
                    <img src="assets/images/icons/window.png" alt="Publyfe">
                    <span>Display banners listed by vertical, size and country</span>
                    <a href="registrationform" class="box-join-btn">Join Now!</a>
                </div>
                <div class="per-boxes">
                    <img src="assets/images/icons/frame.png" alt="Publyfe">
                    <span>Native Ads listed by vertical and country</span>
                    <a href="registrationform" class="box-join-btn">Join Now!</a>
                </div>
                <div class="per-boxes">
                    <img src="assets/images/icons/signal-frame.png" alt="Publyfe">
                    <span>Daily Live Feed of Landing Pages<br>(pages we find, we load, you get live up to date LP's)</span>
                    <a href="registrationform" class="box-join-btn">Join Now!</a>
                </div>
                <div class="per-boxes">
                    <img src="assets/images/icons/signal.png" alt="Publyfe">
                    <span>Daily Offer Feed</span>
                    <a href="registrationform" class="box-join-btn">Join Now!</a>
                </div>
                <div class="per-boxes">
                    <img src="assets/images/icons/mic.png" alt="Publyfe">
                    <span>FB Ads<br>(Live Feed of Ads + Cached 30 Days or Older Ads)</span>
                    <a href="registrationform" class="box-join-btn">Join Now!</a>
                </div>
                <div class="per-boxes">
                    <img src="assets/images/icons/connection.png" alt="Publyfe">
                    <span>Resources - Affiliate Networks and Traffic Sources (Reviews)</span>
                    <a href="registrationform" class="box-join-btn">Join Now!</a>
                </div>
                <div class="per-boxes">
                    <img src="assets/images/icons/www.png" alt="Publyfe">
                    <span>Domain Whois Data<br>(Contact site Wwners, Manage Internal Notes and Contacts)</span>
                    <a href="registrationform" class="box-join-btn">Join Now!</a>
                </div>
                <div class="per-boxes">
                    <img src="assets/images/icons/ip.png" alt="Publyfe">
                    <span>Reverse IP Lookup, Email Whois Lookup, IP History, IP Location Finder, Similar Domains</span>
                    <a href="registrationform" class="box-join-btn">Join Now!</a>
                </div>
            </div>
        </div>
    </div>
    <div class="section-wrap second-section-wrap">
        <div class="container">
            <div class="section-title">
                <h2>Unlike Other Spy Tools</h2>
                <div class="section-sub-title">
                    <span class="text-logo"><span>Pub</span>lyfe</span> filters out irrelevant ads and only reveals campaigns super affiliates are running.
                </div>
            </div>
            <div class="tools-content clearfix">
                <div class="col-md-6">
                    <div class="content-heading">More Successful Campaigns! Less Costly Mistakes!</div>

                    <p>No other platform gives you actionable insights like Publyfe. Our bots crawl the
                        internet in dozens of countries and our team manually filters out irrelevant ads and only serves what super affiliates are running.</p>

                    <p>Stop wasting time and money running campaigns that don't convert. Uncover your competitor's campaign creatives and landing pages. Access thousands of creatives filtered by vertical and country.</p>

                    <p>Condense hundreds of hours of tiresome research and analysis to a few easy minutes. Upgrade to Super Affiliate account and download thousands of ads and banners with one click. Publyfe is updated weekly so you're always up to date on new marketing angles in your industry.</p>
                </div>
                <div class="col-md-6">
                    <img src="assets/images/laptop.png" alt="Publyfe">
                </div>
            </div>
            <div class="tools-step">
                <div class="per-step">
                    <div class="step-num">
                        <div class="step-line-left"></div>
                        <div class="step-count">1</div>
                        <div class="step-line-right"></div>
                        <div class="step-line-blue"></div>
                        <div class="clearfix"></div>
                    </div>
                    <div class="step-container">
                        <div class="step-title">Join Today</div>
                        <div class="step-text">
                            Join for free or get right down to business with out full access packages.
                        </div>
                    </div>
                </div>
                <div class="per-step">
                    <div class="step-num">
                        <div class="step-line-blue"></div>
                        <div class="step-line-right"></div>
                        <div class="step-count">2</div>
                        <div class="step-line-right"></div>
                        <div class="step-line-blue"></div>
                        <div class="clearfix"></div>
                    </div>
                    <div class="step-container">
                        <div class="step-title">Uncover Campaigns</div>
                        <div class="step-text">
                            Uncover banner ads, native ads, and landing pages yourcompetitors are using.
                        </div>
                    </div>
                </div>
                <div class="per-step">
                    <div class="step-num">
                        <div class="step-line-blue"></div>
                        <div class="step-line-right"></div>
                        <div class="step-count">3</div>
                        <div class="step-line-right"></div>
                        <div class="step-line-blue"></div>
                        <div class="clearfix"></div>
                    </div>
                    <div class="step-container">
                        <div class="step-title">Apply Your Strategies</div>
                        <div class="step-text">
                            No need to reinvent the wheel. Apply these insights to your own marketing strategies.
                        </div>
                    </div>
                </div>
                <div class="per-step">
                    <div class="step-num">
                        <div class="step-line-blue"></div>
                        <div class="step-line-right"></div>
                        <div class="step-count">4</div>
                        <div class="step-line-left"></div>
                        <div class="clearfix"></div>
                    </div>
                    <div class="step-container">
                        <div class="step-title">Launch Campaigns</div>
                        <div class="step-text">
                            Discover new traffic sources and affiliate networks and launch your winning campaigns!
                        </div>
                    </div>
                </div>
                <div class="clearfix"></div>
            </div>
            <div class="tools-join-btn">
                <a href="registrationform" class="join-btn">Join Now for FREE!</a>
            </div>
        </div>
    </div>


    <!-- Footer start -->
    

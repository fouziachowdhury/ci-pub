<div class="mobile-menu-wrap">
    <ul class="clearfix">
        <li><a href="home">Home</a></li>
        <li><a href="networks">Network</a></li>
        <li class="active"><a href="affiliate">Affiliate</a></li>
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
    <div class="header-wrap">
        <div class="top-navbar">
            <div class="container">
                <div class="logo">
                    <a href="home"><img src="assets/images/logo_1.png" alt="Publyfe"/></a>
                </div>
                <div class="menu-bar">
                    <ul class="clearfix">
                        <li><a href="home">Home</a></li>
                        <li><a href="network">Network</a></li>
                        <li class="active"><a href="affiliate">Affiliate</a></li>
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
                <div class="banner-text-whois">
                    <div class="main-banner-text">Affiliates</div>
                    <div class="sub-banner-text">
                        Discover competing Advertisers, increase traffic and ROI.
                    </div>
                    <div class="banner-img">
                        <img src="assets/images/dashboard.png" alt="Publyfe">
                    </div>
                </div>
                <div class="clearfix"></div>
            </div>
        </div>
    </div>
    <!-- Header end -->

    <div class="section-wrap section-affiliate no-pads-btm">
        <div class="container popular-container">
            <div class="section-title">
                <h2>PUB<span class="blue">LYFE</span> IS FOR AFFILIATES</h2>
                <div class="section-sub-title">
                    Unlike other spy tools, Publyfe filters out irrelevant ads and only reveals campaigns super affiliates are running. Stop wasting time with other spy tools browsing by keywords through useless brand campaigns and irrelevant ads. With Publyfe you simply select a vertical and country and view the hottest campaigns running by other affiliates.
                </div>
            </div>
            <div class="services-box-wrap affiliate-service clearfix">
                <div class="per-boxes">
                    <img src="assets/images/icons/banner-ads.png" alt="Publyfe">
                    <strong>Banner Ads</strong>
                    <span>No need to reinvent the wheel. Browse through 20000+ display banners that media buyers are using. Apply these insights to your own marketing strategies.</span>
                    <a href="registrationform" class="box-join-btn">Join Now!</a>
                </div>
                <div class="per-boxes">
                    <img src="assets/images/icons/native-ads.png" alt="Publyfe">
                    <strong>Native Ads</strong>
                    <span>Filter native ads by vertical to follow what your competitors are up to. We only display ads from top affiliate verticals, no need to waste time browsing through arbitrage site ads.</span>
                    <a href="registrationform" class="box-join-btn">Join Now!</a>
                </div>
                <div class="per-boxes">
                    <img src="assets/images/icons/landing-page.png" alt="Publyfe">
                    <strong>Landing Pages</strong>
                    <span>Stop wasting time and money running landing pages that don’t convert. Discover the most profitable landing pages other affiliates are using. Duplicate their strategies to run more profitable campaigns.</span>
                    <a href="registrationform" class="box-join-btn">Join Now!</a>
                </div>
                <div class="per-boxes">
                    <img src="assets/images/icons/facebook-ads.png" alt="Publyfe">
                    <strong>Facebook Ads</strong>
                    <span>Praesent sapien massa, convallis a pellentesque nec, egestas non nisi. Porttitor at sem. Praesent sapien massa, convallis a pellentesque nec, egestas non nisi.</span>
                    <a href="registrationform" class="box-join-btn">Join Now!</a>
                </div>
                <div class="per-boxes">
                    <img src="assets/images/icons/facebook-ecommerce.png" alt="Publyfe">
                    <strong>Facebook Ecommerce Ads</strong>
                    <span>Cras ultricies ligula sed magna dictum porta. Nulla porttitor accumsan tincidunt. Pellentesque in ipsum id orci porta dapibus. molestie malesuada. Donec rutrum congue leo eget.</span>
                    <a href="registrationform" class="box-join-btn">Join Now!</a>
                </div>
                <div class="per-boxes">
                    <img src="assets/images/icons/resource.png" alt="Publyfe">
                    <strong>Resources <br> <small>(Affiliate Network, Ad Networks, and more)</small></strong>
                    <span>Discover new traffic sources, affiliate networks and connect with the insiders of the CPA affiliate industry. Condense hundreds of hours of tiresome research and analysis to a few easy minutes.</span>
                    <a href="registrationform" class="box-join-btn">Join Now!</a>
                </div>
            </div>
        </div>
        <div class="popular-affiliate-wrap">
            <div class="container">
                <div class="section-title">
                    <h2>POPULAR AFFILIATE VERTICALS</h2>
                    <div class="section-sub-title">
                        <strong><span class="blue">Access over 40000</span></strong> display and native ads promoting the hottest verticals in the cpa affiliate space and thousands of landing pages. We cover 19 of the most popular affiliate verticals:
                    </div>
                </div>
                <div class="affiliate-list clearfix">
                    <div class="col-md-3 col-sm-4">
                        <div class="per-affiliate-list clearfix">
                            <div class="box-btn"></div>
                            <span>Bizopp</span>
                        </div>
                    </div>
                    <div class="col-md-3 col-sm-4">
                        <div class="per-affiliate-list clearfix">
                            <div class="box-btn"></div>
                            <span>Diabetes</span>
                        </div>
                    </div>
                    <div class="col-md-3 col-sm-4">
                        <div class="per-affiliate-list clearfix">
                            <div class="box-btn"></div>
                            <span>Finance</span>
                        </div>
                    </div>
                    <div class="col-md-3 col-sm-4">
                        <div class="per-affiliate-list clearfix">
                            <div class="box-btn"></div>
                            <span>Skincare</span>
                        </div>
                    </div>
                    <div class="col-md-3 col-sm-4">
                        <div class="per-affiliate-list clearfix">
                            <div class="box-btn"></div>
                            <span>Brain</span>
                        </div>
                    </div>
                    <div class="col-md-3 col-sm-4">
                        <div class="per-affiliate-list clearfix">
                            <div class="box-btn"></div>
                            <span>Diet</span>
                        </div>
                    </div>
                    <div class="col-md-3 col-sm-4">
                        <div class="per-affiliate-list clearfix">
                            <div class="box-btn"></div>
                            <span>Flashlight</span>
                        </div>
                    </div>
                    <div class="col-md-3 col-sm-4">
                        <div class="per-affiliate-list clearfix">
                            <div class="box-btn"></div>
                            <span>Survey</span>
                        </div>
                    </div>
                    <div class="col-md-3 col-sm-4">
                        <div class="per-affiliate-list clearfix">
                            <div class="box-btn"></div>
                            <span>Casino</span>
                        </div>
                    </div>
                    <div class="col-md-3 col-sm-4">
                        <div class="per-affiliate-list clearfix">
                            <div class="box-btn"></div>
                            <span>Downloads</span>
                        </div>
                    </div>
                    <div class="col-md-3 col-sm-4">
                        <div class="per-affiliate-list clearfix">
                            <div class="box-btn"></div>
                            <span>Insurance</span>
                        </div>
                    </div>
                    <div class="col-md-3 col-sm-4">
                        <div class="per-affiliate-list clearfix">
                            <div class="box-btn"></div>
                            <span>Sweepstakes</span>
                        </div>
                    </div>
                    <div class="col-md-3 col-sm-4">
                        <div class="per-affiliate-list clearfix">
                            <div class="box-btn"></div>
                            <span>Credit Score</span>
                        </div>
                    </div>
                    <div class="col-md-3 col-sm-4">
                        <div class="per-affiliate-list clearfix">
                            <div class="box-btn"></div>
                            <span>E-Cig</span>
                        </div>
                    </div>
                    <div class="col-md-3 col-sm-4">
                        <div class="per-affiliate-list clearfix">
                            <div class="box-btn"></div>
                            <span>Muscle</span>
                        </div>
                    </div>
                    <div class="col-md-3 col-sm-4">
                        <div class="per-affiliate-list clearfix">
                            <div class="box-btn"></div>
                            <span>Teeth</span>
                        </div>
                    </div>
                    <div class="col-md-3 col-sm-4">
                        <div class="per-affiliate-list clearfix">
                            <div class="box-btn"></div>
                            <span>Dating</span>
                        </div>
                    </div>
                    <div class="col-md-3 col-sm-4">
                        <div class="per-affiliate-list clearfix">
                            <div class="box-btn"></div>
                            <span>Erectile Dysfunction</span>
                        </div>
                    </div>
                    <div class="col-md-3 col-sm-4">
                        <div class="per-affiliate-list clearfix">
                            <div class="box-btn"></div>
                            <span>Securtiy</span>
                        </div>
                    </div>
                </div>
                <div class="tools-join-btn">
                    <a href="registrationform" class="join-btn">Join Now for FREE!</a>
                    <span>FREE Trial No Credit Card Needed</span>
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
            <div class="alert alert-success alert-dismissable" id="packagesuccess" style="display:none;width: 80%; margin: 0 auto;margin-bottom: 20px;">
                <i class="fa fa-check-square-o"></i>
                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                <div id="showmessage"></div>
            </div>
            <!--<h4 id="showmessage" style="text-align: center;color: #15c352;"></h4>-->
<!--            <div ></div>-->
            <div class="tools-join-btn">
                <?php if (isset($_SESSION['member_id']) && $_SESSION['member_id'] != '') { ?>
                    <a onclick="affiliatefree()" class="join-btn join-btn-green" role="button">FREE TRIAL</a>
                <?php } else { ?>
                    <a href="<?php echo base_url() ?>freepack/1" class="join-btn join-btn-green" role="button">FREE TRIAL</a>
                <?php } ?>
                <!--<a href="#" class="join-btn join-btn-green">FREE TRIAL</a>-->
            </div>
            <div class="plan-container">
                <div class="col-md-6">
                    <div class="per-plan plan-blue">
                        <div class="plan-header">
                            <div class="plan-title">
                                super affiliate
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
                                <?php foreach ($membership_options as $option){?>
                                <div class="per-plan-checklist clearfix">
                                    <div class="per-plan-checkbox"><div class="per-plan-checkbox-box check-green"><i class="fa fa-check"></i></div></div>
                                    <!--<span>20000+ Display Banners</span>-->
                                    <span><?php echo $option['option_name']; ?></span>
                                    <p>All Banners Sorted By Size: & Country UNLIMITED Downloads of All Banners</p>
                                </div>
                                <?php }?>
<!--                                <div class="per-plan-checklist clearfix">
                                    <div class="per-plan-checkbox"><div class="per-plan-checkbox-box check-green"><i class="fa fa-check"></i></div></div>
                                    <span>30000+ Native Ads</span>
                                    <p>Native Ads Sorted By Vertical & Country Download Images & Text Headlines</p>
                                </div>
                                <div class="per-plan-checklist clearfix">
                                    <div class="per-plan-checkbox"><div class="per-plan-checkbox-box check-green"><i class="fa fa-check"></i></div></div>
                                    <span>Facebook Groups</span>
                                    <p>Access Publyfe Group</p>
                                </div>
                                <div class="per-plan-checklist clearfix">
                                    <div class="per-plan-checkbox"><div class="per-plan-checkbox-box check-green"><i class="fa fa-check"></i></div></div>
                                    <span>FB Ecomm</span>
                                    <p>Access Top Internet Marketing Groups</p>
                                </div>
                                <div class="per-plan-checklist clearfix">
                                    <div class="per-plan-checkbox"><div class="per-plan-checkbox-box check-green"><i class="fa fa-check"></i></div></div>
                                    <span>PPV Ads</span>
                                </div>
                                <div class="per-plan-checklist clearfix">
                                    <div class="per-plan-checkbox"><div class="per-plan-checkbox-box check-green"><i class="fa fa-check"></i></div></div>
                                    <span>1000+ Advertorial & Landing Page</span>
                                    <p>Download HTML Files Of Each Lander</p>
                                </div>-->
                                <div class="per-plan-checklist clearfix">
                                    <div class="per-plan-checkbox"><div class="per-plan-checkbox-box check-green"><i class="fa fa-check"></i></div></div>
                                    <span>Traffic Sources</span>
                                    <p>350+ Reviews</p>
                                </div>
                                <div class="per-plan-checklist clearfix">
                                    <div class="per-plan-checkbox"><div class="per-plan-checkbox-box check-green"><i class="fa fa-check"></i></div></div>
                                    <span>Affiliate Networks</span>
                                </div>
                                <div class="per-plan-checklist clearfix">
                                    <div class="per-plan-checkbox"><div class="per-plan-checkbox-box check-green"><i class="fa fa-check"></i></div></div>
                                    <span>24 Hours Email Support</span>
                                </div>
                                <div class="per-plan-checklist clearfix">
                                    <div class="per-plan-checkbox"><div class="per-plan-checkbox-box check-green"><i class="fa fa-check"></i></div></div>
                                    <span>Live Chat Support</span>
                                </div>
                            </div>
                            <div class="tools-join-btn">
                                <a href="superpackageforaffiliate/185" class="join-btn">Join Now</a>
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
                                <?php echo $net_sum;?>
                            </div>
                            <div class="plan-month">/month</div>
                        </div>
                        <div class="plan-type"><span>Customized Package</span></div>
                        
                        <div class="plan-features">
                            <form action="custompackageforaffiliate" method="post" id="frm1">
                                <div class="plan-checklist">
                                    <?php foreach ($membership_options as $option){?>
                                    <div class="per-plan-checklist clearfix">
                                        <div class="per-plan-checkbox toggle-check">
                                            <div class="per-plan-checkbox-box check-red" onclick="optionValue('<?php echo $option['option_id']?>')">
                                                <i class="fa fa-check" data-attr="<?php echo $option['option_id']?>"></i>
                                            </div>
                                        </div>
                                        <span><?php echo $option['option_name']?></span>
                                        <span class="-plan-feature-price"><?php echo $option['option_price']?></span>
                                    </div>
                                    
                                    <!--<input type="text" name="option_id[]" id="option_<?php echo $option['option_id'];?>">-->
                                    <?php }?>
                                    <div id="case_id" style="display: none">
                                    </div>
<!--                                    <div class="per-plan-checklist clearfix">
                                        <div class="per-plan-checkbox toggle-check">
                                            <input getradiocheck="0" optinval="2" type="checkbox" class="networkoptionValue" value="2" name="option_id[]">
                                            <div class="per-plan-checkbox-box check-red">
                                                <i class="fa fa-check"></i>
                                            </div>
                                        </div>
                                        <span>30000+ Native Ads</span>
                                        <p>Native Ads Sorted By Vertical & Country Download Images & Text Headlines</p>
                                        <span class="-plan-feature-price">$55</span>
                                    </div>
                                    <div class="per-plan-checklist clearfix">
                                        <div class="per-plan-checkbox toggle-check">
                                            <input getradiocheck="0" optinval="3" type="checkbox" class="networkoptionValue" value="3" name="option_id[]">
                                            <div class="per-plan-checkbox-box check-red">
                                                <i class="fa fa-check"></i>
                                            </div>
                                        </div>
                                        <span>Facebook Groups</span>
                                        <p>Access Publyfe Group</p>
                                        <span class="-plan-feature-price">$75</span>
                                    </div>
                                    <div class="per-plan-checklist clearfix">
                                        <div class="per-plan-checkbox toggle-check">
                                            <input getradiocheck="0" optinval="4" type="checkbox" class="networkoptionValue" value="4" name="option_id[]">
                                            <div class="per-plan-checkbox-box check-red">
                                                <i class="fa fa-check"></i>
                                            </div>
                                        </div>
                                        <span>FB Ecomm</span>
                                        <p>Access Top Internet Marketing Groups</p>
                                        <span class="-plan-feature-price">$55</span>
                                    </div>
                                    <div class="per-plan-checklist clearfix">
                                        <div class="per-plan-checkbox toggle-check">
                                            <input getradiocheck="0" optinval="5" type="checkbox" class="networkoptionValue" value="5" name="option_id[]">
                                            <div class="per-plan-checkbox-box check-red">
                                                <i class="fa fa-check"></i>
                                            </div>
                                        </div>
                                        <span>PPV Ads</span>
                                        <span class="-plan-feature-price">$25</span>
                                    </div>
                                    <div class="per-plan-checklist clearfix">
                                        <div class="per-plan-checkbox toggle-check">
                                            <input getradiocheck="0" optinval="13" type="checkbox" class="networkoptionValue" value="13" name="option_id[]">
                                            <div class="per-plan-checkbox-box check-red">
                                                <i class="fa fa-check"></i>
                                            </div>
                                        </div>
                                        <span>1000+ Advertorial & Landing Page</span>
                                        <p>Download HTML Files Of Each Lander</p>
                                        <span class="-plan-feature-price">$55</span>
                                    </div>-->
                                    <div class="per-plan-checklist clearfix">
                                        <div class="per-plan-checkbox"><div class="per-plan-checkbox-box check-green"><i class="fa fa-check"></i></div></div>
                                        <span>Traffic Sources</span>
                                        <p>350+ Reviews</p>
                                    </div>
                                    <div class="per-plan-checklist clearfix">
                                        <div class="per-plan-checkbox"><div class="per-plan-checkbox-box check-green"><i class="fa fa-check"></i></div></div>
                                        <span>Affiliate Networks</span>
                                    </div>
                                    <div class="per-plan-checklist clearfix">
                                        <div class="per-plan-checkbox"><div class="per-plan-checkbox-box check-green"><i class="fa fa-check"></i></div></div>
                                        <span>24 Hours Email Support</span>
                                    </div>
                                    <div class="per-plan-checklist clearfix">
                                        <div class="per-plan-checkbox"><div class="per-plan-checkbox-box check-green"><i class="fa fa-check"></i></div></div>
                                        <span>Live Chat Support</span>
                                    </div>
                                </div>
                               
                                <div class="tools-join-btn">
                                    <button type="submit" class="join-btn">Join Now</button>
                                    <!--<a href="#" class="join-btn">Join Now</a>-->
                                    <span>Save $50</span>
                                </div>
                            </form>
                            
                        </div>
                    </div>
                </div>
                <div class="clearfix"></div>
            </div>
        </div>
    </div>
<script>
    $(document).ready(function () {
        console.log('ok');
        $("#frm1").submit(function(e) {
            alert("hello");
            e.preventDefault();
             $("i.checked").each(function(){
                alert($(this).attr('data-attr'));
            });
        });
        
        $.ajax({
            type: 'POST',
            url: '<?php echo base_url() ?>pagecount',
            data: {'page_id': 1},
            success: function (data) {
            }
        });
    });

    function affiliatefree() {
        $.ajax({
            type: 'POST',
            url: '<?php echo base_url() ?>activefreepackage',
            data: {
                'package_id': 1,
                'package': 'Affiliate'
            },
            success: function (data) {
                console.log(data);
                var hhh = JSON.parse(data);
                console.log(hhh);
                $('#showmessage').html(hhh.insertmessage);
                $("#packagesuccess").show();
                //setTimeout(function(){ 
                 // $("#packagesuccess").hide();   
              //}, 180000);
            }
        });
    }
</script>
<div class="mobile-menu-wrap">
    <ul class="clearfix">
        <li><a href="home">Home</a></li>
        <li><a href="networks">Network</a></li>
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
        
    </div>
    <section class="single-page-title">
        <div class="container text-center">
            <h2>Login Form</h2>
        </div>
    </section>
    <!-- .page-title -->

    <section class="about-text ptb-100">
        <section class="section_title">
            <div class="container text-center">
                <h2>If You Don't Have An Account Then Please <a href="registrationform">SINGUP</a></h2>
                <span class="bordered-icon"><i class="fa fa-circle-thin"></i></span>
            </div>
        </section>
        <div class="container">
            <div class="row">

                <form id="member_login_form" method="post" role="form" style="display: block;" action="loginmember">
                    <div class="form-group">
                        <input type="text" name="member_email" id="member_email" tabindex="1" class="form-control" 
                               placeholder="Email" value="<?php echo set_value('member_email'); ?>" style="height: 52px;">
                        <?php if (form_error('member_email')) { ?>
                            <span style="color:red"><?php echo form_error('member_email'); ?></span>
                        <?php } ?>
                    </div>
                    <div class="form-group">
                        <input type="password" name="member_password" id="member_password" tabindex="2" 
                               class="form-control" placeholder="Password" value="<?php echo set_value('member_password');?>" style="height: 52px;">
                        <?php if (form_error('member_password')) { ?>
                            <span style="color:red"><?php echo form_error('member_password'); ?></span>
                        <?php } ?>
                    </div>
                    <!--<div class="form-group">
                        <input type="checkbox" tabindex="3" class="" name="remember" id="remember">
                        <label for="remember"> Remember Me</label>
                    </div>-->
                    <div class="form-group">
                        <div class="row">
                            <input type="submit" name="login-submit" id="member_login_submit" tabindex="4" 
                                   class="form-control btn btn-login btn-info btn-block" value="Log In"  style="padding: 25px;">
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="row">
                            <div class="col-lg-12">
                                <div class="text-center">
                                    <a href="forgetpassword" tabindex="5" class="forgot-password">Forgot Password?</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>

    </section>
    <!-- Footer end -->
    


<!-- .about-text-->
<script type="text/javascript">

    jQuery().ready(function () {
        var v = jQuery("#member_login_form").validate({
            rules: {
                member_email: {
                    required: true,
                    email: true
                },
                member_password: {
                    required: true
                }
            },
            errorElement: "span",
            errorClass: "help-inline-error",
        });

        $("#member_login_submit").click(function () {
            if (v.form()) {
                //$("#loader").show();
                //setTimeout(function () {
                $("#member_login_form").submit();
                // }, 1000);
                return false;
            }
        });
    });
</script>  
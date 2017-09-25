<!--<div id="main-wrapper">
     Page Preloader 
    <div id="preloader">
        <div id="status">
            <div class="status-mes"></div>
        </div>
    </div>

    <div class="uc-mobile-menu-pusher">

        <div class="content-wrapper">
            <nav class="navbar m-menu navbar-default navbar-fixed-top">
                <div class="container">
                     Brand and toggle get grouped for better mobile display 
                    <div class="navbar-header">
                        <button type="button" class="navbar-toggle collapsed" data-toggle="collapse"
                                data-target="#navbar-collapse-1">
                            <span class="sr-only">Toggle navigation</span>
                            <span class="icon-bar"></span>
                            <span class="icon-bar"></span>
                            <span class="icon-bar"></span>
                        </button>
                        <div style="float: left; height: 50px; padding: 15px 15px; font-size: 18px; line-height: 20px; background-color: transparent;"><a style="color: #fff;" class="navbar-brand" href="<?php echo base_url()?>"> <img style="width: 130px;" src="<?php echo base_url()?>assets/publyfe_logo.png"></a></div>
                    </div>


                     Collect the nav links, forms, and other content for toggling 
                    <div class="collapse navbar-collapse" id="#navbar-collapse-1">

                        <ul class="nav-cta hidden-xs">
                            <li class="dropdown"><a href="#" data-toggle="dropdown" class="dropdown-toggle"><i
                                        class="fa fa-search"></i></a>
                                <ul class="dropdown-menu">
                                    <li>
                                        <div class="head-search">
                                            <form role="form">
                                                 Input Group 
                                                <div class="input-group">
                                                    <input type="text" class="form-control" placeholder="Type Something">
                                                    <span class="input-group-btn">
                                                        <button type="submit" class="btn btn-primary">Search</button>
                                                    </span>
                                                </div>
                                            </form>
                                        </div>
                                    </li>
                                </ul>
                            </li>
                        </ul>

                        <div class="alert alert-info fade in forloginmessage" style="display:none; width: 600px;float: right;">
                            <a href="#" class="close" data-dismiss="alert">&times;</a>
                            <strong>Please Login First To Access This Page .</strong>
                        </div>


                        <ul class="nav navbar-nav navbar-right main-nav">
                            <li class="active"><a href="<?php echo base_url() ?>">Home</a></li>
                            <li><a href="<?php echo base_url() ?>affiliate">Affiliate</a></li>
                            <li><a href="<?php echo base_url() ?>network">Network</a></li>
                            <li><a href="<?php echo base_url() ?>whois">Whois</a></li>
                            <li><a href="<?php echo base_url()?>siteterms">Terms of Use</a></li>
                            <li><a href="<?php echo base_url()?>siteprivacy">Privacy</a></li>
                            <li><a href="<?php echo base_url()?>contactwithus">Contact Us</a></li>
                            <?php if(isset($_SESSION['member_id']) !=''){ ?>
                            <li><a href="<?php echo base_url() ?>memberprofile/<?php echo $_SESSION['member_id']; ?>">Profile</a></li>
                            <li><a href="<?php echo base_url() ?>userhome">User Home</a></li>
                            <?php } else { ?>
                            <li><a href="<?php echo base_url() ?>registrationform">Register</a></li>
                            <li><a href="<?php echo base_url() ?>loginform">Log In</a></li>
                            <?php } ?>
                        </ul>

                    </div>
                     .navbar-collapse 
                </div>
                 .container 
            </nav>-->
            <!-- .nav -->
            <div class="mobile-menu-wrap">
                <ul class="clearfix">
                    <li class="active"><a href="index.html">Home</a></li>
                    <li><a href="networks.html">Network</a></li>
                    <li><a href="affiliate.html">Affiliate</a></li>
                    <li><a href="whois.html">Whois</a></li>
                </ul>
                <div class="mobile-menu-btn">
                    <a href="#" class="btn btn-outline">Login</a>
                    <a href="#" class="btn">Join for Free</a>
                </div>
            </div>
            
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
                        <a href="#" class="btn btn-outline">Login</a>
                        <a href="#" class="btn">Join for Free</a>
                    </div>
                    <div class="top-social-icon">
                        <ul class="social-icon clearfix">
                            <li><a href="#"><i class="fa fa-facebook"></i></a></li>
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

            <script>
                $(document).ready(function () {
                    $("#whoisbtn a").click(function () {
                        alert('fouzia');
                        // var member_id = $.session.get('member_id');
                        var member_id = "<?php if(isset($_SESSION['member_id'])) { echo $_SESSION['member_id'];} ?>";
                       // alert(member_id);
                        if (member_id == '') {
                            alert('iffffffffff');
                            $('.forloginmessage').show();
                            setTimeout(function () {
                                $('.forloginmessage').hide();
                            }, 7000);
                            alert('dipaaaa');
                            window.location = 'http://localhost/publyfe';
                        } else {
                            var href = $("#whoisbtn a").attr('href');
                            alert(href);
                            window.location = 'http://localhost/publyfe/=' + href;
                        }
                    });
                });

                //$('#whoisbtn').click(function(){
                //   var member_id = $.session.get('member_id');
                //   alert(member_id);
                // });
            </script>


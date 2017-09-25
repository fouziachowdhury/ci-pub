<base href="<?php echo base_url() ?>">
<!DOCTYPE html>
<html lang="en">
    <!-- Mirrored from eliteadmin.themedesigner.in/demos/eliteadmin-material/index.html by HTTrack Website Copier/3.x [XR&CO'2014], Sat, 24 Sep 2016 09:15:49 GMT -->
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="description" content="">
        <meta name="author" content="">
        <link rel="icon" type="image/png" sizes="16x16" href="assets/admin/images/favicon.png">
        <title>Publyf - <?php echo $page_title; ?></title>
        <!-- Bootstrap Core CSS -->
        <link href="assets/admin/bootstrap/dist/css/bootstrap.min.css" rel="stylesheet" type="text/css"/>
        <!-- animation CSS -->
        <link href="assets/admin/css/animate.css" rel="stylesheet" type="text/css"/>

        <!-- Menu CSS -->
        <link href="assets/admin/bower_components/sidebar-nav/dist/sidebar-nav.min.css" rel="stylesheet" type="text/css"/>
        <link href="assets/admin/bower_components/datatables/jquery.dataTables.min.css" rel="stylesheet" type="text/css" />
        <!--<link href="../../../cdn.datatables.net/buttons/1.2.2/css/buttons.dataTables.min.css" rel="stylesheet" type="text/css" />-->
        <!-- Dropzone css -->

        <link rel="stylesheet" href="assets/admin/bower_components/dropify/dist/css/dropify.min.css">

        <link href="assets/admin/bower_components/summernote/dist/summernote.css" rel="stylesheet" />

        <link href="assets/admin/bower_components/dropzone-master/dist/dropzone.css" rel="stylesheet" type="text/css" />
        <!-- animation CSS -->

        <link href="assets/admin/bower_components/custom-select/custom-select.css" rel="stylesheet" type="text/css" />
        <link href="assets/admin/bower_components/switchery/dist/switchery.min.css" rel="stylesheet" />
        <link href="assets/admin/bower_components/bootstrap-select/bootstrap-select.min.css" rel="stylesheet" />
        <link href="assets/admin/bower_components/bootstrap-tagsinput/dist/bootstrap-tagsinput.css" rel="stylesheet" />
        <link href="assets/admin/bower_components/bootstrap-touchspin/dist/jquery.bootstrap-touchspin.min.css" rel="stylesheet" />
        <link href="assets/admin/bower_components/multiselect/css/multi-select.css"  rel="stylesheet" type="text/css" />

        <link href="assets/admin/css/animate.css" rel="stylesheet">
        <!-- Custom CSS -->
        <link href="assets/admin/css/style.css" rel="stylesheet">
        <!-- color CSS -->
        <link href="assets/admin/css/colors/default.css" id="theme"  rel="stylesheet">

        <!---------------------------BOOTSTREP RATING MASTER----------------------------->
        <link rel="stylesheet" href="<?php echo base_url() ?>assets/front/starrating/css/star-rating.min.css">
        <link rel="stylesheet" href="<?php echo base_url() ?>assets/front/starrating/themes/krajee-svg/theme.css" media="all" type="text/css"/>

        <!---------------------------LIGHT GALLERY MASTER----------------------------->
<!--        <link rel="stylesheet" href="<?php echo base_url() ?>assets/front/lightbox/dist/css/lightbox.min.css">-->

        <!--<link href="assets/admin/bower_components/clockpicker/dist/jquery-clockpicker.min.css" rel="stylesheet">
         Color picker plugins css 
        <link href="assets/admin/bower_components/jquery-asColorPicker-master/css/asColorPicker.css" rel="stylesheet">
         Date picker plugins css 
        <link href="assets/admin/bower_components/bootstrap-datepicker/bootstrap-datepicker.min.css" rel="stylesheet" type="text/css" />-->

        <!-----------------------------------------JQUERY UI----------------------------------->
        <link href="<?php echo base_url() ?>assets/front/jQueryautocomplete/jquery-ui.css" rel="stylesheet" type="text/css" />
        <!-----------------------------------------JQUERY UI----------------------------------->

        <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js" type="text/javascript"></script>
        <!-- Bootstrap Core JavaScript -->
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/js/bootstrap.min.js"></script>
        <script>
            (function (i, s, o, g, r, a, m) {
                i['GoogleAnalyticsObject'] = r;
                i[r] = i[r] || function () {
                    (i[r].q = i[r].q || []).push(arguments)
                }, i[r].l = 1 * new Date();
                a = s.createElement(o),
                        m = s.getElementsByTagName(o)[0];
                a.async = 1;
                a.src = g;
                m.parentNode.insertBefore(a, m)
            })(window, document, 'script', '../../../www.google-analytics.com/analytics.js', 'ga');

            ga('create', 'UA-19175540-9', 'auto');
            ga('send', 'pageview');

        </script>


        <style>
            /*html, body {
                    height: 100%;
                    margin: 0;
                    padding: 0;
            }*/
            #map {
                width: 100%;
                height: 300px;
            }
            .controls {
                margin-top: 10px;
                border: 1px solid transparent;
                border-radius: 2px 0 0 2px;
                box-sizing: border-box;
                -moz-box-sizing: border-box;
                height: 32px;
                outline: none;
                box-shadow: 0 2px 6px rgba(0, 0, 0, 0.3);
            }
            #searchInput {
                background-color: #fff;
                font-family: Roboto;
                font-size: 15px;
                font-weight: 300;
                margin-left: 12px;
                padding: 0 11px 0 13px;
                text-overflow: ellipsis;
                width: 50%;
            }
            #searchInput:focus {
                border-color: #4d90fe;
            }

        </style>
    </head>
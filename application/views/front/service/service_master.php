<?php echo $headerlink; ?>
<body>
    <div class="preloader">
        <svg class="circular" viewBox="25 25 50 50">
        <circle class="path" cx="50" cy="50" r="20" fill="none" stroke-width="2" stroke-miterlimit="10"/>
        </svg>
    </div>
    <div id="wrapper" style="background-color: #fff">
        <?php  echo $header; ?>
        <?php 
        if (isset($sidebar)) {
            echo $sidebar;
        }
        ?>
        
        <div id="page-wrapper">
            <div class="container-fluid">
                <!---------------------------------MAIN TEMPLATE START -------------------------->
                <div class="row bg-title" style="overflow: visible; margin-top:20px">
                    <div class="col-lg-6 col-md-7 col-sm-7 col-xs-12">
                    </div>
                    <div class="col-lg-3 col-md-4 col-sm-4 col-xs-12">
                        <!--<div id="myTable_filter" class="dataTables_filter"><label>Tags:<input class="" placeholder="" aria-controls="myTable" type="text" id="banTag"></label></div>-->
                    </div>
                    <div class="col-lg-3 col-md-4 col-sm-4 col-xs-12">
                        <!--<div class="dataTables_length" id="myTable_length" style="float: right;">
                            <form method="get" id="dropdownlandsearch" name="dropdownlandsearch">
                                <label>Show <select name="myTable_length" aria-controls="myTable" class="" id="bannerdrop">
                                        <option value="25">25</option>
                                        <option value="50">50</option>
                                        <option value="250">250</option>
                                        <option value="500">500</option>
                                    </select> entries</label>
                            </form>
                        </div>-->
                    </div>
                </div> 
                <!---------------------------------MAIN TEMPLATE END -------------------------->
                <?php echo $front_maincontent; ?>
                <?php echo $footer; ?>
            </div>
        </div>
        <?php echo $footerlink; ?>
</body>
</html>

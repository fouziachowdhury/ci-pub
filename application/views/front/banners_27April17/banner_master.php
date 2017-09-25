<?php echo $headerlink; ?>
<body>
    <div class="preloader">
        <svg class="circular" viewBox="25 25 50 50">
        <circle class="path" cx="50" cy="50" r="20" fill="none" stroke-width="2" stroke-miterlimit="10"/>
        </svg>
    </div>
    <div id="wrapper">
        <?php  echo $header; ?>
        <?php 
        if (isset($sidebar)) {
            echo $sidebar;
        }
        ?>
        
        <div id="page-wrapper">
            <div class="container-fluid">
                <!---------------------------------MAIN TEMPLATE START -------------------------->
                <div class="row bg-title" style="overflow: visible;">
                    <div class="col-lg-6 col-md-7 col-sm-7 col-xs-12">
                        <!--                        <h4 class="page-title"></h4>--> 
                        <ul class="list-unstyled list-inline" style="text-align: left;">
                            <li><h4>Filter By</h4></li>
                            <li>
                                <div class="dropdown">
                                    <button class="btn btn-success dropdown-toggle" type="button" data-toggle="dropdown">Category
                                        <span class="fa fa-sort-desc"></span></button>
                                    <ul class="dropdown-menu dropdown-design">
                                        <?php foreach ($allcategory as $cat) { ?>
                                            <li value="<?php echo $cat['cat_id']; ?>"><a onclick="searchbycategory(<?php echo $cat['cat_id']; ?>)"><?php echo $cat['cat_name']; ?></a></li>
                                        <?php } ?>
                                    </ul>
                                </div>
                            </li>
                            <li>
                                <div class="dropdown">
                                    <button class="btn btn-success dropdown-toggle" type="button" data-toggle="dropdown">Country
                                        <span class="fa fa-sort-desc"></span></button>
                                    <ul class="dropdown-menu dropdown-design" style="height: 350px;overflow: auto;">
                                        <?php foreach ($allcountry as $country) { ?>
                                            <li value="<?php echo $country['country_id']; ?>"><a onclick="searchbycountry(<?php echo $country['country_id']; ?>)"><?php echo $country['country_name']; ?></a></li>
                                        <?php } ?>
                                    </ul>
                                </div>
                            </li>
                             <li>
                                <div class="dropdown">
                                    <button class="btn btn-success dropdown-toggle" type="button" data-toggle="dropdown">Size
                                        <span class="fa fa-sort-desc"></span></button>
                                    <ul class="dropdown-menu dropdown-design" style="height: 350px;overflow: auto;">
                                        <?php foreach ($allsize as $size) { ?>
                                            <li value="<?php echo $size['width']; ?> - <?php echo $size['height']; ?>"><a onclick="searchbysize(<?php echo $size['width']; ?>,<?php echo $size['height']; ?>)"><?php echo $size['width']; ?> - <?php echo $size['height']; ?></a></li>
                                        <?php } ?>
                                    </ul>
                                </div>
                            </li>
                        </ul>
                    </div>
                    <div class="col-lg-3 col-md-4 col-sm-4 col-xs-12">
                        <div id="myTable_filter" class="dataTables_filter"><label>Tags:<input class="" placeholder="" aria-controls="myTable" type="text" id="banTag"></label></div>
                    </div>
                    <div class="col-lg-3 col-md-4 col-sm-4 col-xs-12">
                        <div class="dataTables_length" id="myTable_length" style="float: right;">
                            <form method="get" id="dropdownlandsearch" name="dropdownlandsearch">
                                <label>Show <select name="myTable_length" aria-controls="myTable" class="" id="bannerdrop">
                                        <option value="2">2</option>
                                        <option value="5">5</option>
                                        <option value="10">10</option>
                                        <option value="100">100</option>
                                    </select> entries</label>
                            </form>
                        </div>
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

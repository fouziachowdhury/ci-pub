<div class="row demosrs" id='showfbaddsdata'>
    <section id="contentrs">
        <div id="container" class="clearfix" style="padding: 5px; margin-bottom: 20px; border-radius: 5px; clear: both; -webkit-border-radius: 5px; -moz-border-radius: 5px; border-radius: 5px;">
            <div class="row">
                <?php
                //echo $api_query; exit;
                ?>
                <div class="row" style="background: #fff; border: 1px solid #ddd; margin: 0 auto; margin-bottom: 20px;">
                    <div id="all_time" style="display: block;">
                        <div class="col-md-12 col-sm-12 col-xs-12">
                            <div class="white-box">
                                <div class="jumbotron">
                                    <h2 class="blue" style="color:#2196F3;">Domain Info</h2>
                                    <ul class="list-unstyled">
                                        <li>Query : <?php if(isset($api_query)){ echo $api_query; } ?></li>
                                        <li>Domain Name : <?php if(isset($domain_name)){ echo $domain_name; } ?></li>
                                    </ul>
                                    <h4>Registrant Contact Info</h4>
                                    <ul class="list-unstyled">
                                        <li><strong>Name:</strong> <?php if(isset($registrant_contact_full_name)){ echo $registrant_contact_full_name; } ?></li>
                                        <li><strong>Company:</strong> <?php if(isset($registrant_contact_company_name)) { echo $registrant_contact_company_name; } ?></li>
                                        <li><strong>Address:</strong> <?php if(isset($registrant_contact_mailing_address)) { echo $registrant_contact_mailing_address; } ?></li>
                                        <li><strong>City :</strong> <?php if(isset($registrant_contact_city_name)) { echo $registrant_contact_city_name; } ?></li>
                                        <li><strong>State:</strong> <?php if(isset($registrant_contact_state_name)) { echo $registrant_contact_state_name; } ?></li>
                                        <li><strong>Zip Code:</strong> <?php if(isset($registrant_contact_zip_code)) { echo $registrant_contact_zip_code; } ?></li>
                                        <li><strong>Country Name:</strong> <?php if(isset($registrant_contact_country_name)) { echo $registrant_contact_country_name; } ?></li>
                                        <li><strong>Email Address:</strong> <?php if(isset($registrant_contact_email_address)) { echo $registrant_contact_email_address; } ?></li>
                                        <li><strong>Phone Number:</strong> <?php if(isset($registrant_contact_phone_number)) { echo $registrant_contact_phone_number; } ?></li>
                                    </ul>
                                    <h4>Administrative Contact Info</h4>
                                    <ul class="list-unstyled">
                                        <li><strong>Name:</strong> <?php if(isset($administrative_contact_full_name)){ echo $administrative_contact_full_name; } ?></li>
                                        <li><strong>Company:</strong> <?php if(isset($administrative_contact_company_name)) { echo $administrative_contact_company_name; } ?></li>
                                        <li><strong>Address:</strong> <?php if(isset($administrative_contact_mailing_address)) { echo $administrative_contact_mailing_address; } ?></li>
                                        <li><strong>City :</strong> <?php if(isset($administrative_contact_city_name)) { echo $administrative_contact_city_name; } ?></li>
                                        <li><strong>State:</strong> <?php if(isset($administrative_contact_state_name)) { echo $administrative_contact_state_name; } ?></li>
                                        <li><strong>Zip Code:</strong> <?php if(isset($administrative_contact_zip_code)) { echo $administrative_contact_zip_code; } ?></li>
                                        <li><strong>Country Name:</strong> <?php if(isset($administrative_contact_country_name)) { echo $administrative_contact_country_name; } ?></li>
                                        <li><strong>Email Address:</strong> <?php if(isset($administrative_contact_email_address)) { echo $administrative_contact_email_address; } ?></li>
                                        <li><strong>Phone Number:</strong> <?php if(isset($administrative_contact_phone_number)) { echo $administrative_contact_phone_number; } ?></li>
                                    </ul>
                                    <h4>Technical Contact Info</h4>
                                    <ul class="list-unstyled">
                                        <li><strong>Name:</strong> <?php if(isset($technical_contact_full_name)){ echo $technical_contact_full_name; } ?></li>
                                        <li><strong>Company:</strong> <?php if(isset($technical_contact_company_name)) { echo $technical_contact_company_name; } ?></li>
                                        <li><strong>Address:</strong> <?php if(isset($technical_contact_mailing_address)) { echo $technical_contact_mailing_address; } ?></li>
                                        <li><strong>City :</strong> <?php if(isset($technical_contact_city_name)) { echo $technical_contact_city_name; } ?></li>
                                        <li><strong>State:</strong> <?php if(isset($technical_contact_state_name)) { echo $technical_contact_state_name; } ?></li>
                                        <li><strong>Zip Code:</strong> <?php if(isset($technical_contact_zip_code)) { echo $technical_contact_zip_code; } ?></li>
                                        <li><strong>Country Name:</strong> <?php if(isset($technical_contact_country_name)) { echo $technical_contact_country_name; } ?></li>
                                        <li><strong>Email Address:</strong> <?php if(isset($technical_contact_email_address)) { echo $technical_contact_email_address; } ?></li>
                                        <li><strong>Phone Number:</strong> <?php if(isset($technical_contact_phone_number)) { echo $technical_contact_phone_number; } ?></li>
                                        
                                    </ul>
                                    <h4>Name Servers : </h4>
                                    
                                    <ul class="list-unstyled">
                                        <?php foreach($name_servers as $server){ ?>
                                        <li><?php if(isset($server)) { echo $server; } ?></li>
                                        <?php } ?>
                                    </ul>
                                    
                                    <h4>Domain Status :</h4>
                                    <ul class="list-unstyled">
                                        <?php foreach($domain_status as $status){ ?>
                                        <li><?php if(isset($status)) { echo $status; } ?></li>
                                        <?php } ?>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
<!--            <div>
                <h3 style="color:red">There is no data according your criteria !!!!</h3>
            </div>-->
<?php // }  ?>
        </div>
        <div class="clearfix"></div>
</div>
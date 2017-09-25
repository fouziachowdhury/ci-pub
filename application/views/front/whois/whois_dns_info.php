<div class="row">
    <div class="col-md-12">
        <?php if(isset($a_type)){?>
        <div class="white-box">
            <div class="row">
                <h3 style="color: #c30909;">DNS Record Lookup</h3>
                <div class="col-sm-12 col-xs-12">
                    <h4>Query - A Records</h4>
                    <?php foreach ($a_type as $a_typ){?>
                    <ul class="list-unstyled">
                        <li><strong>Name:</strong> <?php echo $a_typ->name;?></li>
                        <li><strong>TTL:</strong> <?php echo $a_typ->ttl;?></li>
                        <li><strong>Class:</strong> <?php echo $a_typ->class;?></li>
                        <li><strong>Data:</strong> <?php echo $a_typ->data;?></li>
                    </ul>
                    <?php }?>
                    <hr>
                </div>
                <div class="col-sm-12 col-xs-12">
                    <h4>Query - MX Records</h4>
                    <?php foreach ($MX_type as $type){?>
                        <ul class="list-unstyled">
                            <li><strong>Name:</strong> <?php echo $type->name;?></li>
                            <li><strong>TTL:</strong> <?php echo $type->ttl;?></li>
                            <li><strong>Class:</strong> <?php echo $type->class;?></li>
                            <li><strong>Data:</strong> <?php echo $type->data;?></li>
                        </ul>
                    <?php }?>
                    <hr>
                </div>
            </div>
        </div>
        <?php }else{?>
            <h3><?php if(isset($dns_message)){echo $dns_message;}?></h3>
        <?php }?>
        <?php if(isset($ip_whois_result)){?>
        <div class="white-box">
            <div class="row">
                <h3 style="color: #c30909;">Domain/IP Whois</h3>
                <ul class="list-unstyled">
                    <li><strong>Domain:</strong> <?php echo $ip_whois_result->query->domain; ?></li>
                    <li><strong>Created:</strong> <?php echo $ip_whois_result->response->registration->created; ?></li>
                    <li><strong>Expires:</strong> <?php echo $ip_whois_result->response->registration->expires; ?></li>
                    <li><strong>Updated:</strong> <?php echo $ip_whois_result->response->registration->updated; ?></li>
                    <li><strong>Registrar:</strong> <?php echo $ip_whois_result->response->registration->registrar; ?></li>
                </ul>
                <hr>
                <h4>Name Servers</h4>
                <ul class="list-unstyled">
                    <?php foreach ($ip_whois_result->response->name_servers as $name_servers) { ?>
                        <li><?php echo $name_servers; ?></li>
                    <?php } ?>
                </ul>
                <hr>
                <h4>Status</h4>
                <ul class="list-unstyled">
                    <?php foreach ($ip_whois_result->response->registration->statuses as $statuses) { ?>
                        <li><?php echo $statuses; ?></li>
                    <?php } ?>
                </ul>
                <hr>
            </div>
        </div>
        <?php }else{?>
            <h3><?php if(isset($IP_Whois_message)){echo $IP_Whois_message;}?></h3>
        <?php }?>
        
        <?php if(isset($ip_history_result)){?>
        <div class="white-box">
            <div class="row">
                <h3 style="color: #c30909;">IP History Of <?php echo $ip_history_result->query->domain; ?></h3>
                <ul class="list-unstyled">
                    <li><strong>Domain:</strong> <?php echo $ip_history_result->query->domain; ?></li>
                </ul>
                <hr>
                <h4>Records</h4>
                    <?php $i = 0; foreach ($ip_history_result->response->records as $records_data) { ?>
                        <ul class="list-unstyled">
                            <li><strong>IP:</strong> <?php echo $records_data->ip; ?></li>
                            <li><strong>Location:</strong> <?php echo $records_data->location; ?></li>
                            <li><strong>Owner:</strong> <?php echo $records_data->owner; ?></li>
                            <li><strong>Lastseen:</strong> <?php echo $records_data->lastseen; ?></li>
                        </ul>
                    <?php $i++;
                    if($i==5) break;
                    } ?>
            </div>
        </div>
        <?php }else{?>
            <h3><?php if(isset($IP_History_message)){echo $IP_History_message;}?></h3>
        <?php }?>
        
        <?php if(isset($ip_location_result)){?>
        <div class="white-box">
            <div class="row">
                <h3 style="color: #c30909;">IP Location</h3>
                <ul class="list-unstyled">
                    <li><strong>IP:</strong> <?php echo $ip_location_result->query->ip; ?></li>
                </ul>
                <hr>
                <h4>Records</h4>
                <ul class="list-unstyled">
                    <li><strong>City:</strong> <?php echo $ip_location_result->response->city; ?></li>
                    <li><strong>Zip code:</strong> <?php echo $ip_location_result->response->zipcode; ?></li>
                    <li><strong>Region Name:</strong> <?php echo $ip_location_result->response->region_name; ?></li>
                    <li><strong>Country:</strong> <?php echo $ip_location_result->response->country_name; ?></li>
                </ul>
            </div>
        </div>
        <?php }else{?>
            <h3><?php if(isset($IP_Location_message)){echo $IP_Location_message;}?></h3>
        <?php }?>
        
        <?php if(isset($reverse_dns_result)){?>
        <div class="white-box">
            <div class="row">
                <h3 style="color: #c30909;">Reverse DNS</h3>
                <ul class="list-unstyled">
                    <li><strong>IP:</strong> <?php echo $reverse_dns_result->query->ip; ?></li>
                </ul>
                <hr>
                <h4>Records</h4>
                <ul class="list-unstyled">
                    <li><strong>RDNS:</strong> <?php echo $reverse_dns_result->response->rdns; ?></li>
                </ul>
            </div>
        </div>
        <?php }else{?>
            <h3><?php if(isset($Reverse_DNS_message)){echo $Reverse_DNS_message;}?></h3>
        <?php }?>
        
        <?php if(isset($reverse_ip_result)){?>
        <div class="white-box">
            <div class="row">
                <h3 style="color: #c30909;">Reverse IP <?php // echo $reverse_ip_result->query->tool; ?></h3>
                <ul class="list-unstyled">
                    <li><strong>Host:</strong> <?php echo $reverse_ip_result->query->host; ?></li>
                </ul>
                <hr>
                <h4>Records</h4>
                    <?php $i = 0; foreach ($reverse_ip_result->response->domains as $domains_data) { ?>
                        <ul class="list-unstyled">
                            <li><strong>Name:</strong> <?php echo $domains_data->name; ?></li>
                            <li><strong>Last Resolved:</strong> <?php echo $domains_data->last_resolved; ?></li>
                        </ul>
                <hr>
                    <?php $i++;
                    if($i==5) break;
                    } ?>
            </div>
        </div>
        <?php }else{?>
            <h3><?php if(isset($Reverse_Ip_message)){echo $Reverse_Ip_message;}?></h3>
        <?php }?>
        
        <?php if(isset($reverse_mx_result)){?>
        <div class="white-box">
            <div class="row">
                <h3 style="color: #c30909;">Reverse MX <?php // echo $reverse_mx_result->query->tool; ?></h3>
                <ul class="list-unstyled">
                    <li><strong>Mail Server:</strong> <?php echo $reverse_mx_result->query->mailserver; ?></li>
                    <li><strong>Domain Count:</strong> <?php if(isset($reverse_mx_result->response->domain_count)){echo $reverse_mx_result->response->domain_count;} ?></li>
                </ul>
                <hr>
                <h4>Records</h4>
                    <?php $i = 0; if(isset($reverse_mx_result->response->domains)){
                        foreach ($reverse_mx_result->response->domains as $domain_data) { ?>
                        <ul class="list-unstyled">
                            <li><strong>Domain:</strong> <?php echo $domain_data; ?></li>
                        </ul>
                    <?php $i++;
                    if($i==20) break;
                    }} ?>
            </div>
        </div>
        <?php }else{?>
            <h3><?php if(isset($Reverse_MX_message)){echo $Reverse_MX_message;}?></h3>
        <?php }?>
        
        
        <?php if(isset($reverse_ns_result)){?>
        <div class="white-box">
            <div class="row">
                <h3 style="color: #c30909;">Reverse NS <?php // echo $reverse_ns_result->query->tool; ?></h3>
                <ul class="list-unstyled">
                    <li><strong>Name Server:</strong> <?php echo $reverse_ns_result->query->nameserver; ?></li>
                    <li><strong>Domain Count:</strong> <?php if(isset($reverse_ns_result->response->domain_count)){echo $reverse_ns_result->response->domain_count;} ?></li>
                </ul>
                <hr>
                <h4>Records</h4>
                    <?php $i = 0; if(isset($reverse_ns_result->response->domain_count)){
                        foreach ($reverse_ns_result->response->domains as $ns_domain) { ?>
                        <ul class="list-unstyled">
                            <li><strong>Domain:</strong> <?php echo $ns_domain->domain; ?></li>
                        </ul>
                    <?php $i++;
                    if($i==20) break;
                    } }?>
            </div>
        </div>
        <?php }else{?>
            <h3><?php if(isset($Reverse_NS_message)){echo $Reverse_NS_message;}?></h3>
        <?php }?>
        
        
        <?php if(isset($reverse_whois_result)){?>
        <div class="white-box">
            <div class="row">
                <h3 style="color: #c30909;">Reverse Whois <?php // echo $reverse_whois_result->query->tool; ?></h3>
                <ul class="list-unstyled">
                    <li><strong>Name:</strong> <?php echo $reverse_whois_result->query->query; ?></li>
                    <li><strong>Count:</strong> <?php echo $reverse_whois_result->response->result_count; ?></li>
                </ul>
                <hr>
                <h4>Records</h4>
                    <?php $i = 0; foreach ($reverse_whois_result->response->matches as $matches_data) { ?>
                        <ul class="list-unstyled">
                            <li><strong>Domain:</strong> <?php echo $matches_data->domain; ?></li>
                            <li><strong>Created Date:</strong> <?php echo $matches_data->created_date; ?></li>
                            <li><strong>Registrar:</strong> <?php echo $matches_data->registrar; ?></li>
                        </ul>
                <hr>
                    <?php $i++;
                    if($i==5) break;
                    } ?>
            </div>
        </div>
        <?php }else{?>
            <h3><?php if(isset($Reverse_Whois_message)){echo $Reverse_Whois_message;}?></h3>
        <?php }?>
    </div>
    <!--    <div class="col-sm-12 ol-md-12 col-xs-12">
            <div class="white-box">
                <h3 class="box-title">File Upload1</h3>
                <label for="input-file-now">Image</label>
                
            </div>
        </div>-->
    
    
    
    
</div>



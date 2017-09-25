<div class="row">
    <div class="col-md-12">
        <div class="white-box">
            <div class="row">
                <div class="col-sm-12 col-xs-12">
                    <h5 style="color: red;"><?php
                        if (validation_errors()) {
                            echo validation_errors();
                        }
                        ?>
                    </h5>
                     <?php if ($this->session->flashdata('success')) { ?>
                        <div class="alert alert-success alert-dismissable">
                            <i class="fa fa-check-square-o"></i>
                            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                        <?php echo $this->session->flashdata('success'); ?>
                        </div>
                       <?php } ?>

                       <?php if ($this->session->flashdata('error')) { ?>
                        <div class="alert alert-danger alert-dismissable">
                            <i class="fa fa-check-square-o"></i>
                            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                        <?php echo $this->session->flashdata('error'); ?>
                        </div>

                       <?php } ?>
                    <form action="WhoisAdmin/updatePlatinumWhois" method="post" enctype="multipart/form-data">
                        <div class="col-xs-12">
                            <div class="form-group col-xs-12">
                                <label for="exampleInputuname">Monthly Membership Price</label>
                                <input type="text" name="mothly_membership_price" class="form-control" value="<?php if ($whoisdata) {echo $whoisdata->mothly_membership_price;}?>">
                            </div>
                        </div>
                        
                        <div class="col-xs-12">
                            <div class="form-group col-sm-6">
                                <label for="exampleInputuname">DNS Record Lookup</label>
                                <input type="text" name="dns_record_lookup" id="dns_record" class="form-control" value="<?php if ($whoisdata) {echo $whoisdata->dns_record_lookup;} ?>">
                                <span id="dns_output" style="color: red"></span>
                            </div>
                            <div class="form-group col-sm-6">
                                <label for="exampleInputuname">Domain/IP Whois</label>
                                <input type="text" name="domain_iP_whois" id="domain_ip" class="form-control" value="<?php if ($whoisdata) {echo $whoisdata->domain_iP_whois;} ?>">
                                <span id="domain_output" style="color: red"></span>
                            </div>
                        </div>
                        
                        <div class="col-xs-12">
                            <div class="form-group col-sm-6">
                                <label for="exampleInputuname">IP History</label>
                                <input type="text" name="ip_history" id="ip_history" class="form-control" value="<?php if($whoisdata){echo $whoisdata->ip_history;} ?>">
                                <span id="ip_history_output" style="color: red"></span>
                            </div>
                            <div class="form-group col-sm-6">
                                <label for="exampleInputuname">IP Location Finder</label>
                                <input type="text" name="ip_location_finder" id="ip_location" class="form-control" value="<?php if($whoisdata){echo $whoisdata->ip_location_finder;} ?>">
                                <span id="ip_location_output" style="color: red"></span>
                            </div>
                        </div>
                        
                        <div class="col-xs-12">
                            <div class="form-group col-sm-6">
                                <label for="exampleInputuname">Reverse DNS Lookup</label>
                                <input type="text" name="reverse_dns_lookup" id="reverse_dns" class="form-control" value="<?php if($whoisdata){echo $whoisdata->reverse_dns_lookup;} ?>">
                                <span id="reverse_dns_output" style="color: red"></span>
                            </div>
                            <div class="form-group col-sm-6">
                                <label for="exampleInputuname">Reverse IP Lookup</label>
                                <input type="text" name="reverse_ip_lookup" id="reverse_ip" class="form-control" value="<?php if($whoisdata){echo $whoisdata->reverse_ip_lookup;} ?>">
                                <span id="reverse_ip_output" style="color: red"></span>
                            </div>
                        </div>
                        
                        <div class="col-xs-12">
                            <div class="form-group col-sm-6">
                                <label for="exampleInputuname">Reverse MX Lookup</label>
                                <input type="text" name="reverse_mx_lookup" id="reverse_mx" class="form-control" value="<?php if($whoisdata){echo $whoisdata->reverse_mx_lookup;} ?>">
                                <span id="reverse_mx_output" style="color: red"></span>
                            </div>
                            <div class="form-group col-sm-6">
                                <label for="exampleInputuname">Reverse NS Lookup</label>
                                <input type="text" name="reverse_ns_lookup" id="reverse_ns" class="form-control" value="<?php if($whoisdata){echo $whoisdata->reverse_ns_lookup;} ?>">
                                <span id="reverse_ns_output" style="color: red"></span>
                            </div>
                        </div>
                        
                        <div class="col-xs-12">
                            <div class="form-group col-sm-6">
                                <label for="exampleInputuname">Reverse Whois Lookup</label>
                                <input type="text" name="reverse_whois_lookup" id="reverse_whois" class="form-control" value="<?php if($whoisdata){echo $whoisdata->reverse_whois_lookup;} ?>">
                                <span id="reverse_whois_output" style="color: red"></span>
                            </div>
                            <div class="form-group col-sm-6">
                                <label for="exampleInputuname">URL/String Decode</label>
                                <input type="text" name="url_string_decode" id="url_string" class="form-control" value="<?php if($whoisdata){echo $whoisdata->url_string_decode;} ?>">
                                <span id="url_string_output" style="color: red"></span>
                            </div>
                        </div>
                        <button type="submit" id="myBtn" class="btn btn-success waves-effect waves-light m-r-10">Submit</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>



<script>
    
    $("#dns_record").keyup(function (event) {
        var input = $(this).val();
        if (!isNumber(input)) {
            $("#dns_output").html("Enter Numbers Only");
            $(":submit").attr("disabled", true);
            $(this).val(input.substring(0, input.length - 1));
        } else {
            $("#dns_output").html("");
//            print("");
            $(":submit").removeAttr("disabled");
        }
    });
    
    $("#domain_ip").keyup(function (event) {
        var input = $(this).val();
        if (!isNumber(input)) {
            $("#domain_output").html("Enter Numbers Only");
            $(":submit").attr("disabled", true);
            $(this).val(input.substring(0, input.length - 1));
        } else {
            $("#domain_output").html("");
            $(":submit").removeAttr("disabled");
        }
    });
    
    $("#ip_history").keyup(function (event) {
        var input = $(this).val();
        if (!isNumber(input)) {
            $("#ip_history_output").html("Enter Numbers Only");
            $(":submit").attr("disabled", true);
            $(this).val(input.substring(0, input.length - 1));
        } else {
            $("#ip_history_output").html("");
//            print("");
            $(":submit").removeAttr("disabled");
        }
    });
    
    $("#ip_location").keyup(function (event) {
        var input = $(this).val();
        if (!isNumber(input)) {
            $("#ip_location_output").html("Enter Numbers Only");
            $(":submit").attr("disabled", true);
            $(this).val(input.substring(0, input.length - 1));
        } else {
            $("#ip_location_output").html("");
            $(":submit").removeAttr("disabled");
        }
    });
    
    
    $("#reverse_dns").keyup(function (event) {
        var input = $(this).val();
        if (!isNumber(input)) {
            $("#reverse_dns_output").html("Enter Numbers Only");
            $(":submit").attr("disabled", true);
            $(this).val(input.substring(0, input.length - 1));
        } else {
            $("#reverse_dns_output").html("");
//            print("");
            $(":submit").removeAttr("disabled");
        }
    });
    
    $("#reverse_ip").keyup(function (event) {
        var input = $(this).val();
        if (!isNumber(input)) {
            $("#reverse_ip_output").html("Enter Numbers Only");
            $(":submit").attr("disabled", true);
            $(this).val(input.substring(0, input.length - 1));
        } else {
            $("#reverse_ip_output").html("");
            $(":submit").removeAttr("disabled");
        }
    });
    
    $("#reverse_mx").keyup(function (event) {
        var input = $(this).val();
        if (!isNumber(input)) {
            $("#reverse_mx_output").html("Enter Numbers Only");
            $(":submit").attr("disabled", true);
            $(this).val(input.substring(0, input.length - 1));
        } else {
            $("#reverse_mx_output").html("");
//            print("");
            $(":submit").removeAttr("disabled");
        }
    });
    
    $("#reverse_ns").keyup(function (event) {
        var input = $(this).val();
        if (!isNumber(input)) {
            $("#reverse_ns_output").html("Enter Numbers Only");
            $(":submit").attr("disabled", true);
            $(this).val(input.substring(0, input.length - 1));
        } else {
            $("#reverse_ns_output").html("");
            $(":submit").removeAttr("disabled");
        }
    });
    
    $("#reverse_whois").keyup(function (event) {
        var input = $(this).val();
        if (!isNumber(input)) {
            $("#reverse_whois_output").html("Enter Numbers Only");
            $(":submit").attr("disabled", true);
            $(this).val(input.substring(0, input.length - 1));
        } else {
            $("#reverse_whois_output").html("");
//            print("");
            $(":submit").removeAttr("disabled");
        }
    });
    
    $("#url_string").keyup(function (event) {
        var input = $(this).val();
        if (!isNumber(input)) {
            $("#url_string_output").html("Enter Numbers Only");
            $(":submit").attr("disabled", true);
            $(this).val(input.substring(0, input.length - 1));
        } else {
            $("#url_string_output").html("");
            $(":submit").removeAttr("disabled");
        }
    });
    
    function isNumber(n) {
        return (parseFloat(n) == n);
    }

    
</script>
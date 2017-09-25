
<div class="row">
    <div class="col-md-12 col-sm-12 col-xs-12">
<!--        <div class="white-box">
            <div class="row">
                <form class="form-horizontal">
                    <div class="form-group">
                        <label for="inputEmail3" class="col-sm-2 control-label">Search by type</label>
                        <div class="col-sm-6">
                            <select class="form-control select2" id="type" onchange="showDiv()">
                                <option value="1">All Time</option>
                                <option value="2">Year</option>
                                <option value="3">6 Months</option>
                                <option value="4">3 Months</option>
                                <option value="5">Month</option>
                            </select>
                        </div>
                    </div>

                </form>
            </div>
        </div>-->
    </div>
    
    <div id="all_time" style="display: block;">
        <div class="col-md-4 col-sm-12 col-xs-12">
            <div class="white-box">
                <h3>Total Registered User</h3>
                <table class="table">
                    <tr>
                        <td>Total User</td>
                        <td><?php echo $total_user?></td>
                    </tr>

                </table>
            </div>
        </div>
        <div class="col-md-4 col-sm-12 col-xs-12">
            <div class="white-box">
                <h3>Total Banner Ads</h3>
                <table class="table">
                    <tr>
                        <td>Total Banner Ads</td>
                        <td><?php echo $total_banner?></td>
                    </tr>

                </table>
            </div>
        </div>
        <div class="col-md-4 col-sm-12 col-xs-12">
            <div class="white-box">
                <h3>Total Facebook Ads</h3>
                <table class="table">
                    <tr>
                        <td>Total Facebook Ads</td>
                        <td><?php echo $total_facebook?></td>
                    </tr>
                </table>
            </div>
        </div>
<!--        <div class="col-md-4 col-sm-12 col-xs-12">
            <div class="white-box">
                <h3>Total Number of Cancel Reservation</h3>
                <table class="table">
                    <tr>
                        <td>Total Cancel Reservation</td>
                        <td></td>
                    </tr>

                </table>
            </div>
        </div> -->
    </div>
    
    
    
</div>
<!-- /.row -->


<!-- /.container-fluid -->

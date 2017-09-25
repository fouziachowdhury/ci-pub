<?php if ($this->uri->segment('2') != '') { ?>
    <div class="alert alert-danger" id="pagepermissionerror">
        <a href="<?php echo base_url() ?>userhome" class="close" data-dismiss="alert" aria-label="close">&times;</a>
        <strong>Sorry, you do not have permissions to view this page or your trial has expired. Please upgrade your package today to gain full access to this section.</strong>
    </div>
<?php } ?>

<div class="row">
    <div id="all_time" style="display: block;">
        <!--<div class="col-md-12 col-sm-12 col-xs-12">
            <div class="white-box">
                <div class="jumbotron">
                    <h1 class="blue" style="color:#2196F3;">Welcome To PUBLYFE........ </h1>
                </div>
            </div>
        </div>-->
        <div class="row">
            <div class="col-md-6">
                 <div>
                <div class="panel panel-default"  <div style="border:1px solid #ddd">
                    <div class="panel-heading"> 
                        <div class="row">
                            <div class="col-md-4 col-sm-4 col-xs-4"><b>News</b></div>
                            <div class="col-md-6 col-sm-6 col-xs-6"></div>
                            <div class="col-md-2 col-sm-2 col-xs-2"><b>Date</b></div>
                        </div>
                    </div>
                    <div class="panel-body">
                        <table class="table table-striped" style="border: 1px solid #ddd;">
                            <tbody>
                                <?php foreach ($newsinfo as $news) { ?>
                                    <tr>
                                        <td style="font-size: 11px; padding: 15px;">
                                        <?php
                                       $string = strip_tags($news['news']); 

                                        if (strlen($string) > 100) {
                                            $stringCut = substr($string, 0, 142); 
                                            $string = substr($stringCut, 0, strrpos($stringCut, ' ')).'...'; 
                                        }
                                        echo $string;
                                        ?>
                                       </td>
                                        <td style="font-size: 11px; padding: 15px;"><?php echo date("m/d/Y", strtotime($news['date'])); ?></td>
                                    </tr>
<?php } ?>

                            </tbody>
                        </table>
                    </div>
                    <div class="panel-footer"> </div>
                </div>
                </div>
            </div>
                
                <div class="col-md-6">
                 <div>
                <div class="panel panel-default"  <div style="border:1px solid #ddd">
                    <div class="panel-heading"><b>Message From Our Sponsors</b></div>
                    <div class="panel-body">
                        <table class="table table-striped" style="border: 1px solid #ddd;">
                            <tbody>
                                <?php foreach ($sponsorinfo as $sponsormsg) { ?>
                                    <tr>
                                        <td style="font-size: 11px; padding: 15px;  width: 380px;">
                                        <?php
                                       $string = strip_tags($sponsormsg['sponsor_txt']); 

                                        if (strlen($string) > 100) {
                                            $stringCut = substr($string, 0, 142); 
                                            $string = substr($stringCut, 0, strrpos($stringCut, ' ')).'...'; 
                                        }
                                        echo $string;
                                        ?>
                                       </td>
                                        <td style="text-align: right;"><img style="width: 100px;" src="<?php echo base_url()?>uploads/sponsor_icon/<?php echo $sponsormsg['sponsor_image']; ?>" ></td>
                                    </tr>
<?php } ?>

                            </tbody>
                        </table>
                    </div>
                    <div class="panel-footer"> </div>
                </div>
                </div>
            </div>
        </div>
    </div>
    <!-- /.row -->


    <!-- /.container-fluid -->

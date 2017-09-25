<!-------------MODAL------------>
<!--<div class="modal fade" tabindex="-1" role="dialog" id="commentmodal">-->
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-body">
                <form action="<?php echo base_url() ?>addLandingComments" method="post" class="form-horizontal" id="commentForm" role="form"> 
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    <div class="form-group">
                        <label for="email" class="control-label" style="margin-left: 14px;font-size: 18px; font-weight: bold;">COMMENT</label>
                        <div class="col-sm-12">
                            <textarea class="form-control" name="comment" id="addComment" rows="5"></textarea>
                        </div>
                    </div>
                    <input type="hidden" id="com_option_id" name="option_id" value="">
                    <input type="hidden" id="com_adds_id" name="adds_id" value="">
                    <div class="form-group">
                        <div class="col-sm-10">                    
                            <button class="btn btn-success text-uppercase" type="submit" id="submitComment"><i class="fa fa-paper-plane" aria-hidden="true"></i> POST</button>
                        </div>
                    </div>            
                </form>
                <div class="media-body">
                    <?php foreach ($all_com_info as $comm) {  ?>
                    <?php $myDateTime = DateTime::createFromFormat('Y-m-d', $comm['date']);
                        $formattedweddingdate = $myDateTime->format('m-d-Y');
                      ?>
                    <div class="well well-lg">
                        <span class="media-heading text-uppercase reviews" style="color: #000;font-weight: bold;"><?php echo $comm['name'];   ?></span><span style="float: right;"><?php echo $formattedweddingdate;   ?></span>
                        <p class="media-comment">
                            <?php echo $comm['comment']; ?>
                        </p>
                         <a href="<?php echo base_url()?>deleteComment/landingpage/<?php echo $comm['comment_id'];?>"><button type="button" class="close"><span aria-hidden="true">&times;</span></button></a><br><br>
                    </div>    
                    <?php }  ?>
                </div>
            </div>
        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
<!--</div>-->
<table id="" class="table table-bordered table-striped">
    <thead>

        <tr>
            <th style="text-align: center;">Sl No.</th>
            <th style="text-align: center;">Embedded Code</th>
            <th style="text-align: center;">Embedded Code</th>
        </tr>
    </thead>
    <tbody>
        <input type="hidden" id="cat_id" value="<?php echo $this->session->userdata('cat_id'); ?>">
        <input type="hidden" id="country_id" value="<?php echo $this->session->userdata('country_id'); ?>">
        <?php
        
        $i = 1;if($all_info){
        foreach (array_chunk($all_info, 2) as $row) {
            ?>
            <tr>
                <td><?php echo $i; ?></td>
                <?php foreach ($row as $value) { ?>
                    <td colspan="1">
                        <form  action="admin/activateEcommercePreview" method="post" enctype="multipart/form-data">
                            <table>
                                <tr>
                                
                                    <td><?php //echo $value['fb_ecom_id']; ?>
                                        <?php if ($value['facebook_image']) { ?>
                                            <img src="uploads/facebook_images/<?php echo $value['facebook_image']; ?>" style="width: 500px;">
                                        <?php } else { ?>
                                            <?php echo $value['embedded_code']; ?>
                                        <?php } ?>
                                        <input type="hidden" name="fb_ecom_id" value="<?php echo $value['fb_ecom_id']; ?>">
                                        <input type="file" name="image">
                                        <input type="hidden" name="facebook_image" value="<?php echo $value['facebook_image']; ?>">
                                        
                                        <button type="submit" class="btn btn-success">Activate Preview</button>
                                        <a data-toggle="modal" data-target="#editLink<?php echo $value['fb_ecom_id']; ?>" style="cursor: pointer;">
                                            <button class="btn btn-info">Edit</button>
                                        </a>
                                        <a href="admin/deleteFbEcomImage/<?php echo $value['fb_ecom_id']; ?>">
                                            <button type="button" class="btn btn-danger">Delete</button>
                                        </a>
                                        
                                    </td>
                                </tr>
                            </table>
                        </form>

                        <div id="editLink<?php echo $value['fb_ecom_id']; ?>" class="modal fade" role="dialog">
                            <div class="modal-dialog">
                                Modal content
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <button type="button" class="close"
                                                data-dismiss="modal">&times;</button>
                                        <h4 class="modal-title" style="text-align: center">Edit Facebook Ads</h4>
                                    </div>
                                    <form action="admin/updateEcommereceFacebook" method="post" enctype="multipart/form-data">
                                        <input type="hidden" name="fb_ecom_id" class="form-control" value="<?php echo $value['fb_ecom_id']; ?>">
                                        <div class="modal-body">
                                            <div class="row">
                                                <div class="form-group">
                                                    <label for="exampleInputuname">Categories(For Bulk)</label>
                                                    <select class="select2 m-b-10 select2-multiple" multiple="multiple" name="bulk_cat[]">
                                                        <option value="0">Choose Categories</option>
                                                        <?php foreach ($all_category as $cat) { ?>
                                                            <option value="<?php echo $cat['cat_id'] ?>" 
                                                            <?php
                                                            $category_id = explode(',', $value['cat_id']);
                                                            foreach ($category_id as $category) {
                                                                if ($cat['cat_id'] == $category) {
                                                                    echo 'selected';
                                                                }
                                                            }
                                                            ?>>
                                                                        <?php echo $cat['cat_name'] ?>
                                                            </option>
                                                        <?php } ?>
                                                    </select>
                                                </div>

                                                <div class="form-group">
                                                    <label for="exampleInputuname">Countries(For Bulk)</label>
                                                    <select class="select2 m-b-10 select2-multiple" multiple="multiple" name="bulk_country[]">
                                                        <option value="0">Choose Countries</option>
                                                        <?php foreach ($all_country as $country) { ?>
                                                            <option value="<?php echo $country['country_id'] ?>"
                                                            <?php
                                                            $country_id = explode(',', $value['country_id']);
//                                                            print_r($country_id);
                                                            foreach ($country_id as $cntry) {
                                                                if ($country['country_id'] == $cntry) {
                                                                    echo 'selected';
                                                                }
                                                            }
                                                            ?>>
                                                            <?php echo $country['country_name'] ?>
                                                            </option>
                                                        <?php } ?>
                                                    </select>
                                                </div>

                                                <div class="form-group">
                                                    <label for="exampleInputuname">Keywords(For Bulk)</label>
                                                    <input type="text" name="bulk_keyword[]" class="keyword" id="keyword_bulk<?php echo $value['fb_ecom_id']; ?>" multiple class="" 
                                                           value="<?php
                                                           $keyword = explode(',', $value['keyword']);
                                                           foreach ($all_keyword as $all_key) {
                                                               foreach ($keyword as $key) {
                                                                   if ($all_key['id'] == $key) {
                                                                       echo $all_key['keyword_tags'] . ',';
                                                                   }
                                                               }
                                                           }
                                                           ?>">
                                                </div>

                                                <div class="form-group">
                                                    <label for="exampleInputuname">Embedded Code<span style="color:red">*</span></label>
                                                    <textarea class="form-control" name="embedded_code" style="resize: none"><?php echo $value['embedded_code']; ?></textarea>
                                                </div>

                                                <div class="form-group">
                                                    <label for="exampleInputuname">Landing page URL</label>
                                                    <input type="text" name="landing_page_url" class="form-control" value="<?php echo $value['landing_page_url']; ?>" placeholder="Landing page URL">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
                                            <button type="submit" id="sub_button" class="btn btn-success">Update</button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>

                    </td>

                <?php } ?>
            </tr>
            <?php $i++;
        }}
        ?>
    </tbody>
</table>

<div id="pagination" style="float: right">
    <ul class="tsc_pagination">

        <!-- Show pagination links -->
        <?php
        foreach ($links as $link) {
            echo "<li>" . $link . "</li>";
        }
        ?>
    </ul>
</div>
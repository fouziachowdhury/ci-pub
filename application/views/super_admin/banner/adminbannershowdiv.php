<form action="admin/editMultipleBanner" method="post">
    <ul class="list-inline list-unstyled">
        <li>
            <a style="display: none;margin: 5px 0px;" id="statusButton">
                <button type="submit" name="status" class="btn btn-success">Status</button>
            </a> 
        </li>

        <li>
            <a style="display: none;margin: 5px 0px;" id="editButton" data-toggle="modal" data-target="#editLink">
                <button type="button" name="edit" class="btn btn-info">Edit</button>
                <!--<button type="submit" name="edit" class="btn btn-info">Edit</button>-->
            </a>
        </li>

        <li>
            <a style="display: none;margin: 5px 0px;" id="deleteButton" onclick="return chkDelete()">
                <button type="submit" name="delete" class="btn btn-danger">Delete</button>
            </a> 
        </li>
    </ul>


    <table id="myTable" class="table table-striped">
        <thead>
            <!--<p style="text-align: right;color: red;">Search By Name, Email, Fee Paid</p>-->
            <tr>
                <th style="text-align: center;" class="check">
                    <input type="checkbox" id="flowcheckall" value="" />&nbsp;
                </th>
                <th style="text-align: center;">Image</th>
                <th style="text-align: center;">Size</th>
                <th style="text-align: center;">Category</th>
                <th style="text-align: center;">Country</th>
                <th style="text-align: center;">Keyword</th>
                <th style="text-align: center;">Date</th>
                <th style="text-align: center;">Status</th>
                <th style="text-align: center;">Action</th>
            </tr>
        </thead>
        <tbody>
            <?php if (!empty($all_info)) {
                foreach ($all_info as $row) { ?>

                    <tr style="text-align: center;">
                        <td>
                            <input class="check_id" name="banner_id[]" type="checkbox" value="<?php echo $row['banner_id']; ?>" onclick="showButton()">
                        </td>
                        <td>
                            <a class="example-image-link" href="uploads/banner_images/<?php echo $row['image'] ?>" data-lightbox="example-1">
                                <img class="example-image" src="uploads/banner_images/<?php echo $row['image'] ?>" alt="Banner Image" style="width: 100px;height: 50px;"/>
                            </a>
                        </td>
                        <td><?php echo $row['width']; ?> * <?php echo $row['height'] ?></td>
                        <td>
                            <?php
                            $category = explode(',', $row['cat_id']);
//                                    print_r($category);
                            foreach ($category as $cat) {
                                foreach ($all_category as $all_cat) {
                                    if ($all_cat['cat_id'] == $cat) {
                                        echo $all_cat['cat_name'] . '<br>';
                                    }
                                }
                            }
                            ?>
                        </td>
                        <td>
                            <?php
                            $country = explode(',', $row['country_id']);
//                                    print_r($category);
                            foreach ($country as $cnt) {
                                foreach ($all_country as $country) {
                                    if ($country['country_id'] == $cnt) {
                                        echo $country['country_name'] . '<br>';
                                    }
                                }
                            }
                            ?>
                        </td>
                        <td>
                            <?php
                            $keyword = explode(',', $row['keyword']);
//                                    print_r($category);
                            foreach ($keyword as $key) {
                                foreach ($all_keyword as $all_key) {
                                    if ($all_key['id'] == $key) {
                                        echo $all_key['keyword_tags'] . '<br>';
                                    }
                                }
                            }
                            ?>
                        </td>
                        <td>
                            <?php $timestamp = strtotime($row['date']);
                                echo date('m-d-y', $timestamp);?>
                        </td>
                        <td>
        <?php if ($row['status'] == 1) { ?>
                                <a onclick="changeBannerStatus('<?php echo $row['banner_id']; ?>')">
                                    <label class="label label-success" id="active<?php echo $row['banner_id']; ?>" style="line-height: 2;cursor: pointer;">Active</label>
                                </a>
                            <?php } ?>
        <?php if ($row['status'] == 0) { ?>
                                <a onclick="changeBannerStatus('<?php echo $row['banner_id']; ?>')" style="">
                                    <label class="label label-danger" id="inactive<?php echo $row['banner_id']; ?>" style="line-height: 2;cursor: pointer;">Inactive</label>
                                </a>
        <?php } ?>
                        </td>
                        <td>
        <!--                                <a onclick="changeBannerStatus('<?php echo $row['banner_id']; ?>')">
                                <span data-toggle="tooltip" data-placement="top" title="Change Status" class="glyphicon glyphicon-refresh"></span>
                            </a>&nbsp;-->
                            <a href="admin/editBanner/<?php echo $row['banner_id']; ?>">
                                <span data-toggle="tooltip" data-placement="top" title="Edit Banner" class="glyphicon glyphicon-edit"></span>
                            </a>&nbsp;<!--
                            <a href="admin/delete_user/" onclick="return chkDelete()">
                                <span data-toggle="tooltip" data-placement="top" title="Remove" class="glyphicon glyphicon-remove"></span>
                            </a>-->
                        </td>

                <div id="editLink" class="modal fade" role="dialog">
                    <div class="modal-dialog">
                        Modal content

                        <div class="modal-content">
                            <div class="modal-header">
                                <button type="button" class="close"
                                        data-dismiss="modal">&times;</button>
                                <h4 class="modal-title" style="text-align: center">Edit</h4>
                            </div>
                            <!--<form action="admin/updateBanner" class="form-horizontal" method="post" enctype="multipart/form-data">-->
                            <div class="modal-body">
                                <div class="row">
                                    <div class="form-group">
                                        <label for="exampleInputuname">Categories(For Bulk)</label>
                                        <select class="select2 m-b-10 select2-multiple" multiple="multiple" name="bulk_cat[]">
                                            <option value="0">Choose Categories</option>
                                            <?php foreach ($all_category as $cat) { ?>
                                                <option value="<?php echo $cat['cat_id'] ?>"><?php echo $cat['cat_name'] ?></option>
        <?php } ?>
                                        </select>
                                    </div>

                                    <div class="form-group">
                                        <label for="exampleInputuname">Countries(For Bulk)</label>
                                        <select class="select2 m-b-10 select2-multiple" multiple="multiple" name="bulk_country[]">
                                            <option value="0">Choose Countries</option>
                                            <?php foreach ($all_country as $country) { ?>
                                                <option value="<?php echo $country['country_id'] ?>"><?php echo $country['country_name'] ?></option>
        <?php } ?>
                                        </select>
                                    </div>

                                    <div class="form-group">
                                        <label for="exampleInputuname">Keywords(For Bulk)</label>
                                        <input type="text" name="bulk_keyword[]" id="choose_usr_email" multiple class="" value="<?php echo set_value('membership_price'); ?>">
                                    </div>
                                </div>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-danger btn-rounded"
                                        data-dismiss="modal">Close
                                </button>
                                <button type="submit" name="edit" id="sub_button" class="btn btn-success btn-rounded">Submit
                                </button>
                            </div>
                            <!--                                        </form>-->
                        </div>
                    </div>
                </div>

                </tr>
            <?php }
        } else {
            ?>

            <div>
                <h3 style="color:red">There is no data according your criteria !!!!</h3>
            </div>
<?php } ?>

        </tbody>
    </table>
</form>
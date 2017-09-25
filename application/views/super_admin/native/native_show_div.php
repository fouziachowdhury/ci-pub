<form action="admin/editMultipleNative" method="post">
    <ul class="list-inline list-unstyled">
        <li>
            <a style="display: none;margin: 5px 0px;" id="statusButton">
                <button type="submit" name="status" class="btn btn-success">Status</button>
            </a> 
        </li>
        <li>
            <!--<a style="display: none;margin: 5px 0px;" id="editButton">-->
            <a style="display: none;margin: 5px 0px;" id="editButton" data-toggle="modal" data-target="#editLink">
                <button type="button" name="edit" class="btn btn-info">Edit</button>
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
                <th style="text-align: center;width: 5%" class="check">
                    <input type="checkbox" id="flowcheckall" value="" />
                </th>
                <th style="text-align: center;width: 10%">Image</th>
                <th style="text-align: center;width: 10%">Size</th>
                <th style="text-align: center;width: 12%">Headline</th>
                <th style="text-align: center;width: 13%">Category</th>
                <th style="text-align: center;width: 10%">Country</th>
                <th style="text-align: center;width: 10%">Keyword</th>
                <th style="text-align: center;width: 10%">Date</th>
                <th style="text-align: center;width: 10%">Status</th>
                <th style="text-align: center;width: 10%">Action</th>
            </tr>
        </thead>
        <tbody>
            <?php if (!empty($all_info)) {
                foreach ($all_info as $row) { ?>

                    <tr style="text-align: center;">
                        <td>
                            <input class="check_id" name="native_id[]" type="checkbox" value="<?php echo $row['native_id']; ?>" onclick="showButton()">
                        </td>
                        <td>
                            <a class="example-image-link" href="uploads/native_images/<?php echo $row['image'] ?>" data-lightbox="example-1">
                                <img src="uploads/native_images/<?php echo $row['image'] ?>" alt="Banner Image" style="width: 100px;height: 50px;">
                            </a>
                        </td>
                        <td><?php echo $row['width']; ?> * <?php echo $row['height'] ?></td>
                        <td>
                            <?php foreach ($all_headline as $headline){
                                if($headline['headline_id'] == $row['headline']){
                                    echo $headline['headline'];
                                }
                            }?>
                        </td>
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
                                <a onclick="changeNativeStatus('<?php echo $row['native_id']; ?>')">
                                    <label class="label label-success" id="active<?php echo $row['native_id']; ?>" style="line-height: 2;cursor: pointer;">Active</label>
                                </a>
                            <?php } ?>
                            <?php if ($row['status'] == 0) { ?>
                                <a onclick="changeNativeStatus('<?php echo $row['native_id']; ?>')">
                                    <label class="label label-danger" id="inactive<?php echo $row['native_id']; ?>" style="line-height: 2;cursor: pointer;">Inactive</label>
                                </a>
                            <?php } ?>
                        </td>
                        <td>
        <!--                                <a onclick="changeNativeStatus('<?php echo $row['native_id']; ?>')">
                                <span data-toggle="tooltip" data-placement="top" title="Change Status" class="glyphicon glyphicon-refresh"></span>
                            </a>&nbsp;-->
                            <a href="admin/editNative/<?php echo $row['native_id']; ?>">
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
                                        <select class="select2 m-b-10" multiple="multiple" name="bulk_cat[]" id="bulk_category" onchange="bulkCategory()">
                                            <option value="0">Choose Category</option>
                                            <?php foreach ($all_category as $cat) { ?>
                                                <option value="<?php echo $cat['cat_id']; ?>"><?php echo $cat['cat_name']; ?></option>
                                            <?php } ?>
                                        </select>
                                    </div>

                                    <div class="form-group">
                                        <label for="exampleInputuname">Countries(For Bulk)</label>
                                        <select class="select2 m-b-10" multiple="multiple" name="bulk_country[]" id="bulk_country" onchange="bulkCountry()">
                                            <option value="0">Choose Countries</option>
                                            <?php foreach ($all_country as $country) { ?>
                                                <option value="<?php echo $country['country_id'] ?>"><?php echo $country['country_name'] ?></option>
                                            <?php } ?>
                                        </select>
                                    </div>

                                    <div class="form-group" id="">
                                        <label for="exampleInputuname">Headline(For Bulk)</label>
                                        <select class="select2 m-b-10" multiple="multiple" id="headline" name="bulk_headline[]">

                                        </select>
                                    </div>

                                    <div class="form-group">
                                        <label for="exampleInputuname">Keywords(For Bulk)</label>
                                        <input type="text" name="bulk_keyword[]" id="bulk_keyword" multiple class="" value="<?php echo set_value('membership_price'); ?>">
                                    </div>
                                </div>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-danger btn-rounded" data-dismiss="modal">Close</button>
                                <button type="submit" name="edit" id="sub_button" class="btn btn-success btn-rounded">Submit</button>
                            </div>
                            <!--                                        </form>-->
                        </div>
                    </div>
                </div>


                </tr>
            <?php }
            } else {?>

            <div>
                <h3 style="color:red">There is no data according your criteria !!!!</h3>
            </div>
        <?php } ?>

        </tbody>
    </table>
</form>
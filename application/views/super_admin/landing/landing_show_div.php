<form action="landingPageAdmin/editMultipleLanding" method="post">
    <ul class="list-inline list-unstyled">
        <!--        <li>
                    <a style="display: none;margin: 5px 0px;" id="statusButton">
                        <button type="submit" name="status" class="btn btn-success">Status</button>
                    </a> 
                </li>-->

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
                <th style="text-align: center;width: 10%;" class="check">
                    <input type="checkbox" id="flowcheckall" value="" />&nbsp;
                </th>
                <th style="text-align: center;width: 20%;">Show Preview</th>
                <th style="text-align: center;width: 25%;">Url</th>
                <th style="text-align: center;width: 15%;">Category</th>
                <th style="text-align: center;width: 15%;">Country</th>
                <th style="text-align: center;width: 15%;">Action</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($all_info as $landing) { //echo '<pre>'; print_r($landing);?>
                <tr style="text-align: center;">
                    <td>
                        <input class="check_id" name="landing_id[]" type="checkbox" value="<?php echo $landing['landing_id']; ?>" onclick="showButton()">
                    </td>
                    <td>
                        <a class="example-image-link" href="<?php echo $landing['zip_file_name']; ?>" data-lightbox="example-1">
                            <img src="<?php echo $landing['zip_file_name']; ?>" alt="Landing Image" style="width: 100px;">
                        </a>
                    </td>
                    <td><a href="<?php echo $landing['url']; ?>" target="_blank">
                            <?php
                            if (strlen($landing['url']) > 50) {
                                echo substr($landing['url'], 0, 50);
                            } else {
                                echo $landing['url'];
                            }
                            ?></a>
                    </td>
                    <td>
                        <?php
                        $category = explode(',', $landing['cat_id']);
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
                        $country = explode(',', $landing['country_id']);
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
                        <a href="<?php echo $landing['zip_file_name']; ?>" download>
                            <span data-toggle="tooltip" data-placement="top" title="Remove" class="glyphicon glyphicon-download-alt"></span>
                        </a>&nbsp;
                        <a href="landingPageAdmin/editLanding/<?php echo $landing['landing_id']; ?>">
                            <span data-toggle="tooltip" data-placement="top" title="Edit Banner" class="glyphicon glyphicon-edit"></span>
                        </a>&nbsp;
                        <a href="landingPageAdmin/delete_landing/<?php echo $landing['landing_id']; ?>" onclick="return chkDelete()">
                            <span data-toggle="tooltip" data-placement="top" title="Remove" class="glyphicon glyphicon-remove"></span>
                        </a>
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
                                            <label for="exampleInputuname">Categories</label>
                                            <select class="select2 m-b-10 select2-multiple" multiple="multiple" name="bulk_cat[]">
                                                <option value="0">Choose Categories</option>
                                                <?php foreach ($all_category as $cat) { ?>
                                                    <option value="<?php echo $cat['cat_id'] ?>"><?php echo $cat['cat_name'] ?></option>
                                                <?php } ?>
                                            </select>
                                        </div>

                                        <div class="form-group">
                                            <label for="exampleInputuname">Countries</label>
                                            <select class="select2 m-b-10 select2-multiple" multiple="multiple" name="bulk_country[]">
                                                <option value="0">Choose Countries</option>
                                                <?php foreach ($all_country as $country) { ?>
                                                    <option value="<?php echo $country['country_id'] ?>"><?php echo $country['country_name'] ?></option>
                                                <?php } ?>
                                            </select>
                                        </div>

                                        <div class="form-group">
                                            <label for="exampleInputuname">Keywords</label>
                                            <input type="text" name="bulk_keyword[]" id="keyword" multiple class="" value="">
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
            <?php } ?>
        </tbody>
    </table>
</form>
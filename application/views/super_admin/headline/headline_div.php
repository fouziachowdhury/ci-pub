<form action="admin/deleteMultipleHeadline" method="post">
    <ul class="list-inline list-unstyled">
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
            <th style="text-align: center;">Headline</th>
            <!--<th style="text-align: center;">Type</th>-->
            <th style="text-align: center;">Category</th>
            <th style="text-align: center;">Country</th>
            <th style="text-align: center;">Status</th>
            <th style="text-align: center;">Action</th>
        </tr>
    </thead>
    <tbody>
        <?php $i = 1;
        foreach ($all_headline as $row) { ?>
            <tr style="text-align: center;">
                <td>
                    <input class="check_id" name="headline_id[]" type="checkbox" value="<?php echo $row['headline_id']; ?>" onclick="showButton()">
                </td>
                <td><?php echo $row['headline']; ?></td>
                <td>
                    <?php
                    foreach ($all_category as $all_cat) {
                        if ($all_cat['cat_id'] == $row['cat_id']) {
                            echo $all_cat['cat_name'];
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
    <!--                                <td>
                    <?php if ($row['type'] == 1) {
                        echo 'Category';
                    } else {
                        echo 'Country';
                    } ?>
                </td>-->
                <td>
    <?php if ($row['status'] == 1) { ?>
                        <a onclick="changeHeadlineStatus('<?php echo $row['headline_id']; ?>')">
                            <label class="label label-success" id="active<?php echo $row['headline_id']; ?>" style="line-height: 2;cursor: pointer;">Active</label>
                        </a>
    <?php } ?>
    <?php if ($row['status'] == 0) { ?>
                        <a onclick="changeHeadlineStatus('<?php echo $row['headline_id']; ?>')" style="">
                            <label class="label label-danger" id="inactive<?php echo $row['headline_id']; ?>" style="line-height: 2;cursor: pointer;">Inactive</label>
                        </a>
    <?php } ?>
                </td>
                <td>
                    <!--<a href="admin/changeHeadlineStatus/<?php echo $row['headline_id']; ?>">-->
                    <!--    <span data-toggle="tooltip" data-placement="top" title="Change Status" class="glyphicon glyphicon-refresh"></span>-->
                    <!--</a>&nbsp;-->
                    <a data-toggle="modal" data-target="#editLink<?php echo $row['headline_id']; ?>" style="cursor: pointer;" onclick="editHeadline('<?php echo $row['headline_id']; ?>')">
                        <span data-toggle="tooltip" data-placement="top" title="Edit Headline" class="glyphicon glyphicon-edit"></span>
                    </a>&nbsp;
                    <a href="admin/deleteHeadline/<?php echo $row['headline_id']; ?>" onclick="return chkDelete()">
                        <span data-toggle="tooltip" data-placement="top" title="Remove" class="glyphicon glyphicon-remove"></span>
                    </a>
                </td>
        <div id="editLink<?php echo $row['headline_id']; ?>" class="modal fade" role="dialog">
            <div class="modal-dialog">
                <!-- Modal content-->
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close"
                                data-dismiss="modal">&times;</button>
                        <h4 class="modal-title" style="text-align: center">Edit Headline</h4>
                    </div>
                    <form action="admin/updateHeadline" method="post" enctype="multipart/form-data">
                        <input type="hidden" name="headline_id" class="form-control" value="<?php echo $row['headline_id']; ?>">
                        <!--<input type="hidden" id="type_id<?php echo $row['headline_id']; ?>" value="<?php echo $row['type']; ?>" >-->
                        <div class="modal-body">
                            <div class="row">
                                <!--                                                <div class="form-group">
                                                                                    <label class="control-label">Type<span style="color:red">*</span></label>
                                                                                    <div class="radio-list">
                                                                                        <label class="radio-inline p-0">
                                                                                            <div class="radio radio-info">
                                                                                                <input type="radio" name="type" id="type_id<?php echo $row['headline_id']; ?>" class="type_id" value="1" 
    <?php
    if ($row['type'] == 1) {
        echo 'checked';
    }
    ?> 
                                                                                                       onclick="editHeadline('<?php echo $row['headline_id']; ?>')">
                                                                                                <label for="radio">Category Type</label>
                                                                                            </div>
                                                                                        </label>
                            
                                                                                        <label class="radio-inline">
                                                                                            <div class="radio radio-info">
                                                                                                <input type="radio" name="type" id="type_id<?php echo $row['headline_id']; ?>" class="type_id" value="2" 
    <?php
    if ($row['type'] == 2) {
        echo 'checked';
    }
    ?>
                                                                                                       onclick="editHeadline('<?php echo $row['headline_id']; ?>')">
                                                                                                <label for="radio3">Country Type</label>
                                                                                            </div>
                                                                                        </label>
                                                                                    </div>
                                                                                </div>-->

                                                        <!--<div class="form-group" id="category<?php echo $row['headline_id']; ?>" style="display: none;">-->
                                <div class="form-group">
                                    <label class="control-label">Category</label>
                                    <select class="form-control select2" name="cat_id">
                                        <option value="0">Choose Category</option>
    <?php foreach ($all_category as $cat) { ?>
                                            <option value="<?php echo $cat['cat_id']; ?>" 
        <?php
        if ($row['cat_id'] == $cat['cat_id']) {
            echo 'selected';
        }
        ?>>
                                            <?php echo $cat['cat_name']; ?>
                                            </option>
                                        <?php } ?>
                                    </select>
                                </div>

                                                        <!--<div class="form-group" id="country<?php echo $row['headline_id']; ?>" style="display: none;">-->
                                <div class="form-group">
                                    <label class="control-label">Country</label>
                                    <select class="select2 m-b-10 select2-multiple" multiple="multiple" name="country[]">
                                        <option value="0">Choose Countries</option>
    <?php foreach ($all_country as $allcountry) { ?>
                                            <option value="<?php echo $allcountry['country_id']; ?>" 
        <?php
        $country = explode(',', $row['country_id']);
        foreach ($country as $cntry) {
            if ($allcountry['country_id'] == $cntry) {
                echo 'selected';
            }
        }
        ?>>
        <?php echo $allcountry['country_name'] ?>
                                            </option>
    <?php } ?>
                                    </select>
                                </div>

                                <div class="form-group">
                                    <label for="form-first-name">Headline Name</label>
                                    <input type="text" name="headline" class="form-control" value="<?php echo $row['headline']; ?>">
    <!--                            <span class="help-inline">Mensagem de erro do campo</span> -->
                                </div>

                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
                            <button type="submit" id="sub_button" class="btn btn-success">Submit</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </tr>
    <?php $i++;
} ?>
</tbody>
</table>
    
</form>
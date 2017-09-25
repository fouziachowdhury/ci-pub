<?php foreach ($banner as $row) { ?>
    
            <select class="select2 m-b-10 select2-multiple" id="category<?php echo $row[0]['banner_id']; ?>" multiple="multiple" name="hobbies[]" style="display: none;">
                <option value="0">Choose Categories</option>
                <?php foreach ($all_category as $all_cat) { ?>
                    <option value="<?php echo $all_cat['cat_id']; ?>" 
                    <?php
                    foreach ($category as $cat) {
                        if ($all_cat['cat_id'] == $cat) {
                            echo 'selected';
                        }
                    }
                    ?>><?php echo $all_cat['cat_name']; ?></option>
    <?php } ?>
            </select>
        
            <select class="select2 m-b-10 select2-multiple" id="country<?php echo $row[0]['banner_id']; ?>" multiple="multiple" name="hobbies[]" style="display: none;">
                <option value="0">Choose Country</option>
                <?php foreach ($all_country as $all_count) { ?>
                    <option value="<?php echo $all_count['country_id']; ?>" 
                    <?php
                            $country = explode(',', $row[0]['country_id']);
                            foreach ($country as $count) {
                                if ($all_count['country_id'] == $count) {
                                    echo 'selected';
                                }
                            }
                            ?>><?php echo $all_count['country_name']; ?></option>
            <?php } ?>
            </select>
        
    
<?php
}?>
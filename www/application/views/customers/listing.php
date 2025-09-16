<form action="">
<div class="row">
    <?php if ($perms['add']) : ?>
    <div class="col-xs-6 col-sm-4 col-md-1" style='margin-top:23px;'>
        <a href="<?php echo base_url("customers/add?referer=customers/listing/".$this->uri->segment(3)); ?>">
            <button type="button" class="btn btn-success btn-block"><i class="fa fa-plus"></i> Add</button>
        </a>
    </div>
    <?php endif; ?>
    <div class="col-xs-2">
        <label for="">Display</label>
        <select class="form-control" name="display" id="rpp">
            <option value="">Select</option>
            <option value="10" <?php echo ( (empty($rows_per_page)) || ($rows_per_page == 10) ) ? 'selected':'';?>>10 rows</option>
            <option value="25" <?php echo ($rows_per_page == 25) ? 'selected':'';?>>25 rows</option>
            <option value="50" <?php echo ($rows_per_page == 50) ? 'selected':'';?>>50 rows</option>
            <option value="100" <?php echo ($rows_per_page == 100) ? 'selected':'';?>>100 rows</option>
        </select>
    </div>
    <div class="col-xs-6 col-sm-4 col-md-2">
        <label for="">Search</label>
        <div class="input-group">
            <input type="search" name="search_text" id="search_text" class="form-control" placeholder="Search Customer" value="<?php echo $this->input->get("search_text");?>">
            <div class="input-group-text clear-search cursor-pointer"><i class="fa fa-times"></i></div>
        </div>
    </div>
    <div class="col-xs-6 col-sm-4 col-md-1" style='margin-top:23px;'>
        <button class="btn btn-info btn-block"><i class="fa fa-check"></i> Apply</button>
    </div>
</div>
</form>
<?php if( (isset($pagination)) && (!empty($pagination)) ) echo $pagination;?>
<div class="row">
    <div class="col-xs-12 col-sm-12">
        <div class="box">
            <?php if ((isset($customers)) && (!empty($customers))) : ?>
                <div class="box-body table-responsive no-padding">
                    <table id="customers_listing" class="table">
                        <thead>
                            <tr class='text-center'>
                                <th rowspan='2'>Name</th>
                                <th rowspan='2'>Address</th>
                                <th rowspan='2'>City</th>
                                <th colspan='2'>Phone Number</th>
                                <th rowspan='2'>Actions</th>
                            </tr>
                            <tr class='text-center'>
                                <th>Main</th>
                                <th>Secondary</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($customers as $customer) : ?>
                                <tr data-id="<?php echo $customer->uuid; ?>">
                                    <td><?php echo "{$customer->title} <b>{$customer->last_name}</b> {$customer->first_name}"; ?></td>
                                    <td><?php echo $customer->address; ?></td>
                                    <td><?php echo $customer->city; ?></td>
                                    <td><?php echo $customer->phone_number1; ?></td>
                                    <td><?php echo $customer->phone_number2; ?></td>
                                    <td>
                                        <?php if ($perms['edit']) : ?>
                                            <a href="<?php echo base_url("customers/edit/" . $customer->uuid."?referer=customers/listing/".$this->uri->segment(3,1)); ?>">
                                                <div class="btn btn-primary"><i class="fa fa-edit"></i> Edit</div>
                                            </a>
                                        <?php endif; ?>
                                        <?php if ($perms['delete']) echo DeleteButton2('customers', 'uuid', $customer->uuid,"","","md"); ?>
                                    </td>
                                </tr>
                            <?php endforeach; ?>
                        </tbody>

                    </table>
                </div>
            <?php else : ?>
                <p>No records</p>
            <?php endif; ?>
        </div>
    </div>
</div>
<?php if( (isset($pagination)) && (!empty($pagination)) ) echo $pagination;?>
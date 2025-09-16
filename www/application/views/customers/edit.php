<form id="save_customers" role="form" action="<?php echo base_url('customers/save/'); ?>" method="post" enctype="multipart/form-data">
    <input type="hidden" id="uuid" name="uuid" value="<?php echo $customer->uuid;?>">
    <input type="hidden" name="referer" value="<?php echo $this->input->get("referer");?>">
    <div class="panel panel-info">
        <div class="panel-body">
            <div class="row">
                <div class="col-md-2">
                    <a href="<?php echo base_url($this->input->get("referer"));?>"><div class="btn btn-warning"><i class="fa fa-chevron-left"></i> Back</div></a>
                </div>
            </div>
            <div class="row">
                <div class="col-md-4">
                    <div class="row">
                        <div class="col-md-4">
                            <div class="form-group">
                                <label>Customer Code</label>
                                <input type="text" class="form-control" name="customer_code" id="customer_code" placeholder="Auto Generated" value="<?php echo $customer->customer_code;?>" readonly>
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="form-group">
                                <label>Title: </label>
                                <label for="title_mr"><input type="radio" name="title" value="Mr" id="title_mr" <?php echo ($customer->title == 'Mr') ? 'checked' : '';?> required> Mr</label>
                                <label for="title_mrs"><input type="radio" name="title" value="Mrs" id="title_mrs" <?php echo ($customer->title == 'Mrs') ? 'checked' : '';?> required> Mrs</label>
                                <label for="title_miss"><input type="radio" name="title" value="Miss" id="title_miss" <?php echo ($customer->title == 'Miss') ? 'checked' : '';?> required> Miss</label>
                                <label for="title_dr"><input type="radio" name="title" value="Dr" id="title_dr" <?php echo ($customer->title == 'Dr') ? 'checked' : '';?> required> Dr</label>
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="form-group">
                                <label>First Name</label>
                                <input type="text" class="form-control required" name="first_name" id="first_name" placeholder="" value="<?php echo $customer->first_name;?>" required>
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="form-group">
                                <label>Last Name</label>
                                <input type="text" class="form-control" name="last_name" id="last_name" placeholder="" value="<?php echo $customer->last_name;?>">
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="form-group">
                                <label>Address</label>
                                <textarea name="address" id="address" cols="30" rows="4" class="form-control" placeholder=""><?php echo $customer->address;?></textarea>
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="form-group">
                                <label>City, Village or Region</label>
                                <input type="text" class="form-control" name="city" id="city" placeholder="" value="<?php echo $customer->city;?>">
                            </div>
                        </div>

                        <div class="col-md-12">
                            <div class="form-group">
                                <label>NIC</label>
                                <input type="text" class="form-control" name="nic" id="nic" placeholder="" value="<?php echo $customer->nic;?>">
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="form-group">
                                <label>Date of Birth</label>
                                <input type="date" class="form-control" name="dob" id="dob" placeholder="" value="<?php echo $customer->dob;?>" min="1900-01-01" max="<?php echo date("Y-m-d");?>" pattern="">
                            </div>
                        </div>
                        
                        <div class="col-md-12">
                            <div class="form-group">
                                <label>Remarks</label>
                                <textarea name="remarks" id="remarks" cols="30" rows="3" class="form-control" placeholder=""><?php echo $customer->remarks;?></textarea>
                            </div>
                        </div>

                        <div class="col-md-12">
                            <div class="form-group">
                                <label>Email</label>
                                <input type="text" class="form-control" name="email" id="email" placeholder="" value="<?php echo $customer->email;?>">
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="form-group">
                                <label>Primary Phone Number</label>
                                <input type="tel" pattern="[0-9]{7,8}" class="form-control" name="phone_number1" maxlength="8" id="phone1" placeholder="7 to 8 numbers" value="<?php echo $customer->phone_number1;?>">
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="form-group">
                                <label>Secondary Phone Number</label>
                                <input type="tel" pattern="[0-9]{7,8}" class="form-control" name="phone_number2" maxlength="8" id="phone2" placeholder="7 to 8 numbers" value="<?php echo $customer->phone_number2;?>">
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="panel-body">
        <a href="<?php echo base_url("customers/listing");?>"><div class="btn btn-warning"><i class="fa fa-chevron-left"></i> Back</div></a>
        <button type="submit" class="btn btn-info"><i class="fa fa-save"></i> Save</button>
    </div>

</form>
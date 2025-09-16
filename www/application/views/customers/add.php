<style>
input[required]{
    border-left: 3px solid darkblue;
}
</style>
<form id="save_customers" role="form" action="<?php echo base_url('customers/save/'); ?>" method="post" enctype="multipart/form-data">
    <input type="hidden" id="uuid" name="uuid" value="">
    <input type="hidden" name="referer" value="<?php echo $this->input->get("referer");?>">
    <div class="panel panel-info">
        <div class="panel-body">
            <div class="row">
                <div class="col-md-2">
                    <a href="<?php echo base_url($this->input->get("referer"));?>"><div class="btn btn-warning"><i class="fa fa-chevron-left"></i> Back</div></a>                </div>
            </div>
            <div class="row">
                <div class="col-md-4">
                    <div class="row">
                        <div class="col-md-4">
                            <div class="form-group">
                                <label>Customer Code</label>
                                <input type="text" class="form-control" name="customer_code" id="customer_code" placeholder="Auto Generated" value="" readonly>
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="form-group">
                                <label>Title: </label>
                                <label for="title_mr"><input type="radio" name="title" value="Mr" id="title_mr" checked> Mr</label>
                                <label for="title_mrs"><input type="radio" name="title" value="Mrs" id="title_mrs" disabled> Mrs</label>
                                <label for="title_miss"><input type="radio" name="title" value="Miss" id="title_miss" disabled> Miss</label>
                                <label for="title_dr"><input type="radio" name="title" value="Dr" id="title_dr"> Dr</label>
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="form-group">
                                <label>First Name</label>
                                <input type="text" class="form-control required" name="first_name" id="first_name" placeholder="" value="" required>
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="form-group">
                                <label>Last Name</label>
                                <input type="text" class="form-control" name="last_name" id="lname" placeholder="" value="" required>
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="form-group">
                                <label>Address</label>
                                <textarea name="address" id="address" cols="30" rows="4" class="form-control" placeholder=""></textarea>
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="form-group">
                                <label>City, Village or Region</label>
                                <input type="text" class="form-control" name="city" id="city" placeholder="" value="">
                            </div>
                        </div>

                        <div class="col-md-12">
                            <div class="form-group">
                                <label>NIC</label>
                                <input type="text" class="form-control" name="nic" id="nic" minlength='14' maxlength='14' placeholder="" value="" required>
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="form-group">
                                <label>Date of Birth</label>
                                <input type="date" class="form-control" name="dob" id="dob" placeholder="" value="" min="1900-01-01" max="<?php echo date("Y-m-d");?>" pattern="">
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="form-group">
                                <label>Remarks</label>
                                <textarea name="remarks" id="remarks" cols="30" rows="3" class="form-control" placeholder=""></textarea>
                            </div>
                        </div>

                        <div class="col-md-12">
                            <div class="form-group">
                                <label>Email</label>
                                <input type="text" class="form-control" name="email" id="email" placeholder="" value="">
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="form-group">
                                <label>Primary Phone Number</label>
                                <input type="tel" pattern="[0-9]{7,8}" class="form-control" name="phone_number1" maxlength="8" id="phone1" placeholder="7 to 8 numbers" value="" required>
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="form-group">
                                <label>Secondary Phone Number</label>
                                <input type="tel" pattern="[0-9]{7,8}" class="form-control" name="phone_number2" maxlength="8" id="phone2" placeholder="7 to 8 numbers" value="">
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
<form id="" role="form" action="<?php echo base_url('paymentmodes/save/'); ?>" method="post">
    <input type="hidden" name="uuid" value="<?php echo $data->uuid; ?>">

    <div class="panel panel-info">
        <div class="panel-body">
            <div class="col-md-3">
                <div class="form-group">
                    <label for="name"><i class="fa fa-info-circle"></i> Region</label>
                    <input id="name" type="text" class="form-control required" name="name" placeholder="" data-name="Region Name" value="<?php echo $data->name; ?>" autofocus>
                </div>
            </div>
        </div>
        <div class="panel-body">
            <div class="col-md-3">
                <div class="form-group">
                    <label for="attachment"><i class="fa fa-info-circle"></i> Attachment</label>
                    <p class="notes">Select this option if you need to upload documents related to this payment mode when processing. For example proof of payment</p>
                    <input type="radio" name="attachment" id="attachment_yes" value="1" <?php echo ($data->attachment=='1')?'checked':'';?>>
                    <label for="attachment_yes">Yes</label>
                    <input type="radio" name="attachment" id="attachment_no" value="0" <?php echo ($data->attachment=='0')?'checked':'';?>>
                    <label for="attachment_no">No</label>
                </div>
            </div>
        </div>

        <div class="panel-body">
            <a href='<?php echo base_url('paymentmodes/listing');?>'><div class="btn btn-warning"><i class="fa fa-chevron-left"></i> Listing</div></a>
            <button type="submit" class="btn btn-primary"><i class="fa fa-save"></i> Save</button>
        </div>
    </div>
</form>
<form id="expenses" role="form" action="<?php echo base_url('expenses/update'); ?>" method="post">
    <input type="hidden" name="uuid" value="<?php echo $data->uuid; ?>">

    <div class="panel panel-info">
        <div class="panel-body">
            <div class="col-sm-6 col-md-4 col-lg-3">
                <div class="form-group">
                    <label for="">Expenses Date</label>
                    <input type="date" class="form-control" name="expenses_date" id="expenses_date" value="<?php echo substr($data->expenses_date,0,10); ?>" autofocus>
                </div>
                <div class="form-group">
                    <label>Description</label>
                    <textarea name="description" id="" rows="3" class="form-control"><?php echo $data->description;?></textarea>
                </div>
                <div class="form-group">
                    <label for="">Amount</label>
                    <input type="number" class='form-control' name="amount" id="" value="<?php echo $data->amount;?>">
                </div>
                <div class="form-group">
                    <a href='<?php echo base_url('expenses/listing');?>'><div class="btn btn-warning"><i class="fa fa-chevron-left"></i> Back</div></a>
                    <div class="btn btn-info" id="save"><i class="fa fa-save"></i> Save</div>
                </div>
            </div>
        </div>
    </div>
</form>
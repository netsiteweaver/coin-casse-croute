<?php if($perms['add']): ?>
<div class="row">
    <div class="col-xs-1">
        <a href="<?php echo base_url("expenses/add/"); ?>"><button class="btn btn-success btn-xs btn-flat"><i class="fa fa-plus"></i> Add</button></a>
    </div>
</div>
<?php endif; ?>
<div class="row">
    <div class="col-sm-4 col-md-3 col-lg-2">
        <div class="form-group">
            <label for="">From Date</label>
            <input type="date" name="start_date" class="form-control" id="" value="<?php echo !empty($this->input->get("start_date"))?$this->input->get("start_date"):date("Y-m-d");?>">
        </div>
    </div>
    <div class="col-sm-4 col-md-3 col-lg-2">
        <div class="form-group">
            <label for="">To Date</label>
            <input type="date" name="end_date" class="form-control" id="" value="<?php echo !empty($this->input->get("end_date"))?$this->input->get("end_date"):date("Y-m-d");?>">
        </div>
    </div>
    <div class="col-sm-4 col-md-3 col-lg-2">
        <div class="form-group">
            <label for="">Per Page</label>
            <select name="per_page" id="" class="form-control">
                <option value="">Select</option>
                <option value="5" <?php echo $this->input->get("per_page")==5 ? 'selected' :'';?>>5 Rows</option>
                <option value="10" <?php echo $this->input->get("per_page")==10 ? 'selected' :'';?>>10 Rows</option>
                <option value="25" <?php echo $this->input->get("per_page")==25 ? 'selected' :'';?>>25 Rows</option>
                <option value="50" <?php echo $this->input->get("per_page")==50 ? 'selected' :'';?>>50 Rows</option>
            </select>
        </div>
    </div>
    <div class="col-sm-4 col-md-3 col-lg-2">
        <div style='margin-top:20px;' class="btn btn-info" id="apply"><i class="fa fa-check"></i> Apply</div>
    </div>
</div>
<div class="row">
    <div class="col-sm-12 col-md-8 col-lg-6">
        <div class="box">
            <?php if ((isset($expenses)) && (!empty($expenses))): ?>
            <div class="box-body table-responsive no-padding">
                <table id="" class="table">
                    <thead>
                        <tr>
                            <th>Date</th> 
                            <th>Description</th>
                            <th>Amount</th>
                            <th>Operations</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($expenses as $row): ?>
                            <tr>
                                <td><?php echo substr($row->expenses_date,0,10); ?></td>
                                <td><?php echo $row->description; ?></td>
                                <td class='text-right'><?php echo number_format($row->amount,2); ?></td>
                                <td>
                                    <?php if($perms['edit']): ?>
                                    <a href="<?php echo base_url("expenses/edit/" . $row->uuid); ?>"><button class="btn btn-xs btn-flat btn-primary"><i class="glyphicon glyphicon-pencil"></i> Edit</button></a>
                                    <?php endif; ?>
                                    <?php if($perms['delete']) DeleteButton2('colors','uuid',$row->uuid); ?>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
            <?php else: ?>
                <p>No records</p>
            <?php endif; ?>
        </div>
    </div>
</div>
<div class="row">
    <div class="col-sm-12">
        <?php echo $pagination;?>
    </div>
</div>
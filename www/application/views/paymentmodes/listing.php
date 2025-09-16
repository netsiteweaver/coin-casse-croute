<?php if($perms['add']): ?>
<div class="row">
    <div class="col-xs-1">
        <a href="<?php echo base_url("paymentmodes/add/"); ?>"><button class="btn btn-success btn-xs btn-flat"><i class="fa fa-plus"></i> Add</button></a>
    </div>
</div>
<?php endif; ?>
<div class="row">
    <div class="col-xs-12 col-sm-12 col-md-6 col-lg-4">
        <div class="box">
            <?php if ((isset($paymentmodes)) && (!empty($paymentmodes))): ?>
            <div class="box-body table-responsive no-padding">
                <table id="" class="table">
                    <thead>
                        <tr>
                            <th>Name</th>
                            <th>Attachment</th>
                            <th>Operations</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($paymentmodes as $paymentmode): ?>
                            <tr>
                                <td><?php echo $paymentmode->name; ?></td>
                                <td class="text-center"><i class="fa fa-<?php echo ($paymentmode->attachment == '1')?'check':'times'; ?>"></i></td>
                                <td>
                                    <?php if($perms['edit']): ?>
                                    <a href="<?php echo base_url("paymentmodes/edit/" . $paymentmode->uuid); ?>"><button class="btn btn-xs btn-flat btn-primary"><i class="glyphicon glyphicon-pencil"></i> Edit</button></a>
                                    <?php endif; ?>
                                    <?php if( ($paymentmode->id != '1') && ($perms['delete']) ) DeleteButton2('payment_modes','uuid',$paymentmode->uuid); ?>
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
<div class="row">
    <div class="col-xs-12 col-sm-6 col-md-4">
        <p>Drag the rows vertically to re-order</p>
        <div class="box">
        <?php if( (isset($addons)) && (!empty($addons)) ): ?>
            <div class="box-body table-responsive no-padding">
                <table id="category_listing" class="table">            
                    <colgroup>
                        <col style='width:200px;'>
                        <col style='width:25%'>
                        <col>
                    </colgroup>        
                    <thead>
                        <tr>
                            <th>Addon Name</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach($addons as $addon): ?>
                        <tr data-id="<?php echo $addon->id;?>">
                            <td><?php echo $addon->name; ?></td>
                            <td>
                                <?php if($perms['edit']): ?>
                                <a href="<?php echo base_url("addons/edit/".$addon->uuid); ?>"><div class="btn btn-xs btn-flat btn-primary"><i class="fa fa-edit"></i> Edit</div></a>
                                <?php endif; ?>
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

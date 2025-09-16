<div class="row">
    <div class="col-xs-12 col-sm-6 col-md-4">
        <p>Drag the rows vertically to re-order</p>
        <div class="box">
        <?php if( (isset($productcategories)) && (!empty($productcategories)) ): ?>
            <div class="box-body table-responsive no-padding">
                <table id="category_listing" class="table">            
                    <colgroup>
                        <col style='width:200px;'>
                        <col style='width:25%'>
                        <col>
                    </colgroup>        
                    <thead>
                        <tr>
                            <th>Category Name</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach($productcategories as $productcategory): ?>
                        <tr data-id="<?php echo $productcategory->id;?>">
                            <td><?php echo $productcategory->name; ?></td>
                            <td>
                                <?php if($perms['edit']): ?>
                                <a href="<?php echo base_url("product_categories/edit/".$productcategory->uuid); ?>"><div class="btn btn-xs btn-flat btn-primary"><i class="fa fa-edit"></i> Edit</div></a>
                                <?php endif; ?>
                                <?php if($perms['delete']) echo DeleteButton2('product_categories','uuid',$productcategory->uuid); ?>
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

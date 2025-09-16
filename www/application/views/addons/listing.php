<form action="">
<div class="row mb-3">
    <?php if ($perms['add']) : ?>
    <div class="col-xs-6 col-sm-4 col-md-1" style='margin-top:23px;'>
        <a href="<?php echo base_url("addons/add?referer=addons/listing/".$this->uri->segment(3)); ?>">
            <button type="button" class="btn btn-success btn-block"><i class="fa fa-plus"></i> Add</button>
        </a>
    </div>
    <?php endif; ?>
    <div class="col-xs-1" style='margin-top:23px;'>
        <a href="<?php echo base_url("addons/reorder"); ?>"><div class="btn btn-md bg-purple re-order"><i class="fa fa-sort"></i> Display Order</div></a>
    </div>
    <div class="col-xs-6 col-sm-4 col-md-2">
        <label for="">Display</label>
        <select class="form-control" name="display" id="rpp">
            <option value="">Select</option>
            <option value="10" <?php echo ( (empty($rows_per_page)) || ($rows_per_page == 10) ) ? 'selected':'';?>>10 rows</option>
            <option value="25" <?php echo ($rows_per_page == 25) ? 'selected':'';?>>25 rows</option>
            <option value="50" <?php echo ($rows_per_page == 50) ? 'selected':'';?>>50 rows</option>
            <option value="100" <?php echo ($rows_per_page == 100) ? 'selected':'';?>>100 rows</option>
            <option value="3" <?php echo ($rows_per_page == 3) ? 'selected':'';?>>3 rows</option>
        </select>
    </div>
    <div class="col-xs-6 col-sm-4 col-md-2">
        <label for="">Search</label>
        <div class="input-group">
            <input type="search" name="search_text" id="search_text" class="form-control" placeholder="Search Order" value="<?php echo $this->input->get("search_text");?>">
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
    <div class="col-xs-12 col-sm-6">
        <div class="box">
        <?php if( (isset($addons)) && (!empty($addons)) ): ?>
            <div class="box-body table-responsive no-padding">
                <table id="product_listing" class="table">                    
                    <thead>
                        <tr>
                            <th>Photo</th>
                            <!-- <th>Stockref</th> -->
                            <th>Name <span class="showOnFocus hidden"><i class="fa fa-search"></i></span></th>
                            <th>Price</th>
                            <th>VAT%</th>
                            <th>Price + VAT</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach($addons as $product): ?>
                            <?php $grossAmount = floatval($product->selling_price) / (1 + (floatval($product->vat)/100)); ?>
                        <tr data-id="<?php echo $product->uuid;?>">
                            <td style='width:100px;'>
                            <?php if(empty($product->photo)):?>
                                <img style='width:50px' src="./assets/images/image-placeholder-200px.png" alt="">
                            <?php else:?>
                                <img style='width:100%' src="<?php echo base_url('uploads/addons/'.$product->photo); ?>" alt="<?php //echo $product->photo;?>">
                                <?php endif;?>
                            </td>
                            <!-- <td><?php echo $product->stockref; ?></td> -->
                            <td><?php echo $product->name; ?></td>
                            <td class='text-right'><?php echo number_format( ($grossAmount),2); ?></td>
                            <td class='text-center'><?php echo $product->vat; ?>%</td>
                            <td class='text-right'><?php echo number_format( ($product->selling_price),2); ?></td>
                            <td>
                                <?php if($perms['edit']): ?>
                                <a href="<?php echo base_url("addons/edit/".$product->uuid); ?>"><div class="btn btn-xs btn-flat btn-primary"><i class="fa fa-edit"></i> Edit</div></a>
                                <?php endif; ?>
                                <?php if($perms['delete']) echo DeleteButton2('products','uuid',$product->uuid); ?>
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

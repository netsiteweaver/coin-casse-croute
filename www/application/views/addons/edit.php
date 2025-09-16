<form id="edit_product" role="form" action="<?php echo base_url('addons/save/'); ?>" method="post" enctype="multipart/form-data">
    <input type="hidden" name="uuid" value="<?php echo $addon->uuid;?>">
    <input type="hidden" name="id" value="<?php echo $addon->id;?>">

    <div class="panel panel-info">
        <div class="panel-body">
            <div class="row">
                <div class="col-sm-6 col-md-4">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group">
                                <label>Name</label>
                                <input type="text" class="form-control required" name="name" placeholder="" data-name="Product name" value="<?php echo $addon->name;?>" autofocus>
                            </div>

                            <div class="form-group">
                                <label>Selling Price</label>
                                <p class="notes">Enter price inclusive of fax, if applicable</p>
                                <input type="text" class="form-control allow_decimal text-right required" name="selling_price" placeholder="" data-name="Selling Price" value="<?php echo $addon->selling_price;?>" required>
                            </div>      
                            
                            <div class="form-group">
                                <label for="vat">VAT</label>
                                <select name="vat" id="vat" class="form-control">
                                    <option value="15" <?php echo ($addon->vat=='15')?'selected':'';?>>15%</option>
                                    <option value="0" <?php echo ($addon->vat=='0')?'selected':'';?>>0%</option>
                                </select>
                            </div>  
                        </div>
                        
                    </div>
                    
                    <div class="row" id="image-block">
                        <input type="hidden" name="deleted_image" value="">
                        <?php if(!empty($addon->photo)):?>
                        <div class="col-md-2" data-id="<?php echo $addon->id;?>">
                            <img src="<?php echo base_url("uploads/addons/".$addon->photo);?>" alt="" class="img-responsive img-thumbnail">
                            <div class='delete-image' style='position:absolute;top:0;right:20px;color:#ff0000;'><i class="fa fa-times"></i></div>
                        </div>
                        <?php endif;?>
                    </div>

                    <div id='upload_photo' class="row <?php echo (!empty($addon->photo))?'hidden':'';?>">
                        <div class="form-group col-md-12">
                            <label>Photos</label>
                            <div class="row">
                                <div class="col-md-12">
                                    <p class="notes">For best result, please choose an images with a white background</p>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-12">
                                    <div id="preview"></div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-3">
                                    <input type="file" accept="image/*" name="photos[]" value="" onchange="showPreview(event)" multiple>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-sm-6 col-md-4">
                    <div class="col-md-12">
                        <p>Addon is for the following Product Categories:</p>
                        <table class="table">
                            <tbody>
                                <?php foreach($product_categories as $pc):?>
                                <tr class="cursor-pointer select-category" data-selected="<?php echo (in_array($pc->id,$addon->addons))?'1':'0';?>">
                                    <td><img src="<?php echo base_url("uploads/product_categories/".$pc->photo);?>" class="img-thumbnail" width="50px"></td>
                                    <td>
                                        <?php echo $pc->name;?>
                                        <input type="checkbox" class="d-none addon_category" name="addon_category[]" value="<?php echo $pc->id;?>" <?php echo (in_array($pc->id,$addon->addons))?'checked':'';?>>
                                    </td>
                                    <td style="width:50px; color:green;" class="choice">
                                        <?php if(in_array($pc->id,$addon->addons)):?>
                                            <i class="fa fa-check-square fa-2x"></i>
                                        <?php endif;?>
                                    </td>
                                </tr>
                                <?php endforeach;?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>

            
            <div class="row">
                <div class="col-md-12">
                    <a href="<?php echo base_url('addons/listing');?>"><div class="btn btn-warning"><i class="fa fa-chevron-left"></i> Back</div></a>
                    <button type="submit" class="btn btn-primary"><i class="fa fa-save"></i> Save</button>
                </div>
            </div>
                
        </div>
    </div>
</form>
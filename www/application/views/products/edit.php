<form id="edit_product" role="form" action="<?php echo base_url('products/save/'); ?>" method="post" enctype="multipart/form-data">
    <input type="hidden" name="uuid" value="<?php echo $product->uuid;?>">
    <input type="hidden" name="id" value="<?php echo $product->id;?>">

    <div class="panel panel-info">
        <div class="panel-body">
            <div class="row">
                <div class="col-md-4">
                    <div class="form-group">
                        <label>Stock Ref</label>
                        <!-- <p class="notes">Not recommended to change</p> -->
                        <input type="text" class="form-control readonly" name="" placeholder="" data-name="Stock Ref" value="<?php echo $product->stockref;?>" autofocus readonly>
                    </div>
                    <div class="form-group">
                        <label> Item Name</label>
                        <input type="text" class="form-control required" name="name" placeholder="" data-name="Product name" value="<?php echo $product->name;?>" autofocus>
                    </div>
                    <div class="form-group d-none">
                        <label for="">Description</label>
                        <p class="notes">This is Optional</p>
                        <textarea name="description" id="" rows="5" class="form-control"><?php echo $product->description;?></textarea>
                    </div>
                    <div class="form-group">
                        <label>Category</label>
                        <select name="category_id" class="form-control required" data-name="Vetement Model" required>
                            <option value="">Select</option>
                            <?php foreach ($product_categories as $vm) : ?>
                                <option value="<?php echo $vm->id; ?>" <?php echo ($product->category_id==$vm->id)?'selected':'';?>><?php echo $vm->name; ?></option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                    
                    <div class="form-group">
                        <label>Cost Price</label>
                        <input type="text" class="form-control allow_decimal text-right" name="cost_price" placeholder="" data-name="Unit Price" value="<?php echo $product->cost_price;?>">
                    </div>
                    <div class="form-group">
                        <label>Selling Price</label>
                        <input type="text" class="form-control allow_decimal text-right required" name="selling_price" placeholder="" data-name="Selling Price" value="<?php echo $product->selling_price;?>" required>
                    </div>    
                    <div class="form-group">
                        <label for="vat">VAT</label>
                        <select name="vat" id="vat" class="form-control">
                            <option value="15" <?php echo ($product->vat=='15')?'selected':'';?>>15%</option>
                            <option value="0" <?php echo ($product->vat=='0')?'selected':'';?>>0%</option>
                        </select>
                    </div>          
                </div>
            </div>
            
            <div class="row" id="image-block">
                <input type="hidden" name="deleted_image" value="">
                <?php if(!empty($product->photo)):?>
                <div class="col-md-2" data-id="<?php echo $product->id;?>">
                    <img src="<?php echo base_url("uploads/products/".$product->photo);?>" alt="" class="img-responsive img-thumbnail">
                    <div class='delete-image' style='position:absolute;top:0;right:20px;color:#ff0000;'><i class="fa fa-times"></i></div>
                </div>
                <?php endif;?>
            </div>

            <div id='upload_photo' class="row <?php echo (!empty($product->photo))?'hidden':'';?>">
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
            
            <div class="row">
                <div class="col-md-12">
                    <a href="<?php echo base_url('products/listing');?>"><div class="btn btn-warning"><i class="fa fa-chevron-left"></i> Back</div></a>
                    <button type="submit" class="btn btn-primary"><i class="fa fa-save"></i> Save</button>
                </div>
            </div>
                
        </div>
    </div>
</form>
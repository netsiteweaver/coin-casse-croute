<form id="add_product" role="form" action="<?php echo base_url('products/save/'); ?>" method="post" enctype="multipart/form-data">
    <input type="hidden" name="uuid" value="">
    <input type="hidden" name="id" value="">
    <div class="panel panel-info">
        <div class="panel-body">
            <div class="row">
                <div class="col-md-4">
                    <div class="form-group">
                        <label> Product Name</label>
                        <input type="text" class="form-control required" name="name" placeholder="" data-name="Product name" value="" autofocus required>
                    </div>
                    <div class="form-group d-none">
                        <label for="">Description</label>
                        <p class="notes">This is Optional</p>
                        <textarea name="description" id="" rows="5" class="form-control"></textarea>
                    </div>
                    <div class="form-group">
                        <label>Category</label>
                        <select name="category_id" class="form-control required" data-name="Vetement Model" required>
                            <option value="">Select</option>
                            <?php foreach ($product_categories as $vm) : ?>
                                <option value="<?php echo $vm->id; ?>"><?php echo $vm->name; ?></option>
                            <?php endforeach; ?>
                        </select>
                    </div>

                    <div class="form-group">
                        <label>Cost Price</label>
                        <input type="text" class="form-control allow_decimal text-right" name="cost_price" placeholder="" data-name="Unit Price" value="0">
                    </div>
                    <div class="form-group">
                        <label>Selling Price</label>
                        <input type="text" class="form-control allow_decimal text-right required" name="selling_price" placeholder="" data-name="Selling Price" value="1" required>
                    </div>
                    <div class="form-group">
                        <label for="vat">VAT</label>
                        <select name="vat" id="vat" class="form-control">
                            <option value="15">15%</option>
                            <option value="0">0%</option>
                        </select>
                    </div> 
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
            
            <div class="row">
                <div class="col-md-12">
                    <a href="<?php echo base_url('products/listing');?>"><div class="btn btn-warning"><i class="fa fa-chevron-left"></i> Back</div></a>
                    <button type="submit" class="btn btn-primary"><i class="fa fa-save"></i> Save</button>
                </div>
            </div>
                
        </div>
    </div>
</form>
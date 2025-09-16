<form id="add_product" role="form" action="<?php echo base_url('addons/save/'); ?>" method="post" enctype="multipart/form-data">
    <input type="hidden" name="uuid" value="">
    <input type="hidden" name="id" value="">
    <div class="panel panel-info">
        <div class="panel-body">
            <div class="row">
                <div class="col-md-4">
                    <div class="form-group">
                        <label>Name</label>
                        <input type="text" class="form-control required" name="name" placeholder="" data-name="Product name" value="" autofocus required>
                    </div>
                    <div class="form-group">
                        <label>Selling Price</label>
                        <p class="notes">Enter price inclusive of fax, if applicable</p>
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
                <div class="col-md-4">
                    <p>Addon is for the following Product Categories:</p>
                    <table class="table">
                        <tbody>
                            <?php foreach($product_categories as $pc):?>
                            <tr class="cursor-pointer select-category" data-selected="0">
                                <td><img src="<?php echo base_url("uploads/product_categories/".$pc->photo);?>" class="img-thumbnail" width="50px"></td>
                                <td>
                                    <?php echo $pc->name;?>
                                    <input type="checkbox" class="d-none addon_category" name="addon_category[]" value="<?php echo $pc->id;?>">
                                </td>
                                <td style="width:50px; color:green;" class="choice"></td>
                            </tr>
                            <?php endforeach;?>
                        </tbody>
                    </table>
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
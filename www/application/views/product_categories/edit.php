<form id="save_productcategories" role="form" action="<?php echo base_url('product_categories/save/'); ?>" method="post" enctype="multipart/form-data">
    <input type="hidden" id="uuid" name="uuid" value="<?php echo $product_category[0]->uuid;?>">
    <div class="panel panel-info">
        <div class="panel-body">
            <div class="row">
                <div class="col-md-3">
                    <div class="form-group">
                        <label>Category Name</label>
                        <input type="text" class="form-control required onFocusInput" name="name" id="name" autofocus placeholder="" value="<?php echo $product_category[0]->name;?>">
                        <p class="help-block onFocusNotes">Please enter Category Name.</p>
                    </div>  
                    <div class="form-group">
                        <label for="">Display Order</label>
                        <input type="number" name="display_order" class="form-control" value="<?php echo $product_category[0]->display_order;?>" step='1' min='1'>
                    </div>  
                </div>
            </div>
            <div class="row" id="image-block">
                <input type="hidden" name="deleted_image" value="">
                <?php if(!empty($product_category[0]->photo)):?>
                <div class="col-md-2" data-id="<?php echo $product_category[0]->id;?>">
                    <img src="<?php echo base_url("uploads/product_categories/".$product_category[0]->photo);?>" alt="ddd" class="img-responsive img-thumbnail">
                    <div class='delete-image' style='position:absolute;top:0;right:20px;color:#ff0000;'><i class="fa fa-times"></i></div>
                </div>
                <?php endif;?>
            </div>
            <div id='upload_photo' class="row <?php echo (!empty($product_category[0]->photo))?'hidden':'';?>">
                <div class="form-group col-md-12">
                    <label>Photo</label>
                    <div class="row">
                        <div class="col-md-3">
                            <input type="file" accept="image/*" name="photo[]" value="">
                        </div>
                    </div>
                </div>
            </div>
        </div>
   </div>
        <div class="panel-body">
            <div class="col-md-2">
                <button type="submit"  class="btn btn-primary btn-block">Save</button>
            </div>
        </div> 
    </div>
</form>
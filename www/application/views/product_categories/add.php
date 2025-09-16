<form id="save_productcategories" role="form" action="<?php echo base_url('product_categories/save/'); ?>" method="post" enctype="multipart/form-data">
    <input type="hidden" id="uuid" name="uuid" value="">
    <div class="panel panel-info">
        <div class="panel-body">
            <div class="col-md-3">
                <div class="form-group">
                    <label>Category Name</label>
                    <input type="text" class="form-control required onFocusInput" name="name" id="name" autofocus placeholder="" value="">
                    <p class="help-block onFocusNotes">Please enter Category Name.</p>
                </div>  
                <div class="form-group">
                    <label for="display_order">Display Order</label>
                    <input type="number" class="form-control" name="display_order" min="1" step="1" value="">
                </div>
                <div class="row">
                    <div class="col-md-3">
                        <input type="file" accept="image/*" name="photo[]" value="">
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
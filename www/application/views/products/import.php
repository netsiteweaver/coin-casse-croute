<form id="import_regions" role="form" action="<?php echo base_url('products/upload'); ?>" method="post" enctype="multipart/form-data">
    <div class="panel panel-info">
        <div id="message" class="panel-body hidden">
            <div class="col-md-3">
                <p class="red">Please select file for uploading before proceeding</p>
            </div>
        </div>
        <div class="panel-body">
            <div class="col-md-6">
                <div class="form-group">
                    <label for="">Please select file for uploading</label>
                    <p class="red">Please upload a csv file to import products. The image give you a clear idea of the columns needed for a proper import. Failure to do so will result in your database being damaged and not workable.</p>
                    <img src="./assets/images/product-import-sample.png" style="width:100%;">
                    <br><br>
                    <input type="file" name="products" id="" accept=".csv">
                </div>
            </div>
        </div>
        
        <div class="panel-body">
            <a href='<?php echo base_url('regions/listing');?>'><div class="btn btn-warning"><i class="fa fa-chevron-left"></i> Listing</div></a>
            <button type="submit" class="btn btn-primary"><i class="fa fa-save"></i> Save</button>
        </div>
    </div>
</form>
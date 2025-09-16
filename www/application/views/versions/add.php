<form role="form" action="<?php echo base_url('versions/save/'); ?>" method="post" enctype="multipart/form-data">

    <div class="panel panel-info">
        <div class="panel-heading">Vehicle Information</div>
        <div class="panel-body" id="vehicle_information_block">
            <div class="row">
                <div class="col-md-3">        
                    <div class="form-group">
                        <label>Select Sub Model</label>
                        <select name="submodel" id="onchangesubmodel" class="form-control required" autofocus>
                            <option value="" selected>Select</option>
                            <?php foreach($submodels as $submodel):?>
                            <option value="<?php echo $submodel->id;?>"><?php echo "{$submodel->model} &gt; {$submodel->sub_model}";?></option>
                            <?php endforeach;?>
                        </select>
                    </div>
                </div>
                
                <div class="col-md-3">        
                    <div class="form-group">
                        <label>Vehicle Category</label>
                        <select name="category_id"  class="form-control required">
                            <option value="" selected>Select</option>
                            <?php foreach($vehiclecats as $vehiclecat):?>
                            <option value="<?php echo $vehiclecat->id;?>"><?php echo $vehiclecat->label;?></option>
                            <?php endforeach;?>
                        </select>
                    </div>
                </div>
            
                <div class="col-md-3">
                    <div class="form-group">
                        <label>Title</label>
                        <input type="text" class="form-control required" name="title" placeholder="" value="">
                        <p class="help-block onFocusNotes">Please enter Title.</p>
                    </div>    
                </div>

                <div class="col-md-3">
                    <div class="form-group">
                        <label>Brand</label>
                        <select class="form-control" name="vehicle_brand" id="vehicle_brand">
                            <option value="combustion_engine">Combustion Engine</option>
                            <option value="plugin_hybrid">Plugin Hybrid</option>
                            <option value="electric">100% Electric</option>
                            <option value="amg">AMG</option>
                        </select>
                    </div>  
                </div>

        </div>
    </div>

    <div class="panel panel-default"> <!-- Thumbnail -->
        <div class="panel-heading">Thumbnail</div>
        <div class="panel-body">
            <div class="row">
                <div class="col-md-12">
                    <p class="notes">For best result, please choose an image with a white background</p>
                </div>
            </div>
            <div class="row">
                <div class="col-md-4">
                    
                    <img id="preview" src="" style="height:75px;">
                </div>  
            </div> 
            <div class="row">
                <div class="col-md-3">
                    <input type="file"   name="thumbnail" value="" onchange="showPreview(event)">
                </div>
            </div>
        </div>
    </div>

    <div class="panel panel-default"> <!-- BLOCKS -->
        <div class="panel-heading">Blocks</div>
        <div class="panel-body">
        <div class="input-group block-container">
            <div class="col-md-8">Block</div>
            <div class="col-md-2">Order</div>
            <div class="col-md-2">&nbsp;</div>
            
            <div class="block-group proto hidden">
                <input type="hidden" name="page_block_id[]" value="">
                <div class="col-md-7">
                    <select name="block_id[]" id="" class="form-control">
                        <option value="">Select Block</option>
                        <?php foreach($blocks as $blk):?>
                        <option value="<?php echo $blk->id;?>"><?php echo $blk->name;?></option>
                        <?php endforeach;?>
                    </select>
                </div>
                <div class="col-md-3">
                    <input type="number" class="form-control block_order text-center" name="block_order[]" step='10' min='10' value="">
                </div>
                <!-- <div class="col-md-1">
                    <div class="btn btn-flat btn-sm bg-purple edit-block"><i class="fas fa-edit"></i></div>
                </div> -->
                <div class="col-md-1">
                    <div class="btn btn-flat btn-sm btn-danger delete-block"><i class="fa fa-trash"></i></div>
                </div>
            </div>

            <div class="block-group">
                <input type="hidden" name="page_block_id[]" value="">
                <div class="col-md-7">
                    <select name="block_id[]" id="" class="form-control">
                        <option value="">Select Block</option>
                        <?php foreach($blocks as $blk):?>
                        <option value="<?php echo $blk->id;?>"><?php echo $blk->name;?></option>
                        <?php endforeach;?>
                    </select>
                </div>
                <div class="col-md-3">
                    <input type="number" class="form-control block_order text-center" name="block_order[]" step='10' min='10' value="">
                </div>
                <!-- <div class="col-md-1">
                    <div class="btn btn-flat btn-sm bg-purple edit-block"><i class="fas fa-edit"></i></div>
                </div> -->
                <div class="col-md-1">
                    <div class="btn btn-flat btn-sm btn-danger delete-block"><i class="fa fa-trash"></i></div>
                </div>
            </div>
            
            <div class="col-sm-12">
                <div class="btn btn-sm btn-flat bg-purple add-block"><i class="fa fa-plus-square"></i> Add Block</div>
            </div>
            
        </div>
        </div>
    </div>

        

            <div class="col-md-2">
                <button type="submit" class="btn btn-primary btn-block">Save</button>
            </div>
                            </form>
        </div>
    </div>
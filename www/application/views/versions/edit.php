<form role="form" action="<?php echo base_url('versions/update/'); ?>" method="post" enctype="multipart/form-data">
<div class="panel panel-info">
    <div class="panel-heading">Vehicle Information</div>
    <div class="panel-body" id="vehicle_information_block">
           
        <input type="hidden" name="id" value="<?php echo $versions->id; ?>">
        <div class="col-md-3">        
            <div class="form-group">
                <label>Select Sub Models</label>
                <select name="submodel" id="onchangesubmodel" class="form-control required">
                    <option value="" selected>Select</option>
                    <?php foreach($submodels as $submodel):?>
                    <option value="<?php echo $submodel->id;?>" <?php echo($submodel->id==$versions->sub_model_id)?'selected':'';?>><?php echo "{$submodel->model} &gt; {$submodel->sub_model}";?></option>
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
                    <option value="<?php echo $vehiclecat->id;?>" <?php echo($vehiclecat->id==$versions->category_id)?'selected':'';?>><?php echo $vehiclecat->label;?></option>

                    <?php endforeach;?>
                </select>

            </div>
        </div>
        <div class="col-md-3">
            <div class="form-group">
                <label>Title</label>
                <input type="text" class="form-control required onFocusInput" name="title" autofocus placeholder="" value="<?php echo $versions->title; ?>">
                <p class="help-block onFocusNotes">Please enter Title.</p>
            </div>    
        </div>
        <div class="col-md-3">
            <div class="form-group">
                <label>Brand</label>
                <select class="form-control" name="vehicle_brand" id="vehicle_brand">
                    <option value="combustion_engine" <?php echo ($versions->vehicle_brand=='')?'selected':'combustion_engine';?>>Combustion Engine</option>
                    <option value="plugin_hybrid" <?php echo ($versions->vehicle_brand=='plugin_hybrid')?'selected':'';?>>Plugin Hybrid</option>
                    <option value="electric" <?php echo ($versions->vehicle_brand=='electric')?'selected':'';?>>100% Electric</option>
                    <option value="amg" <?php echo ($versions->vehicle_brand=='amg')?'selected':'';?>>AMG</option>
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
                    <img id="preview" src="<?php echo base_url('../uploads/vehicles/versions/'.$versions->thumbnail);?>" onerror="this.src='../../assets/images/image-placeholder-500x500.jpg'" style="height:75px;">
                </div>  
            </div> 
            <div class="row">
                <div class="col-md-3">
                    <input type="file"  name="thumbnail" value="" onchange="showPreview(event)">
                </div>
            </div>
        </div>
    </div>

    <div class="panel panel-default"> <!-- Brochure -->
        <div class="panel-heading">Brochure</div>
        <div class="panel-body">
            <div class="row">
                <div class="col-md-12 <?php echo (empty($versions->brochure))?'hidden':'';?>">
                    <?php echo $versions->brochure;?> <i style="color:#4c4c4c;" class="fa fa-download cursor-pointer" id="download_brochure" data-filename="<?php echo $versions->brochure;?>" title="Download Brochure"></i> <i style="color:#d73925;" class="pull-right fa fa-trash cursor-pointer" id="remove_brochure"></i>
                </div>
                
                <div class="col-md-12 <?php echo (!empty($versions->brochure))?'hidden':'';?>">
                    <p class="notes">Please upload a brochure in PDF format, not exceeding 50MB.</p>
                    <input type="file" name="brochure" value="" accept="application/pdf">
                </div>
                <div class="col-md-4">
                    <input type="text" name="label" class='form-control' placeholder="Enter a Label for Brochure (max 50 chars)" maxlength='50' value="<?php echo $versions->label;?>">
                    <p class="notes">This label will be used in the email sent to clients instead of the filename or the model selected.<br>Duplicate labels for a specific model will be automatically omitted in the email.</p>
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
                <input type="hidden" name="deletedBlocks" value="[]">
                <?php if(count($versions->blocks)==0):?>
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
                <?php endif;?>
                <?php foreach($versions->blocks as $block):?>
                <div class='block-group' data-page-block-id="<?php echo $block->pid;?>">
                    <input type="hidden" class="page_block_id" name="page_block_id[]" value="<?php echo $block->pid;?>">
                    <div class="col-md-7">
                        <select name="block_id[]" id="" class="form-control">
                            <option value="">Select Block</option>
                            <?php foreach($blocks as $blk):?>
                            <option value="<?php echo $blk->id;?>" <?php echo ($blk->id == $block->bid)?'selected':'';?>><?php echo $blk->name;?></option>
                            <?php endforeach;?>
                        </select>
                    </div>
                    <div class="col-md-3">
                        <input type="number" class="form-control block_order text-center" name="block_order[]" step='10' min='10' value="<?php echo $block->block_order;?>">
                    </div>
                    <div class="col-md-1">
                        <div class="btn btn-flat btn-sm bg-purple edit-block"><i class="fas fa-edit"></i></div>
                    </div>
                    <div class="col-md-1">
                        <div class="btn btn-flat btn-sm btn-danger delete-block"><i class="fa fa-trash"></i></div>
                    </div>
                </div>
                <?php endforeach;?>
                <div class="col-sm-12">
                    <div class="btn btn-sm btn-flat bg-purple add-block"><i class="fa fa-plus-square"></i> Add Block</div>
                </div>
                
            </div>
        </div>
</div>


<div class="panel-body">
    <div class="col-md-2">
        <button type="submit" class="btn btn-primary btn-block">Update</button>
        
    </div>
</div>
        
</form>

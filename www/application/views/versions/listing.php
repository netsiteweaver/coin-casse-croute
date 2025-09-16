<?php if($perms['add']): ?>
<div class="row">
    <div class="col-xs-1">
        <a href="<?php echo base_url("versions/add"); ?>"><button class="btn btn-xs btn-flat btn-success"><i class="fa fa-plus"></i> Add</button></a>
    </div>
    <div class="col-md-6 pull-right text-right">
        <label for="enable_sorting">
        <input type="checkbox" id='enable_sorting'> Enable to Drag rows vertically to re-order
        </label>
    </div>
</div>
<?php endif; ?>
<div class="row">
    <div class="col-md-4">
        <input type="search" class="form-control" placeholder="TYPE TEXT TO SEARCH" id='searchText' autofocus>
    </div>
</div>
<div class="row">
    <div class="col-xs-12 col-sm-12">
        <div class="box">
        <?php if( (isset($versions)) && (!empty($versions))): ?>
            <div class="box-body table-responsive no-padding">
                <table id="versions" class="table">
                    <thead>
                        <tr>
                            <th>Title</th>
                            <th>Sub Model</th>
                            <th>Model</th>
                            <th>Category</th>
                            <th>Brand</th>
                            <th>Thumbnail</th>
                            <th>Brochure</th>
                            <th>Display Order</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach($versions as $version): ?>
                        <tr data-id="<?php echo $version->id;?>">
                            <td><?php echo $version->title; ?></td>
                            <td><?php echo $version->sub_model; ?></td>
                            <td><?php echo $version->model; ?></td>
                            <td><?php echo $version->category; ?></td>
                            <td class='text-center'><?php 
                            switch($version->vehicle_brand){
                                case "combustion_engine":
                                    echo "Combustion Engine";
                                    break;
                                case "plugin_hybrid":
                                    echo "Plugin Hybrid";
                                    break;
                                case "electric":
                                    echo "100% Electric";
                                    break;
                                case "amg":
                                    echo "AMG";
                                    break;
                            }
                            ?></td>
                            <td style='width:20%' class='text-center'>
                            <?php //if(!empty($version->thumbnail)):?>
                                <img src="<?php echo base_url('../uploads/vehicles/versions/'.$version->thumbnail); ?>" alt="" onerror="this.src='../assets/images/image-placeholder-500x500.jpg'" height="50px">
                            <?php //endif;?>
                            </td>
                            <td class='text-center' title="<?php echo $version->brochure;?>"><?php echo (!empty($version->brochure))?'<i style="color:#00a65a;" class="fa fa-check fa-2x"></i>':'<i style="color:#d73925;" class="fa fa-times fa-2x"></i>';?></td>
                            <td class='display_order'><?php echo $version->display_order;?></td>

                                <td>
                                <?php if($perms['edit']): ?>
                                <a href="<?php echo base_url("versions/edit/".$version->uuid); ?>"><button class="btn btn-primary"><i class="glyphicon glyphicon-pencil"></i> Edit</button></a>
                                <?php endif; ?>
                                <?php if($perms['delete']) DeleteButton2('versions','uuid',$version->uuid); ?>
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

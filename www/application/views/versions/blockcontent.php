<div class="row">
    <div class="col-md-6">
        <!-- <form action="<?php //echo base_url('pages/updateblockcontent');?>" method="post"> -->
        <input type='hidden' name="id" value="<?php echo $result->id;?>">
        <div class="row">
            <div class="col-md-12">
                <h3>Block Name: <?php echo $result->block_name;?></h3>
            </div>
        </div>
        <div class="row">
            <div class="col-md-12">
                <div class="btn btn-flat btn-sm <?php echo (!empty($result->query))?'btn-info':'btn-default';?>" id="query">Query</div>
                <div class="btn btn-flat btn-sm <?php echo (empty($result->query))?'btn-info':'btn-default';?>" id="form">Form</div>
            </div>
        </div>

        <div id='form-block' class='<?php echo (!empty($result->query))?'hidden':'';?>'>
            <ul class="nav nav-tabs">
            <?php foreach($languages as $i => $l):?>
                <li class="<?php echo($i==0)?'active':'';?>"><a data-toggle="tab" href="#tab_<?php echo $l->abbr;?>"><?php echo $l->name;?></a></li>
            <?php endforeach;?>
            </ul>   
            
            <div class="tab-content">
                <?php foreach($languages as $i => $l):?>
                <div id="tab_<?php echo $l->abbr;?>" class="tab-pane <?php echo($i==0)?'in fade active':'';?>">
                    <form action="<?php echo base_url('versions/updateblockcontent');?>" method="POST" enctype="multipart/form-data">
                    <input type='hidden' name="id" value="<?php echo $result->id;?>">
                    <input type='hidden' name="language" value="<?php echo $l->abbr;?>">

                        <?php blockContentEditor($result,$l,"vehicles/versions");?>
                    
                        <div class="form-group">
                            <button class="btn btn-flat btn-sm btn-info"><i class="fa fa-save"></i> Update <?php echo $l->name;?></button>
                            <button class="btn btn-flat btn-sm btn-primary" onclick="window.close()"><i class="fa fa-times"></i> Close</button>
                        </div>
                    </form>
                </div>
                <?php endforeach;?>
            </div>
        </div>

        <form action="<?php echo base_url('versions/updateblockcontent');?>" method="post">
            <input type='hidden' name="id" value="<?php echo $result->id;?>">
            <div id='query-block' class='<?php echo (!empty($result->query))?'':'hidden';?>'>
                <div class="row">
                    <div class="col-md-12">
                        <div class="form-group">
                            <label for="">Query</label>
                            <textarea name="query" rows="3" class="form-control"><?php echo $result->query;?></textarea>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-6">
                        <button class="btn btn-flat btn-sm btn-info"><i class="fa fa-save"></i> Update</button>
                    </div>
                </div>
            </div>
        </form>
    </div>
</div>
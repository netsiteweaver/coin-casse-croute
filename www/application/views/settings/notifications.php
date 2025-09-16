<div class="row">
    <div class="col-xs-12">
        <div class="box box-primary">
            <h3>Define who will receive notifications at each Stage</h3>
            <p>Orders change stage throughout its lifecycle. The system allows you to notify specific users when it changes from stage to another by sending an email each time.</p>
            <form id="form" role="form" action="<?php echo base_url('settings/updatenotifications'); ?>" method="post">
                <div class="box-body">
                    <div class="row">
                        <div class="col-md-12">
                            <nav>
                                <div class="nav nav-tabs" id="nav-tab" role="tablist">
                                <?php foreach($stages as $i => $stage):?>
                                    <a class="nav-item nav-link <?php echo ($i==0)?'active':'';?>" id="nav-rows_per_page-tab" data-toggle="tab" href="#nav-<?php echo strtolower(str_replace(' ','_',($stage->name)));?>" role="tab" aria-controls="nav-home" aria-selected="true"><?php echo $stage->name; ?></a>
                                <?php endforeach;?>
                                </div>
                            </nav>
                            <div class="tab-content" id="nav-tabContent">
                                <?php foreach($stages as $j => $stage):?>
                                <div class="tab-pane fade show <?php echo ($j==0)?'active':'';?>" id="nav-<?php echo strtolower(str_replace(' ','_',($stage->name)));?>" role="tabpanel" aria-labelledby="nav-<?php echo strtolower(str_replace(' ','_',($stage->name)));?>-tab">
                                    <div class="row">
                                        <div class="col-md-4">
                                            <table id="<?php echo $stage->id;?>" class="table table-bordered process">
                                            <?php foreach ($users as $user):?>
                                                <tr data-stage='<?php echo $stage->id;?>' data-user='<?php echo $user->id;?>'>
                                                    <td>
                                                        <?php if(!empty($user->photo)):?>
                                                        <img src="<?php echo base_url("uploads/users/".$user->photo);?>" alt=""  class="img-circle elevation-2" style="width:50px;">
                                                        <?php else:?>
                                                            <img src="<?php echo base_url("assets/images/photo-placeholder.webp");?>" alt=""  class="img-circle elevation-2" style="width:50px;">
                                                        <?php endif;?>
                                                    </td>
                                                    <td><?php echo $user->name;?></td>
                                                    <td><?php echo $user->email;?></td>
                                                    <td><?php echo $user->user_level;?></td>
                                                    <td>
                                                        <input type="checkbox" class='pull-right' name="<?php echo $stage->id.'_'.$user->id;?>" 
                                                        <?php echo isset($notifications[$stage->id][$user->id]) ? 'checked' : '';?>
                                                        >
                                                    </td>
                                                </tr>
                                            <?php endforeach;?>
                                            </table>
                                        </div>
                                    </div>
                                </div>
                                <?php endforeach;?>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-2">
                            <div class="btn btn-info" id="update"><i class="fa fa-save"></i> Update</div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
        <div class="row dashboard-widgets">
        <?php foreach($orders as $i => $order):?>
          <div class="col-sm-6 col-lg-3">
            <!-- small box -->
            <div class="small-box <?php echo $stage_classes[$i];?>">
              <div class="inner">
                <h3><?php echo $order->mode;?></h3>
                <p><?php echo $order->name;?></p>
              </div>
              <div class="icon <?php echo (!empty($order->image))?'':'d-none';?>">
                <img src="<?php echo base_url();?>uploads/stages/<?php echo $order->image;?>" alt="" style='width:64px;height:64px;'>
              </div>
              <a href="<?php echo base_url("orders/listing?stage=".urlencode($order->id));?>" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
            </div>
          </div>
        <?php endforeach;?>
        </div>
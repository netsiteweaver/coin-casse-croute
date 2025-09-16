<style>
    .searchable.searching::after{
        content:"\f002";
        font-size: 14px/1;
        font-family: FontAwesome;
        float:right;
    }
</style>
<?php if($perms['add']): ?>
<div class="row">
    <!-- <div class="col-xs-1" style='margin-top:25px;'>
        <a href="<?php echo base_url("orders/add"); ?>"><div class="btn btn-xs btn-flat btn-success"><i class="fa fa-plus"></i> Add</div></a>
    </div> -->
    <div class="col-xs-1" style='margin-top:20px;'>
        <a href="<?php echo base_url("orders/add"); ?>"><button type="button" class="btn btn-success"><i class="fa fa-plus"></i> Add</button></a>
    </div>
    <div class="col-xs-6 col-sm-4 col-md-3">
        <label for="">Date Range</label>
        <div class="input-group">
            <input type="text" class="form-control daterange" name="daterange" id="">
            <span class="input-group-text"><i class="fa fa-calendar"></i></span>
        </div>
    </div>
    <div class="col-xs-2">
        <label for="">Display</label>
        <select class="form-control" name="" id="rpp">
            <option value="">Select</option>
            <option value="10" <?php echo ( (empty($this->input->get('display'))) || ($this->input->get("display") == 10) ) ? 'selected':'';?>>10 rows</option>
            <option value="25" <?php echo ($this->input->get("display") == 25) ? 'selected':'';?>>25 rows</option>
            <option value="50" <?php echo ($this->input->get("display") == 50) ? 'selected':'';?>>50 rows</option>
            <option value="100" <?php echo ($this->input->get("display") == 100) ? 'selected':'';?>>100 rows</option>
        </select>
    </div>
    <div class="col-xs-6 col-sm-4 col-md-2">
        <label for="">Search <i class="fa fa-search"></i></label>
        <div class="input-group">
            <input type="search" id="search_text" class="form-control" placeholder="Search Order" value="<?php echo $this->input->get("search_text");?>">
            <div class="input-group-text clear-search cursor-pointer"><i class="fa fa-times"></i></div>
        </div>
    </div>
    <div class="col-xs-6 col-sm-4 col-md-2" style='margin-top:20px;'>
        <div class="btn btn-md btn-flat btn-info btn-block" id="apply-filter"><i class="fa fa-check"></i> Apply</div>
    </div>
</div>
<?php endif; ?>
<div class="row">
    <div class="col-xs-12 col-sm-12">
        <div class="box">
        <?php if( (isset($orders)) && (!empty($orders)) ): ?>
            <div class="box-body table-responsive no-padding">
                <table id="orders_listing" class="table table-not-striped">                    
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Order Date</th>
                            <th class='searchable' title="This column is included in search">Order No.</th>
                            <th class='searchable' title="This column is included in search">Customer</th>
                            <th>Amount</th>
                            <?php if($_SESSION['user_level'] != 'Normal'):?>
                            <th>Agent</th>
                            <?php endif;?>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach($orders as $i => $order): ?>
                        <tr class="text-center <?php echo ($order->status=='0')?'deleted':'';?>" data-id="<?php echo $order->uuid;?>">
                            <td><?php echo $i+1;?></td>
                            <td><?php echo date_format(date_create($order->order_date),'Y-m-d'); ?></td>
                            <td><?php echo $order->document_number;?></td>
                            <?php if($order->customer_id == null):?>
                            <td>WALK IN</td>
                            <?php else:?>
                            <td><?php echo $order->first_name. '<br>'.$order->last_name."</a>"; ?></td>
                            <?php endif;?>
                            <td><?php echo number_format($order->amount,0) ;?></td>
                            <?php if($_SESSION['user_level'] != 'Normal'):?>
                            <td><?php echo $order->agent;?></td>
                            <?php endif;?>
                            <td>
                                <?php if($perms['view']):?>
                                    <?php if($perms['edit']):?>
                                    <!-- <a href="<?php echo base_url("orders/edit/".$order->uuid);?>"><div class="btn btn-info"><i class="fa fa-edit"></i></div></a> -->
                                    <?php endif;?>
                                    <a href="<?php echo base_url("orders/receipt/".$order->uuid);?>"><div class="btn btn-default"><i class="fa fa-file"></i> View</div></a>
                                    <a href="<?php echo base_url("orders/receipt/".$order->uuid."?print");?>"><div class="btn bg-purple"><i class="fa fa-print"></i> Print</div></a>
                                <?php endif;?>
                                <?php if($perms['delete']) echo DeleteButton('orders/delete/','uuid',$order->uuid); ?>

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
<div class="row">
    <div class="col-md-12">
        <?php echo $pagination;?> 
    </div>
</div>
<div class="row d-none">
    <div class="col-xs-12">
        <?php echo "Displaying " . count($orders) . " of $total_records records";?>
    </div>
</div>

<!-- Vue mount point: only for Orders listing page -->
<div id="orders-app" class="card card-outline card-info" style="margin-top: 15px;">
    <div class="card-header">
        <h3 class="card-title">Orders Tools (Vue)</h3>
    </div>
    <div class="card-body">
        <div class="row">
            <div class="col-sm-6">
                <div class="form-group">
                    <label for="ordersQuickFilter">Quick filter (client-side, instant)</label>
                    <input id="ordersQuickFilter" type="text" v-model="q" class="form-control" placeholder="Type to filter visible rows...">
                </div>
            </div>
            <div class="col-sm-6">
                <div class="mt-4">
                    <span class="badge badge-info" style="font-size: 100%;">Showing {{ shown }} of {{ total }} rows</span>
                </div>
            </div>
        </div>
    </div>
    <!-- Keep totals accessible if needed in the future -->
    <div class="d-none" data-total-records="<?php echo isset($total_records)?$total_records:0; ?>"></div>
    <!-- /card-body -->
    
</div>

<!-- Vue 3 via CDN, loaded only on this view -->
<script src="https://unpkg.com/vue@3/dist/vue.global.prod.js"></script>
<script>
(function(){
    if(typeof Vue === 'undefined'){ return; }
    const { createApp, ref, watch } = Vue;
    const mountSelector = '#orders-app';
    if(!document.querySelector(mountSelector)) return;

    createApp({
        setup(){
            const q = ref('');
            const rows = Array.prototype.slice.call(document.querySelectorAll('#orders_listing tbody tr'));
            const total = ref(rows.length);
            const shown = ref(rows.length);

            function applyFilter(value){
                if(!rows.length){ shown.value = 0; return; }
                if(!value){
                    rows.forEach(function(row){ row.style.display = ''; });
                    shown.value = rows.length;
                    return;
                }
                var lc = value.toLowerCase();
                var count = 0;
                rows.forEach(function(row){
                    var text = (row.textContent || '').toLowerCase();
                    var match = text.indexOf(lc) !== -1;
                    row.style.display = match ? '' : 'none';
                    if(match) count++;
                });
                shown.value = count;
            }

            watch(q, function(newVal){ applyFilter(newVal); }, { immediate: true });

            return { q, total, shown };
        }
    }).mount(mountSelector);
})();
</script>

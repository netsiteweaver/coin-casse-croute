<style>
  #modal-client-overlay{
    position:absolute;
    width:97%;
    height:100%;
    background-color:#000;
    z-index:10000;
    opacity:0.9;
  }
  #modal-client-overlay p{
    font-size:2em;
    color:#fff;
    margin-top:100px;
    text-align:center;
  }
</style>
<div class="row"><div class="col-xs-12"><h3>Order No.: <?php echo $order->document_number;?></h3></div></div>
<div class="row">
    <div class="col-md-6 col-xs-9">
      <h3 data-toggle='collapse' data-target='#customer_info'>Customer Info</h3>
      <input type="hidden" id="uuid" value="<?php echo $order->uuid;?>">
      <input type="hidden" id="customer_id" value="<?php echo $order->customer_id;?>">
      <input type="hidden" id="product_id" value="<?php echo $order->rows[0]->product_id;?>">
      <input type="hidden" id="measurements" value='<?php echo $order->rows[0]->measurements;?>'>
      <div class='collapse in' id="customer_info">
        <table class="table table-bordered">
        <tr>
            <td>Order Date:</td>
            <td><?php echo date_format(date_create($order->order_date),'Y-m-d');?></td>
          </tr>
          <tr>
            <td>Customer Code:</td>
            <td><?php echo $order->customer->customer_code;?></td>
          </tr>
          <tr>
            <td>Name</td>
            <td><?php echo "{$order->customer->title} {$order->customer->last_name} {$order->customer->first_name}";?></td>
          </tr>
          <tr>
            <td>Address</td>
            <td><?php echo $order->customer->address;?></td>
          </tr>
          <tr>
            <td>Phone</td>
            <td><?php echo $order->customer->phone_number1.', '.$order->customer->phone_number2;?></td>
          </tr>
          <tr>
            <td>Nationality</td>
            <td><?php echo $order->customer->nationality;?></td>
          </tr>
          <tr>
            <td>Fidelity</td>
            <td><?php echo $order->customer->fidelity_card;?></td>
          </tr>
          <tr>
            <td>Discount</td>
            <td><?php echo $order->customer->discount;?>%</td>
          </tr>
        </table>
      </div>
      <h3 data-toggle='collapse' data-target='#item_details'>Item Details</h3>
      <div class='collapse in' id="item_details">
        <table class="table table-bordered">
          <tbody>
            <tr>
              <td>Item Code</td>
              <td class=''>
                <input type="text" class='form-control itemcode' tabindex='-1' value="<?php echo $order->rows[0]->productStockRef;?>" readonly>
              </td>
            </tr>
            <tr>
              <td>Description</td>
              <td class=''>
                <input type="text" class='form-control description' tabindex='-1' value="<?php echo $order->rows[0]->productDescription;?>" readonly>
              </td>
            </tr>
            <tr>
              <td>Unit Price</td>
              <td class=''>
                <input id="price" type="text" class='form-control price text-right' tabindex='-1' value="<?php echo $order->rows[0]->price;?>" readonly>
              </td>
            </tr>
            <tr>
              <td>Quantity</td>
              <td class=''>
                <input id="quantity" type="number" class='form-control quantity' min='1' value="<?php echo $order->rows[0]->quantity;?>">
              </td>
            </tr>
            <tr>
              <td>Amount</td>
              <td class=''>
                <input id="amount" type="text" class='form-control amount text-right' tabindex='-1' value="<?php echo number_format(floatval($order->rows[0]->price) * floatval($order->rows[0]->quantity),0);?>" readonly>
              </td>
            </tr>
            <tr>
              <td>Discount %</td>
              <td class=''>
                <input type="text" class='form-control discount text-right' tabindex='-1' value="<?php echo $order->discount;?>" readonly>
              </td>
            </tr>
            <tr>
              <td>Discount Amount</td>
              <td class=''>
                <input id="discount" type="text" class='form-control discountamount text-right' tabindex='-1' value="<?php echo $order->amount * $order->discount / 100;?>" readonly>
              </td>
            </tr>
            <tr>
              <td>Net Amount</td>
              <td class=''>
                <input type="text" class='form-control netamount text-right' tabindex='-1' value="<?php echo $order->amount - ($order->amount * $order->discount / 100);?>" readonly>
              </td>
            </tr>
            <tr>
              <td>Deposit</td>
              <td class=''>
                <div class="input-group">
                  <input id="deposit" type="number" class='form-control deposit text-right' min='0' value="<?php echo $order->deposit;?>">
                  <div class="input-group-addon"><i class="fa fa-check"></i></div>
                </div>
                
              </td>
            </tr>
            <tr>
              <td>Balance</td>
              <td class=''>
                <input type="text" class='form-control balance text-right' tabindex='-1' value="0<?php echo $order->amount - $order->deposit;?>" readonly>
              </td>
            </tr>
          </tbody>
          
        </table>
      </div>
      <h3 data-toggle='collapse' data-target='#order_details'>Order Details</h3>
      <div class='collapse in' id='order_details'>
        <table class="table table-bordered">
          <tr>
            <td>Delivery Date</td>
            <td><input id="delivery_date" type="date" class='form-control' value="<?php echo date_format(date_create($order->delivery_datetime),'Y-m-d');?>"></td>
          </tr>
          <tr>
            <td>Delivery Time</td>
            <td><input id="delivery_time" type="time" class='form-control' value="<?php echo date_format(date_create($order->delivery_datetime),'H:i');?>"></td>
          </tr>
          <tr>
            <td>Delivery Store</td>
            <td>
              <select name="" id="delivery_store" class="form-control">
                <option value="">Select</option>
                <?php foreach($departments as $d):?>
                <option value="<?php echo $d->id;?>" <?php echo ($d->id == $order->delivery_store_id)?'selected':'';?>><?php echo $d->name;?></option>
                <?php endforeach;?>
              </select>
            </td>
          </tr>
          <tr>
            <td></td>
            <td></td>
          </tr>
          <tr>
            <td></td>
            <td></td>
          </tr>
          <tr>
            <td></td>
            <td></td>
          </tr>
        </table>
      </div>
    </div>
    <div class="col-md-4">
      <h3>Customer History</h3>
      <div id="customer_history">
        <table class="table">
          <thead>
            <tr>
              <th>DATE</th>
              <th>NUMBER</th>
              <th>PRODUCT</th>
              <th>AMOUNT</th>
              <th>STAGE</th>
            </tr>
          </thead>
          <tbody>
            <?php foreach($history as $order):?>
            <tr class='text-center'>
              <td><?php echo date_format(date_create($order->order_date),'Y-m-d');?></td>
              <td><?php echo $order->document_number;?></td>
              <td><?php echo $order->productName;?></td>
              <td><?php echo number_format(floatval($order->amount) - floatval($order->discount));?></td>
              <td><?php echo $order->stageName;?></td>
            </tr>
            <?php endforeach;?>
          </tbody>
        </table>
      </div>
    </div>
    <div class="col-md-2">
      <div id='process1' class="btn btn-success btn-block process" data-step='1'><img src="../../../www/assets/images/svg/user-plus-svgrepo-com.svg" alt="client"> Select Client </div>
      <div id='process2' class="btn btn-success btn-block process" data-step='2'><img src="../../../www/assets/images/svg/product-workspace-svgrepo-com.svg" alt=""> Select Product </div>
      <div id='process3' class="btn btn-success btn-block process" data-step='3'><img src="../../../www/assets/images/svg/product-workspace-svgrepo-com.svg" alt=""> Enter Measurements </div>
      <div id='process5' class="btn btn-success btn-block process" data-step='5'><img src="../../../www/assets/images/svg/photo-svgrepo-com.svg" alt=""> Photos </div>
      <div id='process4' class="btn btn-success btn-block process" data-step='4'><img src="../../../www/assets/images/svg/cart-arrow-down-svgrepo-com.svg" alt=""> Update Order </div>

      <hr>
      <div class="row col-xs-12" id="message-box"></div>
    </div>

    </div>

    
</div>

<!-- Modal Select Client -->
<div class="modal fade" id="modalSelectClient" tabindex="-1" role="dialog" aria-labelledby="add-user-title" aria-hidden="true">
  <div class="modal-dialog modal-lg" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title"><i class="fa fa-user"></i> Select Customer</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body" id='content'>
        
        <div class="row">
          <div class="col-md-12">
            <div class="row">
              <div class="col-md-8">
                <input type="text" class="form-control" placeholder="Enter at least 2 characters to start searching" id="modalSearchClients">
              </div>
              <div class="col-md-4">
                <div class="btn btn-info pull-right" id="addClient" data-toggle="modal" data-target="#modalAddClient"><i class="fa fa-user"></i> Add Customer</div>
              </div>
            </div>
            <div class="row">
              <div class="col-md-12">
                <!-- <div id="modal-client-overlay" class="hidden"><p>Please wait ...</p></div> -->
                <table id="select_customer" class="table table-bordered">
                  <thead>
                    <tr>
                      <th>CODE</th>
                      <th>NAME</th>
                      <th>NATIONALITY</th>
                      <th>FIDELITY</th>
                      <th>ADDRESS</th>
                      <th>PHONE 1</th>
                      <th>PHONE 2</th>
                      <th>&nbsp;</th>
                    </tr>
                  </thead>
                  <tbody></tbody>
                </table>
              </div>
            </div>

          </div>
        </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal"><i class="fa fa-times"></i> Close</button>
        <!-- <button type="button" id="save_customer" class="btn btn-primary"><i class="fa fa-save"></i> Save</button> -->
      </div>
    </div>
  </div>
</div>

<!-- Modal Select Client Add -->
<div class="modal fade" id="modalAddClient" tabindex="-1" role="dialog" aria-labelledby="add-user-title" aria-hidden="true">
  <div class="modal-dialog modal-lg" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title"><i class="fa fa-user"></i> Add Customer</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <?php $this->load->view("shared/customers_add");?>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal"><i class="fa fa-times"></i> Cancel</button>
        <button type="button" id="quick_save_customer" class="btn btn-primary"><i class="fa fa-save"></i> Save</button>
      </div>
    </div>
  </div>
</div>

<!-- Modal Select Product -->
<div class="modal fade" id="modalSelectProducts" tabindex="-1" role="dialog" aria-labelledby="add-user-title" aria-hidden="true">
  <div class="modal-dialog modal-lg" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h3 class="modal-title text-center">Select Product</h3>
        <p class='text-center'>Click on an image to select it</p>
        <!-- <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button> -->
      </div>
      <div class="modal-body" id='content'></div>
      <div class="modal-footer">
        <button type="button" class="btn btn-warning" data-dismiss="modal"><i class="fa fa-undo"></i> Cancel</button>
        <!-- <button type="button" id="save_customer" class="btn btn-primary"><i class="fa fa-save"></i> Save</button> -->
      </div>
    </div>
  </div>
</div>

<!-- Modal Measurements-->
<div class="modal fade" id="modalMeasurements" tabindex="-1" role="dialog" aria-labelledby="add-user-title" aria-hidden="true">
  <div class="modal-dialog modal-lg" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title"><i class="fa fa-user"></i> Measurements</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body" id=''></div>
      <div class="modal-footer">
        <div id="viewMeasurements" class="btn btn-info pull-left"><i class="fa fa-list"></i> View Measurements <span class="badge">0</span></div>
        <button type="button" class="btn btn-secondary" data-dismiss="modal"><i class="fa fa-times"></i> Close</button>
        <button type="button" id="saveMeasurements" class="btn btn-primary"><i class="fa fa-save"></i> Done</button>
      </div>
    </div>
  </div>
</div>

<!-- Modal View Measurements -->
<div class="modal fade" id="viewMeasurementsModal" tabindex="-1" role="dialog" aria-labelledby="add-user-title" aria-hidden="true">
  <div class="modal-dialog modal-sm" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title"><i class="fa fa-user"></i> View Measurements</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body" id=''>
        <table class="table table-bordered">
          <thead>
            <tr>
              <th>ZONE</th>
              <th>VALUE</th>
              <th>&nbsp;</th>
            </tr>
          </thead>
          <tbody></tbody>
        </table>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal"><i class="fa fa-times"></i> Close</button>
      </div>
    </div>
  </div>
</div>
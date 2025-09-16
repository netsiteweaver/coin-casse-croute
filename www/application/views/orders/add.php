<div class="row">
  <div class="col-md-5">
    <div class="row">
      <div class="col-md-2 selected-table"></div>
      <div class="col-md-10 float-right">
        <div class="btn btn-sm bg-red clearAllTables float-right"><i class="fas fa-broom"></i> Clear All</div>
        <div class="btn btn-sm bg-purple openAssignModal float-right"><i class="fa fa-undo"></i> Replace / Merge</div>
        <div class="btn btn-sm bg-yellow openTableModal float-right"><i class="far fa-hand-point-up"></i> Select Table</div>
      </div>
    </div>
  </div>
</div>

<div class="row">
    <div class="col-md-4 vertical-separator tbl">
        <div class="row text-bold cart-header">
            <div class="col-sm-5 text-left">ITEM</div>
            <div class="col-sm-1 text-center">QTY</div>
            <div class="col-sm-2 text-right">PRICE</div>
            <div class="col-md-2 text-right">AMOUNT</div>
            <div class="col-sm-1 text-center">VAT</div>
            <div class="col-md-1 text-left"><i class="fa fa-2x fa-times deleteAll"></i></div>
        </div>
        <div id="items-cart"></div>
    </div>
    <div class="col-md-2 vertical-separator">
        <div class="row">
            <div class="col-md-3 btn btn-default calc-btn" style='background-color:#fbf8cc;'>7</div>
            <div class="col-md-3 btn btn-default calc-btn" style='background-color:#fde4cf;'>8</div>
            <div class="col-md-3 btn btn-default calc-btn" style='background-color:#ffcfd2;'>9</div>
        </div>
        <div class="row">
            <div class="col-md-3 btn btn-default calc-btn" style='background-color:#f1c0e8;'>4</div>
            <div class="col-md-3 btn btn-default calc-btn" style='background-color:#cfbaf0;'>5</div>
            <div class="col-md-3 btn btn-default calc-btn" style='background-color:#a3c4f3;'>6</div>
        </div>
        <div class="row">
            <div class="col-md-3 btn btn-default calc-btn" style='background-color:#90dbf4;'>1</div>
            <div class="col-md-3 btn btn-default calc-btn" style='background-color:#8eecf5;'>2</div>
            <div class="col-md-3 btn btn-default calc-btn" style='background-color:#98f5e1;'>3</div>
        </div>
        <div class="row">
            <div class="col-md-3 btn btn-default calc-btn" style='background-color:#b9fbc0;'>0</div>
            <div class="col-md-6 btn btn-success nocalc-btn save">Save</div>
        </div>

        <div class="row">
            <div class="col-md-12">
                <label for="popup_customer">Customer:</label>
                <input type="hidden" name="customer_id" value="">
                <input type="text" id="popup_customer" class="form-control cursor-pointer" value="WALK IN" data-toggle="modal" data-target="#customerModal" readonly>
            </div>
        </div>

        <div class="row">
            <div class="col-md-12">
                <label for="popup_payment_mode">Payment Mode:</label>
                <input type="hidden" name="payment_mode_id" value="1">
                <input type="text" id="popup_payment_mode" class="form-control cursor-pointer" value="CASH" data-toggle="modal" data-target="#paymentModeModal" readonly>
            </div>
        </div>
        
    </div>
    <div class="col-md-6" id="categories">
        <div class="row" style="position:relative;">
            <div class="col-sm-12"><h3>Select Category</h3></div>
            <div class="target"></div>
        </div>
    </div>
    <div class="col-md-6 d-none" id="products">
        <div class="row">
            <div class="col-sm-12">
                <h3><span class='category-name'></span>
                    <div class='backToCategories cursor-pointer float-right'><i class="fa fa-chevron-left"></i> Back</div>
                </h3>
            </div>
            <div class="target"></div>
        </div>
    </div>
    <div id="addons-block" class="d-none">
        <div class="content"></div>
        <div id="hideshow"><i class="fa fa-2x fa-chevron-left d-none"></i><i class="fa fa-2x fa-chevron-right"></i></div>
    </div>
</div>

<!-- Modal -->
<div class="modal fade" id="customerModal" tabindex="-1" role="dialog" aria-labelledby="customerModalTitle" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <div class="modal-title">Select Customer</div>
        <div class="btn btn-sm btn-info float-right" id="addCustomer"><i class="fa fa-plus"></i> New Customer</div>
      </div>
      <div class="modal-body">
        <input type="text" class="form-control" id="searchCustomer" placeholder="Search customer">
        <table id="customer_list" class="table table-compact table-bordered">
            <tbody>
                <?php foreach($customers as $c):?>
                <tr>
                    <td class='name select-customer cursor-pointer' data-id="<?php echo $c->customer_id;?>"><?php echo $c->name;?></td>
                </tr>
                <?php endforeach;?>
            </tbody>
        </table>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
      </div>
    </div>
  </div>
</div>

<!-- Modal -->
<div class="modal fade" id="createCustomerModal" tabindex="-1" role="dialog" aria-labelledby="createCustomerModalTitle" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <div class="modal-title">New Customer</div>
      </div>
      <div class="modal-body">
        <form id="saveCustomerForm" role="form" action="<?php echo base_url('customers/save/'); ?>" method="post" enctype="multipart/form-data">
        <input type="hidden" name="customer_code" value="1">
        <div class="row">
          <div class="col-md-12">
            <div class="form-group">
                <label>Titles</label>
                <label for="title_mr"><input type="radio" name="title" value="Mr" id="title_mr" checked> Mr</label>
                <label for="title_mrs"><input type="radio" name="title" value="Mrs" id="title_mrs"> Mrs</label>
                <label for="title_miss"><input type="radio" name="title" value="Miss" id="title_miss"> Miss</label>
                <label for="title_dr"><input type="radio" name="title" value="Dr" id="title_dr"> Dr</label>
            </div>
            <div class="form-group">
                <label>First Name *</label>
                <input type="text" class="form-control required" name="first_name" id="first_name" placeholder="" value="" required>
            </div>
            <div class="form-group">
                <label>Last Name *</label>
                <input type="text" class="form-control" name="last_name" id="lname" placeholder="" value="" required>
            </div>
            <div class="form-group">
                <label>Address</label>
                <textarea name="address" id="address" cols="30" rows="4" class="form-control" placeholder=""></textarea>
            </div>
            <div class="form-group">
                <label>City, Village or Region</label>
                <input type="text" class="form-control" name="city" id="city" placeholder="" value="">
            </div>
            <div class="form-group">
                <label>NIC</label>
                <input type="text" class="form-control" name="nic" id="nic" minlength='14' maxlength='14' placeholder="" value="" required>
            </div>
            <div class="form-group">
                <label>Date of Birth</label>
                <input type="date" class="form-control" name="dob" id="dob" placeholder="" value="" min="1900-01-01" max="<?php echo date("Y-m-d");?>" pattern="">
            </div>
            <div class="form-group">
                <label>Remarks</label>
                <textarea name="remarks" id="remarks" cols="30" rows="3" class="form-control" placeholder=""></textarea>
            </div>
            <div class="form-group">
                <label>Email</label>
                <input type="text" class="form-control" name="email" id="email" placeholder="" value="">
            </div>
            <div class="form-group">
                <label>Primary Phone Number</label>
                <input type="tel" pattern="[0-9]{7,8}" class="form-control" name="phone_number1" maxlength="8" id="phone1" placeholder="7 to 8 numbers" value="" required>
            </div>
            <div class="col-md-12">
                <div class="form-group">
                    <label>Secondary Phone Number</label>
                    <input type="tel" pattern="[0-9]{7,8}" class="form-control" name="phone_number2" maxlength="8" id="phone2" placeholder="7 to 8 numbers" value="">
                </div>
            </div>
          </div>
        </div>
        </form>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        <div class="btn btn-info" id="saveCustomer"><i class="fa fa-save"></i> Save</div>
      </div>
    </div>
  </div>
</div>

<!-- Modal -->
<div class="modal fade" id="paymentModeModal" tabindex="-1" role="dialog" aria-labelledby="paymentModeModalTitle" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLongTitle">Select Payment Mode</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <ul class="list-group">
        <?php foreach($payment_modes as $pt):?>
            <li class="list-group-item select-payment-mode cursor-pointer" data-id="<?php echo $pt->id;?>"><?php echo $pt->name;?></li>
        <?php endforeach;?>
        </ul>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
      </div>
    </div>
  </div>
</div>

<!-- Modal -->
<div class="modal fade" id="tableModal" tabindex="-1" role="dialog" aria-labelledby="tableModalTitle" aria-hidden="true">
  <div class="modal-dialog modal-sm modal-dialog-centered" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title">Select Table</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <ul class="list-group">
        <?php for($i=1;$i<=10;$i++):?>
            <li data-table="<?php echo $i;?>" class="list-group-item select-table cursor-pointer" data-id="<?php echo $i;?>">Table <?php echo $i;?></li>
        <?php endfor;?>
        </ul>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
      </div>
    </div>
  </div>
</div>

<div id="table-overlay" class="d-none"></div>

<!-- Modal -->
<div class="modal fade" id="selectTable2" tabindex="-1" role="dialog" aria-labelledby="tableModalTitle" aria-hidden="true">
  <div class="modal-dialog modal-lg modal-dialog-centered" role="document">
    <div class="modal-content">
      <div class="modal-body">
        <div class="row">
          <?php for($i=0;$i<=10;$i++):?>
          <div class="col-sm-3">
            <div data-table="<?php echo $i;?>" class="resto-table select-table btn btn-lg btn-block btn-default" data-id="<?php echo $i;?>"></div>
          </div>
          <?php endfor;?>
        </div>
      </div>
    </div>
  </div>
</div>

<!-- Modal -->
<div class="modal fade" id="assignTable2" tabindex="-1" role="dialog" aria-labelledby="tableModalTitle" aria-hidden="true">
  <div class="modal-dialog modal-md modal-dialog-centered" role="document">
    <div class="modal-content">
      <div class="modal-body">
        <div class="row">
          <div class="col-sm-5 source">
            <p class="text-center">SOURCE</p>
            <ul class="list-group">
            <?php for($i=0;$i<=10;$i++):?>
              <li class='list-group-item text-center'><?php echo $i;?></li>
            <?php endfor;?>
            </ul>
          </div>
          <div class="col-md-2"></div>
          <div class="col-sm-5 destination">
            <p class="text-center">DESTINATION</p>
            <ul class="list-group">
            <?php for($i=1;$i<=10;$i++):?>
              <li class='list-group-item text-center'><?php echo $i;?></li>
            <?php endfor;?>
            </ul>
          </div>        
        </div>
        <div class="row">
          <div class="col-sm-4">
            <div class="btn btn-warning float-left" data-dismiss="modal"><i class="fa fa-undo"></i> CANCEL</div>
          </div>
          <div class="col-sm-4">
            <div class="btn btn-info" id="replaceTable"><i class="fa fa-minus"></i> REPLACE</div>
          </div>
          <div class="col-sm-4">
            <div class="btn btn-primary" id="mergeTable"><i class="fa fa-plus"></i> MERGE</div>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
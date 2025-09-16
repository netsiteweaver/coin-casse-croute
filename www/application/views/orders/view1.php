<div id="order_sheet_pdf" class='p-40'>
<div class="row">
    <div class="col-sm-2"><img class='img-thumbnail' style='width:200px' src="<?php echo base_url("uploads/logo/".$logo);?>" alt="Company Logo"></div>
    <div class="col-sm-4">
            <span style='font-size:1.5em;'><?php echo $company->legal_name;?><br></span>
            <?php echo $company->address1;?>, 
            <?php echo (!empty($company->address2))?", ".$company->address2:'';?>
            <?php echo $company->city;?>
            <?php echo (!empty($company->phone))?"<br> Phone: ".$company->phone:'';?>
            <?php echo (!empty($company->mobile))?", Mobile: ".$company->mobile:'';?>
            <?php echo (!empty($company->email))?"<br>Email: ".$company->email:'';?>
    </div>
    <div class="col-sm-3">
        <h3 class='text-center'>ORDER SHEET</h3>
    </div>
    <div class="col-sm-3">
        <div class="btn btn-danger pdf"><i class="fa fa-file-pdf"></i> PDF</div>
    </div>
</div>
<div id="order_sheet" class="row">
    <div class="col-md-12">
        <div class='title'>ORDER DETAILS</div>
        <table style='table-layout: fixed;' class="table table-not-striped">
            <tr>
                <th>Shop</th>
                <td><?php echo $order->orderDepartment;?></td>
                <th>Staff</th>
                <td><?php echo $order->agent;?></td>
                <th>Order No</th>
                <td class='order-number'><?php echo $order->document_number;?></td>
                <th>Stage</th>
                <td><?php echo $order->stage;?></td>
            </tr>
            <tr>
                <th>Date Order</th>
                <td><?php echo $order->order_date;?></td>
                <th>Date Del</th>
                <td><?php echo $order->delivery_datetime;?></td>
                <th>Date Trial</th>
                <td><?php //echo $order->agent;?></td>
                <th>Del Place</th>
                <td><?php echo $order->deliveryStore;?></td>
           </tr>
        </table>
        <div class='title'>CLIENT DETAILS</div>
        <table style='table-layout: fixed;' class="table table-not-striped">            
            <tr>
                <th>Client name</th>
                <td><?php echo "{$order->title} {$order->first_name} {$order->last_name}";?></td>
                <th>Emsys ID</th>
                <td></td>
                <th>FIDELITY CARD</th>
                <td><?php echo $order->fidelity_card;?></td>
                <th>CUSTOMER CODE</th>
                <td><?php echo $order->customer_code;?></td>
           </tr>
            <tr>
                <th>Telephone Number</th>
                <td><?php echo $order->phone_number1;?></td>
                <th>Order Process By</th>
                <td><?php echo $order->agent;?></td>
                <th></th>
                <td></td>
                <th></th>
                <td></td>
            </tr>
            
        </table>
        <div class='title'><span><?php echo $order->vetementName;?></span> MEASUREMENTS</div>
        <table style='table-layout: fixed;' class="table table-not-striped">
            <tr>
                <th>Fabric Reference</th>
                <td><?php echo $order->fabric_reference;?></td>
                <th>Fabric Color</th>
                <td><?php echo $order->fabric_color;?></td>
				<th>Size</th>
                <td><?php echo $order->size;?></td>
			</tr>
        </table>
        <div class="row">
            <div class="col-md-6">
                <table style='table-layout: fixed;' class="table table-not-striped">
                    <thead>
                        <tr>
                            <th>ZONE</th>
                            <th>MEASUREMENT</th>
                            <th>REMARKS</th>
                        </tr>
                    </thead>
                    <?php foreach($order->measurements as $m):?>

                    <tr>
                        <td><?php echo $m->zone;?></th>
                        <td><?php echo $m->value;?></th>
                        <td><?php echo $m->remarks;?></td>
                    </tr>
                    <?php endforeach;?>
                
                </table>
            </div>
        </div>

    </div>
</div>
</div>
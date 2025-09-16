<div class="row">
    <div class="col-md-4">
        <table class="table table-not-striped">
            <tr>
                <td>Customer:</td>
            </tr>
            <tr>
                <td><?php echo "{$order->customer_code}";?></td>
            </tr>
            <tr>
                <td><?php echo "{$order->title} {$order->last_name} {$order->first_name}";?></td>
            </tr>
            <tr>
                <td><?php echo "{$order->address}, {$order->city}";?></td>
            </tr>
            <tr>
                <td><?php echo "Email: {$order->email}";?></td>
            </tr>
            <tr>
                <td><?php echo "Phones: {$order->phone_number1}, {$order->phone_number2}";?></td>
            </tr>
        </table>
    </div>
    <div class="col-md-4"></div>
    <div class="col-md-4">
        <table class="table table-no-border table-not-striped">
            <tr>
                <td>Order No.:</td>
                <td><?php echo "{$order->document_number}";?></td>
            </tr>
            <tr>
                <td>Order Date:</td>
                <td><?php echo "{$order->order_date}";?></td>
            </tr>
            <tr>
                <td>Agent</td>
                <td><?php echo "{$order->agent}";?></td>
            </tr>
            <tr>
                <td>Stage</td>
                <td><?php echo "{$order->stage}";?></td>
            </tr>
            <tr>
                <td>Delivery</td>
                <td><?php echo date_format(date_create($order->delivery_datetime),'d M Y @ H:i');?></td>
            </tr>
            <tr>
                <td>Delivery Store</td>
                <td><?php echo "{$order->deliveryStore}";?></td>
            </tr>
        </table>
    </div>
</div>

<div class="row">
    <div class="col-md-12">
        <h4>Product Details:</h4>
        <table class="table table-not-condensed table-not-striped">
            <thead>
                <tr>
                    <th>STOCK REF</th>
                    <th>PRODUCT NAME</th>
                    <th>DESCRIPTION</th>
                    <th>CATEGORY</th>
                    <th>QTY</th>
                    <th>PRICE</th>
                    <th>AMOUNT</th>
                    <th></th>
                </tr>
            </thead>
            <tbody>
                <tr class='text-center'>
                    <td><?php echo $order->productStockRef;?></td>
                    <td><?php echo $order->productName;?></td>
                    <td><?php echo $order->productDescription;?></td>
                    <td><?php echo $order->productCategory;?></td>
                    <td class='text-right'><?php echo $order->quantity;?></td>
                    <td class='text-right'><?php echo $order->price;?></td>
                    <td class='text-right'><?php echo number_format(floatval($order->quantity) * floatval($order->price), 0) ;?></td>
                    <td><?php //echo $order->productStockRef;?></td>
                </tr>
            </tbody>
        </table>
    </div>
</div>

<div class="row">
    <div class="col-md-4">
        <img src="<?php echo base_url("uploads/vetements/".$order->vetementPhoto);?>" alt="Vetement Photo">
    </div>
    <div class="col-md-4">
        <h4>Measurements:</h4>
        <table class="table table-not-condensed table-not-striped">
            <thead>
                <?php foreach($order->measurements as $m):?>
                <tr>
                    <td><?php echo $m->zone;?></td>
                    <td><?php echo $m->value;?></td>
                </tr>
                <?php endforeach;?>
            </thead>
        </table>
    </div>
</div>
<div id="invoice">
	<table>
		<thead><!-- header of receipt -->
			<tr>
				<td colspan='3'>
					<img src="<?php echo base_url("uploads/logo/".$logo);?>" alt="">
				</td>
			</tr>
			<tr>
				<td colspan='3' class="company-info title"><?php echo $company->name;?></td>
			</tr>
			<tr>
				<td colspan='3' class="company-info address"><?php echo $company->address1 . ', ' . $company->city;?></td>
			</tr>
			<?php if( (!empty($company->phone)) || (!empty($company->mobile)) ):?>
			<tr>
				<td colspan='3' class="company-info phone">
					<?php if(!empty($company->phone)):?>
					Phone: <?php echo $company->phone;?>
					<?php endif;?> 
					<?php if(!empty($company->mobile)):?>
					Mobile: <?php echo $company->mobile;?>
					<?php endif;?>
				</td>
			</tr>
			<?php endif;?>
			<?php if( (!empty($company->brn)) || (!empty($company->vat)) ):?>
			<tr>
				<td colspan='3' class="company-info ">
					<?php if(!empty($company->vat)):?>
					BRN: <?php echo $company->brn;?>
					<?php endif;?>
					&nbsp;&nbsp;/&nbsp;&nbsp;
					<?php if(!empty($company->vat)):?>
					VAT: <?php echo $company->vat;?>
					<?php endif;?>
				</td>
			</tr>
			<?php endif;?>

		</thead>
		<tbody>
			<tr>
				<td>ITEM</td>
				<td>QTY</td>
				<td>AMOUNT</td>
			</tr>
			<?php $totalVat = []; $totalVat[15]=0; $totalVat[0]=0; $totalQuantity = 0; ?>
			<?php foreach($order->rows as $o):?>
				<?php 
				$vat = floatval($o->quantity * $o->price) - (floatval($o->quantity * $o->price) / (1 + (floatval($o->vat)/100))); 
				$totalVat[$o->vat] += $vat;
				$totalQuantity += $o->quantity;
				?>
			<tr>
				<td><?php echo (($o->productType=='addon')?'+':'') . "[". $o->category . "] " . $o->productName;?></td>
				<td><?php echo $o->quantity;?></td>
				<td><?php echo number_format($o->quantity * $o->price,2);?></td>
			</tr>
			<?php endforeach;?>

			<tr class="totals">
				<td colspan="2">Total</td>
				<td class="text-right">Rs <?php echo number_format($order->amount,2);?></td>
			</tr>

			<tr>
				<td colspan="2">VAT 15.00%</td>
				<td class="text-right">Rs <?php echo number_format($totalVat[15],2);?></td>
			</tr>
		</tbody>
	</table>

	<table>
		<tbody>
			<?php if(($order->customer_id!==null)):?>
			<tr>
				<td colspan='3'>
					Customer: <?php echo ($order->customer_id==null)?"WALK IN":$order->customerName;?>
				</td>
			</tr>
			<?php endif;?>

			<tr>
				<td colspan='<?php echo ($order->table_number > 0)?'2':'3';?>'>
					Payment Mode: <?php echo $order->paymentMode;?>
				</td>
				<?php if($order->table_number!=='0'):?>
				<td>
					Table: <?php echo $order->table_number;?>
				</td>
				<?php endif;?>
			</tr>

			<?php if($total_items != "none"):?>
			<tr>
				<td>
					Items Count: <?php echo ($total_items == "items") ? $totalQuantity : count($order->rows);?>
				</td>
			</tr>
			<?php endif;?>
		</tbody>
	</table>

	<table class="receipt-info">
		<tbody>
			<tr>
				<td><?php echo $order->document_number;?> | <?php echo $order->order_date;?> | <?php echo $order->agent;?></td>
			</tr>
		</tbody>
	</table>

	<table class="receipt-info">
		<tbody>
			<tr>
				<td class='center'><?php echo $footer_message;?></td>
			</tr>
		</tbody>
	</table>

	<?php if(!empty($company->working_hours)):?>
	<table class="receipt-info">
		<tbody>
			<tr><td class='center'>WORKING HOURS</td></tr>
			<tr>
				<td class='center'><?php echo nl2br($company->working_hours);?></td>
			</tr>
		</tbody>
	</table>
	<?php endif;?>

	<table class="social">
		<tbody>
			<?php if(!empty($company->facebook)):?>
			<tr>
				<td>
					<img src="./assets/images/social/facebook-bw-64x64px.png" alt="">
				</td>
				<td>
					<div><?php echo $company->facebook;?></div>
				</td>
			</tr>
			<?php endif;?>
			<?php if(!empty($company->instagram)):?>
			<tr>
				<td >
					<img src="./assets/images/social/instagram-bw-64x64px.png" alt="">
				</td>
				<td>
					<div><?php echo $company->instagram;?></div>
				</td>
			</tr>
			<?php endif;?>
			<?php if(!empty($company->youtube)):?>
			<tr>
				<td >
					<img src="./assets/images/social/youtube-bw-64x64px.png" alt="">
				</td>
				<td>
					<div><?php echo $company->youtube;?></div>
				</td>
			</tr>
			<?php endif;?>
			<?php if(!empty($company->whatsapp)):?>
			<tr>
				<td >
					<img src="./assets/images/social/whatsapp-bw-64x64px.png" alt="">
				</td>
				<td>
					<div><?php echo $company->whatsapp;?></div>
				</td>
			</tr>
			<?php endif;?>
		</tbody>
	</table>

	<div id="buttons">
		<a class="print" style='color:brown'><i class="fa fa-print"></i> Print</a>
		<a href="<?php echo base_url("orders/add");?>" style='color:brown'><i class="fa fa-chevron-right"></i> Continue</a>
	</div>
</div>



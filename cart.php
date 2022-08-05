<?php
session_start();

if(isset($_POST['product_id'])){
	$order_table='';
	$message='';
	if($_POST['action']=='add'){
		if(isset($_SESSION['shopping_cart'])){
			$is_available=0;
			foreach ($_SESSION['shopping_cart'] as $keys => $values) {
				if($_SESSION['shopping_cart'][$keys]['product_id']==$_POST['product_id']){
					$is_available++;
					$_SESSION['shopping_cart'][$keys]['product_quantity']=$_SESSION['shopping_cart'][$keys]['product_quantity']+$_POST['product_quantity'];

				}

			}
			if ($is_available<1) {
				$item_array = array(
					'product_id' => $_POST['product_id'],
					'product_name' => $_POST['product_name'],
					'product_price' => $_POST['product_price'],
					'product_quantity' => $_POST['product_quantity']
				);
				$count=count($_SESSION['shopping_cart']);
				$_SESSION['shopping_cart'][$count]=$item_array;
			}
		}
		else{
			$item_array = array(
					'product_id' => $_POST['product_id'],
					'product_name' => $_POST['product_name'],
					'product_price' => $_POST['product_price'],
					'product_quantity' => $_POST['product_quantity']
			);
			$_SESSION['shopping_cart'][0]=$item_array;
		}
		$order_table .='
			<table class="table table-bordered">
				<tr>
					
					<th width="20%">product name</th>
					<th width="10%">quantity</th>
					<th width="20%">price</th>
					<th width="15%">total</th>
					<th width="5%">action</th>
				</tr>
		';
		if(!empty($_SESSION['shopping_cart'])){
			$total=0;
			foreach ($_SESSION['shopping_cart'] as $keys => $values) {
				$order_table .='
					<tr>
					
						<td>'.$values['product_name'].'</td>

						<td>'.$values['product_quantity'].'</td>
						<td align="right">$'.$values['product_price'].'</td>
						<td align="right">$'.number_format($values["product_quantity"]*$values["product_price"],2).'</td>
						<td><button name="delete" class="delete" id="'.$values['product_id'].'">remove</button></td>
					</tr>
				';
				$total=$total+($values["product_quantity"]*$values["product_price"]);
			}
			$order_table .= '
				<tr>
					<td colspan="3" align="right">total</td>
					<td align="right">$'.number_format($total,2).'</td>
				</tr>
			';
		}
		$order_table .='</table>';
		$output  = array(
			'order_table' => $order_table,
			'cart_items' => count($_SESSION['shopping_cart'])
		);
		echo json_encode($output);

	}
}
?> 


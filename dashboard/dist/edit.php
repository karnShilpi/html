<?php 
require_once('../../config.php');
if($_REQUEST['task']=='edit' && $_REQUEST['id']!=''){
	
	$id=$_REQUEST['id'];
	$sql = "SELECT t1.c_name,t1.phone,t1.homeAddress,t2.month,t2.amount,t2.date,t2.payment_mode FROM customer as t1 INNER JOIN payment_detail as t2 ON t1.id = t2.customer_id where t1.id='$id'";
	$result = $mysqli -> query($sql);
	$records_edit=$result -> fetch_all(MYSQLI_ASSOC);
	print_r( json_encode($records_edit));
}
?>

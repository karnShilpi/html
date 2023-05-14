<?php 
require_once('../../config.php');
if($_REQUEST['task']=='edit' && $_REQUEST['id']!=''){
	
	$id=$_REQUEST['id'];
	$sql = "SELECT t1.c_name,t1.phone,t1.homeAddress,t2.month,t2.amount,t2.date,t2.payment_mode FROM customer as t1 INNER JOIN payment_detail as t2 ON t1.id = t2.customer_id where t1.id='$id'";
	$result = $mysqli -> query($sql);
	$records_edit=$result -> fetch_all(MYSQLI_ASSOC);
	print_r( json_encode($records_edit));
}
if($_REQUEST['task']=='GR'){
	
	$sql1 = "SELECT id, c_name,phone,homeAddress FROM customer";
	$result = $mysqli -> query($sql1);
	$records_1=$result -> fetch_all(MYSQLI_ASSOC);
	$sql2 = "SELECT t1.id, t1.c_name,t1.phone,t1.homeAddress,t2.month,t2.amount,t2.date,t2.payment_mode FROM customer as t1 INNER JOIN payment_detail as t2 ON t1.id = t2.customer_id ";
	$result = $mysqli -> query($sql2);
	$records_2=$result -> fetch_all(MYSQLI_ASSOC);
	$final_array=array('r1'=>$records_1, 'r2'=>$records_2);
	print_r( json_encode($final_array));
}
?>

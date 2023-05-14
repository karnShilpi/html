<?php 
session_start();
$_REQUEST['task']='';
require_once('../../config.php');
if($_SESSION['userdata']==''){
	header('Location: ../../login.php');
	exit();
}

$sql = "SELECT * FROM customer";
$result = $mysqli -> query($sql);
$records=$result -> fetch_all(MYSQLI_ASSOC);

/*Insert*/
if(isset($_POST['submit'])){
	
	$name= $mysqli -> real_escape_string($_POST['name']);
	$phone= $mysqli -> real_escape_string($_POST['phone']);
	$homeAddress= $mysqli -> real_escape_string($_POST['homeAddress']);
	$mysqli -> query("INSERT INTO customer (c_name, phone, homeAddress)
             VALUES ('$name', '$phone' , '$homeAddress')");
           $c_id=$mysqli -> insert_id;

				if ($c_id) {
				for($i=1;$i<=12;$i++){
					$amount= $_POST['amount_' . $i . '']?$mysqli -> real_escape_string($_POST['amount_' . $i . '']):'';
					$payment_mode= $_POST['payment_mode_' . $i . '']?$mysqli -> real_escape_string($_POST['payment_mode_' . $i . '']):'';
					$date= $mysqli -> real_escape_string($_POST['date_' . $i . ''])?$mysqli -> real_escape_string($_POST['date_' . $i . '']):'';
					
					
					$mysqli -> query("INSERT INTO payment_detail (customer_id, month, amount,date,payment_mode)
             VALUES ('$c_id', '$i', '$amount','$payment_mode','$date')");
          
				}
				header("Refresh:0");
				} else {
				echo "Error: ";
				}
}

if($_REQUEST['task']=='edit' && $_REQUEST['id']!=''){
	
	$id=base64_decode($_REQUEST['id']);
	$sql = "SELECT t1.c_name,t1.phone,t1.homeAddress,t2.month,t2.amount,t2.date,t2.payment_mode FROM customer as t1 INNER JOIN payment_detail as t2 ON t1.id = t2.customer_id where t1.id='$id'";
	$result = $mysqli -> query($sql);
	$records_edit=$result -> fetch_all(MYSQLI_ASSOC);
	
}



?>
<!DOCTYPE html>
<html lang="en" >
<head>
  <meta charset="UTF-8">
  <title>CodePen - Dark UI - Bank dashboard concept</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-KK94CHFLLe+nY2dmCWGMq91rCGa5gtU4mk92HdvYe+M/SXH301p5ILy+dN9+nJOZ" crossorigin="anonymous">
  
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/meyer-reset/2.0/reset.min.css">
<link rel="stylesheet" href="./style.css">

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.4/jquery.min.js"></script>
<script src='https://kit.fontawesome.com/a076d05399.js' crossorigin='anonymous'></script>
</head>
<body>
<!-- partial:index.partial.html -->
<div class="app">
	<header class="app-header">
		<div class="app-header-logo">
			<div class="logo">
				<span class="logo-icon">
					<img src="https://assets.codepen.io/285131/almeria-logo.svg" />
				</span>
				<h1 class="logo-title">
					<span>ABC</span>
					<span>Jwellers</span>
				</h1>
			</div>
		</div>
		<div class="app-header-navigation">
			<div class="tabs">
				<!--<a href="#">
					Overview
				</a>
				<a href="#" class="active">
					Payments
				</a>
				<a href="#">
					Cards
				</a>
				<a href="#">
					Account
				</a>
				<a href="#">
					System
				</a>
				<a href="#">
					Business
				</a>-->
			</div>
</div>
		<div class="app-header-actions">
			<button class="user-profile">
				<span><?php print_r(!empty($_SESSION['userdata']['name'])?$_SESSION['userdata']['name']:'') ; ?></span>
				<span>
				<i class="fa fa-user" aria-hidden="true"></i>
				</span>
			</button>
			<div class="app-header-actions-buttons">
				<button class="icon-button large">
					<i class="ph-magnifying-glass"></i>
				</button>
				<button class="icon-button large">
					<i class="ph-bell"></i>
				</button>
			</div>
		</div>
		<div class="app-header-mobile">
			<button class="icon-button large">
				<i class="ph-list"></i>
			</button>
		</div>

	</header>
	<div class="app-body">
		<div class="app-body-navigation">
			<nav class="navigation">
				<a href="#">
					<i class="ph-browsers"></i>
					<span>Dashboard</span>
				</a>
				<a href="#">
					<i class="ph-check-square"></i>
					<span>Customer</span>
				</a>
				
			</nav>
			
		
		</div>
		<div class="app-body-main-content">
			<section class="service-section">
				<h2>Customer</h2>
				<div class="service-section-header">
					<div class="search-field">
						<i class="ph-magnifying-glass"></i>
						<input type="text" placeholder="Account number">
					</div>
					<button class="flat-button" class="btn btn-primary" data-toggle="modal" onclick="showModal()"  data-target="#exampleModalCenter">
						Add
					</button>
					<button class="flat-button">
						Search
					</button>
				</div>
				<div class="mobile-only">
					<button class="flat-button">
						Toggle search
					</button>
				</div>
				<div class="tiles">
					<?php foreach($records as $row){ ?>
					<article class="tile">
						<div class="tile-header">
							<i class="far fa-user-circle"  style='font-size:36px'></i>
							<h3>
								<span><?php echo $row['c_name']?$row['c_name']:''; ?></span>
								<span><?php echo $row['homeAddress']?$row['homeAddress']:''; ?></span>
							</h3>
						</div>
						
							<span>Amount: <?php echo $row['amount']?$row['amount']:''; ?></span>
							
							<span class="icon-button" data-id="<?php echo $row['id']; ?>" onclick="showeditModal(event)">
								<i class="ph-caret-right-bold"></i>
							</span>
						
					</article>
					<?php } ?>
					
				</div>
				
			</section>
			
		</div>
		
	</div>
</div>


<div id="edit_model_div"></div>
<!-- Modal Add-->
<div class="modal fade" id="exampleModalCenter" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
  <div class="modal-dialog modal-fullscreen " role="document">
    <div class="modal-content">
      <div class="modal-header">
	  <h5 class="modal-title text-dark mb-3">Add Customer</h5>
        <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
	  <form action="customer.php" method="post">
  
	 <div class="input-group mb-2">
  <div class="input-group-prepend">
    <span class="input-group-text">Name</span>
  </div>
  <input type="text" class="form-control" name="name" id="name" aria-describedby="emailHelp" >
   </div>
   <div class="input-group mb-2">
  <div class="input-group-prepend">
    <span class="input-group-text">Mobile</span>
  </div>
  <input type="text" class="form-control" name="phone" id="mobile" aria-describedby="emailHelp" >
   </div>
   
  
  <div class="input-group mb-2">
  <div class="input-group-prepend">
    <span class="input-group-text">Address</span>
  </div>
  <textarea class="form-control" name="homeAddress" aria-label="With textarea"></textarea>
</div>

<table class="table">
  <thead>
    <tr>
      <th scope="col">Month</th>
      <th scope="col">Amount</th>
      <th scope="col">Payment type</th>
      <th scope="col">Date</th>
    </tr>
  </thead>
  <?php $month_array=array(
    'January',
    'February',
    'March',
    'April',
    'May',
    'June',
    'July ',
    'August',
    'September',
    'October',
    'November',
    'December',
); ?>
  <tbody>
	<?php for($i = 0; $i < count($month_array); $i++){ ?>

		<tr>
      <th scope="row"><?php echo $month_array[$i]; ?></th>
      <td><input type="hidden" name="month_<?php echo $i+1;?>" value="<?php echo ($i+1);?>">
	     <input type="number" class="form-control" name="amount_<?php echo $i+1;?>" id="amount" aria-describedby="emailHelp" >
     </td>
      <td><input type="text" class="form-control" name="payment_mode_<?php echo $i+1;?>" aria-describedby="emailHelp" >
      </td>
      <td><div class="form-group">
            <div class='input-group date' id='datetimepicker1'>
			<input type='text' name="date_<?php echo $i+1;?>" class="form-control" id='datetimepicker4' />
               <span class="input-group-addon">
               <span class="glyphicon glyphicon-calendar"></span>
               </span>
			  
            </div>
         </div></td>
    </tr>

<?php } ?>
    
   
  </tbody>
</table>

  

      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
        <button type="submit"  name="submit" class="btn btn-primary" >Save </button>
      </div>
	  </form>
    </div>
  </div>
</div>
<!-- partial -->
  <script src='https://unpkg.com/phosphor-icons'></script><script  src="./script.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ENjdO4Dr2bkBIFxQpeoTz1HIcje39Wm4jDKdf19U8gI4ddQ3GYNS7NTKfAdVQSZe" crossorigin="anonymous"></script>
 
</body>
<script>
    $('#exampleModalCenter').on('shown.bs.modal', function () {
  $('#exampleModalCenter').trigger('focus')
});
function showModal() {
      $('#exampleModalCenter').modal('show');
  }
function showeditModal(e) {
	e.preventDefault();
	var id=$(e.currentTarget).attr('data-id');
	$.ajax({
        url: "edit.php",
        type: "post",
        data:{task:'edit',id:id} ,
        success: function (response) {
        var c_data=JSON.parse(response);
        var model_edit=`<div class="modal fade" id="editModalCenter" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
  <div class="modal-dialog modal-fullscreen " role="document">
    <div class="modal-content">
      <div class="modal-header">
	  <h5 class="modal-title text-dark mb-3">Edit Customer</h5>
        <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
	  <form action="customer.php" method="post">
  
	 <div class="input-group mb-2">
  <div class="input-group-prepend">
    <span class="input-group-text">Name</span>
  </div>
  <input type="text" class="form-control" name="name" id="name" aria-describedby="emailHelp" value="${c_data[0].c_name?c_data[0].c_name:''}" >
   </div>
   <div class="input-group mb-2">
  <div class="input-group-prepend">
    <span class="input-group-text">Mobile</span>
  </div>
  <input type="text" class="form-control" name="phone" id="mobile" aria-describedby="emailHelp" value="${c_data[0].phone?c_data[0].phone:''}" >
   </div>
   
  
  <div class="input-group mb-2">
  <div class="input-group-prepend">
    <span class="input-group-text">Address</span>
  </div>
  <textarea class="form-control" name="homeAddress" aria-label="With textarea">${c_data[0].homeAddress?c_data[0].homeAddress:''}</textarea>
</div>

<table class="table">
  <thead>
    <tr>
      <th scope="col">Month</th>
      <th scope="col">Amount</th>
      <th scope="col">Payment type</th>
      <th scope="col">Date</th>
    </tr>
  </thead>
  <?php $month_array=array(
    'January',
    'February',
    'March',
    'April',
    'May',
    'June',
    'July ',
    'August',
    'September',
    'October',
    'November',
    'December',
); ?>
  <tbody>
	<?php for($i = 0; $i < count($month_array); $i++){ ?>

		<tr>
      <th scope="row"><?php echo $month_array[$i]; ?></th>
      <td><input type="hidden" name="month_<?php echo $i+1;?>" value="<?php echo ($i+1);?>">
	     <input type="number" class="form-control" name="amount_<?php echo $i+1;?>" id="amount" aria-describedby="emailHelp" value="${c_data[<?php echo $i; ?>].amount?c_data[<?php echo $i; ?>].amount:''}">
     </td>
      <td><input type="text" class="form-control" name="payment_mode_<?php echo $i+1;?>" aria-describedby="emailHelp" value="${c_data[<?php echo $i; ?>].payment_mode?c_data[<?php echo $i; ?>].payment_mode:''}" >
      </td>
      <td><div class="form-group">
            <div class='input-group date' id='datetimepicker1'>
			<input type='text' name="date_<?php echo $i+1;?>" class="form-control" id='datetimepicker4' value="${c_data[<?php echo $i; ?>].date?c_data[<?php echo $i; ?>].date:''}"/>
               <span class="input-group-addon">
               <span class="glyphicon glyphicon-calendar"></span>
               </span>
			   
            </div>
         </div></td>
    </tr>

<?php } ?>
    
   
  </tbody>
</table>

  

      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
        <button type="submit"  name="submit" class="btn btn-primary" >Save </button>
      </div>
	  </form>
    </div>
  </div>
</div>`;
$('#edit_model_div').html(model_edit)
$('#editModalCenter').modal('show');
  },
        error: function(jqXHR, textStatus, errorThrown) {
           console.log(textStatus, errorThrown);
        }
    });
	
  }
    </script>
</html>

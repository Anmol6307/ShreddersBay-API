<?php
 
header('Access-Control-Allow-Origin: *');
header('Access-Control-Allow-Methods: GET, POST, PUT, DELETE');
header('Access-Control-Allow-Headers: Content-Type');
 //http://localhost:8000/SHREDDERSBAY_API/API/user_api.php?action=select
 session_start();
include("../DB.php");
$form_data = json_decode(file_get_contents("php://input"));
$data = array();
$error = array();



if($_REQUEST['action']=='insert'){	
				$user_id = $_POST['user_id']; 
				$prod_id = $_POST['prod_id'];
								$addr_id = $_POST['addr_id'];
				$total_weight = $_POST['approx_weight'];
				$total_price = $_POST['approx_price']; 
				$file_name = $_POST['filename'];
                $schedule_date = $_POST['schedule_date'];
				$query = "INSERT INTO tbl_orders(user_id, prod_id, addr_id, total_weight, approx_price, filename,  booking_date, schedule_date) VALUES ('$user_id', '$prod_id', '$addr_id', '$total_weight', '$total_price', '$file_name', now(), '$schedule_date')";
				if(mysqli_query($con, $query))
				{
				  $data["message"] = "Order Placed";         
				}
				$query1 = "DELETE from tbl_cart where prod_id=$prod_id";
				mysqli_query($con, $query1);
				
				echo json_encode($data);
}

if($_REQUEST['action']=='select')
{
	 $query = "SELECT * FROM tbl_orders as o left join tbl_users as user on user.id=o.user_id left join tbl_address as addr on addr.addr_id=o.addr_id left join tbl_products as p on p.p_id=o.prod_id WHERE o.status = 1 order by o.booking_id  DESC";
	 $res = mysqli_query($con, $query);
	 while($row = mysqli_fetch_assoc($res)){
	 	$data[] = $row;
	  // $data['name'] = $row['name'];
	  // $data['email'] = $row['email'];
	  // $data['mobile'] = $row['mobile'];
	  // $data['date'] = $row['date'];
 	}
	
		   echo json_encode($data);


}

if($_REQUEST['action']=='selectCustomerCurrent')
{
	 $query = "SELECT o.*, user.id, user.user_role, user.name, user.email, user.mobile, user.profile, p.p_name FROM tbl_orders as o left join tbl_users as user on user.id=o.user_id left join tbl_address as addr on addr.addr_id=o.addr_id left join tbl_products as p on p.p_id=o.prod_id WHERE o.user_id ='".$_GET['user_id']."' and o.status = 1 || o.status = 2 order by o.booking_id  DESC";
	 $res = mysqli_query($con, $query);
	 while($row = mysqli_fetch_assoc($res)){
	 	$data[] = $row;
	  // $data['name'] = $row['name'];
	  // $data['email'] = $row['email'];
	  // $data['mobile'] = $row['mobile'];
	  // $data['date'] = $row['date'];
 	}
	
		   echo json_encode($data);


}

if($_REQUEST['action']=='selectCustomerCancel')
{
	 $query = "SELECT * FROM tbl_orders as o left join tbl_users as user on user.id=o.user_id left join tbl_address as addr on addr.addr_id=o.addr_id left join tbl_products as p on p.p_id=o.prod_id WHERE o.user_id ='".$_GET['user_id']."' and o.status = 0 order by o.booking_id  DESC";
	 $res = mysqli_query($con, $query);
	 while($row = mysqli_fetch_assoc($res)){
	 	$data[] = $row;
	  // $data['name'] = $row['name'];
	  // $data['email'] = $row['email'];
	  // $data['mobile'] = $row['mobile'];
	  // $data['date'] = $row['date'];
 	}
	
		   echo json_encode($data);


}

if($_REQUEST['action']=='selectCustomerComplete')
{
	 $query = "SELECT * FROM tbl_orders as o left join tbl_users as user on user.id=o.user_id left join tbl_address as addr on addr.addr_id=o.addr_id left join tbl_products as p on p.p_id=o.prod_id WHERE o.user_id ='".$_GET['user_id']."' and o.status = 4 order by o.booking_id  DESC";
	 $res = mysqli_query($con, $query);
	 while($row = mysqli_fetch_assoc($res)){
	 	$data[] = $row;
	  // $data['name'] = $row['name'];
	  // $data['email'] = $row['email'];
	  // $data['mobile'] = $row['mobile'];
	  // $data['date'] = $row['date'];
 	}
	
		   echo json_encode($data);


} 

if($_REQUEST['action']=='customer_cancel')
{
 	            $booking_id=$_POST['booking_id'];
			
	$query = "UPDATE tbl_orders SET status = '0', canceled_date = now() WHERE booking_id='".$booking_id."'";
	if(mysqli_query($con, $query))
	{
		$data["message"] = "Data Updated";         
	}
echo json_encode($data);
}


if($_REQUEST['action']=='select_current')
{
	 $query = "SELECT * FROM tbl_orders as o left join tbl_users as user on user.id=o.user_id left join tbl_address as addr on addr.addr_id=o.addr_id left join tbl_products as p on p.p_id=o.prod_id WHERE o.dealer_id ='".$_GET['user_id']."' and o.status = 2 order by o.booking_id  DESC";
	 $res = mysqli_query($con, $query);
	 while($row = mysqli_fetch_assoc($res)){
	 	$data[] = $row;
	  // $data['name'] = $row['name'];
	  // $data['email'] = $row['email'];
	  // $data['mobile'] = $row['mobile'];
	  // $data['date'] = $row['date'];
 	}
	
		   echo json_encode($data);


}

if($_REQUEST['action']=='select_cancel')
{
	 $query = "SELECT * FROM tbl_orders as o left join tbl_users as user on user.id=o.user_id left join tbl_address as addr on addr.addr_id=o.addr_id left join tbl_products as p on p.p_id=o.prod_id WHERE o.status = 1 && o.dealer_id ='".$_GET['user_id']."' order by o.booking_id  DESC";
	 $res = mysqli_query($con, $query);
	 while($row = mysqli_fetch_assoc($res)){
	 	$data[] = $row;
	  // $data['name'] = $row['name'];
	  // $data['email'] = $row['email'];
	  // $data['mobile'] = $row['mobile'];
	  // $data['date'] = $row['date'];
 	}
	
		   echo json_encode($data);


}


if($_REQUEST['action']=='select_complete')
{
	 $query = "SELECT * FROM tbl_orders as o left join tbl_users as user on user.id=o.user_id left join tbl_address as addr on addr.addr_id=o.addr_id left join tbl_products as p on p.p_id=o.prod_id WHERE o.status = 4 && o.dealer_id ='".$_GET['user_id']."' order by o.booking_id  DESC";
	 $res = mysqli_query($con, $query);
	 while($row = mysqli_fetch_assoc($res)){
	 	$data[] = $row;
	  // $data['name'] = $row['name'];
	  // $data['email'] = $row['email'];
	  // $data['mobile'] = $row['mobile'];
	  // $data['date'] = $row['date'];
 	}
	
		   echo json_encode($data);


}



if($_REQUEST['action']=='select_id')
{
	 $query = "SELECT * FROM tbl_orders as o left join tbl_products as p on p.p_id=o.prod_id where o.user_id = '".$_GET['user_id']."'";
	// echo "$query";
	 $res = mysqli_query($con, $query);
	  while($row = mysqli_fetch_assoc($res)){
	 	$data[] = $row;
	  // $data['name'] = $row['name'];
	  // $data['email'] = $row['email'];
	  // $data['mobile'] = $row['mobile'];
	  // $data['date'] = $row['date'];
 	}
	
		   echo json_encode($data);


}

if($_REQUEST['action']=='edit')
{
 	            $user_id = $_GET['user_id']; 
				$prod_id = $_POST['prod_id'];
				$total_weight = $_POST['approx_weight'];
				$total_price = $_POST['approx_price']; 
				$file_name = $_POST['filename'];
                $schedule_date = $_POST['schedule_date'];
				
	$query = "UPDATE tbl_cart SET user_id = '$user_id', prod_id = '$prod_id', total_price = '$total_price', total_weight = '$total_weight', filename = '$file_name', updated_at = now() WHERE id='".$form_data->id."'";
	// echo $query;
	if(mysqli_query($con, $query))
	{
		$data["message"] = "Data Updated";         
	}
echo json_encode($data);
}	


if($_REQUEST['action']=='accept')
{
 	            $dealer_id = $_POST['user_id']; 
 	            $booking_id = $_POST['booking_id'];
			
	$query = "UPDATE tbl_orders SET dealer_id = '$dealer_id', status = '2', updated_at = now() WHERE booking_id='".$booking_id."'";
	// echo $query;
	if(mysqli_query($con, $query))
	{
		$data["message"] = "Data Updated";         
	}
echo json_encode($data);
}	


if($_REQUEST['action']=='cancel')
{
 	            $booking_id=$_POST['booking_id'];
			
	$query = "UPDATE tbl_orders SET status = '1', canceled_date = now() WHERE booking_id='".$booking_id."'";
	if(mysqli_query($con, $query))
	{
		$data["message"] = "Data Updated";         
	}
echo json_encode($data);
}

if($_REQUEST['action']=='complete')
{
 	            $booking_id=$_POST['booking_id'];
			
	$query = "UPDATE tbl_orders SET status = '4', completed_date = now() WHERE booking_id='".$booking_id."'";
	if(mysqli_query($con, $query))
	{
		$data["message"] = "Data Updated";         
	}
echo json_encode($data);
}


if($_REQUEST['action']=='delete')
{
	$query = "DELETE from tbl_cart  WHERE id='".$form_data->id."'";
	if(mysqli_query($con, $query))
	{
		$data["message"] = "Deleted Successfully";         
	}
	echo json_encode($data);
}

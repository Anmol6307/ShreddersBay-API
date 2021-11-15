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
				$user_id = $_SESSION['user_id']; 
				$prod_id = $_POST['prod_id'];
				$total_weight = $_POST['approx_weight'];
				$total_price = $_POST['approx_price']; 
                $schedule_date = $_POST['schedule_date'];
				$query = "INSERT INTO tbl_orders(user_id, prod_id, total_weight, approx_price , booking_date, schedule_date) VALUES ('$user_id', '$prod_id', '$total_weight', '$total_price',now(), '$schedule_date')";
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
	 $query = "SELECT * FROM tbl_orders as o left join tbl_products as p on p.p_id=o.prod_id where o.user_id = '".$_SESSION['user_id']."'";
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
	 $query = "SELECT * FROM tbl_cart WHERE id='".$form_data->id."'";
	// echo "$query";
	 $res = mysqli_query($con, $query);
	 $row = mysqli_fetch_array($res);
	 $data[] = $row;
	  //$data['name'] = $row['name'];
	  //$data['email'] = $row['email'];
	  //$data['mobile'] = $row['mobile'];
	  //$data['date'] = $row['date'];
 
 echo json_encode($data);
}


if($_REQUEST['action']=='edit')
{
                $price = $_POST['price'];
				$user_id = $_SESSION['user_id']; 
				$prod_id = $_POST['prod_id'];
				$total_weight = $_POST['weight'];
				$total_price = $total_weight*$price; 
				$location = "../upload/";
                $file_name = $_FILES['file']['name'];
                $tmp_name = $_FILES['file']['tmp_name'];
				move_uploaded_file($tmp_name, $location . $file_name);
				
	$query = "UPDATE tbl_cart SET user_id = '$user_id', prod_id = '$prod_id', total_price = '$total_price', total_weight = '$total_weight', filename = '$file_name', updated_at = now() WHERE id='".$form_data->id."'";
	// echo $query;
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

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
			 	$p_name = mysqli_real_escape_string($con, $form_data->p_name);
			 	$sub_name = mysqli_real_escape_string($con, $form_data->sub_name);
			 	$weight = mysqli_real_escape_string($con, $form_data->weight);
			    $price = mysqli_real_escape_string($con, $form_data->price);
			 	// $file = mysqli_real_escape_string($con, $form_data->file);

				$query = "INSERT INTO tbl_products(p_name, sub_name, weight, price, status) VALUES ('$p_name', '$sub_name', '$weight', '$price', '1')";
				if(mysqli_query($con, $query))
				{
				  $data["message"] = "Data Inserted";         
				}

				echo json_encode($data);
}

if($_REQUEST['action']=='select')
{
	 $query = "SELECT * FROM tbl_products";
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
	$p_id=$_GET['p_id'];
	 $query = "SELECT * FROM tbl_products WHERE p_id='".$p_id."'";
	 $res = mysqli_query($con, $query);
	 $row = mysqli_fetch_assoc($res);
	 //$p_name = $row['p_name'];
	 //$sub_name = $row['sub_name'];
	 //$weight = $row['weight'];
	 //$price = $row['price'];
	 //$file = $row['file'];
 	 //$data['status'] = $row['status'];
 	 //$data['date'] = $row['date'];
	 $data[] = $row;
     echo json_encode($data);
}


if($_REQUEST['action']=='edit')
{

	$p_name = mysqli_real_escape_string($con, $form_data->p_name);
	$subname = mysqli_real_escape_string($con, $form_data->subname);
	$weight = mysqli_real_escape_string($con, $form_data->weight);
	$price = mysqli_real_escape_string($con, $form_data->price);
	//file uploading
	$query = "UPDATE tbl_products SET  p_name = '$p_name', sub_name = '$sub_name', weight = '$weight', price = '$price' WHERE p_id='".$form_data->id."'";
	echo $query;
	if(mysqli_query($con, $query))
	{
		$data["message"] = "Data Updated";         
	}
echo json_encode($data);
}		


if($_REQUEST['action']=='delete')
{
	$query = "DELETE from tbl_products  WHERE p_id='".$form_data->id."'";
	if(mysqli_query($con, $query))
	{
		$data["message"] = "Deleted Successfully";         
	}
	echo json_encode($data);
}				
?>

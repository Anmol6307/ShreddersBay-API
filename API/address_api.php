<?php

//http://localhost:8000/SHREDDERSBAY_API/API/user_api.php?action=select
include("../DB.php");
$form_data = json_decode(file_get_contents("php://input"));
$data = array();
$error = array();



if($_REQUEST['action']=='insert'){		
			 	$user_id = mysqli_real_escape_string($con, $form_data->user_id);
			 	$country_id = mysqli_real_escape_string($con, $form_data->country_id);
			 	$state_id = mysqli_real_escape_string($con, $form_data->state_id);
			    $city_id = mysqli_real_escape_string($con, $form_data->city_id);
			 	$area_id = mysqli_real_escape_string($con, $form_data->area_id);
			 	$address = mysqli_real_escape_string($con, $form_data->address);
			 	$pin_code = mysqli_real_escape_string($con, $form_data->pin_code);
			 	$add_type = mysqli_real_escape_string($con, $form_data->add_type);
			    $landmark = mysqli_real_escape_string($con, $form_data->landmark);
				$query = "INSERT INTO tbl_address(user_id, country_id, state_id, city_id, area_id,address, pin_code, add_type, landmark, status) VALUES ('$user_id', '$country_id', '$state_id', '$city_id', '$area_id', '$address', '$pin_code', '$add_type', '$landmark', '1')";
				if(mysqli_query($con, $query))
				{
				  $data["message"] = "Data Inserted";         
				}

				echo json_encode($data);
}

if($_REQUEST['action']=='select')
{
	 $query = "SELECT * FROM tbl_address";
	 $res = mysqli_query($con, $query);
	 while($row = mysqli_fetch_assoc($res)){
	 	$data = $row;
	  // $data['name'] = $row['name'];
	  // $data['email'] = $row['email'];
	  // $data['mobile'] = $row['mobile'];
	  // $data['date'] = $row['date'];
	   echo json_encode($data);
 	}

}



if($_REQUEST['action']=='select_id')
{
	 $query = "SELECT * FROM tbl_address WHERE addr_id='".$form_data->id."'";
	 echo "$query";
	 $res = mysqli_query($con, $query);
	 $row = mysqli_fetch_array($res);
	 $user_id = $row['user_id'];
	 $country_id = $row['country_id'];
	 $state_id = $row['state_id'];
	 $city_id = $row['city_id'];
	 $area_id = $row['area_id'];
	 $address = $row['address'];
	 $pin_code = $row['pin_code'];
	 $add_type = $row['add_type'];
	 $landmark = $row['landmark'];
 	 $data['status'] = $row['status'];
 	 $data['date'] = $row['date'];
     echo json_encode($data);
}


if($_REQUEST['action']=='edit')
{

	$user_id = mysqli_real_escape_string($con, $form_data->user_id);
	$country_id = mysqli_real_escape_string($con, $form_data->country_id);
	$state_id = mysqli_real_escape_string($con, $form_data->state_id);
	$city_id = mysqli_real_escape_string($con, $form_data->city_id);
	$area_id = mysqli_real_escape_string($con, $form_data->area_id);
	$address = mysqli_real_escape_string($con, $form_data->address);
	$pin_code = mysqli_real_escape_string($con, $form_data->pin_code);
	$add_type = mysqli_real_escape_string($con, $form_data->add_type);
	$landmark = mysqli_real_escape_string($con, $form_data->landmark);
	$query = "UPDATE tbl_address SET  user_id = '$user_id', country_id = '$country_id', state_id = '$state_id', city_id = '$city_id',area_id = '$area_id', address = '$address', pin_code = '$pin_code', add_type = '$add_type', landmark = '$landmark' WHERE addr_id='".$form_data->id."'";
	echo $query;
	if(mysqli_query($con, $query))
	{
		$data["message"] = "Data Updated";         
	}
echo json_encode($data);
}		


if($_REQUEST['action']=='delete')
{
	$query = "DELETE from tbl_address  WHERE addr_id='".$form_data->id."'";
	if(mysqli_query($con, $query))
	{
		$data["message"] = "Deleted Successfully";         
	}
	echo json_encode($data);
}				
?>

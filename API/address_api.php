<?php

//http://localhost:8000/SHREDDERSBAY_API/API/user_api.php?action=select
session_start();
include("../DB.php");
$form_data = json_decode(file_get_contents("php://input"));
$data = array();
$error = array();



if($_REQUEST['action']=='insert'){	
$hidden_id =$_POST['id'];
$user_id = $_SESSION['user_id'];
			 	$country_id = $_POST['country'];
			 	$state_id = $_POST['state'];
			    $city_id = $_POST['city'];
			 	// $area_id = $_POST['area_id'];
			 	$address = $_POST['address'];
			 	$pin_code = $_POST['pincode'];
			 	// $add_type = $_POST['add_type'];
			    $landmark = $_POST['landmark'];
if($hidden_id==''){
			 	
				$query = "INSERT INTO tbl_address(user_id, country_id, state_id, city_id, address, pin_code, landmark, status) VALUES ('$user_id', '$country_id', '$state_id', '$city_id', '$address', '$pin_code', '$landmark', '1')";
				
			
				if(mysqli_query($con, $query))
				{
				  $data["message"] = "Data Inserted";         
				}

				echo json_encode($data);
}

else
{
$query1 = "UPDATE tbl_address SET  user_id = '$user_id', country_id = '$country_id', state_id = '$state_id', city_id = '$city_id', address = '$address', pin_code = '$pin_code', landmark = '$landmark' WHERE addr_id='".$hidden_id."'";
	echo $query1;
	if(mysqli_query($con, $query1))
	{
		$data["message"] = "Data Updated";         
	}
echo json_encode($data);
}
}

if($_REQUEST['action']=='select')
{
	 $query = "SELECT * FROM tbl_address as addr left join tbl_city as city on city.city_id=addr.city_id left join tbl_state as state on state.state_id=city.state_id left join tbl_country as country on country.country_id=state.country_id left join tbl_users as user on user.id=addr.user_id where user.id='".$_SESSION['user_id']."'";
	 //echo "$query";

	 $res = mysqli_query($con, $query);
	 while($row = mysqli_fetch_assoc($res)){
	 	$data[] = $row;
	  
 	}
     echo json_encode($data);
}



if($_REQUEST['action']=='select_id')
{
	 $query = "SELECT * FROM tbl_address WHERE addr_id='".$_GET['id']."'";
	 $res = mysqli_query($con, $query);
	 $row = mysqli_fetch_assoc($res);
	 $data = $row;
    echo json_encode($data); 
}

		


if($_REQUEST['action']=='delete')
{
	$query = "DELETE from tbl_address  WHERE addr_id='".$_POST['id']."'";
	if(mysqli_query($con, $query))
	{
		$data["message"] = "Deleted Successfully";         
	}
	echo json_encode($data);
}				
?>

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
			 	$user_role = $_POST['role'];
			 	$name = $_POST['name']; 
				$email = $_POST['email']; 
				$mobile = $_POST['mobile']; 
				$password = $_POST['password']; 
				$query = "INSERT INTO tbl_users(name, email, password, mobile, user_role, status) VALUES ('$name', '$email', '$password', '$mobile', '$user_role', '1')";
				if(mysqli_query($con, $query))
				{
				  $data["message"] = "Data Inserted";         
				}

				echo json_encode($data);
}

if($_REQUEST['action']=='select')
{
	 $query = "SELECT * FROM tbl_users";
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
	 $query = "SELECT * FROM tbl_users WHERE id='".$form_data->id."'";
	 echo "$query";
	 $res = mysqli_query($con, $query);
	 $row = mysqli_fetch_array($res);
	 $data[] = $row;
	  //$data['name'] = $row['name'];
	  //$data['email'] = $row['email'];
	  //$data['mobile'] = $row['mobile'];
	  //$data['date'] = $row['date'];
 
 echo json_encode($data);
}


if($_REQUEST['action']=='user_info')
{
	$role = $_POST['role'];
	 $email = $_POST['email']; 
	 $password = $_POST['password'];
	 $query = "SELECT * FROM tbl_users WHERE email = '$email' && password = '$password' && user_role = '$role'";	 
	 $res = mysqli_query($con, $query);
	 $row = mysqli_fetch_assoc($res);
	 $data[] = $row;
	 $_SESSION['user_id'] = $row['id'];
	 $_SESSION['data'] = $data;
 
 echo json_encode($data);
}

if($_REQUEST['action']=='edit')
{

	$name = mysqli_real_escape_string($con, $form_data->name); 
	$email = mysqli_real_escape_string($con, $form_data->email);
	$mobile = mysqli_real_escape_string($con, $form_data->mobile); 
	$query = "UPDATE tbl_users SET name = '$name', email = '$email', mobile = '$mobile', updated_at = now() WHERE id='".$form_data->id."'";
	// echo $query;
	if(mysqli_query($con, $query))
	{
		$data["message"] = "Data Updated";         
	}
echo json_encode($data);
}		


if($_REQUEST['action']=='delete')
{
	$query = "DELETE from tbl_users  WHERE id='".$form_data->id."'";
	if(mysqli_query($con, $query))
	{
		$data["message"] = "Deleted Successfully";         
	}
	echo json_encode($data);
}

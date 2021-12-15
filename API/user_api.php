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
				// $hidden_id = $_POST['id'];	
			 	$name = $_POST['name']; 
				$email = $_POST['email']; 

				$mobile = $_POST['mobile']; 
				$token = bin2hex(random_bytes(15));
				
if(!isset($_POST['id'])){ 
	if(!isset($_POST['google_id']))
	{
	$user_role = $_POST['role'];
	$password = $_POST['password']; 
	$repassword = $_POST['repassword'];
	$emailquery = "select * from tbl_users where email='$email'";
				        $query = mysqli_query($con, $emailquery);
					    if (mysqli_num_rows($query) > 0) {
					        $data['message'] = "email already exists";
					    } else {
					 $pass = password_hash($password, PASSWORD_BCRYPT);
				$query = "INSERT INTO tbl_users(name, email, password, mobile, token, user_role, status) VALUES ('$name', '$email', '$pass', '$mobile', '$token', '$user_role', '1')";
				if(mysqli_query($con, $query))
				{
				  // $data["message"] = "Data Inserted";  
				$subject = "Email Verification";

                $body = "Hi, $name Click here too activate your account http://localhost/SHREDDERSBAY_API/API/user_api.php?action=varify_email&role=$user_role&token=$token";
                $headers = "From:anmolsahu04012000@gmail.com";

                if (mail($email, $subject, $body, $headers)) {
                    $data["message"] = "Email successfully sent to $email...";
                } else {
                    $data["message"] = "Email sending failed...";
                }       
				}
				
			}
}
else{
$google_id=$_POST['google_id'];
$google_token = $_POST['token'];
	$user_role = $_POST['role'];
	$profile_pic = $_POST['profile_pic']; 
				$query = "INSERT INTO tbl_users(name, email, google_id, token, profile, user_role, status) VALUES ('$name', '$email', '$google_id', '$google_token', '$user_role', '1')";
				echo $query;
				if(mysqli_query($con, $query))
				{
				  $data["message"] = "Data Inserted";         
				}

}
				echo json_encode($data);
}
else{
	 $hidden_id = $_POST['id'];	
	$query = "UPDATE tbl_users SET name = '$name', email = '$email', mobile = '$mobile', updated_at = now() WHERE id='".$hidden_id."'";
	 // echo $query;
	 // die();
	if(mysqli_query($con, $query))
	{
		$data["message"] = "Data Updated";         
	}
echo json_encode($data);
}
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

if($_REQUEST['action']=='varify_email')
{
	if(isset($_GET['token'])){
		$token= $_GET['token'];
		$role=$_GET['role'];
		$update_query = "UPDATE tbl_users set varify_email='1' WHERE token='".$token."' and user_role='".$role."'";
		$res = mysqli_query($con,$update_query);
		if($res){
			echo "<div style='margin: 0px auto; margin-top:15%; width:35%; height:30%; text-align: center; border: 1px solid green;'><h2 style='color:green; font-family: FontAwesome;''>Email Varified Successfully</h2>
			<a href='http://localhost/ShreddersBay%20Project/login.php?role=".$role."'>Go Back To Login</a></div>";
		}
		else{
		echo "<div style='margin: 0px auto; margin-top:15%; width:35%; height:30%; text-align: center; border: 1px solid red;'><h2 style='color:red; font-family: FontAwesome;'>Something Went Wrong! Please Try Again Later...</h2></div>";			
		}
	
	}	
		   // echo json_encode($data);
		
}



if($_REQUEST['action']=='select_id')
{
	 $query = "SELECT * FROM tbl_users WHERE id='".$_SESSION['user_id']."'";
	 // echo "$query";
	 $res = mysqli_query($con, $query);
	 $row = mysqli_fetch_assoc($res);
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
	 $query = "SELECT * FROM tbl_users WHERE email = '".$email."' && user_role = '".$role."' && varify_email = '1'";
	
	 $res = mysqli_query($con, $query);
	 
	 $row = mysqli_fetch_assoc($res);
	 if($row['email']){
	 $db_pass=$row['password'];
	 	$pass_decode = password_verify($password, $db_pass);
	 	if($pass_decode){
	 		$_SESSION['user_id'] = $row['id'];
			 $_SESSION['data'] = $row;
			 $data[] = $row;   
	 } 
	 	else{
	 				$data["message"] = "Incorrect Password";         
	 	}
	 }
	 else{
	 			$data["message"] = "User Not Exist";         
	 }

	 
 echo json_encode($data);
}

if($_REQUEST['action']=='edit')
{

	$name = $_POST['name']; 
	$email = $_POST['email'];
	$mobile = $_POST['mobile']; 
	$query = "UPDATE tbl_users SET name = '$name', email = '$email', mobile = '$mobile', updated_at = now() WHERE id='".$_GET['user_id']."'";
	 echo $query;
	 die();
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

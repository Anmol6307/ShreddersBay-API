<?php

//http://localhost:8000/SHREDDERSBAY_API/API/user_api.php?action=select
include("../DB.php");
$form_data = json_decode(file_get_contents("php://input"));
$data = array();
$error = array();



if($_REQUEST['action']=='insert'){		
			 	$question = mysqli_real_escape_string($con, $form_data->question);
			 	$answer = mysqli_real_escape_string($con, $form_data->answer);
				$query = "INSERT INTO tbl_faqs(question, answer, status) VALUES ('$question', '$answer', '1')";
				if(mysqli_query($con, $query))
				{
				  $data["message"] = "Data Inserted";         
				}

				echo json_encode($data);
}

if($_REQUEST['action']=='select')
{
	 $query = "SELECT * FROM tbl_faqs";
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
	 $query = "SELECT * FROM tbl_faqs WHERE faq_id='".$form_data->id."'";
	 echo "$query";
	 $res = mysqli_query($con, $query);
	 $row = mysqli_fetch_array($res);
	$question = $row['question'];
	$answer = $row['answer'];
 	$data['status'] = $row['status'];
 	$data['created_at'] = $row['created_at'];
     echo json_encode($data);
}


if($_REQUEST['action']=='edit')
{

	$question = mysqli_real_escape_string($con, $form_data->question);
    $answer = mysqli_real_escape_string($con, $form_data->answer);
	$query = "UPDATE tbl_faqs SET question = '$question', answer = '$answer' WHERE faq_id='".$form_data->id."'";
	echo $query;
	if(mysqli_query($con, $query))
	{
		$data["message"] = "Data Updated";         
	}
echo json_encode($data);
}		


if($_REQUEST['action']=='delete')
{
	$query = "DELETE from tbl_faqs  WHERE faq_id='".$form_data->id."'";
	if(mysqli_query($con, $query))
	{
		$data["message"] = "Deleted Successfully";         
	}
	echo json_encode($data);
}				
?>

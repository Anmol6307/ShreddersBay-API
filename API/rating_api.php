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
                $name = $_POST['name'];
                $rating = $_POST['rate'];               
                $message = $_POST['message'];
                $query = "INSERT INTO tbl_rating (user_id, name, rating, message) VALUES ('$user_id', '$name', '$rating', '$message')";
                if(mysqli_query($con, $query))
                {
                  $data["message"] = "Data Inserted";         
                }

                echo json_encode($data);
}
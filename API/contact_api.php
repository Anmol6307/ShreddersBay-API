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



if ($_REQUEST['action'] == 'insert') {
    $user_id = $_POST['user_id'];
    $name = $_POST['name'];
    $email = $_POST['email'];
    $mobile = $_POST['mobile'];
    $query = "INSERT INTO tbl_contacts (user_id, name, email, mobile, status) VALUES ('$user_id', '$name', '$email', '$mobile', '0')";
    if (mysqli_query($con, $query)) {
        $data["message"] = "Data Inserted";
    }

    echo json_encode($data);
}

if ($_REQUEST['action'] == 'select') {
    $query = "SELECT * FROM tbl_contacts";
    $res = mysqli_query($con, $query);
    while ($row = mysqli_fetch_assoc($res)) {
        $data = $row;
        // $data['name'] = $row['name'];
        // $data['email'] = $row['email'];
        // $data['mobile'] = $row['mobile'];
        // $data['date'] = $row['date'];
        echo json_encode($data);
    }
}



if ($_REQUEST['action'] == 'select_id') {
    $query = "SELECT * FROM tbl_contacts WHERE id='" . $form_data->id . "'";
    // echo "$query";
    $res = mysqli_query($con, $query);
    $row = mysqli_fetch_array($res);
    $data['user_id'] = $row['user_id'];
    $data['mobile'] = $row['mobile'];


    echo json_encode($data);
}


if ($_REQUEST['action'] == 'edit') {
    $user_id = mysqli_real_escape_string($con, $form_data->user_id);
    $mobile = mysqli_real_escape_string($con, $form_data->mobile);
    $query = "UPDATE tbl_contacts SET name = '$name', email = '$email', mobile = '$mobile' WHERE id='" . $form_data->id . "'";
    // echo $query;
    if (mysqli_query($con, $query)) {
        $data["message"] = "Data Updated";
    }
    echo json_encode($data);
}


if ($_REQUEST['action'] == 'delete') {
    $query = "DELETE from tbl_contacts  WHERE id='" . $form_data->id . "'";
    if (mysqli_query($con, $query)) {
        $data["message"] = "Deleted Successfully";
    }
    echo json_encode($data);
}

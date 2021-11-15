<?php

//http://localhost:8000/SHREDDERSBAY_API/API/user_api.php?action=select
include("../DB.php");
$form_data = json_decode(file_get_contents("php://input"));
$data = array();
$error = array();



if ($_REQUEST['action'] == 'insert') {
    $country_id = mysqli_real_escape_string($con, $form_data->country_id);
    $state_name = mysqli_real_escape_string($con, $form_data->state_name);
    $query = "INSERT INTO tbl_state(country_id, state_name, status) VALUES ('$country_id', '$state_name', '1')";
    if (mysqli_query($con, $query)) {
        $data["message"] = "Data Inserted";
    }

    echo json_encode($data);
}

if ($_REQUEST['action'] == 'select') {
    $query = "SELECT * FROM tbl_state";
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
    $query = "SELECT * FROM tbl_state WHERE id='" . $form_data->id . "'";
    echo "$query";
    $res = mysqli_query($con, $query);
    $row = mysqli_fetch_array($res);
    $data['country_id'] = $row['country_id'];
    $data['state_name'] = $row['state_name'];

    echo json_encode($data);
}


if ($_REQUEST['action'] == 'edit') {

    $country_id = mysqli_real_escape_string($con, $form_data->country_id);
    $state_name = mysqli_real_escape_string($con, $form_data->state_name);
    $query = "UPDATE tbl_state SET country_id = '$country_id', state_name = '$state_name', updated_at = now() WHERE id='" . $form_data->id . "'";
    echo $query;
    if (mysqli_query($con, $query)) {
        $data["message"] = "Data Updated";
    }
    echo json_encode($data);
}


if ($_REQUEST['action'] == 'delete') {
    $query = "DELETE from tbl_state  WHERE id='" . $form_data->id . "'";
    if (mysqli_query($con, $query)) {
        $data["message"] = "Deleted Successfully";
    }
    echo json_encode($data);
}

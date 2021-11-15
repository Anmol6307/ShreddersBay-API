<?php

//http://localhost:8000/SHREDDERSBAY_API/API/user_api.php?action=select
include("../DB.php");
$form_data = json_decode(file_get_contents("php://input"));
$data = array();
$error = array();



if ($_REQUEST['action'] == 'insert') {
    $city_id = mysqli_real_escape_string($con, $form_data->city_id);
    $area_id = mysqli_real_escape_string($con, $form_data->area_id);
    $darea_name = mysqli_real_escape_string($con, $form_data->darea_name);
    $remark = mysqli_real_escape_string($con, $form_data->remark);
    $query = "INSERT INTO tbl_delivery_area (city_id, area_id, darea_name, remark, status) VALUES ( '$city_id', '$area_id', '$darea_name', '$remark', '1')";
    if (mysqli_query($con, $query)) {
        $data["message"] = "Data Inserted";
    }

    echo json_encode($data);
}

if ($_REQUEST['action'] == 'select') {
    $query = "SELECT * FROM tbl_delivery_area";
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
    $query = "SELECT * FROM tbl_delivery_area WHERE id='" . $form_data->id . "'";
    echo "$query";
    $res = mysqli_query($con, $query);
    $row = mysqli_fetch_array($res);
    $data['city_id'] = $row['city_id'];
    $data['area_id'] = $row['area_id'];
    $data['darea_name'] = $row['darea_name'];
    $data['remark'] = $row['remark'];

    echo json_encode($data);
}


if ($_REQUEST['action'] == 'edit') {

    $city_id = mysqli_real_escape_string($con, $form_data->city_id);
    $area_id = mysqli_real_escape_string($con, $form_data->area_id);
    $darea_name = mysqli_real_escape_string($con, $form_data->darea_name);
    $remark = mysqli_real_escape_string($con, $form_data->remark);
    $query = "UPDATE tbl_delivery_area SET city_id = '$city_id', area_id = '$area_id', darea_name = '$darea_name', remark = '$remark', updated_at = now() WHERE id='" . $form_data->id . "'";
    echo $query;
    if (mysqli_query($con, $query)) {
        $data["message"] = "Data Updated";
    }
    echo json_encode($data);
}


if ($_REQUEST['action'] == 'delete') {
    $query = "DELETE from tbl_delivery_area WHERE id='" . $form_data->id . "'";
    if (mysqli_query($con, $query)) {
        $data["message"] = "Deleted Successfully";
    }
    echo json_encode($data);
}

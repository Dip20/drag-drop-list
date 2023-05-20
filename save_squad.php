<?php
require_once "./paths.php";


/**
 * validate & save squad data
 */
if (isset($_POST['save_squad'])) {

    $msg = array();
    $data = array(
        'name' => safe_val($conn, $_POST['name']),
        'jersey_no' => safe_val($conn, $_POST['jersey_no']),
        'type' => safe_val($conn, $_POST['type']),
        'created_at' => date("Y-m-d H:i:s"),
    );

    $status =  insert_data("squad", $data, $conn);

    if ($status) {
        $msg = array("st" => "success", "msg" => "Data Successfully added!!");
    } else {
        $msg = array("st" => "failed", "msg" => "Something Went wrong!!");
    }

    print_r(json_encode($msg));
}

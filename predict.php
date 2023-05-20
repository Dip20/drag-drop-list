<?php
require_once "./paths.php";


/**
 * validate & save predict data
 */
if (isset($_POST)) {


    $msg = array();
    $st = 0;
    if (isset($_POST['players']) && !empty($_POST['players'])) {

        /**
         * clear the db
         * although it is not the good method, 
         * later i will use to array diff to check the which player has removed from list and position
         *  as of now i want to achieve the functionality
         * 
         */

        $clear = query("DELETE FROM score_board", $conn);

        if (!$clear) {
            $msg = array("st" => "failed", "msg" => "Could not clear list");
            print_r(json_encode($msg));
        }

        $count = count($_POST['players']);
        for ($i = 0; $i < $count; $i++) {
            $data = array(
                'squad_id' => safe_val($conn, $_POST['players'][$i]),
                'score' => safe_val($conn, $_POST['score'][$i]),
                'orders' => $i,
                'created_at' => date("Y-m-d H:i:s"),
            );

            $status =  insert_data("score_board", $data, $conn);
            if ($status) {
                $st++;
            }
        }

        if ($st > 0) {
            $msg = array("st" => "success", "msg" => "Data Successfully added!!");
        } else {
            $msg = array("st" => "failed", "msg" => "Something Went wrong!!");
        }
    } else {
        // we can blank the list by nothing selected
        $msg = array("st" => "failed", "msg" => "Please Select Player!!");
    }

    print_r(json_encode($msg));
}

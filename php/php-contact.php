<?php

require_once '../config/config.php';
$UDF = new Config();

$json_data = array();

if($_SERVER['REQUEST_METHOD'] == 'POST'){

    if( (isset($_POST['name']) && !empty(trim($_POST['name']))) && (isset($_POST['email']) && !empty(trim($_POST['email']))) && (isset($_POST['phone']) && !empty(trim($_POST['phone']))) ){

        $name = $UDF->htmlvalidation($_POST['name']);
        $email = $UDF->htmlvalidation($_POST['email']);
        $phone = $UDF->htmlvalidation($_POST['phone']);

    
        if( (strlen($name) >= 3 && strlen($name <= 100)) && (strlen($email) <= 100) ){


        }
        else{
            $json_data['status'] = 203;
            $json_data['msg'] = "Invalid Format";
        }

    }
    else{
        $json_data['status'] = 204;
        $json_data['msg'] = "Invalid Format";
    }

}
else{
    $json_data['status'] = 205;
    $json_data['msg'] = "Invalid Request Method";
}

echo json_encode($json_data);

?>
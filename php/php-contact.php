<?php

require_once '../config/config.php';
$UDF = new Config();

$json_data = array();

if($_SERVER['REQUEST_METHOD'] == 'POST'){

    if( (isset($_POST['name']) && !empty(trim($_POST['name']))) && (isset($_POST['email']) && !empty(trim($_POST['email']))) && (isset($_POST['phone']) && !empty(trim($_POST['phone']))) ){

        $name = $UDF->htmlvalidation($_POST['name']);
        $email = $UDF->htmlvalidation($_POST['email']);
        $phone = $UDF->htmlvalidation($_POST['phone']);

         if(!empty($_POST["custom_name"][0])) {
                foreach($_POST["custom_name"] as $k=>$v) {
                    $columnName = $_POST["custom_name"][$k];
                    $columnValue = $_POST["custom_value"][$k];
                    $UDF->alter('contact_form', $columnName);
                    $field_val[$columnName] = $columnValue;
                    $additionalFields .=  "<p>" . $_POST["custom_name"][$k] . ": " . $_POST["custom_value"][$k] . "</p>";
                }
         }
    
        if( (strlen($name) >= 3 && strlen($name <= 100)) && (strlen($email) <= 100) ){
                $field_val['name'] = $name;
                $field_val['email'] = $email;
                $field_val['phone_no'] = $phone;

                $insert = $UDF->insert('contact_form', $field_val);

                if($insert){
                    $json_data['status'] = 200;
                    $json_data['msg'] = "Success";
                }
                else{
                    $json_data['status'] = 201;
                    $json_data['msg'] = "Issue Found";
                }

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
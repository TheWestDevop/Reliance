<?php
require 'Account.php';

header("Content-Type: application/json; charset=UTF-8");




function clean_input($data) {
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data);
    return $data;
  }
  $account_number;
  if (empty($_GET['acct'])){
    $account_number  = "";
  } else{
    $account_number = $_GET['acct'];
  }




$seceretKey = 'MK_TEST_WD7TZCMQV7';
$password = 'H5EQMQSHSURJNQ7UH2R78YAH6UN54ZP7';
$c_code = '2957982769';


$headers = apache_request_headers();
  if(isset($headers['Authorization'])){
      $api_key = $headers['Authorization'];
      $pass = $_POST['Password'];
      $cc = $_POST['Contract_Code'];
       if($api_key != $seceretKey &&  $pass != $password && $c_code != $cc) 
      {
        $response = array(
          "requestStatus"=>"Unsuccessful",
          "Message"=>"Authorization failed,Invalid Credentials.", 
         );  
         return json_encode($response);
         exit;
      }else{
        $deactivate_account = new Account();
        echo $deactivate_account->deactivateReserveAccount(clean_input($account_number));
      }
    }
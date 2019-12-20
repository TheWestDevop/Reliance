<?php
require 'Account.php';
// required headers
header("Access-Control-Allow-Origin: http://localhost/reliance/");
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Methods: POST");
header("Access-Control-Max-Age: 3600");
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");

// get posted data
$contract_code = $_POST['contract_code'];
$account_name = $_POST['account_name'];
$currency_code = $_POST['currency_code'];
$customer_email = $_POST['customer_email'];
$account_reference = $_POST['account_reference'];

function clean_input($data) {
  $data = trim($data);
  $data = stripslashes($data);
  $data = htmlspecialchars($data);
  return $data;
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
        $reserve_account = new Account();
        $reserve_account->reserveAccount(
             clean_input(contract_code),
             clean_input(account_name),
             clean_input(currency_code),
             clean_input(customer_email), 
             clean_input(account_reference) 
        );
      }
    }
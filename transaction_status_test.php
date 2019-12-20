<?php
require 'Account.php';

header("Content-Type: application/json; charset=UTF-8");



function clean_input($data) {
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data);
    return $data;
  }
  $ref;
  
  if (empty($_GET['transactionReference']) && empty($_GET['paymentReference'])){
    $ref = "";
  } elseif(empty($_GET['transactionReference'])){
    $ref = $_GET['paymentReference'];
  }
  else {
    $ref = $_GET['transactionReference'];
  }
  $seceretKey = 'MK_TEST_WD7TZCMQV7';
  $password = 'H5EQMQSHSURJNQ7UH2R78YAH6UN54ZP7';
  $c_code = '2957982769';
  require 'Account.php';

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
          echo $reserve_account->getTransactions(clean_input($ref));
        }
    }
  






   
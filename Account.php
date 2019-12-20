<?php

class Account {

    private $account_name;
    private $account_number;
    private $account_reference;
	private $currency_code;
	private $customer_email;
    private $contract_code;
    private $transactionReference;
    private $paymentReference;
 
   function __construct() {
        $this->account_name = "Test Reserved Account";
        $this->account_reference = "abc123";
        $this->currency_code = "NGN"; 
        $this->customer_email = "test@tester.com";
        $this->contract_code = "8389328412";
        $this->account_number = "9900725554";
        $this->transactionReference ="MNFY|20190809123429|000000";
        $this->paymentReference ="reference12345";
      }
   public function reserveAccount($contract_code,$account_name,$currency_code,$customer_email,$account_reference){
       if(
           $account_name == null || $account_name == '' ||
           $account_reference == null || $account_reference == '' ||  
           $currency_code == null || $currency_code == '' ||
           $customer_email == null || $customer_email == '' ||    
           $contract_code == null || $contract_code == ''
           ) {
         return $this->errorInput();
       } else {
        $this->account_name = $this->clean_data($account_name);
        $this->account_reference = $this->clean_data($account_reference);
        $this->currency_code = $this->clean_data($currency_code);
        $this->customer_email = $this->clean_data($customer_email);
        $this->contract_code = $this->clean_data($contract_code);
        return $this->activate();
       } 
     }
   public function deactivateReserveAccount($account_number){
     if ($account_number == $this->account_number) {
        return $this->deactivate();
     } else {
        return $this->errorInput();
     }
     
     
     }
   public function getTransactions($reference_Id){
       if ($reference_Id == $this->transactionReference || $reference_Id == $this->paymentReference  ) {
           return $this->transactionStatus();
       } else {
           return $this->errorInput();
       }
       
    }
   
  
   protected function errorInput(){
    
    $response = array(
        "requestStatus"=>"Unsuccessful",
        "responseMessage"=>"Error with your input, kindly check and try again.", 
       );  
    
    return json_encode($response);
    }
   protected function activate(){
    $timestamp  = new DateTime();
    
    $splitConfig = array( 
    "subAccountCode"=>$this->contract_code,
    "feePercentage"=>$this->account_name, 
    "splitPercentage"=> $this->account_reference,
    "feeBearer"=>true
     );
    $responsebody = array(
        "contractCode"=>$this->contract_code,
        "accountName"=>$this->account_name, 
        "accountReference"=> $this->account_reference,
        "responseCode"=>"0",
        "currencyCode" => $this->currency_code,
        "customerEmail" =>  $this->customer_email,
        "accountNumber"=> $this->account_number,
        "bankName" => "Providus Bank",
        "bankCode" => "101",
        "reservationReference" => "E9Y49CFNYAVHFGSCKJ6N",
        "status" => "ACTIVE",
        "createdOn" => date('m/d/Y H:i:s', $timestamp->getTimestamp()),
        "incomeSplitConfig" => $splitConfig
       );
    $response = array(
        "requestSuccessful"=>true,
        "responseMessage"=>"success", 
        "responseCode"=>"0",
        "responseBody" => $responsebody
       );  
        
    return json_encode($response);
    }
   protected function deactivate(){
    $timestamp  = new DateTime();
    $ref =  substr(str_shuffle(str_repeat('01234567890abcdefghijklmnoprstuvwxyz',36)),0,20);
    
    $responsebody = array(
        "contractCode"=>$this->contract_code,
        "accountName"=>$this->account_name, 
        "accountReference"=> $this->account_reference,
        "responseCode"=>"0",
        "currencyCode" => $this->currency_code,
        "customerEmail" =>  $this->customer_email,
        "accountNumber"=>$this->account_number,
        "bankName" => "Providus Bank",
        "bankCode" => "101",
        "reservationReference" => "E9Y49CFNYAVHFGSCKJ6N",
        "status" => "ACTIVE",
        "createdOn" => date('m/d/Y H:i:s', $timestamp->getTimestamp()),
       );
    $response = array(
        "requestSuccessful"=>true,
        "responseMessage"=>"success", 
        "responseCode"=>"0",
        "responseBody" => $responsebody
       );  
        
    return json_encode($response);
    }
   protected function transactionStatus(){
    $timestamp  = new DateTime();
    
    $responsebody = array(
        "paymentMethod" => "ACCOUNT_TRANSFER",
        "amount" => '100.00',
        "currencyCode" => $this->currency_code,
        "customerName" => $this->account_name,
        "customerEmail" => $this->customer_email,
        "paymentDescription" => "Test Reserved Account",
        "paymentStatus" => "PAID",
        "transactionReference" => "MNFY|20190809123429|000000",
        "paymentReference" => "reference12345",
        "createdOn" => date('m/d/Y H:i:s', $timestamp->getTimestamp()),
       );
    $response = array(
        "requestSuccessful"=>true,
        "responseMessage"=>"success", 
        "responseCode"=>"0",
        "responseBody" => $responsebody
       );  
        
    return json_encode($response);
    }
   protected function clean_data($data){
    $data = trim($data);
    $data = stripslashes($data);
    $data = strip_tags($data);
    $data =  htmlspecialchars($data);
    return data;
    }


}
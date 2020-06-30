<?php
if ($_SERVER['SERVER_NAME'] == 'www.finpay.pk' || $_SERVER['SERVER_NAME'] == 'finpay.pk' || $_SERVER['SERVER_NAME'] == 'egw5.finpay.pk') {
    define('PROJECT_URL', 'http://finpay.pk');
}else if($_SERVER['SERVER_NAME'] == 'demo.finpay.pk' || $_SERVER['SERVER_NAME'] == 'egw4.finpay.pk'){
    define('PROJECT_URL', 'http://demo.finpay.pk');
}else{
    define('PROJECT_URL', 'http://khuram.finjadev.com/finpay');
}
function BillInquiry($Username, $Password = null, $Consumer_Number = null, $Bank_Mnemonic = null, $Reserved = null) {
    $curl = curl_init();
    curl_setopt_array($curl, array(
        CURLOPT_RETURNTRANSFER => 1,
        CURLOPT_URL => PROJECT_URL.'/BillInquiry',
        CURLOPT_POST => 1,
        CURLOPT_POSTFIELDS => json_encode(array(
            "Username" => $Username,
            "Password" => $Password,
            "Consumer_Number" => $Consumer_Number,
            "Bank_Mnemonic" => $Bank_Mnemonic,
            "Reserved" => $Reserved
                )
    )));
    $response = curl_exec($curl);
    if (!curl_exec($curl)) {
        die('Error: "' . curl_error($curl) . '" - Code: ' . curl_errno($curl));
    }
    curl_close($curl);
    $array1 = json_decode($response, TRUE);
    $string = '';
    if ($array1['Response_Code'] == '00') {
        $string .= $array1['Response_Code'];
        $string .= str_pad($array1['Consumer_Detail'], 30);
        $string .= $array1['Bill_Status'];
        $string .= $array1['Due_Date'];
        $string .= '+' . str_pad($array1['Amount_Within_Due_Date'], 13, '0', STR_PAD_LEFT);
        $string .= '+' . str_pad($array1['Amount_After_Due_Date'], 13, '0', STR_PAD_LEFT);
        $string .= $array1['Billing_Month'];
        $string .= ($array1['Bill_Status'] == 'U') ? str_pad('', 8) : $array1['Date_Paid'];
        $string .= ($array1['Bill_Status'] == 'U') ? str_pad('', 12) : $array1['Amount_Paid'];
        $string .= ($array1['Bill_Status'] == 'U') ? str_pad('', 6) : str_pad($array1['Tran_Auth_Id'], 6);
        $string .= str_pad($array1['Reserved'], 200);
    } else {
        $string = str_pad($array1['Response_Code'], 299);
    }
    return $string;
}

function BillPayment($Username, $Password = null, $Consumer_Number = null, $Tran_Auth_Id = null, $Transaction_Amount = null, $Tran_Date = null, $Tran_Time = null, $Bank_Mnemonic = null, $Reserved = null) {
    $curl = curl_init();
    curl_setopt_array($curl, array(
        CURLOPT_RETURNTRANSFER => 1,
        CURLOPT_URL => PROJECT_URL.'/BillPayment',
        CURLOPT_POST => 1,
        CURLOPT_POSTFIELDS => json_encode(array(
            "Username" => $Username,
            "Password" => $Password,
            "Consumer_Number" => $Consumer_Number,
            "Transaction_Auth_Id" => $Tran_Auth_Id,
            "Transaction_Amount" => $Transaction_Amount,
            "Tran_Date" => $Tran_Date,
            "Tran_Time" => $Tran_Time,
            "Bank_Mnemonic" => $Bank_Mnemonic,
            "Reserved" => $Reserved
                )
    )));
    $response = curl_exec($curl);
    if (!curl_exec($curl)) {
        die('Error: "' . curl_error($curl) . '" - Code: ' . curl_errno($curl));
    }
    curl_close($curl);
    $array1 = json_decode($response, TRUE);
    $string = '';
    if ($array1['Response_Code'] == '00') {
        $string .= $array1['Response_Code'];
        $string .= str_pad($array1['IdentificationParameter'], 20);
        $string .= str_pad($array1['Reserved'], 200);
    } else {
        $string = str_pad($array1['Response_Code'], 222);
    }
    return $string;
}

function EchoTransaction($Username, $Password = null, $Ping = null) {
    $curl = curl_init();
    curl_setopt_array($curl, array(
        CURLOPT_RETURNTRANSFER => 1,
        CURLOPT_URL => PROJECT_URL.'/EchoTransaction',
        CURLOPT_POST => 1,
        CURLOPT_POSTFIELDS => json_encode(array(
            "Username" => $Username,
            "Password" => $Password,
            "Ping" => $Ping
                )
    )));
    $response = curl_exec($curl);
    if (!curl_exec($curl)) {
        die('Error: "' . curl_error($curl) . '" - Code: ' . curl_errno($curl));
    }
    curl_close($curl);
    $array1 = json_decode($response, TRUE);
    $string = '';
    if ($array1['Response_Code'] == '00') {
        $string = 'ARE_YOU_ALIVE';
    } else {
        $string = $array1['Response_Code'];
    }
    return $string;
}

<?php
require 'functions.php';
require 'lib/nusoap.php';
$server         = new nusoap_server();
$server->configureWSDL("Finpay","urn:Finpay");
$server->register(
            "BillInquiry",
            array("Username"=>'xsd:string',"Password"=>'xsd:string',"Consumer_Number"=>'xsd:intger',"Bank_Mnemonic"=>'xsd:string',"Reserved"=>'xsd:string'), //Input
            array("return"=>"xsd:string") //Output
        );
$server->register(
            "BillPayment",
            array("Username"=>'xsd:string',"Password"=>'xsd:string',"Consumer_Number"=>'xsd:intger',"Transaction_Auth_ID"=>'xsd:intger',"Transaction_Amount"=>'xsd:intger',"Tran_Date"=>'xsd:intger',"Tran_Time"=>'xsd:intger',"Bank_Mnemonic"=>'xsd:string',"Reserved"=>'xsd:string'), //Input
            array("return"=>"xsd:string") //Output
        );
$server->register(
            "EchoTransaction",
            array("Username"=>'xsd:string',"Password"=>'xsd:string',"Ping"=>'xsd:string'), //Input
            array("return"=>"xsd:string") //Output
        );
$HTTP_RAW_POST_DATA = isset($HTTP_RAW_POST_DATA) ? $HTTP_RAW_POST_DATA : '';
$server->service($HTTP_RAW_POST_DATA);
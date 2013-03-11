<?php

//-------------------------------------------------
// When you integrate this code
// look for TODO as an indication
// that you may need to provide a value or take action
// before executing this code
//-------------------------------------------------

require_once ("paypalplatform.php");


// ==================================
// PayPal Platform Basic Payment Module
// ==================================

// Request specific required fields			
$actionType			= "PAY";
$cancelUrl			= "http://techsupport.saaninfotech.com/techadmin/adminhome/cancel_payment";
$returnUrl			= "http://techsupport.saaninfotech.com/techadmin/adminhome/payment_success";

$currencyCode		= "USD";

// A basic payment has 1 receiver
// TODO - specify the receiver email
foreach($_SESSION['email'] as $emailAddress)
{
	$receiverEmailArray[] = $emailAddress;
}

// TODO - specify the receiver amount as the amount of money, for example, '5' or '5.55'
foreach($_SESSION['amount_value'] as $amountValue)
{
	$receiverAmountArray[] = $amountValue;	
}

// for basic payment, no primary indicators are needed, so set empty array
$receiverPrimaryArray = array();

// TODO - Set invoiceId to uniquely identify the transaction associated with the receiver
//		  You can set this to the same value as trackingId if you wish
$receiverInvoiceIdArray = array(
		time()
		);

// Request specific optional or conditionally required fields
//   Provide a value for each field that you want to include in the request, if left as an empty string the field will not be passed in the request
$senderEmail					= "write._1359196367_biz@gmail.com";		// TODO - If you are executing the Pay call against a preapprovalKey, you should set senderEmail
											//        It is not required if the web approval flow immediately follows this Pay call
$feesPayer						= "";
$ipnNotificationUrl				= "http://techsupport.saaninfotech.com/techadmin/adminhome/cancel_payment";
$memo							= "This is the Payment to the Experts";		// maxlength is 1000 characters
$pin							= "123456";		// TODO - If you are executing the Pay call against an existing preapproval
											//        the requires a pin, then you must set this
$preapprovalKey					= "PA-1V60179145024981C";		// TODO - If you are executing the Pay call against an existing preapproval, set the preapprovalKey here
$reverseAllParallelPaymentsOnError	= "";				// Do not specify for basic payment
$trackingId						= generateTrackingID();	// generateTrackingID function is found in paypalplatform.php

//-------------------------------------------------
// Make the Pay API call
//
// The CallPay function is defined in the paypalplatform.php file,
// which is included at the top of this file.
//-------------------------------------------------
$resArray = CallPay ($actionType, $cancelUrl, $returnUrl, $currencyCode, $receiverEmailArray,
						$receiverAmountArray, $receiverPrimaryArray, $receiverInvoiceIdArray,
						$feesPayer, $ipnNotificationUrl, $memo, $pin, "PA-1V60179145024981C",
						$reverseAllParallelPaymentsOnError, $senderEmail, $trackingId
);
$ack = strtoupper($resArray["responseEnvelope.ack"]);
if($ack == "SUCCESS")
{
    $_SESSION['success'] = "The Payment was processed successfully";
	header("Location: http://techsupport.saaninfotech.com/techadmin/adminhome/payment_success");
} 
else  
{
    $_SESSION['error'][]  = "The payment was cancelled";
	header("Location: http://techsupport.saaninfotech.com/techadmin/adminhome/cancel_payment");
}

?>
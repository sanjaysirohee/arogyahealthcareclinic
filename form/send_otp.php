<?php
error_reporting(E_ALL);
ini_set('display_errors', '1');
ini_set('log_errors', '1');
session_start();

$vercode = $_GET['vercode'] ?? '';

if(empty($vercode) || !isset($_SESSION["vercode"]) || $_SESSION["vercode"] != $vercode){
    echo "INVALID_CAPTCHA";
    exit;
}

$phone = $_GET['phone'] ?? '';

if(empty($phone)){
    echo "PHONE_MISSING";
    exit;
}
$countrycode=$_GET['countryCode'];

$otp = rand(1000,9999);
$_SESSION['otp'] = $otp;
$_SESSION['otp_time'] = time();
$otp_message = "OTP for veloxn.com contact from is: ".$otp." please mention it there.";

$whatsappMessage =  $otp_message;

// $url = "https://chatbot.veloxn.com/api/send?number=".$countrycode . $phone . $whatsappMessage . "&instance_id=69EB6872C2AD0&access_token=69174aa47b39f";

// $ch = curl_init();
// curl_setopt($ch, CURLOPT_URL, $url);
// curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);

// $response = curl_exec($ch);
// curl_close($ch);

// if($response){
//     echo "OTP_SENT";
// } else {
//     echo "ERROR";
// }


//   $url = "https://chatbot.veloxn.com/api/send?number=".$countrycode . $userPhone . $Message . "&instance_id=69EB6872C2AD0&access_token=69174aa47b39f";

//   $ch = curl_init();
//   curl_setopt($ch, CURLOPT_URL, $url);
//   curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
//   //curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
//   $result = curl_exec($ch);
//   curl_close($ch);
//   if (curl_errno($ch)) {
//     echo 'Error: ' . curl_error($ch);
//   }

    // $adminwhatsappText = "🚨 New Contact Inquiry:\n👤 Name: " . $userName . "\n📧 Email: " . $senderEmail . "\n📱 Phone: " . $country_code . " " . $userPhone . "\n📝 Subject: " . $subject . "\n💬 Message: " . $message;
    // $userwhatsappText = "Hi " . $userName . 
    // ", thank you for contacting Arogya Healthcare Clinic! We have received your inquiry and will get back to you soon.";

    $apiKey = "wsk_wEQ97upCrL453503tHxKgUVAmrdChk9askHbXUe0"; 
    // $adminRecipientNumber = "917292001010"; // Admin WhatsApp Number
    $userRecipientNumber = $countrycode.$phone;
    
    $url = 'https://crm.flowpilot.in.net/api/v1/messages';
    $data = [
        'to'   => $userRecipientNumber,
        'type' => 'text',
        'text' => $whatsappMessage
    ];
    // $userdata = [
    //     'to'   => $userRecipientNumber,
    //     'type' => 'text',
    //     'text' => $userwhatsappText
    // ];

    


$ch = curl_init($url);

curl_setopt_array($ch, [
    CURLOPT_RETURNTRANSFER => true,
    CURLOPT_POST => true,
    CURLOPT_POSTFIELDS => json_encode($data),
    CURLOPT_HTTPHEADER => [
        'Authorization: Bearer ' . $apiKey,
        'Content-Type: application/json'
    ],
    CURLOPT_FOLLOWLOCATION => false,
]);

$response = curl_exec($ch);
$httpCode = curl_getinfo($ch, CURLINFO_HTTP_CODE);
$redirectUrl = curl_getinfo($ch, CURLINFO_REDIRECT_URL);
$curlError = curl_error($ch);

curl_close($ch);
error_log('OTP API HTTP status: ' . $httpCode);
error_log('OTP API response: ' . substr((string)$response, 0, 2000));

if ($response === false) {
    http_response_code(502);
    echo "API_CONNECTION_ERROR";
    exit;
}

if ($httpCode >= 200 && $httpCode < 300) {
    echo "OTP_SENT";
} else {
    error_log('OTP API response: ' . substr((string)$response, 0, 1000));
    http_response_code(502);
    echo "API_ERROR_" . $httpCode;
}


exit;


?>

<?php
ini_set('display_errors', 1);
error_reporting(E_ALL);
session_start();

$recipientNumber = isset($_GET['number']) ? trim($_GET['number']) : '';
$messageText = isset($_GET['message']) ? trim($_GET['message']) : '';

if (empty($recipientNumber) || empty($messageText)) {
    die("Error: Please provide both 'number' and 'message' in the URL parameters.");
}

// Duplicate message prevention check
$requestKey = md5($recipientNumber . $messageText);
if (isset($_SESSION['last_sent_msg']) && $_SESSION['last_sent_msg'] == $requestKey) {
    die("Message already sent recently. Skipping duplicate request.");
}

$apiKey = "wsk_wEQ97upCrL453503tHxKgUVAmrdChk9askHbXUe0"; 
$url = 'https://crm.flowpilot.in.net/api/v1/messages';

$data = [
    'to'   => $recipientNumber,
    'type' => 'text',
    'text' => $messageText
];

$ch = curl_init($url);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
curl_setopt($ch, CURLOPT_POST, true);
curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($data));
curl_setopt($ch, CURLOPT_HTTPHEADER, [
    'Authorization: Bearer ' . $apiKey,
    'Content-Type: application/json'
]);

$response = curl_exec($ch);
$httpCode = curl_getinfo($ch, CURLINFO_HTTP_CODE);
curl_close($ch);

if ($httpCode == 200 || $httpCode == 201) {
    // Mark this message as sent in session
    $_SESSION['last_sent_msg'] = $requestKey;
    echo "Message sent successfully via Flowpilot CRM!<br>Response: " . $response;
} else {
    echo "Failed to send message. HTTP Code: " . $httpCode . "<br>Response: " . $response;
}
?>
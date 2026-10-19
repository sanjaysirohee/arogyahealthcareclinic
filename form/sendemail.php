<?php
ini_set('display_errors', 1);
error_reporting(E_ALL);
session_start();
if (isset($_POST['vercode'])) {
  if ((empty($_SESSION["vercode"])) || ($_SESSION["vercode"] != $_POST['vercode'])) {
    die("<script>alert('Invalid Verification Code'); history.back();</script>");
  }
}

require 'config.php';

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

// Base files
require 'PHPMailer/src/Exception.php';
require 'PHPMailer/src/PHPMailer.php';
require 'PHPMailer/src/SMTP.php';

// Read the form values
if(!isset($_GET['iscontactpage'])){
    $userName = isset($_POST['full_name']) ? preg_replace("/[^\s\S\.\-\_\@a-zA-Z0-9]/", "", $_POST['full_name']) : "";
    $senderEmail = isset($_POST['email']) ? preg_replace("/[^\.\-\_\@a-zA-Z0-9]/", "", $_POST['email']) : "";
    $country_code = isset($_POST['countryCode']) ? preg_replace("/[^\s\S\.\-\_\@a-zA-Z0-9]/", "", $_POST['countryCode']) : "";
    $userPhone = isset($_POST['phoneno']) ? preg_replace("/[^\s\S\.\-\_\@a-zA-Z0-9]/", "", $_POST['phoneno']) : "";
    $services = isset($_POST['services']) ? preg_replace("/[^\s\S\.\-\_\@a-zA-Z0-9]/", "", $_POST['services']) : "";
    $message = isset($_POST['message']) ? preg_replace("/(From:|To:|BCC:|CC:|Subject:|Content-Type:)/", "", $_POST['message']) : "";
    $doctors = isset($_POST['doctors']) ? preg_replace("/[^\s\S\.\-\_\@a-zA-Z0-9]/", "", $_POST['doctors']) : "";
    $app_date = isset($_POST['app_date']) ? preg_replace("/[^\s\S\.\-\_\@a-zA-Z0-9]/", "", $_POST['app_date']) : "";
    $app_time = isset($_POST['app_time']) ? preg_replace("/[^\s\S\.\-\_\@a-zA-Z0-9]/", "", $_POST['app_time']) : "";
    $vpage_name = isset($_POST['vpage_name']) ? preg_replace("/[^\s\S\.\-\_\@a-zA-Z0-9]/", "", $_POST['vpage_name']) : "";
    $vpage_url = isset($_POST['vpage_url']) ? preg_replace("/[^\s\S\.\-\_\@a-zA-Z0-9]/", "", $_POST['vpage_url']) : "";
    
    $userwhatsappText=
         "<p>Dear <b>{$userName}</b>,</p>
           <p>Thank you for Booking Appointment with <b>Arogya Healthcare Clinic</b>. We have received your appointment date and time. If you have any query feel free to contact us on our Email or Helpline number</p>
           <p><b>Your Message:</b><br>" . nl2br(htmlspecialchars($message)) . "</p>
           <br><p>Best regards,<br><b>Arogya Healthcare Clinic Team</b></p>";
   $AdminMessage=
       "<h3> New Appointment Booked at Arogya Healthcare Clinic </h3>
       <h3> {$userName} has a Query</h3>
       <p><b>Name:</b> {$userName}</p>
       <p><b>Phone no:</b> {$userPhone}</p>
       <p><b>Email:</b> {$senderEmail}</p>
       <p><b>Service:</b> {$services}</p>
       <p><b>Doctor:</b> {$doctors}</p>
       <p><b>Appointment Date:</b> {$app_date}</p>
       <p><b>Appointment Time:</b> {$app_time}</p>
       <p><b>Message from {$userName}:</b><br>" . nl2br(htmlspecialchars($message)) . "</p>
       <p> Check Arogya healthcare clinic Admin for full client information</p>";
     $isValidEmail = !empty($senderEmail) && filter_var($senderEmail, FILTER_VALIDATE_EMAIL);
     $mailadminsubject="New Appointment Booked";
     $mailusersubject="Your Appointment is Booked";
    
    // Save data to database
    $stmt = $conn->prepare("INSERT INTO req_query_table (full_name, email,countrycode ,phone_number, services, message, doctors, appointment_date,appointment_time,vpage_name,vpage_url) VALUES (?, ?, ?, ?, ?, ?, ?,?,?,?,?)");
    $stmt->bind_param("sssssssssss", $userName, $senderEmail,$country_code , $userPhone, $services, $message, $doctors, $app_date,$app_time,$vpage_name,$vpage_url);

}
else{
    $userName = isset($_POST['name']) ? preg_replace("/[^\s\S\.\-\_\@a-zA-Z0-9]/", "", $_POST['name']) : "";
    $senderEmail = isset($_POST['email']) ? preg_replace("/[^\.\-\_\@a-zA-Z0-9]/", "", $_POST['email']) : "";
    $country_code = isset($_POST['countryCode']) ? preg_replace("/[^\s\S\.\-\_\@a-zA-Z0-9]/", "", $_POST['countryCode']) : "";
    $userPhone = isset($_POST['phone']) ? preg_replace("/[^\s\S\.\-\_\@a-zA-Z0-9]/", "", $_POST['phone']) : "";
    $subject = isset($_POST['subject']) ? preg_replace("/[^\s\S\.\-\_\@a-zA-Z0-9]/", "", $_POST['subject']) : "";
    $message = isset($_POST['message']) ? preg_replace("/(From:|To:|BCC:|CC:|Subject:|Content-Type:)/", "", $_POST['message']) : "";
    $vpage_name = isset($_POST['vpage_name']) ? preg_replace("/[^\s\S\.\-\_\@a-zA-Z0-9]/", "", $_POST['vpage_name']) : "";
    $vpage_url = isset($_POST['vpage_url']) ? preg_replace("/[^\s\S\.\-\_\@a-zA-Z0-9]/", "", $_POST['vpage_url']) : "";
     $userwhatsappText=
         "<p>Dear <b>{$userName}</b>,</p>
           <p>Thank you for reaching out to <b>Arogya Healthcare Clinic</b>. We have received your message and will get back to you soon.</p>
           <p><b>Your Message:</b><br>" . nl2br(htmlspecialchars($message)) . "</p>
           <br><p>Best regards,<br><b>Arogya Healthcare Clinic Team</b></p>";
   $AdminMessage=
       "<h3> New Message from Arogya Healthcare clinic </h3>
       <h3> {$userName} has a Query</h3>
       <p><b>Name:</b> {$userName}</p>
       <p><b>Phone no:</b> {$userPhone}</p>
       <p><b>Email:</b> {$senderEmail}</p>
       <p><b>Message from {$userName}:</b><br>" . nl2br(htmlspecialchars($message)) . "</p>
       <p> Check Arogya healthcare clinic Admin for full client information</p>";
       $mailadminsubject="New Client Contacted";
     $mailusersubject="Welcome to Arogya Healthcare Clinic";
    
     $isValidEmail = !empty($senderEmail) && filter_var($senderEmail, FILTER_VALIDATE_EMAIL);
    
    // Save data to database
    $stmt = $conn->prepare("INSERT INTO contact_table (full_name, email,countryCode ,phone_number,subject, message,pagename,pageurl) VALUES (?, ?, ?, ?, ?, ?, ?,?)");
    $stmt->bind_param("ssssssss", $userName, $senderEmail,$country_code , $userPhone, $subject, $message,$vpage_name,$vpage_url);
}



if ($stmt->execute()) {
    // echo "Data savsed to database successfully<br>";
} else {
    echo "Database Error: " . $stmt->error;
}

$stmt->close();
$conn->close();

    try {
        $mail = new PHPMailer(true);
        $mail->isSMTP(); // using SMTP protocol
        $mail->Host = 'mail.arogyahealthcareclinic.com'; // SMTP host as gmail
        $mail->SMTPAuth = true;  // enable smtp authentication
        $mail->Username = 'emails@arogyahealthcareclinic.com';  // sender gmail host
        $mail->Password = 'ahc.pwd@121'; // sender gmail host password
        $mail->SMTPSecure = 'tls';  // for encrypted connection
        $mail->isHTML(true);
        $mail->SMTPOptions = array(
            'ssl' => array(
                'verify_peer' => false,
                'verify_peer_name' => false,
                'allow_self_signed' => true
            )
        );
        $mail->Port = 587;   // port for SMTP

      


      $mail->setFrom('emails@arogyahealthcareclinic.com', "Arogya Healthcare Clinic");
      if ($isValidEmail) $mail->addReplyTo($senderEmail, $userName);
      $mail->addAddress('emails@arogyahealthcareclinic.com', "Admin");
      $mail->Subject = $mailadminsubject;
      $mail->Body = $AdminMessage;
      try {
        $mail->send();
        // echo 'Admin email sent successfully';
        } catch (Exception $e) {
            echo "Admin Mailer Error: " . $mail->ErrorInfo;
        }

      if($isValidEmail){
        $userMail = new PHPMailer(true);
        $userMail->isSMTP();
        $userMail->Host = 'mail.arogyahealthcareclinic.com';
        $userMail->SMTPAuth = true;
        $userMail->Username = 'emails@arogyahealthcareclinic.com';
        $userMail->Password = 'ahc.pwd@121';
        $userMail->SMTPSecure = 'tls';
        $userMail->Port = 587;
        $userMail->isHTML(true);
        $userMail->SMTPOptions = [
            'ssl' => [
                'verify_peer' => false,
                'verify_peer_name' => false,
                'allow_self_signed' => true
            ]
        ];
        $userwhatsappText=
          "<p>Dear <b>{$userName}</b>,</p>
            <p>Thank you for reaching out to <b>Arogya Healthcare Clinic</b>. We have received your message and will get back to you soon.</p>
            <p><b>Your Message:</b><br>" . nl2br(htmlspecialchars($message)) . "</p>
            <br><p>Best regards,<br><b>Arogya Healthcare Clinic Team</b></p>";
            
        $userMail->setFrom('emails@arogyahealthcareclinic.com', "Arogya Healthcare Clinic");
        $userMail->addAddress($senderEmail, $userName);
        $userMail->Subject = $mailusersubject;
        $userMail->Body = $userwhatsappText;
        try {
        $userMail->send();
        // echo 'User email sent successfully';
        } catch (Exception $e) {
            echo "User Mailer Error: " . $userMail->ErrorInfo;
        }
      }

      // Flowpilot CRM WhatsApp Integration (Only for Contact Page)
if (isset($_GET['iscontactpage']) && $_GET['iscontactpage'] == 'true') {
    $adminwhatsappText = "🚨 New Contact Inquiry:\n👤 Name: " . $userName . "\n📧 Email: " . $senderEmail . "\n📱 Phone: " . $country_code . " " . $userPhone . "\n📝 Subject: " . $subject . "\n💬 Message: " . $message;
    $userwhatsappText = "Hi " . $userName . 
    ", thank you for contacting Arogya Healthcare Clinic! We have received your inquiry and will get back to you soon.";
    $apiKey = "wsk_wEQ97upCrL453503tHxKgUVAmrdChk9askHbXUe0"; 
    $adminRecipientNumber = "917292001010"; // Admin WhatsApp Number
    $userRecipientNumber = $country_code.$userPhone;
    echo $userRecipientNumber;
    $url = 'https://crm.flowpilot.in.net/api/v1/messages';
    $data = [
        'to'   => $adminRecipientNumber,
        'type' => 'text',
        'text' => $adminwhatsappText
    ];
    $userdata = [
        'to'   => $userRecipientNumber,
        'type' => 'text',
        'text' => $userwhatsappText
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
$curlError = curl_error($ch);

curl_close($ch);



$userch=curl_init($url);


curl_setopt($userch, CURLOPT_RETURNTRANSFER, true);
curl_setopt($userch, CURLOPT_POST, true);
curl_setopt($userch, CURLOPT_POSTFIELDS, json_encode($userdata));
curl_setopt($userch, CURLOPT_HTTPHEADER, [
    'Authorization: Bearer ' . $apiKey,
    'Content-Type: application/json'
]);

$response = curl_exec($userch);
$httpCode = curl_getinfo($userch, CURLINFO_HTTP_CODE);
$curlError = curl_error($userch);

curl_close($userch);

// echo "<pre>";
// echo "HTTP Status: " . $httpCode . "\n";
// echo "cURL Error: " . $curlError . "\n";
// echo "API Response: " . htmlspecialchars(
//     $response === false ? '' : $response
// );
// echo "</pre>";

}
// Send message to Whatsapp Code Start
//  if ($subjectV == 'ContactPage') {
//     $Message = "&type=text&message=Thanks+for+contacting+Website+Development+India.+We+will+get+back+to+you+soon,+you+can+post+more+queries+here....";  
//   }elseif ($subjectV == 'GetaquotePage') {
//     $Message = "&type=text&message=Thanks+for+contacting+Website+Development+India,+regarding+your+queries.+We+will+get+back+to+you+soon,+you+can+post+more+queries+here....";
//   }elseif ($subjectV == 'HomePage') {
//     $Message = "&type=text&message=Thanks+for+contacting+Website+Development+India,+regarding+your+queries.+We+will+get+back+to+you+soon,+you+can+post+more+queries+here....";
//   }else {
//     $Message = "&type=text&message=Thanks+for+contacting+Website+Development+India.+We+will+get+back+to+you+soon,+you+can+post+more+queries+here....";
//   }

	
//   $url = 'https://chatbot.veloxn.com/api/send?number=91' . $userPhone . $Message . '&instance_id=6903052CB8BEB&access_token=6902fc95bde21';
//   $ch = curl_init();
//   curl_setopt($ch, CURLOPT_URL, $url);
//   curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
//   //curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
//   $result = curl_exec($ch);
//   curl_close($ch);
//   if (curl_errno($ch)) {
//     echo 'Error: ' . curl_error($ch);
//   }


// Send message to Whatsapp Code End

echo "<script>alert('Thank you! Your message has been sent successfully.'); window.location='../thankyou';</script>";
        // echo 'Message has been sent';
} catch (Exception $e) { // handle error.
        echo 'Message could not be sent. Mailer Error: ', $mail->ErrorInfo;
}
 

?>
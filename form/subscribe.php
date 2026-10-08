<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);
session_start();
require 'config.php';

// Include PHPMailer files
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require 'PHPMailer/src/Exception.php';
require 'PHPMailer/src/PHPMailer.php';
require 'PHPMailer/src/SMTP.php';

$userName = "Subscriber";
if (!isset($_POST['email'])) {
    die("No data received");
}
$email=$_POST['email'];
$isValidEmail = !empty($email) && filter_var($email, FILTER_VALIDATE_EMAIL);
if (!$isValidEmail) {
    die("Invalid email");
}

$stmt = $conn->prepare("INSERT INTO subscribed_customer (email) VALUES (?)");
if (!$stmt) {
    die("Prepare failed: " . $conn->error);
}
$stmt->bind_param("s", $email);

if ($stmt->execute()) {
    // Email inserted successfully
} else {
    die("Database Insert Error: " . $stmt->error);
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

      $AdminMessage=
        "<h3> New Message from Arogya Healthcare Clinic</h3>
        <h3>You have  a Query from {$email}</h3>";
        


      $mail->setFrom('emails@arogyahealthcareclinic.com', "Arogya Healthcare Clinic");
      if ($isValidEmail) $mail->addReplyTo($email,$userName);
      $mail->addAddress('emails@arogyahealthcareclinic.com', "Admin");
      $mail->Subject = "New Message";
      $mail->Body = $AdminMessage;
      try {
        $mail->send();
        // echo 'Admin email sent successfully';
        } catch (Exception $e) {
            echo "Admin Mailer Error: " . $mail->ErrorInfo;
        }

      if($isValidEmail){
        $mail->clearAddresses();
        $mail->clearReplyTos();

        $mail->setFrom('emails@arogyahealthcareclinic.com', "Arogya Healthcare Clinic");
        $mail->addAddress($email, $userName);

        $mail->Subject = 'Welcome to Arogya Healthcare Clinic';
        $userMessage=
          "<p><b>Hello, </b>{$userName}</p>
            <p>Thank you for reaching out to <b>Arogya Healthcare Clinic</b>. We have received your message and will get back to you soon.</p>
            <br><p>Best regards,<br><b>Arogya Healthcare Clinic Team</b></p>";
        $mail->Body = $userMessage;

        try {
            $mail->send();
        } catch (Exception $e) {
            echo "User Mailer Error: " . $mail->ErrorInfo;
        }
      }

    

echo "<script>alert('Thank you! Your message has been sent successfully. Check your mail for further information'); window.location='../thankyou';</script>";
        // echo 'Message has been sent';
} catch (Exception $e) { // handle error.
        echo 'Message could not be sent. Mailer Error: ', $mail->ErrorInfo;
}

?>

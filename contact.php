<?php
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['send_message'])) {
    $name    = htmlspecialchars($_POST['name']);
    $email   = htmlspecialchars($_POST['email']);
    $phone   = htmlspecialchars($_POST['phone']);
    $subject = htmlspecialchars($_POST['subject']);
    $message = htmlspecialchars($_POST['message']);

    $whatsappText = "New Contact Inquiry:\nName: $name\nEmail: $email\nPhone: $phone\nSubject: $subject\nMessage: $message";

    $apiKey = "wsk_wEQ97upCrL453503tHxKgUVAmrdChk9askHbXUe0"; 
    $recipientNumber = "917292001010";

    $url = 'https://crm.flowpilot.in.net/api/v1/messages';
    $data = [
        'to'   => $recipientNumber,
        'type' => 'text',
        'text' => $whatsappText
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
    curl_close($ch);

    $success_msg = "Message sent successfully to WhatsApp!";
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <title>Contact Arogya Healthcare Clinic | Book Ayurvedic Consultation</title>
    <meta content="width=device-width, initial-scale=1.0" name="viewport">
    <meta name="description" content="Get in touch with Arogya Healthcare Clinic in East Vinod Nagar, New Delhi. Call us or visit for consultation.">

    <!-- Favicon -->
    <link href="img/favicon-32x32.png" rel="icon" type="image/png">
    <link href="img/favicon-32x32.png" rel="apple-touch-icon">

    <!-- Open Graph / Social Sharing Tags -->
    <meta property="og:title" content="Contact Arogya Healthcare Clinic | Book Ayurvedic Consultation">
    <meta property="og:description" content="Get in touch with Arogya Healthcare Clinic in East Vinod Nagar, New Delhi. Call us or visit for consultation.">
    <meta property="og:image" content="https://arogyahealthcareclinic.com/img/logo1.png">
    <meta property="og:url" content="https://arogyahealthcareclinic.com/contact">
    <meta property="og:type" content="website">
    <meta property="og:site_name" content="Arogya Healthcare Clinic">

    <!-- Google Web Fonts -->
    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css2?family=Jost:wght@500;600;700&family=Open+Sans:wght@400;600&display=swap" rel="stylesheet"> 

    <!-- Icon Font Stylesheet -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.10.0/css/all.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.4.1/font/bootstrap-icons.css" rel="stylesheet">

    <!-- Libraries Stylesheet -->
    <link href="lib/owlcarousel/assets/owl.carousel.min.css" rel="stylesheet">
    <link href="lib/animate/animate.min.css" rel="stylesheet">
    <link href="lib/tempusdominus/css/tempusdominus-bootstrap-4.min.css" rel="stylesheet" />
    <link href="lib/twentytwenty/twentytwenty.css" rel="stylesheet" />

    <!-- Customized Bootstrap Stylesheet -->
    <link href="css/bootstrap.min.css" rel="stylesheet">

    <!-- Template Stylesheet -->
    <link href="css/style.css" rel="stylesheet">
</head>

<body>
    <!-- Spinner Start -->
    <div id="spinner" class="show bg-white position-fixed translate-middle w-100 vh-100 top-50 start-50 d-flex align-items-center justify-content-center">
        <div class="spinner-grow text-primary m-1" role="status">
            <span class="sr-only">Loading...</span>
        </div>
        <div class="spinner-grow text-dark m-1" role="status">
            <span class="sr-only">Loading...</span>
        </div>
        <div class="spinner-grow text-secondary m-1" role="status">
            <span class="sr-only">Loading...</span>
        </div>
    </div>
    <!-- Spinner End -->


    <!-- Topbar Start -->
    <div class="container-fluid bg-light ps-5 pe-0 d-none d-lg-block">
        <div class="row gx-0">
            <div class="col-md-6 text-center text-lg-start mb-2 mb-lg-0">
                <div class="d-inline-flex align-items-center">
                    <small class="py-2"><i class="far fa-clock text-primary me-2"></i>Opening Hours: Mon - Fri : 9.00 AM - 6.00 PM</small>
                </div>
            </div>
            <div class="col-md-6 text-center text-lg-end">
                <div class="position-relative d-inline-flex align-items-center bg-primary text-white top-shape px-5">
                    <div class="me-3 pe-3 border-end py-2">
                        <p class="m-0"><i class="fa fa-envelope-open me-2"></i>arogyahealthcareclinic@gmail.com</p>
                    </div>
                    <div class="py-2">
                        <p class="m-0"><i class="fa fa-phone-alt me-2"></i>+91 98375 25270</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Topbar End -->


    <!-- Navbar Start -->
    <nav class="navbar navbar-expand-lg bg-white navbar-light shadow-sm px-3 px-lg-5 py-3 py-lg-0">
    <div class="container-fluid px-0 d-flex align-items-center justify-content-between w-100">
        <a href="index" class="navbar-brand p-0 d-flex align-items-center text-truncate" style="max-width: 75%;">
            <img src="img/logo1.png" alt="Arogya Healthcare Logo" class="rounded-circle" style="width: 45px; height: 45px; object-fit: cover;">
            <span class="ms-2 font-weight-bold text-primary text-truncate" style="font-size: 1.2rem;">Arogya Healthcare Clinic</span>
        </a>
       
        <button class="navbar-toggler m-0 p-2" type="button" data-bs-toggle="collapse" data-bs-target="#navbarCollapse">
            <span class="navbar-toggler-icon"></span>
        </button>
    </div>

    <div class="collapse navbar-collapse" id="navbarCollapse">
        <div class="navbar-nav ms-auto py-0">
            <a href="index" class="nav-item nav-link">Home</a>
            <a href="about" class="nav-item nav-link">About</a>
            <div class="nav-item dropdown">
                <a href="#" class="nav-link dropdown-toggle" data-bs-toggle="dropdown">Services</a>
                <div class="dropdown-menu m-0">
                    <a href="piles" class="dropdown-item">Piles</a>
                    <a href="pilonidal-sinus" class="dropdown-item">Pilonidal Sinus</a>
                    <a href="rectal-polyp" class="dropdown-item">Rectal Polyp</a>
                    <a href="fissure" class="dropdown-item">Fissure</a>
                    <a href="fistula-in-ano" class="dropdown-item">Fistula in Ano</a>
                    <a href="ksharsutra-treatment-for-fistula" class="dropdown-item">Ksharsutra Treatment for fistula</a>
                </div>
            </div>
            <div class="nav-item dropdown">
                <a href="#" class="nav-link dropdown-toggle" data-bs-toggle="dropdown">Ayurveda Treatment</a>
                <div class="dropdown-menu m-0">
                    <a href="piles" class="dropdown-item">Piles</a>
                    <a href="pilonidal-sinus" class="dropdown-item">Pilonidal Sinus</a>
                    <a href="rectal-polyp" class="dropdown-item">Rectal Polyp</a>
                    <a href="fissure" class="dropdown-item">Fissure</a>
                    <a href="fistula-in-ano" class="dropdown-item">Fistula in Ano</a>
                    <a href="ksharsutra-treatment-for-fistula" class="dropdown-item">Ksharsutra Treatment for fistula</a>
                </div>
            </div>
            <a href="contact" class="nav-item nav-link active" style="white-space: nowrap;">Contact Us</a>
        </div>
        <button type="button" class="btn text-dark d-none d-lg-block" data-bs-toggle="modal" data-bs-target="#searchModal"><i class="fa fa-search"></i></button>
        <a href="appointment" class="btn btn-primary py-2  ms-3 d-none d-lg-block">Appointment</a>
    </div>
</nav>
    <!-- Navbar End -->


    <!-- Hero Start -->
    <div class="container-fluid bg-primary py-5 hero-header mb-5">
        <div class="row py-3">
            <div class="col-12 text-center">
                <h1 class="display-3 text-white animated zoomIn">Contact Us</h1>
                <a href="index" class="h4 text-white">Home</a>
                <i class="far fa-circle text-white px-2"></i>
                <a href="contact" class="h4 text-white">Contact</a>
            </div>
        </div>
    </div>
    <!-- Hero End -->


    <!-- Contact Start -->
    <div class="container-fluid py-5">
        <div class="container">
            <div class="row g-5">
                <div class="col-xl-6 col-lg-6 wow slideInUp" data-wow-delay="0.1s">
                    <div class="bg-light rounded h-100 p-5">
                        <div class="section-title">
                            <h5 class="position-relative d-inline-block text-primary text-uppercase">Contact Us</h5>
                            <h1 class="display-6 mb-4">Feel Free To Contact Us</h1>
                        </div>
                        <div class="d-flex align-items-center mb-2">
                            <i class="bi bi-geo-alt fs-1 text-primary me-3"></i>
                            <div class="text-start">
                                <h5 class="mb-0">Our Office</h5>
                                <span>East Vinod Nagar in New Delhi - 110091</span>
                            </div>
                        </div>
                        <div class="d-flex align-items-center mb-2">
                            <i class="bi bi-envelope-open fs-1 text-primary me-3"></i>
                            <div class="text-start">
                                <h5 class="mb-0">Email Us</h5>
                                <span>arogyahealthcareclinic@gmail.com</span>
                            </div>
                        </div>
                        <div class="d-flex align-items-center">
                            <i class="bi bi-phone-vibrate fs-1 text-primary me-3"></i>
                            <div class="text-start">
                                <h5 class="mb-0">Call Us</h5>
                                <span>+91 98375 25270</span>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-xl-6 col-lg-6 wow slideInUp" data-wow-delay="0.3s">
                    <div class="bg-light rounded h-100 p-5">
                        <?php if (isset($success_msg)) { echo '<div class="alert alert-success mb-4">'.$success_msg.'</div>'; } ?>
                        <form method="POST" action="form/sendemail.php?iscontactpage=true">
                            <input type="hidden" name="vpage_name" value="Contact Form">
                            <input type="hidden" name="vpage_url" value="https://arogyahealthcareclinic.com/contact">
                            <div class="row g-3">
                                <div class="col-12">
                                    <label for="name">Name</label>
                                    <input type="text" name="name" id="name" class="form-control border-0 bg-white " placeholder="Your Name" style="height: 55px;" required>
                                </div>
                                <div class="col-12">
                                    <label for="email">Email</label>
                                    <input type="email" name="email" id="email" class="form-control border-0 bg-white " placeholder="Your Email" style="height: 55px;" required>
                                </div>

                                <div class="col-12">
                                    <label for="phoneno">Phone Number (Whatsapp)</label>
                                    <div class="form-floating input-group p-0  bg_light">
                                    <label for="countryCode">Country-Code</label>
                                    <select
                                                    class="form-select border-0 bg_light "
                                                    name="countryCode"
                                                    id="countryCode"
                                                    style="max-width: 140px;height:55px;padding:0px !important;padding-left:8px !important;"

                                                    required
                                                    >
                                                    <option value="">Country-Code</option>
                                                    </select>
                                    <input type="text" name="phone" id="phoneno" class="form-control border-0 bg-white " placeholder="Your Phone Number" style="height: 55px;" required>
                                </div>
                                </div>
                                <div class="col-12">
                                    <label for="subject">Subject</label>
                                    <input type="text" name="subject" id="subject" class="form-control border-0 bg-white " placeholder="Subject" style="height: 55px;" required>
                                </div>
                                <div class="col-12">
                                    <label for="message">Message</label>
                                    <textarea name="message" id="message" class="form-control border-0 bg-white  py-3" rows="5" placeholder="Message" required></textarea>
                                </div>
                                 <div class="col-lg-6 d-flex align-items-center justify-content-center col-xl-6">
                                       <div class="form-floating ">
                                        <img src="form/captcha.php">
                                       </div>       
                                    </div>
                                    <div class="col-lg-12 col-xl-6">
                                     <label for="captcha">Captcha</label>
                                     <input type="text" class="form-control border-0 bg-white  py-3" name="vercode" id="captcha" placeholder="Enter the captcha" style="width:100%;height: 55px;" required>
                                    </div> 
                                <div class="col-12">
                                    <button class="btn btn-primary w-100 py-3" type="submit" name="send_message">Send Message</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
                <div class="col-xl-12 col-lg-12 wow slideInUp" data-wow-delay="0.6s">
                    <iframe class="position-relative rounded w-100 h-100"
                        src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d14008.114324785468!2d77.3003!3d28.6289!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x390cfb2585252b9f%3A0x8797f1f7282b8d5a!2sEast%20Vinod%20Nagar%2C%20Delhi%2C%20110091!5e0!3m2!1sen!2sin!4v1650000000000!5m2!1sen!2sin"
                        frameborder="0" style="min-height: 400px; border:0;" allowfullscreen="" aria-hidden="false"
                        tabindex="0"></iframe>
                </div>
            </div>
        </div>
    </div>
    <!-- Contact End -->


    <!-- Footer Start -->
    <div class="container-fluid bg-dark text-light py-5 wow fadeInUp" data-wow-delay="0.3s" style="margin-top: -75px;">
        <div class="container pt-5">
            <div class="row g-5 pt-4">
                <div class="col-lg-3 col-md-6">
                    <h3 class="text-white mb-4">Quick Links</h3>
                    <div class="d-flex flex-column justify-content-start">
                        <a class="text-light mb-2" href="index"><i class="bi bi-arrow-right text-primary me-2"></i>Home</a>
                        <a class="text-light mb-2" href="about"><i class="bi bi-arrow-right text-primary me-2"></i>About Us</a>
                        <a class="text-light mb-2" href="service"><i class="bi bi-arrow-right text-primary me-2"></i>Our Services</a>
                        <a class="text-light mb-2" href="blog"><i class="bi bi-arrow-right text-primary me-2"></i>Latest Blog</a>
                        <a class="text-light" href="contact"><i class="bi bi-arrow-right text-primary me-2"></i>Contact Us</a>
                    </div>
                </div>
                <div class="col-lg-3 col-md-6">
                    <h3 class="text-white mb-4">Popular Links</h3>
                    <div class="d-flex flex-column justify-content-start">
                        <a class="text-light mb-2" href="piles"><i class="bi bi-arrow-right text-primary me-2"></i>Piles</a>
                        <a class="text-light mb-2" href="pilonidal-sinus"><i class="bi bi-arrow-right text-primary me-2"></i>Pilonidal Sinus</a>
                        <a class="text-light mb-2" href="rectal-polyp"><i class="bi bi-arrow-right text-primary me-2"></i>Rectal Polyp</a>
                        <a class="text-light mb-2" href="fissure"><i class="bi bi-arrow-right text-primary me-2"></i>Fissure</a>
                        <a class="text-light" href="ksharsutra-treatment-for-fistula"><i class="bi bi-arrow-right text-primary me-2"></i>Ksharsutra</a>
                    </div>
                </div>
                <div class="col-lg-3 col-md-6">
                    <h3 class="text-white mb-4">Get In Touch</h3>
                    <p class="mb-2"><i class="bi bi-geo-alt text-primary me-2"></i>East Vinod Nagar in New Delhi - 110091</p>
                    <p class="mb-2"><i class="bi bi-envelope-open text-primary me-2"></i>arogyahealthcareclinic@gmail.com</p>
                    <p class="mb-0"><i class="bi bi-telephone text-primary me-2"></i>+91 9837525270</p>
                </div>
                <div class="col-lg-3 col-md-6">
                    <h3 class="text-white mb-4">Follow Us</h3>
                    <div class="d-flex">
                        <a class="btn btn-lg btn-primary btn-lg-square rounded me-2" href="blank"><i class="fab fa-twitter fw-normal"></i></a>
                        <a class="btn btn-lg btn-primary btn-lg-square rounded me-2" href="blank"><i class="fab fa-facebook-f fw-normal"></i></a>
                        <a class="btn btn-lg btn-primary btn-lg-square rounded me-2" href="blank"><i class="fab fa-linkedin-in fw-normal"></i></a>
                        <a class="btn btn-lg btn-primary btn-lg-square rounded" href="blank"><i class="fab fa-instagram fw-normal"></i></a>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="container-fluid text-light py-4" style="background: #051225;">
        <div class="container">
            <div class="row g-0">
                <div class="col-md-6 text-center text-md-start">
                    <p class="mb-md-0">Copyright @ <a class="text-white border-bottom" href="https://arogyahealthcareclinic.com/">Arogya Healthcare Clinic</a>, All right reserved.</p>
                </div>
                <div class="col-md-6 text-center text-md-end">
                    <p class="mb-0">Designed by <a class="text-white border-bottom" href="https://www.veloxn.com/" target="_blank" rel="noopener noreferrer">Veloxn Private Limited</a></p>
                </div>
            </div>
        </div>
    </div>
    <!-- Footer End -->


    <!-- Back to Top -->
    <a href="#" class="btn btn-lg btn-primary btn-lg-square rounded back-to-top"><i class="bi bi-arrow-up"></i></a>


    <!-- JavaScript Libraries -->
    <script src="https://code.jquery.com/jquery-3.4.1.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0/dist/js/bootstrap.bundle.min.js"></script>
    <script src="lib/wow/wow.min.js"></script>
    <script src="lib/easing/easing.min.js"></script>
    <script src="lib/waypoints/waypoints.min.js"></script>
    <script src="lib/owlcarousel/owl.carousel.min.js"></script>
    <script src="lib/tempusdominus/js/moment.min.js"></script>
    <script src="lib/tempusdominus/js/moment-timezone.min.js"></script>
    <script src="lib/tempusdominus/js/tempusdominus-bootstrap-4.min.js"></script>
    <script src="lib/twentytwenty/jquery.event.move.js"></script>
    <script src="lib/twentytwenty/jquery.twentytwenty.js"></script>

    <!-- Template Javascript -->
    <script src="js/main.js"></script>
    <script src="js/country-code.js"></script>
</body>

</html>
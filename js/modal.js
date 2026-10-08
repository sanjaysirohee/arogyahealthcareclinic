document.querySelector("#contactform").addEventListener("submit", function(e){
    e.preventDefault();

    const phoneno = document.getElementById('phoneno').value;
    const captcha =document.getElementById('captcha').value;
     const countrycode =document.getElementById('countryCode').value;
     console.log(countrycode);

    const otpParams = new URLSearchParams({
        phone: phoneno,
        vercode: captcha,
        countryCode: countrycode
    });

    fetch(`./form/send_otp.php?${otpParams.toString()}`)
.then(res => res.text())
.then(data => {

    data = data.trim();

    if(data === "OTP_SENT"){

        var otpModal = new bootstrap.Modal(document.getElementById('otpModal'));
        otpModal.show();

    } 
    else if(data === "INVALID_CAPTCHA"){

        alert("Captcha is incorrect");

    }
    else if(data === "PHONE_MISSING"){

        alert("Phone number missing");

    }
    else if(data === "PHONE_INVALID"){

        alert("Please enter a valid phone number and country code");

    }
    else{

        alert("Something went wrong");

    }

}).catch(() => {
    alert("Unable to send OTP. Please try again.");
});

    

});

   function verifyotp(){

    let enteredOtp = document.getElementById("otpInput").value;

    // put OTP inside hidden input
    document.getElementById("otpHidden").value = enteredOtp;

    // NOW submit full form
    document.getElementById("contactform").submit();
}

<?php

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

session_set_cookie_params(0);

session_start();

require_once ('connDB.php');
// connect to the db


//Load Composer's autoloader
require 'vendor/autoload.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $firstName = $_POST['firstName'];
    $lastName = $_POST['lastName'];
    $u = $_POST['u'];
    $p = $_POST['p'];
    $email = $_POST['email'];
    $birthday = $_POST['birthday'];
    $strAddress = $_POST['Address'];
    $city = $_POST['City'];
    $state = $_POST['State'];
    $zip = $_POST['PostalCode'];
    $userType = $_POST['userType'];
    $promotion = 0;
    $verification_code = 123456;


    if (empty($firstName) || empty($lastName) || empty($u) || empty($p) || empty($email) || empty($birthday) || empty($strAddress) || empty($city) || empty($state) || empty($zip) || empty($userType)) {
        echo "<div class=echo><h6 id=malign>Please fill out all the fields.</h6></div>";
    } else if (strlen($p) < 7) {
        echo "<div class=echo><h6 id=malign>Password must be more than 6 characters.</h6></div>";
        // return;
    } else {
        //here we check for duplicates within the db if you want to create a new account
        $checkDuplicate = "SELECT * FROM userInfo WHERE username='$u' OR email='$email' LIMIT 1";
        $result = mysqli_query($conn, $checkDuplicate);

        $user = mysqli_fetch_assoc($result);

        if ($user) { // if user exists
            if ($user['username'] === $u) {
                echo "<div class=echo><h6 id=malign>Username already exists!</h6></div>";
            } //if

            if ($user['email'] === $email) {
                echo "<div class=echo><h6 id=malign>Email already exists!</h6></div>";
            } //if
        } else {
            echo ("INSIDE ELSE FOR INSERT");
            if (isset($_POST["register"])) {
                //Create an instance; passing `true` enables exceptions
                $mail = new PHPMailer(true);


                //Server settings
                $mail->SMTPDebug = 1;                      //Enable verbose debug output
                $mail->isSMTP();                                            //Send using SMTP
                $mail->Host       = "smtp.gmail.com";                     //Set the SMTP server to send through
                $mail->SMTPAuth   = true;                                   //Enable SMTP authentication
                $mail->SMTPSecure = "tls";            //Enable implicit TLS encryption
                $mail->Port       = 587;                                    //TCP port to connect to; use 587 if you have set `SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS`
                $mail->Username   = "OfficialLittyLit@gmail.com";                     //SMTP username
                $mail->Password   = "mean1234";                               //SMTP password
                $mail->Subject = "Test Email";


                //Recipients
                $mail->setFrom("OfficialLittyLit@gmail.com");

                $verification_code = substr(number_format(time() * rand(), 0, '', ''), 0, 6);

                $body = '<strong>Hello!</strong> Welcome to LittyLit. Here is your verification Code: ' . $verification_code . '</p>';


                //Content
                $mail->isHTML(true);                                  //Set email format to HTML
                $mail->Body    = $body;

                $mail->addAddress($email);     //Add a recipient

                if($mail->Send()) {
                    echo "Message has been sent";
                    

                    $sql = "INSERT INTO userInfo (firstName, lastName, username, password, email, birthday, strAddress, 
                    city, state, zip, userType, promotion, verification_code, email_verified_at, verified) 
                    VALUES ('". $firstName ."' , '". $lastName ."' , '". $u ."' , '". $p ."' , '". $email ."' , '". $birthday ."' , '". $strAddress ."' ,
                    '". $city ."' , '". $state ."' , '". $zip ."' , '". $userType ."' , '". $promotion ."' , '". $verification_code ."', NULL, '". 0 ."')";
                    mysqli_query($conn, $sql);

                    header("Location: verify.php");
                } else {
                    echo "Error...!";
                }

                //Connect to database
                
                
                $mail->smtpClose();
            }


            if (isset($_SESSION['username'])) {

                header('Location: home.php');
                exit();
            } else if (isset($_POST['username'])) {
                $username = $_POST['username'];
                $_SESSION['username'] = $username;
                $url = "verification.php";
                header('Location: home.php');

                //header(string: 'Location: ' . "cp.php");
                exit();
            }
            }
        }
    }





?>
<!DOCTYPE html>

<head>
    <link href="registration.css" rel="stylesheet">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.1/css/bootstrap.min.css">
    <title>LittyLit</title>
    <link href='https://fonts.googleapis.com/css?family=Nunito' rel='stylesheet'>
    <link href='https://fonts.googleapis.com/css?family=Girassol' rel='stylesheet'>
    <link rel="icon" href="/images/favicon.ico?" type="image/x-icon">
</head>

<body class="d-flex flex-column min-vh-100">
    <main>
        <?php include 'elements/generic-header.html'; ?>
        <!-- Page Content -->
        <div class="container-fluid text-center">
            <div class="row h-100 content justify-content-center">
                <!-- Main Page Portion -->
                <div class="col-sm-10">
                    <div class="ml-4 mt-5">
                        <h1>LittyLit</h1>
                        <h3>Let's get you registered!</h3>
                        <form method="post">
                            <div class="pt-2 row justify-content-center">
                                <div class="col-8 t-2 form-group">
                                    <div class="col-9 t-2 form-group form-check form-check-inline">
                                        <h6 class="mr-5 px-4" style="font-family: Nunito;">I am registering as a...</h6>
                                        <input type="radio" id="Customer" name="userType" value="1" class="m-3">
                                        <label for="Customer">Customer</label><br>
                                        <input type="radio" id="Vendor" name="userType" value="2" class="m-3">
                                        <label for="Vendor">Vendor</label><br>
                                    </div>
                                </div>
                            </div>
                    </div>
                    <div class="pt-2 row justify-content-center">
                        <div class="col-4">
                            <div class="pt-2 form-group">
                                <label for="firstName">First Name</label>
                                <input type="text" placeholder="First Name" class="form-control" id="firstName" name="firstName" required>
                            </div>
                        </div>
                        <div class="col-4">
                            <div class="pl-2 pt-2 form-group">
                                <label for="lastName">Last Name</label>
                                <input type="text" placeholder="Last Name" class="form-control" id="lastName" name="lastName" required>
                            </div>
                        </div>
                    </div>
                    <div class="pt-2 row justify-content-center">
                        <div class="col-8 t-2 form-group">
                            <label for="email">Email</label>
                            <input type="text" placeholder="Email" class="form-control" id="email" name="email" required>
                        </div>
                    </div>
                    <div class="pt-2 row justify-content-center">
                        <div class="col-4">
                            <div class="pt-2 form-group">
                                <label for="username">Username</label>
                                <input type="text" placeholder="Username" class="form-control" id="username" name="u" required>
                            </div>
                        </div>
                        <div class="col-4">
                            <label for="password">Password</label>
                            <div class="pl-2 pt-2 form-group">
                                <input type="password" placeholder="Password" class="form-control" id="password" name="p" required>
                            </div>
                        </div>
                    </div>
                    <div class="pt-2 row justify-content-center">
                        <div class="col-4">
                            <div class="pt-2 form-group">
                                <label for="username">Birthday</label>
                                <input type="text" placeholder="YYYY-MM-DD" class="form-control" id="birthday" name="birthday" required>
                            </div>
                        </div>
                        <div class="col-4">
                            <div class="pl-2 pt-2 form-group">
                            </div>
                        </div>
                    </div>
                    <div class="row justify-content-center">
                        <div class="col-8">
                            <hr>
                        </div>
                    </div>
                    <div class="pt-2 row justify-content-center">
                        <div class="col-8 t-2 form-group">
                            <label for="address">Street Address</label>
                            <input type="text" placeholder="Street Address" class="form-control" id="strAddress" name="Address" required>
                        </div>
                    </div>
                    <div class="pt-2 mb-4 row justify-content-center">
                        <div class="col-3">
                            <div class="pt-2 form-group">
                                <label for="city">City</label>
                                <input type="text" placeholder="City" class="form-control" id="city" name="City" required>
                            </div>
                        </div>
                        <div class="col-2">
                            <div class="pt-2 form-group">
                                <label for="state">State</label>
                                <input type="text" placeholder="GA" class="form-control" id="state" name="State" required>
                            </div>
                        </div>
                        <div class="col-3">
                            <div class="pl-2 pt-2 form-group">
                                <label for="password">Zip Code</label>
                                <input type="text" placeholder="Zip" class="form-control" id="zip" name="PostalCode" required>
                            </div>
                        </div>
                    </div>
                    <button class="btn-lg btn-primary mt-3" style="background-color: #C8D8E4; border-width: 0px; color: #3F3D56" type="submit" name="register">
                        Continue
                    </button>
                    </form>
                </div>
                <div class="row justify-content-center">
                    <h6 class="m-3" style="font-family: Nunito; font-size: 80%;">Already have an account? Click <a href="/login">here</a> to login.</h6>
                    <div class="col-8 text-right">
                    </div>
                </div>
            </div>
        </div>
        </div>

        <footer class="footer pl-4 mt-auto">
            <p>CSCI 4050 Final Project by Andrew Humble, Elodie Collier, Nisha Rajendra, and Manmeet Gill.</p>
        </footer>
    </main>
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.0/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.1/js/bootstrap.min.js"></script>
</body>

</html>
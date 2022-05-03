<?php

session_start();

require_once('connDB.php');
// connect to the db

if (isset($_POST["verify_email"])) {
    $verification_code = $_POST["verification_code"];


    require_once('connDB.php');

    $getUsernameQuery = "SELECT username, userType FROM userInfo WHERE verification_code = '" . $verification_code . "'";
    $getUsernameResult = $conn->query($getUsernameQuery);
    $getUsernameRow = mysqli_fetch_array($getUsernameResult);

    // echo mysqli_affected_rows($conn);

    if (mysqli_affected_rows($conn) == 0) {
        // echo mysqli_affected_rows($conn);
        // echo "<p>Wrong verification Code</p>";
        header("Location: verify.php");
        // die("Verification Code Failed.");
    } else {
        // echo "<p>You can login now</p>";
        $_SESSION['username'] = $getUsernameRow['username'];
        $_SESSION['userType'] = $getUsernameRow['userType'];
        $val = "UPDATE userInfo SET verified = 1 WHERE verification_code = '" . $verification_code . "'";
        $pls = mysqli_query($conn, $val);
        header("Location: home.php ");
    }

    exit();
}

?>


<head>
    <link href="verification.css" rel="stylesheet">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.1/css/bootstrap.min.css">
    <title>LittyLit</title>
    <link href='https://fonts.googleapis.com/css?family=Nunito' rel='stylesheet'>
    <link href='https://fonts.googleapis.com/css?family=Girassol' rel='stylesheet'>
</head>

<body>

    <main>
        <?php include 'elements/header.php' ?>
        <!-- <form method="POST">
            <div class="container mt-5">
                <h1 class="m-5" style="font-family: Nunito">Welcome to <span
                        style="font-family: Girassol">LittyLit</span></h1>
                <h2>We sent you an email containing a 6-digit verification code. </h2>
                <input type="text" name="verification_code" class="Code"
                    style="border: 2px solid #ffffff; border-radius: 4px;" placeholder="Enter Verification Code"
                    required />
                <input type="submit" class="Login" name="verify_email" value="Verify Email">
            </div>
        </form> -->



        <div class="row justify-content-center">
            <div class="col-sm-8" style="background: #C8D8E4; margin: 10%; border-radius: 25px; padding: 3%;">
                <div class="row justify-content-center">
                    <div class="col-sm-8">
                        <h1 style="font-family: Nunito; text-align: center; color: #3F3D56">Welcome to <span style="font-family: Girassol">LittyLit</span></h1>
                    </div>
                </div>
                <div class="row justify-content-center">
                    <div class="col-sm-8">
                        <h6 style="font-family: Nunito; text-align: center; color: #3F3D56">We sent you an email
                            containing a 6-digit verification code.</h6>
                    </div>
                </div>

                <form method="post">
                    <div class="row justify-content-center pt-4">
                        <div class="col-5 justify-text-center justify-content-center pt-4">
                            <input type="text" name="verification_code" class="Code p-4" style="border: 2px solid #ffffff; border-radius: 4px; text-align: center; font-size: 150%;" placeholder="- - - - - -" required />
                        </div>
                    </div>
                    <div class="row pt-5 justify-content-center">
                        <div class="col-sm-8 text-center">
                            <input style="background-color: #2B6777; border: 5px solid #2B6777; font-family: Nunito; color: #ffffff" type="submit" class="Login p-2 btn btn-primary" name="verify_email" value="Verify Email">
                        </div>
                    </div>
                </form>
            </div>
        </div>

    </main>
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.0/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.1/js/bootstrap.min.js"></script>
</body>

</html>
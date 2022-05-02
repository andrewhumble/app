<?php



if (isset($_POST["verify_email"])) {
    $verification_code = $_POST["verification_code"];


    require_once('connDB.php');

    $sql = "UPDATE userInfo SET email_verified_at = NOW() WHERE verification_code = '" . $verification_code . "'";
    $result = mysqli_query($conn, $sql);

    // echo mysqli_affected_rows($conn);

    if (mysqli_affected_rows($conn) == 0) {
        // echo mysqli_affected_rows($conn);
        // echo "<p>Wrong verification Code</p>";
        header("Location: verify.php");
        // die("Verification Code Failed.");
    } else {
        // echo "<p>You can login now</p>";
        $val = "UPDATE userInfo SET verified = 1 WHERE verification_code = '" . $verification_code . "'";
        $pls = mysqli_query($conn, $val);
        header("Location: welcome.html ");
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
                        <h1 style="font-family: Nunito; text-align: center; color: #3F3D56">Welcome to <span
                                style="font-family: Girassol">LittyLit</span></h1>
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
                        <div class="col-sm-4 justify-content-center pt-4">
                           <input type="text" name="verification_code" class="Code"
                    style="border: 2px solid #ffffff; border-radius: 4px;" placeholder="Enter Verification Code"
                    required />
                        </div>
                    </div>
                    <div class="row pt-5 justify-content-center">
                        <div class="col-sm-8 text-center">
                             <input type="submit" class="Login" name="verify_email" value="Verify Email">
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
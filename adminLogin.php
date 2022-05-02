<?php
session_set_cookie_params(0);

session_start();

require('connDB.php');
//connects to db

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $_POST['username'];
    $password = $_POST['password'];

    $emptyUP = false;

    #Hello
    #bye


    if (empty($username) || empty($password)) {
        echo "<div class=echo><h6>Please fill out all fields.</h6></div>";
    } else {

        $sql = "SELECT * FROM userInfo WHERE username='$username' AND password = '$password' AND userType=3 LIMIT 1";
        $result = mysqli_query($conn, $sql);
        $user = mysqli_fetch_assoc($result);

        if (!$user) {
            echo "<div class=echo><h6>Username or password is incorrect.</h6></div>";
        } else {

            if (isset($_SESSION['username'])) {
                $_SESSION['userType'] = 3;
                header('Location: admin-myAccount.php');
                exit();
            } else if (isset($_POST['username'])) {
                $username = $_POST['username'];
                //  $userType = mysqli_real_escape_string($db, $_POST['userType']);
                $_SESSION['username'] = $username;
                $_SESSION['userType'] = 3;
                $url = "admin-myAccount.php";
                header('Location: admin-myAccount.php');


                exit();
            }
        }
    }
}

?>

<!DOCTYPE>

<head>
    <link href="admin-login.css" rel="stylesheet">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.1/css/bootstrap.min.css">
    <title>Welcome to LittyLit</title>
    <link href='https://fonts.googleapis.com/css?family=Nunito:400,700,400italic,700italic' rel='stylesheet'>
    <link href='https://fonts.googleapis.com/css?family=Girassol:400,700,400italic,700italic' rel='stylesheet'>
</head>

<body>
    <main>
        <?php include 'elements/header.php' ?>
        <div class="row justify-content-center">
            <div class="col-sm-8" style="background: #C8D8E4; margin: 10%; border-radius: 25px; padding: 3%;">
                <div class="row justify-content-center">
                    <div class="col-sm-8">
                        <h1 style="font-family: Nunito; text-align: center">Administrator Login</h1>
                    </div>
                </div>

                <form method="post">
                    <div class="row justify-content-center pt-2">
                        <div class="col-sm-4">
                            <label for="user" style="font-family: Nunito; color: black;">Username</label>
                            <input type="text" class="form-control input-lg" name="username" required>
                        </div>
                    </div>
                    <div class="row justify-content-center pt-4">
                        <div class="col-sm-4">
                            <label for="password" style="font-family: Nunito; color: black;">Password</label>
                            <input type="password" class="form-control input-lg" name="password" required>
                        </div>
                    </div>
                    <div class="row pt-5 justify-content-center">
                        <div class="col-sm-8 text-center">
                            <button style="background-color: #2B6777; border: 5px solid #2B6777; font-family: Nunito;" class="btn btn-primary" type="submit" value="Login">Login</button>
                        </div>
                    </div>
                </form>
            </div>

        </div>
    </main>
</body>
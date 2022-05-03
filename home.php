<?php
require_once('connDB.php');
// Check connection
if ($conn == false) {
    die("ERROR: Could not connect. " . mysqli_connect_error());
}

############
session_start();

//connect to database
require_once('connDB.php');

// Check connection
if ($conn === false) {
    die("ERROR: Could not connect. " . mysqli_connect_error());
}

if (!isset($_SESSION['username'])) {
    header("Location: welcome.html");
    exit();
} else {
    $username = $_SESSION['username'];
    $userType = $_SESSION['userType'];
}
###########

$sql = "SELECT * FROM userInfo WHERE username = '" . $username . "'";
$result = $conn->query($sql);
$values = mysqli_fetch_array($result);
$userType = $values['userType'];

?>

<!DOCTYPE>

<head>
    <link href="home.css" rel="stylesheet">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.1/css/bootstrap.min.css">
    <title>LittyLit</title>
    <link href='https://fonts.googleapis.com/css?family=Nunito:400,700,400italic,700italic' rel='stylesheet'>
    <link href='https://fonts.googleapis.com/css?family=Girassol:400,700,400italic,700italic' rel='stylesheet'>
</head>

<body>
    <main>
        <?php include 'elements/header.php' ?>

        <div class="row">
            <div class="col-md-6 text-center" style="background-color:#2B6777;">
                <h1 class="display-1" style="color: #ffffff; font-family: Girassol; margin-top: 15%; font-size: 150px; text-shadow: 2px 2px 7px #04181E;">
                    LittyLit</h2>
                    <h3 style="color: #ffffff; font-family: Nunito; margin-top: 5%; margin-bottom: 10%; font-size: 30px; margin-right: 10%; margin-left: 10%; text-shadow: 2px 2px 7px #04181E;">
                        LittyLit combines the classic love
                        of literature with a modern retail
                        design.</h3>
                    <?php
                    if ($userType == 1) {
                        echo "<a href='customer-browseCatalog.php'>
                        <button type='button' class='btn-lg btn btn-primary mt-3' style='background-color: #ffffff; border-width: 0px;'>
                            <strong style='color: #3F3D56; font-family: Nunito;'>Browse The Catalog!</strong>
                        </button>
                        </a>";
                    } else if ($userType == 2) {
                        echo "<a href='vendor-myBooks.php'>
                        <button type='button' class='btn-lg btn btn-primary mt-3' style='background-color: #ffffff; border-width: 0px;'>
                            <strong style='color: #3F3D56; font-family: Nunito;'>View Your Listed Books!</strong>
                        </button>
                        </a>";
                    } else if ($userType == 3) {
                        echo "<a href='search_order.php'>
                        <button type='button' class='btn-lg btn btn-primary mt-3' style='background-color: #ffffff; border-width: 0px;'>
                            <strong style='color: #3F3D56; font-family: Nunito;'>Search Orders!</strong>
                        </button>
                        </a>";
                    }
                    ?>
            </div>
            <div class="col-md-6 text-center" style="background-color:#C8D8E4;">
                <img style="padding: 10%;" src="./images/undraw_reading_book_re_kqpk.svg" class="img-fluid" alt="Responsive image">
            </div>
        </div>

        <footer class="footer pl-4">
            <p style="font-family: Nunito;">CSCI 4050 Final Project by Andrew Humble, Elodie Collier, Nisha Rajendra,
                and Manmeet Gill.</p>
        </footer>

    </main>

</body>
<?php
session_start();

//connect to database
// hi
require_once('connDB.php');
// Check connection
if ($conn === false) {
    die("ERROR: Could not connect. " . mysqli_connect_error());
}

if ($_SESSION['userType'] != 3) {
    header("Location: home.php");
}

if (!isset($_SESSION['username'])) {

    header("Location: home.php");
    exit();
} else {
    $username = $_SESSION['username'];
}

?>

<!DOCTYPE html>

<head>
    <link href="admin-searchUsers.css" rel="stylesheet">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.1/css/bootstrap.min.css">
    <title>LittyLit</title>
    <link href='https://fonts.googleapis.com/css?family=Nunito' rel='stylesheet'>
    <link href='https://fonts.googleapis.com/css?family=Girassol' rel='stylesheet'>
    <link href="http://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.3.0/css/font-awesome.css" rel="stylesheet" type='text/css'>

</head>

<body>

    <main>
        <?php include 'elements/header.php' ?>

        <form method="post">
            <div class="container-fluid mt-5 p-5" id="Search">
                <div class="mx-auto text-center" style="width: 400px;">
                    <h1 id="header">Search Orders</h1><br>
                    <div class="input-group rounded">
                        <input type="text" id="inputEmail" class="form-control rounded" placeholder="Order ID" name="Search">
                        <input type="submit" class="btn-lg btn-primary ml-4" style="background-color: #2B6777; border-width: 0px;" name="submit">
                    </div>
                    <p id="para">Enter the order id associated with the person</p>
                </div>
            </div>
        </form>
        <?php include 'elements/footer.html'; ?>
    </main>
</body>

</html>
<?php

if (isset($_POST["submit"])) {
    $_SESSION['order'] = $_POST["Search"];
    $res = $conn->query("SELECT * FROM orders WHERE order_id='" . $_SESSION['order'] . "'");
    $results = mysqli_num_rows($res);
    if ($results > 0) {
        while ($row = mysqli_fetch_object($res)) {
?>
            <div class="container">
                <div class="row">
                    <div class="col-lg" id="left">
                        <h1 class="m-3"><?php echo $row->firstName; ?> <?php echo $row->lastName; ?></h1>
                        <h2>Order ID <?php echo $row->order_id; ?></h2>
                    </div>
                    <div class="col-lg" id="right">
                        <form action="admin-editOrder.php" method="post">
                            <input type="submit" id="EditText" name="edit" value="Edit">
                        </form>
                    </div>
                </div>
            </div>
<?php
        }
    } else {
        echo "<h3>Order ID does not exist!</h3>";
    }
}

?>
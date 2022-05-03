<?php
session_start();

//connect to database
require_once('connDB.php');
// Check connection
if ($conn === false) {
    die("ERROR: Could not connect. " . mysqli_connect_error());
}

if ($_SESSION['userType'] != 2) {
    header("Location: home.php");
}

$userType = $_SESSION['userType'];
//ensures someone is logged inbefore allowing them to create a profile
if (!isset($_SESSION['username']) || $_SESSION['userType'] != 2) {

    header("Location: welcome.html");
    exit();
} else {
    $username = $_SESSION['username'];
    $userType = $_SESSION['userType'];
}

$getBooksQuery = "SELECT username, title, author, price, genre, ISBN, stock, imgPath FROM book WHERE username='$username';";
$values = $conn->query($getBooksQuery);

$length = mysqli_num_rows($values);

$order = array_fill(0, $length, NULL);

$i = 0;
while ($row = mysqli_fetch_array($values)) {
    $order[$i] = $row;
    $i++;
}

?>







<!DOCTYPE>

<head>
    <link href="vendor-myBooks.css" rel="stylesheet">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.1/css/bootstrap.min.css">
    <title>LittyLit</title>
    <link href='https://fonts.googleapis.com/css?family=Nunito' rel='stylesheet'>
    <link href='https://fonts.googleapis.com/css?family=Girassol' rel='stylesheet'>
</head>

<body>

    <main>
        <nav class="navbar navbar-expand-lg navbar-light bg-light">
            <a class="navbar-brand pl-4" href="#" style="font-size: 60px; color: #3F3D56">LittyLit</a>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNavAltMarkup" aria-controls="navbarNavAltMarkup" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse justify-content-end" id="navbarNavAltMarkup">
                <div class="navbar-nav d-lg-flex align-items-center mt-3">
                    <a class="nav-item h-100 nav-link" href="vendor-myBooks.php">
                        <h5>My Books</h5>
                    </a>
                    <a class="nav-item h-100 nav-link" href="vendor-myAccount.php">
                        <h5>My Account</h5>
                    </a>
                </div>
            </div>
        </nav>

        <div class="container">
            <div class="row">
                <div class="col-lg-6">
                    <h1>My Books</h1>
                </div>
                <div class="col-lg-6">
                    <button onclick="window.location.href='vendor-addBook.php'" class="AddText">Add Book</button><br>
                </div>

            </div>

        </div>
        <!-- <div class="Search" style="width:1300px; height:100px; background-color: chocolate;">
            <h1>My Books</h1>
            <button onclick="window.location.href='#'" class="AddText">Add Book</button><br>
          </div> -->
        <br>
        <br>
        <br>



        <div class="row">
            <?php foreach ($order as $o) { ?>

                <div class="center">
                    <img class="pic" src="<?php echo $o['imgPath'] ?>" alt="Place Holder Book" style="width:150px; height:200px; margin-top: 20px" /><br>

                    <h4><?php echo $o['title']; ?></h4>


                    <!-- <?php $_SESSION['title'] = $o['title']; ?> -->


                    <p><?php echo $o['author']; ?></p>
                    <?php $_SESSION['author'] = $o['author']; ?>

                    <pre> Inventory: <?php echo $o['stock']; ?>               <?php echo $o['price']; ?></pre>
                    <a href="vendor-editBook.php?selectedBook=<?php echo $o['ISBN'] ?>" class="EditText">Edit</a>
                    <!-- <button onclick="window.location.href='vendor-editBook.php'" class="EditText">Edit</button><br> -->

                </div>
            <?php } ?>

        </div>

    </main>
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.0/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.1/js/bootstrap.min.js"></script>




</body>

</html>
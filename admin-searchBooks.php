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








<?php
// Include the database configuration file  


// Get image data from database 

?>



<!-- DISPLAY IMAGE -->


<!-- <!DOCTYPE html>
<html>

<head>
    <link href="admin-searchBooks.css" rel="stylesheet">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.1/css/bootstrap.min.css">
    <title>LittyLit</title>
    <link href='https://fonts.googleapis.com/css?family=Nunito' rel='stylesheet'>
    <link href='https://fonts.googleapis.com/css?family=Girassol' rel='stylesheet'>
    <link href="http://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.3.0/css/font-awesome.css" rel="stylesheet" type='text/css'>
    <title>Store and retrieve image</title>
    <style>
        <?php include "admin-searchBooks.css" ?>
    </style>
</head>

<body>

    <nav class="navbar navbar-expand-lg navbar-light bg-light">
        <a class="navbar-brand pl-4" href="#" style="font-size: 60px; color: #3F3D56">LittyLit</a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNavAltMarkup" aria-controls="navbarNavAltMarkup" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse justify-content-end" id="navbarNavAltMarkup">
            <div class="navbar-nav d-lg-flex align-items-center mt-3">
                <a class="nav-item h-100 nav-link" href="#">
                    <h5>Search Orders</h5>
                </a>
                <a class="nav-item h-100 nav-link" href="#">
                    <h5>Search Users</h5>
                </a>
                <a class="nav-item h-100 nav-link" href="#">
                    <h5>Search Books</h5>
                </a>
                <a class="nav-item h-100 nav-link" href="#">
                    <h5>My Account</h5>
                </a>
                <a class="nav-item h-100 nav-link" href="#">
                    <h5>Reports</h5>
                </a>
            </div>
        </div>
    </nav> -->

<!DOCTYPE html>

<head>
    <link href="admin-searchBooks.css" rel="stylesheet">
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
                    <h1 id="header">Search Books</h1><br>
                    <div class="input-group rounded">

                        <input type="text" id="inputEmail" class="form-control rounded" placeholder="ISBN" name="Search" />
                        <input type="submit" class="btn-lg btn-primary ml-4 mb-2" style="background-color: #2B6777; border-width: 0px;" name="submit">
                    </div>
                    <p id="para">Search by ISBN</p>
                </div>
            </div>
        </form>
    </main>
    <?php include 'elements/footer.html'; ?>
</body>

</html>

<!-- <form method="post">
        <div class="container-fluid mt-5" id="Search">
            <div class="mx-auto text-center" style="width: 400px;">
                <h1 id="header">Search Books</h1><br>
                <div class="input-group rounded">

                    <input type="text" id="inputEmail" class="form-control rounded" placeholder="ISBN" name="Search" />
                    <input type="submit" name="submit">
                </div>
                <p id="para">Search by ISBN</p>
            </div>
        </div>
    </form> -->

<!-- <div class="container">
    <h1> Retrive</h1>
    <?php if ($result->num_rows > 0) { ?> 
    <div class="gallery"> 
        <?php while ($row = $result->fetch_assoc()) { ?> 
            <img src="<?php echo $row['imgPath'] ?>" /> 
        <?php } ?> 
    </div> 
<?php } else { ?> 
    <p class="status error">Image(s) not found...</p> 
<?php } ?>
</div>
<a href="show_book.php">Upload</a>
</div> -->

<div class="col-sm-12 pt-4">
    <div class="row justify-content-center" style="margin-bottom: 7rem;">


        <?php



        if (isset($_POST["submit"])) {
            $_SESSION['is'] = $_POST["Search"];
            $val = $conn->query("SELECT imgPath FROM `book` WHERE ISBN= '" . $_SESSION['is'] . "'");
            $bookImgRes = mysqli_fetch_array($val);
            if ($bookImgRes != NULL) {
                $bookImg = $bookImgRes['imgPath'];
            }

            $res = $conn->query("SELECT * FROM `book` WHERE ISBN = '" . $_SESSION['is'] . "'");

            $results = mysqli_num_rows($res);
            if ($results > 0) {
                while ($row = mysqli_fetch_array($res)) {
        ?>


                    <a href="admin-editBook.php">
                        <div class="card ml-4 mr-4 mt-4 mb-4" style="background-color: #2B6777; height: 22rem; width: 15rem; border-radius: 1em !important;">
                            <div class="col-sm-12 justify-content-center">
                                <div class="row">
                                    <div class="card-body ml-1">
                                        <img class="card-img-top mx-auto mt-3 mb-4" src="<?php echo $bookImg ?>" alt="Place Holder Book" style="height: 10rem; width: 8rem; display:block">
                                        <div class="row justify-content-center">
                                            <h4 class="card-title text-center" style="font-size: 1.2rem;">
                                                <?php echo $row['title']; ?></h4>
                                        </div>
                                        <div class="row justify-content-center" style="margin-top: -0.5rem; font-size: 0.9rem;">
                                            <p class="card-text" style="color: #fff !important;"><?php echo $row['author']; ?>
                                            </p>
                                        </div>
                                        <div class="row pt-4 justify-content-center">
                                            <p class="card-text" style="font-size: 1.3rem; color: #fff !important;">
                                                <?php echo "$" . number_format($row['price'], 2) ?></p>
                                        </div>
                                        <div class="row pt-1 justify-content-center">
                                            <p class="card-text" style="font-size: 0rem; color: #fff !important;">
                                                <?php echo $row['stock'] ?> in stock</p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </a>
        <?php
                }
            } else {
                echo "<h3>ISBN Not Found!</h3>";
            }
        }




        ?>
    </div>
</div>

<!-- </body>

</html> -->
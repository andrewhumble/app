<?php
require('connDB.php');

if ($_SESSION['userType'] != 3) {
    header("Location: home.php");
}
?>








<?php
// Include the database configuration file  


// Get image data from database 

?>



<!-- DISPLAY IMAGE -->


<!DOCTYPE html>
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
    </nav>

    <form method="post">
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
    </form>

    <!-- <div class="container">
    <h1> Retrive</h1>
    <?php if ($result->num_rows > 0) { ?> 
    <div class="gallery"> 
        <?php while ($row = $result->fetch_assoc()) { ?> 
            <img src="data:image/jpg;charset=utf8;base64,<?php echo base64_encode($row['image']); ?>" /> 
        <?php } ?> 
    </div> 
<?php } else { ?> 
    <p class="status error">Image(s) not found...</p> 
<?php } ?>
</div>
<a href="show_book.php">Upload</a>
</div> -->



    <?php

    if (isset($_POST["submit"])) {
        $ISBN = $_POST["Search"];
        $val = $conn->query("SELECT image FROM `book` WHERE ISBN ='$ISBN'");
        $res = $conn->query("SELECT * FROM `book` WHERE ISBN = '$ISBN'");
        $results = mysqli_num_rows($res);
        if ($results > 0) {
            while ($row = mysqli_fetch_object($res)) {
    ?>



                <div class="container">
                    <div class="center">

                        <!-- Uploading image -->
                        <?php if ($val->num_rows > 0) { ?>
                            <?php while ($blah = $val->fetch_assoc()) { ?>
                                <img id="pic" src="data:image/jpg;charset=utf8;base64,<?php echo base64_encode($blah['image']); ?>" alt="Place Holder Book" style="width:150px; height:200px; margin-top: 20px" /><br>
                            <?php } ?>
                        <?php } else { ?>
                            <p class="status error">Image(s) not found...</p> <?php } ?>
                        <!-- <img class="pic" src= "images/Gatsby.png" alt="Place Holder Book" style="width:150px;height:200px;"> -->
                        <h4 id="work"><?php echo $row->title; ?></h4>
                        <p id="auth"><?php echo $row->author; ?></p><br>
                        <pre id="change">  Inventory: <?php echo $row->Inventory; ?>           <?php echo $row->price; ?></pre>
                        <!-- <p id="change"><?php echo $row->price; ?></p><br> -->
                        <button onclick="window.location.href='#'" class="EditText">Edit</button><br>

                    </div>

        <?php
            }
        } else {
            echo "Name Does not exist";
        }
    }

        ?>


</body>

</html>
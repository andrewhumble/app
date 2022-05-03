<?php
session_set_cookie_params(0);

session_start();

require('connDB.php');

if ($conn === false) {
    die("ERROR: Could not connect. " . mysqli_connect_error());
}

if ($_SESSION['userType'] != 2) {
    header("Location: home.php");
}

$userType = $_SESSION['userType'];

if (!isset($_SESSION['username']) || $_SESSION['userType'] != 2) {

    header("Location: welcome.html");
    exit();
} else {
    $username = $_SESSION['username'];
    $userType = $_SESSION['userType'];

    echo $username;
}


if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $title = $_POST["title"];
    $author = $_POST["author"];
    $genre = $_POST["genre"];
    $price = $_POST["price"];
    $isbn = $_POST["isbn"];
    $stock = $_POST["inventory"];

    echo $title;
    $target_dir = "images/";
    $target_file = $target_dir . basename($_FILES["image"]["name"]);

    $uploadOk = 1;
    $imageFileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));

    $status = $statusMsg = '';
    if (isset($_POST["save"])) {
        $check = getimagesize($_FILES["image"]["tmp_name"]);
        if ($check !== false) {
            echo "File is an image - " . $check["mime"] . ".";
            $uploadOk = 1;
        } else {
            echo "File is not an image.";
            $uploadOk = 0;
        }
    }


    //Check if file already exists
    if (file_exists($target_file)) {
        echo "Sorry, file already exists.";
        $uploadOk = 0;
    }

    //Check file size
    if ($_FILES["image"]["size"] > 1000000) {
        echo "Sorry, your file is too large.";
        $uploadOk = 0;
    }

    //Allow certain file formats
    if (
        $imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg"
        && $imageFileType != "gif"
    ) {
        echo "Sorry, only JPG, JPEG, PNG & GIF files are allowed.";
        $uploadOk = 0;
    }

    //Check if $uploadOk is set to 0 by an error
    if ($uploadOk == 0) {
        echo "Sorry, your file was not uploaded.";
        //if everything is ok, try to upload file
    } else {
        if (move_uploaded_file($_FILES["image"]["tmp_name"], $target_file)) {
            echo "The file " . htmlspecialchars(basename($_FILES["image"]["name"])) . " has been uploaded.";
            $insert = "INSERT into book (username, title, author, price, genre, ISBN, stock, image) VALUES ('mg', '$title', '$author', '$price', '$genre', '$isbn', '$stock', '$target_file')";
            $conn->query($insert);
            echo $insert;
        } else {
            echo "Sorry, there was an error uploading your file.";
        }
    }

    $status = 'error';

    //     if(!empty($_FILES["image"]["name"])) { 
    //         $fileName = basename($_FILES["image"]["name"]); 
    //         $fileType = pathinfo($fileName, PATHINFO_EXTENSION); 
    //         echo "HELLUR";

    //         $allowTypes = array('jpg','png','jpeg','gif'); 
    //         if(in_array($fileType, $allowTypes)){ 
    //             $image = $_FILES['image']['tmp_name']; 
    //             $imgContent = addslashes(file_get_contents($image)); 


    //             $insert = $conn->query("INSERT into book (id, title, author, price, genre, ISBN, stock, image, created) VALUES ('23', '$title', '$author', '$price', '$genre', '$isbn', '$stock', '$imgContent', NOW())");  

    //             if($insert){ 
    //                 $status = 'success'; 
    //                 echo $status;
    //                 $statusMsg = "File uploaded successfully."; 

    //             }else{ 
    //                 $statusMsg = "File upload failed, please try again."; 
    //             }  
    //         }else{ 
    //             $statusMsg = 'Sorry, only JPG, JPEG, PNG, & GIF files are allowed to upload.'; 
    //         } 
    //     }else{ 
    //         $statusMsg = 'Please select an image file to upload.'; 
    //     } 
    // echo $statusMsg;


}


?>




<!DOCTYPE>

<head>
    <link href="vendor-addBook.css" rel="stylesheet">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.1/css/bootstrap.min.css">
    <title>LittyLit</title>
    <link href='https://fonts.googleapis.com/css?family=Nunito' rel='stylesheet'>
    <link href='https://fonts.googleapis.com/css?family=Girassol' rel='stylesheet'>
</head>

<body>

    <main>
        <!-- <ul>
            <li><a class="active" href="home.html">LittyLit</a></li>
            <a href="#" class = "MyBooks"><b>My Account</b></a>
            <a href="#" class = "MyBooks"><b>My Books</b></a>
          </ul> -->
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

        <a href="#" class="GoBack"><b>
                << Go Back</b></a>

        <div class="container">
            <form method="post" action="vendor-addBook.php" method="post" enctype="multipart/form-data">
                <div class="row">
                    <div class=col-lg-3>
                        <img class="pic" src='#' alt="" style="width:210px;height:350px;">
                        <label>Select Image File:</label>
                        <input type="file" name="image">
                        <!-- <a href="#" class="Cover"><b>Change Cover</b></a> -->

                    </div>


                    <div class=col-lg-3 id="QMiddle">
                        <p><b>Book Title</b></p><br>

                        <input class="Text" type="text" id="btitle" name="title"><br><br>

                        <p><b>Author</b></p><br>
                        <input class="Text" type="text" id="btitle" name="author"><br><br>

                        <p><b>Genre</b>
                        <p><br>
                            <input class="TextDrop" type="text" name="genre"><br><br>
                            <!-- <select class="TextDrop">  
                            <option style="font-weight: bolder;" value = "Fiction" selected> Select a Genre  
                            </option>  
                            </select> -->


                    </div>
                    <div class=col-lg-3 id="QEnd">
                        <p><b>Inventory:</b></p>
                        <input class="Inventory" type="text" name="inventory"><br><br>
                        <!-- <select class="Inventory">  
                                <option style="font-weight: bolder;" value = "Number" selected> #  
                                </option>  
                            </select><br><br> -->

                        <p><b>Price</b></p><br>
                        <p>$</p><input class="TextPrice" type="text" id="btitle" name="price"><br><br>

                        <p><b>ISBN</b></p><br>
                        <input class="TextISBN" type="text" id="btitle" name="isbn"><br><br>


                    </div>
                    <div class=col-lg-3 id="Button">
                        <button class="SaveChanges" name="save">Save Changes</button><br>
                        <!-- onclick="window.location.href='#'" -->
                        <a href="#" class="Remove"><b>Remove Book</b></a>

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
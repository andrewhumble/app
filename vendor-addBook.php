<?php
session_set_cookie_params(0);
   
session_start();

require ('connDB.php');


if($_SERVER["REQUEST_METHOD"] == "POST") {
    $title = $_POST["title"];
    $author = $_POST["author"];
    $genre = $_POST["genre"];
    $price = $_POST["price"];
    $isbn = $_POST["isbn"];
    $inventory = $_POST["inventory"];

    echo $title;

    $status = $statusMsg = ''; 
    if (isset($_POST["save"])) {
        $status = 'error'; 
        
        if(!empty($_FILES["image"]["name"])) { 
            // Get file info 
            $fileName = basename($_FILES["image"]["name"]); 
            $fileType = pathinfo($fileName, PATHINFO_EXTENSION); 
            $folder = "images/".$filename;
            echo "HELLUR";
            // Allow certain file formats 
            $allowTypes = array('jpg','png','jpeg','gif'); 
            if(in_array($fileType, $allowTypes)){ 
                $image = $_FILES['image']['tmp_name']; 
                $imgContent = addslashes(file_get_contents($image)); 
             
                // Insert image content into database 
                $insert = $conn->query("INSERT into book (id, title, author, genre, price, isbn, Inventory, image, created) VALUES ('23', '$title', '$author', '$genre', '$price', '$isbn', '$inventory', '$imgContent', NOW())");  
                 
                if($insert){ 
                    $status = 'success'; 
                    $statusMsg = "File uploaded successfully."; 
                    // $result = $conn->query("SELECT image FROM book WHERE isbn='12345'"); 
                }else{ 
                    $statusMsg = "File upload failed, please try again."; 
                }  
            }else{ 
                $statusMsg = 'Sorry, only JPG, JPEG, PNG, & GIF files are allowed to upload.'; 
            } 
        }else{ 
            $statusMsg = 'Please select an image file to upload.'; 
        } 
    // if(!empty($_FILES["image"]["name"])) { 

        // Get file info 
    //     $fileName = basename($_FILES["image"]["name"]); 
    //     $fileType = pathinfo($fileName, PATHINFO_EXTENSION); 
         
    //     // Allow certain file formats 
    //     $allowTypes = array('jpg','png','jpeg','gif'); 
    //     if(in_array($fileType, $allowTypes)){ 
    //         $image = $_FILES['image']['tmp_name']; 
    //         $imgContent = addslashes(file_get_contents($image)); 
         
    //         // Insert image content into database 
    //         echo ($conn->query("INSERT into book (id, title, author, genre, price, isbn, Inventory, image, created) VALUES ('23', '$title', '$author', '$genre', '$price', '$isbn', $inventory, '$imgContent', NOW())"));  
             
    //         if($insert){ 
    //             $status = 'success'; 
    //             $statusMsg = "File uploaded successfully."; 
    //             echo $statusMsg;
    //         }else{ 
    //             $statusMsg = "File upload failed, please try again."; 
    //             echo $statusMsg;
    //         }  
    //     }else{ 
    //         $statusMsg = 'Sorry, only JPG, JPEG, PNG, & GIF files are allowed to upload.'; 
    //     } 
    // }else{ 
    //     $statusMsg = 'Please select an image file to upload.'; 
    //     echo $statusMsg;
    // } 

    }
}


?>




<!DOCTYPE>
<head>
    <link href="vendor-addBook.css" rel="stylesheet">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.1/css/bootstrap.min.css">
    <title>Welcome to LittyLit</title>
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
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNavAltMarkup"
                aria-controls="navbarNavAltMarkup" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse justify-content-end" id="navbarNavAltMarkup">
                <div class="navbar-nav d-lg-flex align-items-center mt-3">
                    <a class="nav-item h-100 nav-link" href="#">
                        <h5>My Books</h5>
                    </a>
                    <a class="nav-item h-100 nav-link" href="#">
                        <h5>My Account</h5>
                    </a>
                </div>
            </div>
        </nav>
          
          <a href="#" class = "GoBack"><b> << Go Back</b></a>
          
          <div class="container">
          <form method="post" action="vendor-addBook.php" method="post" enctype="multipart/form-data">
              <div class="row"> 
                  <div class=col-lg-3>
                    <img class="pic" src='$folder'  alt="" style="width:210px;height:350px;">
                    <!-- <a href="#" class="Cover"><b>Change Cover</b></a> -->
                    <label>Select Image File:</label>
                    <input type="file" name="image">

                  </div>
                  
                  <div class=col-lg-3 id="QMiddle">
                        <p><b>Book Title</b></p><br>
                    
                        <input class="Text" type="text" id="btitle" name="title"><br><br>
    
                        <p><b>Author</b></p><br>
                        <input class="Text" type="text" id="btitle" name="author"><br><br>
    
                        <p><b>Genre</b><p><br>
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
                    <button  class="SaveChanges" name="save">Save Changes</button><br>
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
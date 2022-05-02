<!DOCTYPE>
<head>
    <link href="vendor-myBooks.css" rel="stylesheet">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.1/css/bootstrap.min.css">
    <title>Welcome to LittyLit</title>
    <link href='https://fonts.googleapis.com/css?family=Nunito' rel='stylesheet'>
    <link href='https://fonts.googleapis.com/css?family=Girassol' rel='stylesheet'>
</head>
<body>

    <main>
          <nav class="navbar navbar-expand-lg navbar-light bg-light">
            <a class="navbar-brand pl-4" href="#" style="font-size: 60px; color: #3F3D56">LittyLit</a>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNavAltMarkup"
                aria-controls="navbarNavAltMarkup" aria-expanded="false" aria-label="Toggle navigation">
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
            <div class="center">  
                <img class="pic" src= "images/Gatsby.png" alt="Place Holder Book" style="width:150px;height:200px;">
                <h4>The Great Gatsby</h4>
                <p>F. Scott Fitzgerald</p>
                <pre>  Inventory: 52                         $5.00</pre>
                <button onclick="window.location.href='vendor-editBook.php'" class="EditText">Edit</button><br>
                
          </div>
          
            <div class="center">  
                <img class="pic" src= "images/HarryPotter.png" alt="Place Holder Book" style="width:150px;height:200px;">
                <h4>Harry Potter and Sorcerer's Stone</h4>
                <p>J.K. Rowling</p>
                <pre>  Inventory: 64                         $5.00</pre>
                <button onclick="window.location.href='vendor-editBook.php'" class="EditText">Edit</button><br>
                
            </div>

            <div class="center">  
                <img class="pic" src= "images/Pride.png" alt="Place Holder Book" style="width:150px;height:200px;">
                <h4>Pride and Prejudice</h4>
                <p>Jane Austen</p>
                <pre>  Inventory: <span style="color: red;">Low</span>                        $5.00</pre>
                <button onclick="window.location.href='vendor-editBook.php'" class="EditText">Edit</button><br>
                
            </div>
        </div>  
            
    </main>
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.0/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.1/js/bootstrap.min.js"></script>
</body>

</html>
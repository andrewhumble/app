

<!DOCTYPE>
<head>
    <link href="admin-editBook.css" rel="stylesheet">
    <title>Welcome to LittyLit</title>
    <link href='https://fonts.googleapis.com/css?family=Nunito' rel='stylesheet'>
    <link href='https://fonts.googleapis.com/css?family=Girassol' rel='stylesheet'>
</head>
<body>

    <main>
        <ul>
            <li><a class="active" href="home.html">LittyLit</a></li>
            <li><a class="searchOrdersNav" href="">Search Orders</a></li>
            <li><a class="searchUsersNav" href="">Search Users</a></li>
            <li><a class="searchBooksNav" href="">Search Books</a></li>
            <li><a class="myAccNav" href="admin-myAccount.html">My Account</a></li>
            <li><a class="reportsNav" href="">Reports</a></li>
          </ul>
          
          <a href="#" class = "GoBack"><b> << Go Back</b></a>

          <div class="center">
              <div class="picLeft" style="width: 280px;height:510px;">
                <img class="pic" src= "images/Gatsby.png" alt="Place Holder Book" style="width:210px;height:350px;">
                <a href="#" class="Cover"><b>Change Cover</b></a>
              </div>

              <div class="QMiddle" style="width: 350px;">
                <form action="">
                    <p><b>Book Title</b></p><br>
                    <!-- <h3 class="Text">The Great Gatsby </h3> -->
                    <input class="Text" type="text" id="btitle" name="btitle" placeholder="The Great Gatsby"><br><br>

                    <p><b>Author</b></p><br>
                    <!-- <h3 class="Text">F. Scott Fitzgerald </h3> -->
                    <input class="Text" type="text" id="btitle" name="btitle" placeholder="F. Scott Fitzgerald"><br><br>

                    <p><b>Genre</b><p><br>
                        <select class="TextDrop">  
                        <option style="font-weight: bolder;" value = "Fiction" selected> Fiction   
                        </option>  
                        </select>
                </form>
              </div>

              <div class="QEnd" style="width: 300px;">
                <form action="">
                    <p><b>Inventory:</b></p>
                        <select class="Inventory">  
                            <option style="font-weight: bolder;" value = "Number" selected> 100   
                            </option>  
                        </select><br><br>

                    <p><b>Price</b></p><br>
                    <p>$</p><input class="TextPrice" type="text" id="btitle" name="btitle" placeholder="5.00"><br><br>

                    <p><b>ISBN</b></p><br>
                    <input class="TextISBN" type="text" id="btitle" name="btitle" placeholder="ABC123"><br><br>
                </form>
            </div>

            <div class="Buttons" style="width: 300px;">
                <a href="#" class="Remove"><b>Remove Book</b></a>
                <button onclick="window.location.href='#'" class="SaveChanges">Save Changes</button>

            </div>

          </div>
    </main>
</body>

</html>
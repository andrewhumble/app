<?php
require('connDB.php');
?>

<!DOCTYPE html>

<head>
    <link href="admin-searchUsers.css" rel="stylesheet">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.1/css/bootstrap.min.css">
    <title>Welcome to LittyLit</title>
    <link href='https://fonts.googleapis.com/css?family=Nunito' rel='stylesheet'>
    <link href='https://fonts.googleapis.com/css?family=Girassol' rel='stylesheet'>
    <link href="http://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.3.0/css/font-awesome.css" rel="stylesheet" type='text/css'>

</head>

<body>

    <main>
        <?php include 'elements/header.php' ?>

        <!-- This should be generic html code -->
        <form method="post">
            <div class="container-fluid mt-5" id="Search">
                <div class="mx-auto text-center" style="width: 400px;">
                    <h1 id="header">Search Users</h1><br>
                    <div class="input-group rounded">

                        <input type="text" id="inputEmail" class="form-control rounded" placeholder="username" name="Search" />
                        <input type="submit" name="submit">
                    </div>
                    <p id="para">Enter username associated with the person</p>
                </div>
            </div>
        </form>
    </main>
</body>

</html>



<?php

session_start();

if (isset($_POST["submit"])) {
    $_SESSION['user'] = $_POST["Search"];
   echo $_SESSION['user'];
    $res = $conn->query("SELECT * FROM userInfo WHERE username='".$_SESSION['user']."'");
    $results = mysqli_num_rows($res);
    if ($results > 0) {
        while ($row = mysqli_fetch_object($res)) {
?>
            <div class="container">
                <div class="row">
                    <div class="col-lg" id="left">
                        <h1><?php echo $row->firstName; ?> <?php echo $row->lastName; ?></h1>
                        <h2><?php echo $row->email; ?></h2>
                    </div>
                    <div class="col-lg" id="right">
                        <form action="admin-editUser.php" method="post">
                            <input type="submit" id="EditText" name="edit">
                        </form>
                        <!-- <button onclick="window.location.href='admin-editUser.php'" id="EditText">Edit</button><br> -->
                    </div>
                </div>
            </div>
<?php
        }
    } else {
        echo "Name Does not exist";
    }
}

?>
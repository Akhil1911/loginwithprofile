<?php
session_start();
if (!isset($_SESSION['email'])) {
    header("Location: index.php");
}

?>

<?php

include("functions.php");
include 'partials/_dbconnect.php';
?>
<!doctype html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <link rel="stylesheet" href="style.css">

    <title>TODOs</title>
</head>

<body>

    <!-- ================================================================================================ -->
    <!-- navbar -->
    <!-- ================================================================================================ -->
    <nav class="navbar navbar-expand-lg navbar-light">
        <div class="container-fluid">
            <a class="navbar-brand" href="/login/welcome.php">TODOs</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                    <li class="nav-item">
                        <a class="nav-link nav-link-ltr" href="/login/welcome.php">Home</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link nav-link-ltr" href="/login/todosindex.php">TODOs</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link nav-link-ltr" href="/login/profile.php">Edit Profile</a>
                    </li>
                </ul>
                <ul class="navbar-nav ms-auto mb-2 mb-lg-0">
                    <li class="nav-item">
                        <a class="nav-link nav-link-ltr" aria-current="page" href="#">Welcome -
                            
                        <?php 
                        $semail = $_SESSION['email'];
                        $sql = "select * from todos where email = '$semail'"; 
                        $result = mysqli_query($conn , $sql);
                        while($row = mysqli_fetch_assoc($result)){
                            $username = $row['username'];
                        }
                        echo $username;
                        ?>
                            
                            </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link nav-link-ltr" aria-current="page" href="/login/logout.php">Logout</a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>



    <!-- ================================================================================================ -->
    <!-- script -->
    <!-- ================================================================================================ -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>

</body>

</html>
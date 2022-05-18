<?php
include 'partials/_dbconnect.php';
include("functions.php");
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
    <!-- signup Modal -->
    <!-- ================================================================================================ -->

    <div class="modal fade" id="signupmodal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">SignUp</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form action="/login/index.php" method="post" enctype="multipart/form-data">
                    <div class="modal-body">
                        <div class="mb-3">
                            <label for="username" class="form-label">Username :</label>
                            <input type="text" class="form-control" id="username" name="username" placeholder="Enter Your Username" required>
                        </div>
                        <div class="mb-3">
                            <label for="email" class="form-label">Email :</label>
                            <input type="email" name="email" class="form-control" id="email" placeholder="Enter Your Email" required>
                        </div>
                        <div class="mb-3">
                            <label for="Mobile" class="form-label">Mobile :</label>
                            <input type="number" class="form-control" id="mobile" name="mobile" placeholder="Enter Your Mobile" required>
                        </div>
                        <div class="mb-3">
                            <label for="userimage" class="form-label">Add Image :</label>
                            <input type="file" class="form-control" id="userimage" name="userimage" required>
                        </div>
                        <div class="mb-3">
                            <label for="password" class="form-label">Password :</label>
                            <input type="password" class="form-control" id="password" name="password" placeholder="Enter Your Password" required>
                        </div>
                        <div class="mb-3">
                            <label for="cpassword" class="form-label">Confirm Password :</label>
                            <input type="password" class="form-control" id="cpassword" name="cpassword" placeholder="Confirm Password" required>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="submit" name="signupdata" class="btn btn-primary">Signup</button>
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    </div>
                    <div class="text-center">
                        <p style="font-size: larger;">Already Have an Account, <a style="font-size: larger; text-decoration: none;" href="#loginmodal" data-bs-toggle="modal" data-bs-dismiss="modal">Login Here</a></p>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <!-- ================================================================================================ -->
    <!-- Login Modal -->
    <!-- ================================================================================================ -->

    <div class="modal fade" id="loginmodal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Login</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form action="/login/index.php" method="post" enctype="multipart/form-data">
                    <div class="modal-body">
                        <div class="mb-3">
                            <label for="email" class="form-label">Enter Email :</label>
                            <input type="email" class="form-control" id="email" name="email" placeholder="Enter Your Email" required>
                        </div>

                        <div class="mb-3">
                            <label for="password" class="form-label">Password :</label>
                            <input type="password" class="form-control" id="password" name="password" placeholder="Enter Your Password" required>
                        </div>

                    </div>
                    <div class="modal-footer">
                        <button type="submit" name="logindata" class="btn btn-primary">Login</button>
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    </div>
                    <div class="text-center">
                        <p style="font-size: larger;">New One, <a style="font-size: larger; text-decoration: none;" href="#signupmodal" data-bs-toggle="modal" data-bs-dismiss="modal">Register Here</a></p>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <!-- ================================================================================================ -->
    <!-- navbar -->
    <!-- ================================================================================================ -->

    <nav class="navbar navbar-expand-lg navbar-light">
        <div class="container-fluid">
            <a class="navbar-brand" href="/login/index.php">TODOs</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                    <li class="nav-item">
                        <a class="nav-link nav-link-ltr" onclick="myFunction()" href="/login/welcome.php">Home</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link nav-link-ltr" href="#">About Us</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link nav-link-ltr" href="#">Contact Us</a>
                    </li>
                </ul>
                <ul class="navbar-nav ms-auto mb-2 mb-lg-0">
                    <li class="nav-item">
                        <a class="nav-link nav-link-ltr" aria-current="page" href="#">Welcome Guest</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link nav-link-ltr" data-bs-toggle="modal" data-bs-target="#loginmodal" aria-current="page" href="">Login</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link nav-link-ltr" data-bs-toggle="modal" data-bs-target="#signupmodal" href="">SignUp</a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>
    <!-- ================================================================================================ -->
    <!-- script -->
    <!-- ================================================================================================ -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
    <script>b
        function myFunction() {
            alert("Please Login To Access Me!");
        }
    </script>

</body>

</html>
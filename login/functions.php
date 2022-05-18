<!-- ================================================================================================ -->
<!-- signup php -->
<!-- ================================================================================================ -->
<?php
include 'partials/_dbconnect.php';
if (isset($_POST['signupdata'])) {
    // $srno = $_POST['srno'];
    $username = $_POST['username'];
    $email = $_POST['email'];
    $mobile = $_POST['mobile'];
    $password = $_POST['password'];
    $cpassword = $_POST['cpassword'];
    $userimage = $_FILES['userimage']['name'];
	$userimage_tmp = $_FILES['userimage']['tmp_name'];

    $sql2 = "select * from todos where email = '$email'";
    $result2 = mysqli_query($conn, $sql2);
    $num2 = mysqli_num_rows($result2);
    if ($num2 > 0) {
        echo '<div class="alert alert-danger alert-dismissible fade show" role="alert">
            <strong>Error </strong> Email already registered.
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
          </div>';
    } else {

        if ($password == $cpassword) {
            $hash = password_hash($password, PASSWORD_DEFAULT);
            move_uploaded_file($userimage_tmp,"userimages/$userimage");
            $sql = "INSERT INTO `todos` (`username`, `email`, `mobile`, `password`, `date` , `imgname`) VALUES ('$username', '$email', '$mobile', '$hash', current_timestamp() , '$userimage')";
            $result = mysqli_query($conn, $sql);
            if ($result) {
                echo '<div class="alert alert-warning alert-dismissible fade show" role="alert">
           <strong>Cograts!</strong> Your account has been created and now you can login.
           <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
         </div>';
            } else {
                echo '<div class="alert alert-danger alert-dismissible fade show" role="alert">
            <strong>Error </strong> in creating account, Please try again.
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
          </div>';
            }
        } else {
            echo '<div class="alert alert-danger alert-dismissible fade show" role="alert">
            <strong>Error!</strong> Password donot match
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
          </div>';
        }
    }
}

?>

<!-- ================================================================================================ -->
<!-- login php -->
<!-- ================================================================================================ -->
<?php
$successAlert = false;
$errorAlert = false;
include 'partials/_dbconnect.php';
if (isset($_POST['logindata'])) {
    // $username = $_POST['username'];
    $email = $_POST['email'];
    $password = $_POST['password'];


    $sql = "SELECT * from todos where email = '$email'";
    $result = mysqli_query($conn, $sql);
    $num = mysqli_num_rows($result);
    if ($num == 1) {
        while ($row = mysqli_fetch_assoc($result)) {
            if (password_verify($password, $row['password'])) {
                session_start();
                $_SESSION['loggedin'] = true;
                $_SESSION['srno'] = $row['srno'];
                $_SESSION['username'] = $row['username'];
                $_SESSION['email'] = $row['email'];
                $_SESSION['mobile'] = $row['mobile'];
                $_SESSION['password'] = $row['password'];
                $_SESSION['date'] = $row['date'];
                $_SESSION['imgname'] = $row['imgname'];
                // header("Location:welcome.php");
                echo "<script>window.open('welcome.php','_self')</script>";

                echo "<div class='alert alert-success alert-dismissible fade show fixed-top' role='alert'>
                <strong>Welcome!</strong> You are Logged in succesfully..
                <button type='button' class='close' data-dismiss='alert' aria-label='Close'>
                <span aria-hidden='true'>&times;</span>
                </button>
                </div>";
            } else {
                echo '<div class="alert alert-danger alert-dismissible fade show" role="alert">
                <strong>Error!</strong> No such account Found, Please try again.
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>';
            }
        }
    } else {
        echo '<div class="alert alert-danger alert-dismissible fade show" role="alert">
        <strong>Error!</strong> No such account Found, Please try again.
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>';
    }
}
?>


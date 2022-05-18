<?php
include 'welcome.php';
?>
    <!-- ================================================================================================ -->
    <!-- fetch user data -->
    <!-- ================================================================================================ -->
    <?php
    if (isset($_SESSION['loggedin'])) {
        $loggedin = true;
    } else {
        $loggedin = false;
    }

    // if ($loggedin) {
    //     // $srno = $_SESSION['srno'];
    //     $name = $_SESSION['username'];
        $email = $_SESSION['email'];
    //     $mobile = $_SESSION['mobile'];
    //     $image = $_SESSION['imgname'];
    //     // echo "<h1>" .$_SESSION['srno']. "</h1>" ;
    //     // echo "<h1>" .$_SESSION['email']. "</h1>" ;
    //     // echo "<h1>" .$_SESSION['mobile']. "</h1>" ;
    //     // echo "<h1>" .$_SESSION['password']. "</h1>" ;


    $sql = "select * from todos where email = '$email'";
    $result = mysqli_query($conn , $sql);
    if($result){
                while($row = mysqli_fetch_assoc($result)){
                    $name = $row['username'];
                    $email = $row['email'];
                    $mobile = $row['mobile'];
                    $image = $row['imgname'];

                    echo "  
    <div class='container d-flex justify-content-center mt-4 mb-4'>
    <div class='card' style='width: 18rem;'>
    <img src='/login/userimages/$image' class='card-img-top' alt='...'>
    <div class='card-body'>
      <h5 class='card-title'>Name: $name</h5>
    </div>
    <ul class='list-group list-group-flush'>
      
      <li class='list-group-item'>Email : $email</li>
      <li class='list-group-item'>Mobile : $mobile</li>
    </ul>
  </div>
  </div>";
                }
    }
    // }
    ?>
    <form action="/login/profile.php" method="post" class="my-4">
    <div class="text-center">
        <button type="button" class="btn btn-success" data-bs-toggle="modal" data-bs-target="#updateuser">
            Update User
        </button>
        <button type="submit" name="deletedata" id="deletedata" class="btn btn-success">Delete User</button>
    </div>
    </form>

    <!-- ================================================================================================ -->
    <!-- update user data -->
    <!-- ================================================================================================ -->
    <!-- id = updateuserdata -->
    <?php

   if(!isset($_SESSION['loggedin'])){
       header("Location:index.php");    
   }
 if(isset($_POST['updateuserdata'])){
     
     $uname = $_POST['username'];
     $uemail = $_POST['email'];
     $umobile = $_POST['mobile'];
     $userimage = $_FILES['userimage']['name'];
     $userimage_tmp = $_FILES['userimage']['tmp_name'];
     move_uploaded_file($userimage_tmp,"userimages/$userimage");


     $sql = "UPDATE todos set username = '$uname' , email = '$uemail' , mobile = '$umobile' , imgname = '$userimage' where email = '$email'";
     $result = mysqli_query($conn , $sql);
     if($result){
         echo '<div class="alert alert-warning alert-dismissible fade show" role="alert">
         <strong>Success!</strong> '.$uname.' Your data is Updated.
         <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
       </div>';
       echo "<script>  window.open('profile.php' , '_self');  </script>";
     }
     else{
        echo '<div class="alert alert-danger alert-dismissible fade show" role="alert">
        <strong>SuccErroress!</strong> Data updation failed, Try again.
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
      </div>';
         
     }

 }
    ?>
    <!-- ================================================================================================ -->
    <!-- fetch user Modal -->
    <!-- ================================================================================================ -->
    <?php

    $sql = "SELECT * FROM `todos` where email = '$email'";
    $result = mysqli_query($conn, $sql);
    while ($row = mysqli_fetch_assoc($result)) {
        echo '<div class="modal fade" id="updateuser" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Update User</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form action="/login/profile.php" method="post" enctype="multipart/form-data">
                    <div class="modal-body">
                        <div class="mb-3">
                            <label for="username" class="form-label">Username :</label>
                            <input type="text" class="form-control" id="username" value = "' . $row['username'] . '" name="username" required>
                        </div>
                        <div class="mb-3">
                            <label for="email" class="form-label">Email :</label>
                            <input type="email" name="email" class="form-control" value = "' . $row['email'] . '" id="email" required >
                        </div>
                        <div class="mb-3">
                            <label for="Mobile" class="form-label">Mobile :</label>
                            <input type="number" class="form-control" id="mobile" value = "' . $row['mobile'] . '" name="mobile" required>
                        </div>
                        <div class="mb-3">
                        <label for="userimage" class="form-label">Add Image :</label>
                        <input type="file" class="form-control" id="userimage" name="userimage" required>
                    </div>
                    </div>
                    <div class="modal-footer">
                        <button type="submit" name="updateuserdata" class="btn btn-primary">Update</button>
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    </div>
                </form>
            </div>
        </div>
    </div>';
    }
    ?>
<!-- =====================delete user loggedin ======================== -->
    <?php

if(isset($_POST['deletedata'])){
   

    $sql = "delete from todos where email = '$email'";
    $result = mysqli_query($conn , $sql);
    if($result){
       echo "<script> window.open('index.php', '_self');  </script>";
    }
    else{
        echo '<div class="alert alert-danger alert-dismissible fade show" role="alert">
        <strong>SuccErroress!</strong> Data deletion failed, Try again.
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
      </div>';
    }
}

?>
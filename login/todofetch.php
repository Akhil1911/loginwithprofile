<?php
include 'welcome.php';
include 'partials/_dbconnect.php';
?>


<div class="container my-4">
    <table class="table">
        <thead>
            <tr>
                <th scope="col">Srno</th>
                <th scope="col">Title</th>
                <th scope="col">Description</th>
                <th scope="col">Actions</th>
            </tr>
        </thead>
        <tbody>
            <?php
            $semail = $_SESSION['email'];
            $sql = "SELECT * FROM `atodos` where email = '$semail'";
            $result = mysqli_query($conn, $sql);
            $sno = 0;
            while ($row = mysqli_fetch_assoc($result)) {
                $sno = $sno + 1;
                $srno = $row['srno'];
                $title = $row['title'];
                $description = $row['description'];
                echo ' 
                <form action="/login/todofetch.php" method="post">
                <tr>
      <th scope="row">' . $sno . '</th>
      <td>' . $row['title'] . '</td>
      <td>' . $row['description'] . '</td>
      <td>
            <a href="/login/todoupdate.php?srnoid='.$srno.'" class="btn btn-primary m-2" role="button">Update TODO</a>
            <button type="submit" name="deletedata" class="btn btn-primary m-2">Delete Data</button>
    </td>
    </tr>   
    </form>';
            }
            ?>
        </tbody>
    </table>
    <a href="/login/todosindex.php" class="btn btn-success col-md-2 m-2" role="button">Add New TODOs</a>
</div>



<!-- =====================delete user loggedin ======================== -->
<?php
// function delete(){

// }
if ($_SERVER['REQUEST_METHOD'] == "POST") {
    if (isset($_POST['deletedata'])) {
        // $srno = $_POST['srno'];

        $sql = "delete from atodos  where srno = '$srno'";
        $result = mysqli_query($conn, $sql);
        if ($result) {
            echo "<script>
                    window.alert('Data Deleted Successfully');
                    window.open('todofetch.php', '_self');
                </script>";
        } else {
            echo '<div class="alert alert-danger alert-dismissible fade show" role="alert">
        <strong>Error!</strong>We are Sorry, Due to some technical issues , Note has not been Deleted.
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
      </div>';
        }
    }
}
?>
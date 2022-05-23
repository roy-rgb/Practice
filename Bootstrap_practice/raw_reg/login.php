<?php
session_start();
require_once 'header.php';
require_once 'database.php';

?>

<?php
$message = "";
if (isset($_POST['submit'])) {

    $email = $_POST['email'];
    $password = $_POST['password'];
    $sql = "SELECT * FROM tbl_user WHERE email='$email' ";
//    echo $sql;
    $result = mysqli_query($conn, $sql);
//    print_r($_POST);
//    exit;

    if ($result) {
//        $rowcount=mysqli_num_rows($result);
        if ($result->num_rows > 0) {
            $row = $result->fetch_assoc();
//            print_r($row);exit;
            if (password_verify($password, $row['password'])) {
                $message = "login successfully!!!";
//                echo $message;exit;
                $_SESSION["user_id"] = $row['id'];
                 $_SESSION["user_name"] = $row['firstName'];
                 
                 if(isset( $_SESSION["user_id"])){
                     header("Location: index.php");
                 }
                 
                
            } else {
                $message = "Ops check your email and password!!";
//                echo $message;exit;
                header("Location: login.php");
            }
        } else {
            $message = " check your inputs please!!";
        }
    }
}



//    $result = $conn->query($query);
//    if ($result->num_rows > 0) {
//        while ($row = $result->fetch_assoc()) {
//            if (password_verify($password, $row['password'])) {
//                $message = "login successfully!!!";
//                header("Location: login.php");
//            } else {
//                $message = "Ops check your email and password!!";
//                header("Location: login.php");
//            }
//        }
//    } else {
//        $message = " check your inputs please!!";
//    }
?>





<body>
    <div class="container">
        <?php// include 'nav.php'; ?>

        <div class="mainoption">
            <div class="sideoption">

            </div>

            <div class="sideoption2">

                <div class="login_state">


                    <div class="login shadow-lg p-3 mb-1 bg-white   ">
                        <div class='space-between bg-secondary'></div>
                        <div class="p-2 d-flex justify-content-center bg-light font-weight-bold text-warning flex-fill "><h2> Login </h2> </div>
                        <div class='space-between bg-secondary'></div>
                    </div>
                    <!--                         <h2> Login<h2>-->



                    <?php echo $message ?>

                    <div class="container-fluid bg-light p-3 ">
                        <form action="login.php" method="post">
                            <div class="form-group font-weight-bold ">
                                <label for="email">Email address:</label>
                                <input type="email" id="email" name="email" class="form-control" placeholder="Enter email" id="email">
                            </div>
                            <div class="form-group font-weight-bold">
                                <label for="pwd">Password:</label>
                                <input type="password" id="password" name="password" class="form-control" placeholder="Enter password" id="pwd">
                            </div>

                            <button type="submit" name="submit" value="Submit" class="btn btn-dark text-warning text-center">Log in</button>
                        </form>

                    </div>
                    <div class='space-between bg-secondary'></div>
                </div>
            </div>
        </div>
        <?php require_once 'footer.php'; ?>
    </div>
</body>
</html>

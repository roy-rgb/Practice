<?php
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
                header("Location: userlist.php");
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
        <?php include 'nav.php'; ?>

        <div class="mainoption">
            <div class="sideoption">

            </div>

            <div class="sideoption2">

                <div class="contact_us">
                    <h2> Login<h2>
                            <?php echo $message ?>
                            <form action="login.php" method="post">

                                <table class="tbl-input">                                   
                                    <tr>
                                        <th> <label >Email :</label> </th>
                                        <td>  <input type="text" id="email" name="email" placeholder=" Enter Your Email.."></td>
                                    </tr>

                                    <tr>
                                        <th> <label >Password :</label> </th>
                                        <td>  <input type="text" id="password" name="password" placeholder=" Enter Your password.."></td>
                                    </tr>


                                    <tr>
                                        <td></td>
                                        <td><input type="submit" name="submit" value="Submit"> </td>
                                    </tr>
                                </table>

                            </form>
                            </div>
                            </div>
                            </div>
                            <?php require_once 'footer.php'; ?>
                            </div>
                            </body>
                            </html>

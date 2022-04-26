<?php
require_once 'header.php';
require_once 'database.php';
?>

<?php

$id=$_GET['id'];

$query="SELECT * FROM tbl_user WHERE id = $id";
$getData = $conn->query($query)->fetch_assoc();



if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $firstName = $_POST['firstName'];
    $lastName = $_POST['lastName'];
    $gender = $_POST['gender'];
    $address = $_POST['address'];
    $status = $_POST['status'];

    if ($firstName == '' || $lastName == '' || $gender == '' || $address == '' || $status == '') {
        $error = "field must not be empty";
    } else {
        $query2 = "UPDATE tbl_user SET  firstName = '$firstName', lastName=' $lastName', gender='$gender', address=' $address', status='$status' WHERE id = $id ";
        $update =$conn->query($query2);
     
    }
}
?>



<body>
    <div class="container">
        <?php include 'nav.php'; ?>

        <div class="mainoption">
            <div class="sideoption">

            </div>

            <div class="sideoption2">

                <div class="contact_us">
                    <h2> Update Data<h2>
                            <?php
                            if (isset($error)) {
                                echo $error;
                            }
                            ?>
                            <form action ="" method="post">

                                <table class="tbl-input"> 

                                    <tr>
                                        <th> <label >First Name :</label> </th>
                                        <td><input type="text" id="firstName" name="firstName" value="<?php echo $getData['firstName'];?>"></td>
                                    </tr>

                                    <tr>
                                        <th> <label >Last Name :</label> </th>
                                        <td><input type="text"  id="lastName" name="lastName" value="<?php echo $getData['lastName'];?>"></td>
                                    </tr>



                                    <tr>
                                        <th> <label >Adderss :</label> </th>
                                        <td>  <input type="text" id="address" name="address" value="<?php echo $getData['address'];?>"</td>
                                    </tr>

                                    <tr>
                                        <th> <label >Gender :</label> </th>

                                        <td>  <input type="radio" name="gender"  value="2" <?php if( $getData['gender']==2){echo 'checked';}?>>Female
                                            <input type="radio" name="gender"  value="1"  <?php if( $getData['gender']==1){echo 'checked';}?>>Male    </td>                          

                                    </tr>
                                  
                                      <tr>
                                         
                                        <th> <label >Status :</label> </th>

                                        <td>  <input type="radio" name="status"  value="1"  <?php if( $getData['status']==1){echo 'checked';}?>>Active
                                            <input type="radio" name="status"  value="0" <?php if( $getData['status']==0){echo 'checked';}?>>Inactive    </td>                          
                                    </tr>

                                    <tr>
                                        <td></td>

                                        <td>  <input type="submit" value="Submit"> </td>

                                    </tr>

                                </table>

                            </form>
                            </div>
                            </div>
                            </div>
<?php include 'footer.php'; ?>
                            </div>
                            </body>
                            </html>
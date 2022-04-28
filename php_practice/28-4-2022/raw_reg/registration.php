<?php
require_once 'header.php';
require_once 'database.php';

$message = "";

//if ($_SERVER["REQUEST_METHOD"] == "POST") {
if (isset($_POST["submit"])) {

    $firstName = $_POST['firstName'];
    $lastName = $_POST['lastName'];
    $gender = $_POST['gender'];
    $address = $_POST['address'];
    $status = $_POST['status'];
    $email = $_POST['email'];
    $password = password_hash(($_POST['password']), PASSWORD_DEFAULT);



    if ($firstName == '' || $email == '' || $password == '' || $lastName == ''  || $address == '' || !isset($_POST['gender']) || !isset($_POST['status'] )) {
        $message = "field must not be empty";
    } else {
        $query = "INSERT INTO tbl_user(firstName,lastName,gender,address,status,email,password) values( '$firstName' , '$lastName' , '$gender' , '$address','$status', '$email','$password' );";
        if ($conn->query($query) == TRUE) {
            $message = "new record created successfully!!";
        }
    }
}
?>

<body>
    <div class="container">
        <?php require_once 'nav.php'; ?>

        <div class="mainoption">
            <div class="sideoption">

            </div>

            <div class="sideoption2">
                <div class="contact_us">
                    <h2> Sign Up<h2>
                            <h2 style="color:white;"> <?php echo $message ?></h2>
                            <form action ="" method="post">
                                <table class="tbl-input"> 
                                    <tr>
                                        <th> <label >First Name :</label> </th>
                                        <td><input type="text" id="firstName" name="firstName" placeholder=" Enter Your First name.."></td>
                                    </tr>

                                    <tr>
                                        <th> <label >Last Name :</label> </th>
                                        <td><input type="text"  id="lastName" name="lastName" placeholder=" Enter Your Last name.."></td>
                                    </tr>

                                    <tr>
                                        <th> <label >Adderss :</label> </th>
                                        <td>  <input type="text" id="address" name="address" placeholder=" Enter Your Address.."></td>
                                    </tr>
                                    
                                        <tr>
                                        <th> <label >Email :</label> </th>
                                        <td>  <input type="text" id="email" name="email" placeholder=" Enter Your Email.."></td>
                                    </tr>
                                    
                                       <tr>
                                        <th> <label >Password :</label> </th>
                                        <td>  <input type="text" id="password" name="password" placeholder=" Enter Your password.."></td>
                                    </tr>

                                    <tr>
                                        <th><p>Gender:</p></th>
                                        <td>  
                                            <input type="radio" id="male" name="gender" value="1"><label for="male">Male</label>  
                                            <input type="radio" id="female" name="gender" value="2"><label for="female">Female</label>
                                        </td>
                                    </tr>

                                    <tr>
                                        <th> <label >Status :</label> </th>
                                        <td>  
                                            <input type="radio" id="active" name="status"  value="1">Active
                                            <input type="radio" id="inactive" name="status"  value="0">Inactive    
                                        </td>                          
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
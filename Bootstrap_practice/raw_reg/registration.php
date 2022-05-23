<?php
session_start();
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
    $division = $_POST['division'];
    $district = $_POST['district'];
    $thana = $_POST['thana'];
    
 
    



    if ($firstName == '' || $email == '' || $password == '' || $lastName == '' || $address == '' || !isset($_POST['gender']) || !isset($_POST['status'])) {
        $message = "field must not be empty";
    } else {
        $query = "INSERT INTO tbl_user(firstName,lastName,gender,address,status,email,password,division,district,thana) values( '$firstName' , '$lastName' , '$gender' , '$address','$status', '$email','$password','$division','$district','$thana' );";
        if ($conn->query($query) == TRUE) {
            $message = "New Record Created Successfully!!";
        }
    }
}
?>

<?php
$getQuery = "SELECT * FROM tbl_division";
$result = mysqli_query($conn, $getQuery);
?>

<body>
    <div class="container">
        <?php if (isset($_SESSION["user_mail"]) && isset($_SESSION["user_name"])) { ?>
            <?php
            include 'nav.php';
        }
        ?>

        <div class="mainoption">
            <div class="sideoption">

            </div>

            <div class="sideoption2">
                <div class="registration-sate">
                    
                        <div class="login shadow-lg p-3 mb-1 bg-white   ">
  <div class='space-between bg-secondary'></div>
                            <div class="p-2 d-flex justify-content-center bg-light font-weight-bold text-warning flex-fill "><h2> Sign Up </h2> </div>
                                
                            <div class='space-between bg-secondary'></div>
                             <h2 class="  text-warning font-weight-bold d-flex justify-content-center"> <?php echo $message ?></h2>
                        </div>
                   
                            
                            
                            
                          <div class="container-fluid bg-light p-3 ">
                                <form action="" method="post">
                                    <table class=" table table-secondary table-hover text-secondary  ">
                                        <tr >
                                            <th > <label >First Name :</label> </th>
                                            <td><input type="text" class="w-50 p-2 rounded" id="firstName" name="firstName" placeholder=" Enter Your First name.."></td>
                                        </tr>
                                        
                                        <tr>
                                            <th> <label >Last Name :</label> </th>
                                            <td><input type="text" class="w-50 p-2 rounded" id="lastName" name="lastName" placeholder=" Enter Your Last name.."></td>
                                        </tr>
                                        
                                        <tr>
                                            <th> <label >Adderss :</label> </th>
                                            <td>  <input type="text" class="w-50 p-2 rounded" id="address" name="address" placeholder=" Enter Your Address.."></td>
                                        </tr>
                                        
                                        <tr>
                                            <th> <label >Email :</label> </th>
                                            <td>  <input type="text" class="w-50 p-2 rounded" id="email" name="email" placeholder=" Enter Your Email.."></td>
                                        </tr>
                                        
                                        <tr>
                                            <th> <label >Password :</label> </th>
                                            <td>  <input type="text" class="w-50 p-2 rounded" id="password" name="password" placeholder=" Enter Your password.."></td>
                                        </tr>
                                        
                                        <tr>
                                            <th> <label >Division :</label> </th>
                                            <td>
                                                <select class="w-50 p-2 rounded" name="division" id="division" onchange="showDistrict(this.value)">
                                                    <option value="0">--- Select Division ---</option>

                                                    <?php foreach ($result as $row_sl) { ?>
                                                        <option value="<?php echo $row_sl['id']; ?>"><?php echo $row_sl['name']; ?></option>             
                                                    <?php } ?>

                                                </select>
                                            </td>

                                        </tr>
                                        
                                        <tr>
                                            <th> <label >District :</label> </th>
                                            <td> <select class="w-50 p-2 rounded" name="district" id="district" onchange="showTha(this.value)">
                                                    <option value="0">--- Select District ---</option>
                                                </select></td>
                                        </tr>
                                        
                                        <tr>
                                            <th> <label >Thana :</label> </th>
                                            <td> <select class="w-50 p-2 rounded" name="thana" id="thana" >
                                                    <option value="0">--- Select Thana ---</option>
                                                </select></td>

                                        </tr>

                                        <tr>
                                            <th><p>Gender:</p></th>
                                            <td>  
                                                <input  type="radio" id="male" name="gender" value="1"><label class="font-weight-bold"for="male">Male</label>  
                                                <input  type="radio" id="female" name="gender" value="2"><label class="font-weight-bold" for="female">Female</label>
                                            </td>
                                        </tr>
                                        
                                        <tr>
                                            <th> <label >Status :</label> </th>
                                            <td class="font-weight-bold">  
                                                <input type="radio"  id="active" name="status"  value="1">Active
                                                <input type="radio" id="inactive" name="status"  value="0">Inactive    
                                            </td>                          
                                        </tr>
 
                                        <tr>
                                            <td></td>
                                            <td><input type="submit" name="submit" value="Submit" class="btn btn-dark text-warning text-center font-weight-bold"> </td>
                                        </tr>

                                        
                                    </table>
                                    
                                    
                                </form>

                            </div>
                            
                            
                            
<!--                            <form action ="" method="post">
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
                                        <th> <label >Division :</label> </th>
                                        <td>
                                            <select name="division" id="division" onchange="showDistrict(this.value)">
                                                <option value="0">--- Select Division ---</option>

                                                <?php// foreach ($result as $row_sl) { ?>
                                                    <option value="<?php //echo $row_sl['id']; ?>"><?php //echo $row_sl['name']; ?></option>             
                                                <?php// } ?>

                                            </select>
                                        </td>

                                    </tr>

                                    <tr>
                                        <th> <label >District :</label> </th>
                                        <td> <select name="district" id="district" onchange="showTha(this.value)">
                                                <option value="0">--- Select District ---</option>
                                            </select></td>
                                    </tr>

                                    <tr>
                                        <th> <label >Thana :</label> </th>
                                        <td> <select name="thana" id="thana" >
                                                <option value="0">--- Select Thana ---</option>
                                            </select></td>

                                    </tr>


                                    <tr>
                                        <td></td>
                                        <td><input type="submit" name="submit" value="Submit"> </td>
                                    </tr>
                                </table>

                            </form>-->
                            
                            
                            </div>
                            </div>
                            </div>
                            <?php require_once 'footer.php'; ?>
                            </div>
                                   <script type="text/javascript" src="ajax.js" ></script>
                            </body>
                            </html>
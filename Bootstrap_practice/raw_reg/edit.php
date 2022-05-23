<?php
session_start();
require_once 'header.php';
require_once 'database.php';
?>

<?php
$id = $_GET['id'];


$sql = "select * , tbl_division.name as division_name, tbl_division.id as divisionId ,
    tbl_district.name as district_name , tbl_district.id as districtId, tbl_thana.name as thana_name,tbl_thana.id as thanaId from tbl_user 
        left join tbl_division on  tbl_division.id = tbl_user.division 
        left join tbl_district on tbl_district.id = tbl_user.district
        left join tbl_thana on tbl_thana.id=tbl_user.thana where tbl_user.id= $id";


//$query="SELECT * FROM tbl_user WHERE id = $id";
//$getData = $conn->query($query4)->fetch_assoc();
$result3 = mysqli_query($conn, $sql);
$getData = mysqli_fetch_assoc($result3);

$getQuery = "SELECT * FROM tbl_division";
$result = mysqli_query($conn, $getQuery);





//  $divisionSql = "select * from tbl_division where id=" .$getData['division'];
//  
//  
//                                $diviresult = mysqli_query($conn, $divisionSql);
//                                $row2 = mysqli_fetch_array($diviresult);
//                                
//                                if($getData['division']== 0){
//                                    $division= "<--select division-->";
//                                }else{
//                                    $division=  $row2['name'];
//                                }



if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $firstName = $_POST['firstName'];
    $lastName = $_POST['lastName'];
    $gender = $_POST['gender'];
    $address = $_POST['address'];
    $status = $_POST['status'];
    $division = $_POST['division'];
    $district = $_POST['district'];
    $thana = $_POST['thana'];


    if ($firstName == '' || $lastName == '' || $gender == '' || $address == '' || $status == '') {
        $error = "field must not be empty";
    } else {
        $query2 = "UPDATE tbl_user SET  firstName = '$firstName', lastName=' $lastName', gender='$gender', address=' $address', status='$status', division='$division',district='$district',thana='$thana' WHERE id = $id ";
        $update = $conn->query($query2);
    }
}
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

                <div class="edit-data">
                    <div class="user-list shadow-lg p-3 mb-1 bg-white   ">

                        <div class="p-2 d-flex justify-content-center bg-light font-weight-bold text-warning flex-fill "><h2> Update data </h2> </div>
                    </div>
                    <?php
                    if (isset($error)) {
                        echo $error;
                    }
                    ?>
                    <form action ="" method="post" >

                        <table class="table table-hover table-striped table-light text-secondary font-weight-bold text-dark"> 

                            <tr>
                                <th> <label >First Name :</label> </th>
                                <td><input type="text" id="firstName" name="firstName" value="<?php echo $getData['firstName']; ?>"></td>
                            </tr>

                            <tr>
                                <th> <label >Last Name :</label> </th>
                                <td><input type="text"  id="lastName" name="lastName" value="<?php echo $getData['lastName']; ?>"></td>
                            </tr>



                            <tr>
                                <th> <label >Adderss :</label> </th>
                                <td>  <input type="text" id="address" name="address" value="<?php echo $getData['address']; ?>"</td>
                            </tr>

                            <tr>
                                <th> <label >Gender :</label> </th>

                                <td>  <input type="radio" name="gender"  value="2" <?php
                                    if ($getData['gender'] == 2) {
                                        echo 'checked';
                                    }
                                    ?>>Female
                                    <input type="radio" name="gender"  value="1"  <?php
                                    if ($getData['gender'] == 1) {
                                        echo 'checked';
                                    }
                                    ?>>Male    </td>                          

                            </tr>

                            <tr>

                                <th> <label >Status :</label> </th>

                                <td>  <input type="radio" name="status"  value="1"  <?php
                                           if ($getData['status'] == 1) {
                                               echo 'checked';
                                           }
                                           ?>>Active
                                    <input type="radio" name="status"  value="0" <?php
                                           if ($getData['status'] == 0) {
                                               echo 'checked';
                                           }
                                           ?>>Inactive    </td>                          
                            </tr>

                            <tr>
                                <th> <label >Division :</label> </th>
                                <td>
                                    <select name="division" id="division" onchange="showDistrict(this.value)">



                                        <?php if (isset($getData['division_name'])) { ?>

                                            <option value=" <?php echo $getData['divisionId']; ?> "  >  <?php echo $getData['division_name'] ?> </option>
<?php } else { ?>
                                            <option value="0">--- Select Division ---</option>;
                                        <?php } ?>



<?php foreach ($result as $row_sl) { ?>
        <!--                                                    <option value="<?php // echo $getData['division'];  ?>" <?php // if($getData['division']== $row_sl['id']){ echo 'selected';} else{$getData['division_name']=$row_sl['name'] ;}  ?>  ><?php //echo $row_sl['name'];  ?></option>             -->

                                            <option value='<?php echo $row_sl['id']; ?>'> <?php echo $row_sl['name']; ?></option>
<?php } ?>

                                    </select>
                                </td>

                            </tr>

                            <tr>
                                <th> <label >District :</label> </th>
                                <td> <select name="district" id="district" onchange="showTha(this.value)">

<?php if (isset($getData['district_name'])) { ?>
                                            <option value=" <?php echo $getData['districtId']; ?> "  >  <?php echo $getData['district_name'] ?> </option>
<?php } else { ?>
                                            <option value="0">--- Select District ---</option>;
                                        <?php } ?>

                                    </select></td>
                            </tr>

                            <tr>
                                <th> <label >Thana :</label> </th>
                                <td> <select name="thana" id="thana" >

<?php if (isset($getData['thana_name'])) { ?>
                                            <option value=" <?php echo $getData['thanaId']; ?> " >  <?php echo $getData['thana_name'] ?> </option>
<?php } else { ?>
                                            <option value="0">--- Select Thana ---</option>;
<?php } ?>

                                    </select></td>

                            </tr>


                            <tr>
                                <td></td>

                                <td>  <input class="btn  w-50 p-2 btn-dark text-warning text-center font-weight-bold" type="submit" value="Submit"> </td>

                            </tr>

                        </table>

                    </form>

                </div>
            </div>
        </div>
<?php include 'footer.php'; ?>
    </div>

    <script type="text/javascript" src="ajax.js" ></script>
</body>
</html>
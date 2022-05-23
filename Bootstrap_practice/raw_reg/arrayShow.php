
<!DOCTYPE html>
<?php
session_start();
require_once 'header.php';
require_once 'database.php';
?>

<?php
//$getQuery = "SELECT * FROM tbl_user";
$getQuery = "select * , tbl_division.name as division_name, tbl_division.id as divisionId ,
    tbl_district.name as district_name , tbl_district.id as districtId
    , tbl_thana.name as thana_name,tbl_thana.id as thanaId from tbl_user 
        left join tbl_division on  tbl_division.id = tbl_user.division 
        left join tbl_district on tbl_district.id = tbl_user.district
        left join tbl_thana on tbl_thana.id=tbl_user.thana";

$result = mysqli_query($conn, $getQuery);
?>


<body>
    <div class="container">
       <?php if (isset($_SESSION["user_mail"]) && isset($_SESSION["user_name"])) { include 'nav.php'; ?>
          

        <div class="mainoption">
            <div class="sideoption">

            </div>

            <div class="sideoption2">

                <div class=show-data">
                    <div class="user-list shadow-lg p-3 mb-1 bg-white">

                        <div class="p-2 d-flex justify-content-center bg-light font-weight-bold text-warning flex-fill "><h2>Show Array data </h2> </div>
                    </div>

                    <div class="show-array">
                        <?php
                        while ($row = mysqli_fetch_assoc($result)) {
                            $user[$row['division_id']]['division_name'] = $row['division_name'];
                            $user[$row['division_id']]['district'][$row['district_id']]['district_name'] = $row['district_name'];
                            $user[$row['division_id']]['district'][$row['district_id']]['thana'][$row['thanaId']] ['thana_name'] = $row['thana_name'];
                            $user[$row['division_id']]['district'][$row['district_id']]['thana'][$row['thanaId']]['user'][$row['id']]['first_name'] = $row['firstName'];
                            $user[$row['division_id']]['district'][$row['district_id']]['thana'][$row['thanaId']]['user'][$row['id']]['last_name'] = $row['lastName'];
                            $user[$row['division_id']]['district'][$row['district_id']]['thana'][$row['thanaId']]['user'][$row['id']]['email'] = $row['email'];
                            ?> 


                            <?php
                        }

                        ksort($user);
                        echo "users show";
                        echo '<pre>';
                        print_r($user);
                        //exit;

                        $rowspanArr = [];

                        if (!empty($user)) {
                            foreach ($user as $divId => $divInfo) {
                                if (!empty($divInfo['district'])) {
                                    foreach ($divInfo['district'] as $disId => $disInfo) {
                                        if (!empty($disInfo['thana'])) {
                                            foreach ($disInfo['thana'] as $thanaId => $thanaInfo) {

                                                if (!empty($thanaInfo['user'])) {
                                                    foreach ($thanaInfo['user'] as $uId => $uInfo) {

                                                        $rowspanArr['than'][$divId][$disId][$thanaId] = !empty($rowspanArr['than'][$divId][$disId][$thanaId]) ? $rowspanArr['than'][$divId][$disId][$thanaId] : 0;
                                                        $rowspanArr['than'][$divId][$disId][$thanaId] += 1;

                                                        $rowspanArr['dis'][$divId][$disId] = !empty($rowspanArr['dis'][$divId][$disId]) ? $rowspanArr['dis'][$divId][$disId] : 0;
                                                        $rowspanArr['dis'][$divId][$disId] += 1;

                                                        $rowspanArr['div'][$divId] = !empty($rowspanArr['div'][$divId]) ? $rowspanArr['div'][$divId] : 0;
                                                        $rowspanArr['div'][$divId] += 1;
                                                    }
                                                }
                                            }
                                        }
                                    }
                                }
                            }
                        }
                        ?>
                    </div>



                    <table border="1" cellpadding="0" cellspacing="0" class="table table-hover ">
                        <thead class="thead-dark">
                            <tr>
                                <th>Division</th>
                                <th>District</th>
                                <th>Thana</th>

                                <th>First Name</th>
                                <th>Last Name</th>
                                <th>Email</th>

                            </tr>
                        </thead>
                        <tbody class="table-info ">
<?php
if (!empty($user)) {
    foreach ($user as $divId => $divInfo) {
        ?>
                                    <tr>
                                        <td rowspan="<?php echo!empty($rowspanArr['div'][$divId]) ? $rowspanArr['div'][$divId] : 1; ?>"><?php echo!empty($divInfo['division_name']) ? $divInfo['division_name'] : 0; ?> </td>
                                    <?php
                                    if (!empty($divInfo['district'])) {
                                        $i = 0;
                                        foreach ($divInfo['district'] as $disId => $disInfo) {
                                            if ($i > 0) {
                                                echo "<tr>";
                                            }
                                            ?>
                                                <td rowspan="<?php echo!empty($rowspanArr['dis'][$divId][$disId]) ? $rowspanArr['dis'][$divId][$disId] : 1; ?>"><?php echo!empty($disInfo['district_name']) ? $disInfo['district_name'] : 0; ?> </td>


                <?php
                if (!empty($disInfo['thana'])) {
                    $k = 0;
                    foreach ($disInfo['thana'] as $thanaId => $thanaInfo) {
                        if ($k > 0) {
                            echo "<tr>";
                        }
                        ?>
                                                        <td rowspan="<?php echo!empty($rowspanArr['than'][$divId][$disId][$thanaId]) ? $rowspanArr['than'][$divId][$disId][$thanaId] : 1; ?>"><?php echo!empty($thanaInfo['thana_name']) ? $thanaInfo['thana_name'] : 0; ?> </td>

                                                        <?php
                                                        if (!empty($thanaInfo['user'])) {
                                                            $j = 0;
                                                            foreach ($thanaInfo['user'] as $uId => $uInfo) {
                                                                if ($j > 0) {
                                                                    echo "<tr>";
                                                                }
                                                                ?>

                                                                <td><?php echo!empty($uInfo['first_name']) ? ($uInfo['first_name']) : 0; ?></td>
                                                                <td><?php echo!empty($uInfo['last_name']) ? ($uInfo['last_name']) : 0; ?></td>
                                                                <td><?php echo!empty($uInfo['email']) ? ($uInfo['email']) : 0; ?></td>
                                <?php
                                if ($k < ($rowspanArr['than'][$divId][$disId][$thanaId]) - 1) {
                                    echo "</tr>";
                                }
                                $k++;
                            }
                            ?>
                                                            <?php
                                                            if ($j < ($rowspanArr['dis'][$divId][$disId]) - 1) {
                                                                echo "</tr>";
                                                            }
                                                            $j++;
                                                        }

                                                        if ($i < ($rowspanArr['div'][$divId]) - 1) {
                                                            echo "</tr>";
                                                        }
                                                        $i++;
                                                    }
                                                }
                                                ?>
                                            </tr>

                                                <?php
                                            }//end foreach dis
                                        } //end if dis
                                    }
                                }
                                ?>                            


                        </tbody>
                    </table>



                </div>
            </div>
        </div>
        <div class="tm-25">
<?php include 'footer.php'; ?>
        </div>
    </div>
<?php }else{
         header("location: logout.php");
     } ?>

</body>
</html>
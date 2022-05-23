<?php
require_once 'database.php';
$id = $_GET['id'];



$sql="select * , tbl_division.name as division_name, tbl_division.id as divisionId ,
    tbl_district.name as district_name , tbl_district.id as districtId, tbl_thana.name as thana_name,tbl_thana.id as thanaId from tbl_user 
        left join tbl_division on  tbl_division.id = tbl_user.division 
        left join tbl_district on tbl_district.id = tbl_user.district
        left join tbl_thana on tbl_thana.id=tbl_user.thana where tbl_user.id= $id";

$result = mysqli_query($conn, $sql);
$getData = mysqli_fetch_assoc($result);

echo $getData['address'].",".$getData['division_name']. "," .$getData['district_name'].",".$getData['thana_name'];



?>
<?php
require_once 'database.php';
$id = $_GET['id'];
$stat = (int) !$_GET['stat'];
$btn= $_GET['btn'];

//if($stat == 0){
//  $stat=1;
//}else if($stat == 1){
//$stat = 0;
//}

$sql = "UPDATE tbl_user SET status='$stat' where id = $id";


if (mysqli_query($conn, $sql) === true) {
    $st1 = ($stat == '1') ? 'Active' : 'Inactive';
    $st2 = ($stat == '1') ? 'Deactivate' : 'Activate';
    if ($btn == 1) {
        echo '<button style="background-color:beige; padding:5px;" onclick="changeStatus(' . $id . ',' . $stat . ')">' . $st2 . '</button>';
    } else {
        echo $st1;
    }
}


//$result2 = mysqli_query($conn, $dis_query);


    // $row = mysqli_fetch_array($result2);
    // $temp = $row['status'] == 1 ? 'Active' : 'Deactive';
?>

<!-- <button   ><?php //echo $temp ;?></button> -->



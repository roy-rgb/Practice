<?php
require_once 'database.php';
$id = $_GET['id'];
$than_query = "SELECT * FROM tbl_thana where district_id  = $id";
$result3 = mysqli_query($conn, $than_query);
?>
<select>
    <option value="0">--- Select Thana ---</option>
    <?php foreach ($result3 as $row_sl3) { ?>
        <option value="<?php echo $row_sl3['id']; ?>"><?php echo $row_sl3['name']; ?></option>             
    <?php } ?>
</select>
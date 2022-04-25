<?php
require_once 'database.php';
$id = $_GET['id'];
$dis_query = "SELECT * FROM tbl_district where division_id = $id";
$result2 = mysqli_query($conn, $dis_query);
?>
<select>
    <option value="0">--- Select District ---</option>
    <?php foreach ($result2 as $row_sl2) { ?>
        <option value="<?php echo $row_sl2['id']; ?>"><?php echo $row_sl2['name']; ?></option>             
    <?php } ?>
</select>
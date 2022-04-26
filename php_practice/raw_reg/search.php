<?php
require_once 'header.php';
require_once 'database.php';

?>


<?php

if (isset($_POST['search'])) {
    $search = $_POST['search'];
    $query = "SELECT * FROM tbl_user WHERE firstName LIKE '%$search%' ";
    $read = $conn->query($query);
}
?>



<body>
    <div class="container">
        <?php include 'nav.php'; ?>

        <div class="mainoption">
            <div class="sideoption">
                <h2></h2>
            </div>

            <div class="sideoption2">
                <br>
                <h2> Search LIST</h2>
          


                <table class="tbl-user-list">



                    <tr>
                        <th width="15%">First Name</th>
                        <th width="15%">Last Name</th>
                        <th width="15%">Address</th> 
                        <th width="15%">Gender</th>   
                        <th width="15%">Status</th>   
                        <th width="15%">Action</th>   
                    </tr>


                    <?php if ($read->num_rows > 0) { ?>
                        <?php
                        while ($row = $read->fetch_assoc()) {

                            $temp = $row['gender'] == 1 ? 'male' : 'female';
                            $temp2 = $row['status'] == 1 ? 'Active' : 'Inactive';
                            ?>

                            <tr>

                                <td><?php echo $row['firstName'] ?> </td>
                                <td><?php echo $row['lastName'] ?> </td>
                                <td> <?php echo $row['address'] ?> </td>
                                <td> <?php echo $temp ?> </td>
                                <td> <?php echo $temp2 ?> </td>
                                <td>

                                    <button type="button"> <a href='edit.php?id=<?php echo $row['id']; ?>'>Edit</a> </button>
                                    <button type="button"><a href='delete.php?del_id=<?php echo $row['id'] ?>'>Delete</a></button>
                                </td>

                            </tr>

    <?php } ?>
                    <?php } else { ?>
                        <p>Data is not available</p>
                    <?php } ?>

                </table>
            </div>
        </div>

<?php require_once 'footer.php'; ?>
    </div>
</body>
</html>


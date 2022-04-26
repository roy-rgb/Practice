<?php
require_once 'header.php';
require_once 'database.php';

if (!isset($_GET['pageno']) || $_GET['pageno']==0 ) {
    $page_number = 1;
} else {

    $page_number = $_GET['pageno'];
}

$limit = !empty($_GET['page_limit']) ? $_GET['page_limit'] : 2;

if (isset($_POST['limit_submit'])) {
    $limit = $_POST['page_limit'];
}




$initial_page = ($page_number - 1) * $limit;

$getQuery = "select * from tbl_user";
$result = mysqli_query($conn, $getQuery);
$total_rows = mysqli_num_rows($result);
$total_pages = ceil($total_rows / $limit);

$offsetStr = !empty($initial_page) ? ' offset ' . $initial_page : '';

$getQuery = "SELECT * FROM tbl_user LIMIT " . $limit . $offsetStr;
$result = mysqli_query($conn, $getQuery);
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
                <h2> USER LIST</h2>
                <div class="search-container">
                    <form action="search.php" method="post">
                        <input type="text" placeholder="Search.." name="search">
                        <button type="submit" name="submit">Search</button>
                    </form>
                </div>	

                <div class="tbl-sp">
                    <table class="tbl-user-list">



                        <tr>
                            <th width="15%">Serial</th>
                            <th width="15%">First Name</th>
                            <th width="15%">Last Name</th>
                            <th width="15%">Address</th> 
                            <th width="15%">Gender</th>   
                            <th width="15%">Status</th>   
                            <th width="15%">Action</th>   
                        </tr>


                        <?php
                        if ($result->num_rows > 0) {
                            $serial = $initial_page;
                            ?>
                            <?php
                            while ($row = mysqli_fetch_array($result)) {

                                $temp = $row['gender'] == 1 ? 'male' : 'female';
                                $temp2 = $row['status'] == 1 ? 'Active' : 'Inactive';
                                ?>

                                <tr>

                                    <td><?php echo ++$serial; ?> </td>
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




                <form method="post" action="">

                    <?php
                    $pSet = 5;
                    $xy = $page_number / $pSet;
                    $xyFl = ($page_number%$pSet == 0) ? ($xy-1) : floor($xy);
                    $y2 = ((ceil($xy)) * $pSet);
                    
                    $x = (empty($page_number) || ($page_number > 0 && $page_number <= $pSet )) ? 1    : (($xyFl * $pSet) + 1) ;
                   
                    $y = (empty($page_number) || ($page_number > 0 && $page_number <= $pSet)) ? ( $total_pages < $pSet ? $total_pages : $pSet) : ($total_pages < $y2 ? $total_pages : $y2);
                    ?>

                    

                 
                   <?php if ($x > 1) { ?>  
                       <a class="link-previous" href="userlist.php?pageno=<?php echo 1; ?>&page_limit=<?php echo $limit; ?>"> |<< </a>
                        <a class="link-previous" href="userlist.php?pageno=<?php echo $x-1; ?>&page_limit=<?php echo $limit; ?>"> < </a>

                    <?php } ?>
                       
                      
                <?php for ($i = $x; $i <= $y; $i++) { ?>
                        
                                  
                    <a class="pagination-btn" type="button" href='userlist.php?pageno=<?php echo $i; ?>&page_limit=<?php echo $limit; ?>'> <?php echo $i; ?></a>
               
              
                <?php } ?> 


                    <?php if ($y < $total_pages) {  ?>  
                    
                        <a class="link-next" href="userlist.php?pageno=<?php echo $y+1; ?>&page_limit=<?php echo $limit; ?>"> > </a>
                        <a class="link-next" href="userlist.php?pageno=<?php echo $total_pages; ?>&page_limit=<?php echo $limit; ?>"> >>| </a>

                    <?php } ?>


                </form>


                <div class="page-lm">
                    <form method="post" action="">
                        <select name="page_limit" class="page-drop-select">
                                <option   selected disabled>SELECT OPTION</option>
                                <option   value="2" <?php if ($limit == 2) {echo 'selected';} ?> >2</option>
                                <option  value="3" <?php if ($limit == 3) { echo 'selected'; } ?>>3</option>
                                <option  value="4" <?php if ($limit == 4) {echo 'selected';} ?>>4</option>
                        </select>
                        <button class="btn-page" name="limit_submit" type="submit">Select</button>
                    </form>
                </div>

            </div>
        </div>

<?php require_once 'footer.php'; ?>
    </div>
</body>
</html>


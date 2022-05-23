                <?php
                session_start();
                if (!isset($_SESSION["user_id"])) {
                   header("Location: logout.php");
                      }
                require_once 'header.php';
                require_once 'database.php';

                if (!isset($_GET['pageno']) || $_GET['pageno'] == 0) {
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
                         <?php if (isset($_SESSION["user_mail"]) && isset($_SESSION["user_name"])) { include 'nav.php';  ?>
                        
                     

                        <div class="mainoption" >
                            <div class="sideoption">
                                <h2></h2>
                            </div>

                            <div class="sideoption2">
                                <br>

                                <div class="user-list shadow-lg p-2 mb-1 bg-white   ">
                                    <div class='space-between bg-secondary'></div>
                                    <div class="p-2 d-flex justify-content-center bg-light font-weight-bold text-warning flex-fill "><h2> USER LIST </h2> </div>
                                    <div class='space-between bg-secondary'></div>
                                </div>



                                <div class="container d-flex justify-content-center  w-75 bg-light rounded my-1">
                                    <div class='space-between bg-secondary'></div>
                                    <form action="search.php" method="post">

                                        <input class="p-1 my-2  " type="text" placeholder="Search.." name="search">
                                        <button type="submit" class="btn btn-dark  mx-1 text-warning  font-weight-bold" name="submit">Search</button>

                                    </form>

                                </div>	

                                <div class="tbl-handle table-sm ">
                                    <table class="table table-hover table-striped table-light text-secondary font-weight-bold ">


                                        <thead class="bg-secondary text-warning">
                                            <tr>
                                                <th>Serial</th>
                                                <th>First Name</th>
                                                <th>Last Name</th>
                                                <th>Address</th> 

                                                <th>Gender</th>   
                                                <th>Status</th>   
                                                <th>Status Change</th>
                    <!--                            <th>Division</th>
                                                <th>District</th>
                                                <th>Thana</th>-->
                                                <td colspan="2"><b>Action</b></td>   
                                            </tr>
                                        </thead>

                                        <?php
                                        if ($result->num_rows > 0) {
                                            $serial = $initial_page;
                                            ?>
                                            <?php
                                            while ($row = mysqli_fetch_array($result)) {

                                                $divisionSql = "select name from tbl_division where id=" . $row['division'];
                                                $diviresult = mysqli_query($conn, $divisionSql);
                                                $row2 = mysqli_fetch_array($diviresult);

                                                if ($row['division'] == 0) {
                                                    $division = "<--select division-->";
                                                } else {
                                                    $division = $row2['name'];
                                                }

                                                $districtSql = "select name from tbl_district where id=" . $row['district'];
                                                $disresult = mysqli_query($conn, $districtSql);
                                                $row3 = mysqli_fetch_array($disresult);

                                                if ($row['district'] == 0) {
                                                    $district = "<--select district-->";
                                                } else {
                                                    $district = $row3['name'];
                                                }
                                                $thanaSql = "select name from tbl_thana where id=" . $row['thana'];
                                                $thanares = mysqli_query($conn, $thanaSql);
                                                $row4 = mysqli_fetch_array($thanares);

                                                if ($row['thana'] == 0) {
                                                    $thana = "<--select thana-->";
                                                } else {
                                                    $thana = $row4['name'];
                                                }

                                                $temp = $row['gender'] == '1' ? 'male' : 'female';
                                                $temp2 = $row['status'] == '1' ? 'Active' : 'Inactive';
                                                ?>
                                                <tbody>
                                                    <tr>

                                                        <td><?php echo ++$serial; ?> </td>
                                                        <td><?php echo $row['firstName'] ?> </td>
                                                        <td><?php echo $row['lastName'] ?> </td>


                                                        <td>   <button type="button" class="btn btn-info" onclick="showAddress(<?php echo $row['id'] ?>)" data-toggle="modal" data-target="#myModal">
                                                                See Address
                                                            </button> 
                                                        </td>

                        <!--                                        <td> <?php echo $row['address'] . "," . $division . "," . $district . "," . $thana ?> </td>-->

                                                        <td> <?php echo $temp ?> </td>

                                                        <td id="btn-status<?php echo $row['id']; ?>"> <?php echo $temp2; ?>   </td> 


                                                        <td id="btn-status2<?php echo $row['id']; ?>"> <button style="background-color:beige; padding:3px;"  onclick="changeStatus(<?php echo $row['id']; ?>,<?php echo $row['status'] ?>)"> <?php echo ($row['status'] == '0') ? 'Activate' : 'Deactivate'; ?> </button></td>

                                <!--                                    <td><?php //echo $row2['name'];  ?></td>
                                                                    <td><?php //echo $row3['name'];  ?></td>
                                                                    <td><?php // echo $row4['name'];  ?></td>-->





                                                        <td>     
                                                            <a  href='edit.php?id=<?php echo $row['id']; ?>'> <button class="bg-info" > <i class="fa-solid fa-edit"></i> </button> </a> 
                                                            <a  href='delete.php?del_id=<?php echo $row['id'] ?> '> <button class="bg-danger"><i class="fa-solid fa-trash-can"></i></button> </a>
                                                        </td>

                                                    </tr>
                                                </tbody>

                                                <!-- The Modal -->
                                                <div class="modal" id="myModal">
                                                    <div class="modal-dialog">
                                                        <div class="modal-content">

                                                            <!-- Modal Header -->
                                                            <div class="modal-header">
                                                                <h4 class="modal-title">Address</h4>
                                                                <button type="button" class="close" data-dismiss="modal">&times;</button>
                                                            </div>

                                                            <!-- Modal body -->
                                                            <div class="modal-body" id="modal-body">

                                                            </div>

                                                            <!-- Modal footer -->
                                                            <div class="modal-footer">
                                                                <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
                                                            </div>

                                                        </div>
                                                    </div>
                                                </div>



                                            <?php } ?>
                                        <?php } else { ?>
                                            <p>Data is not available</p>
                                        <?php } ?>

                                    </table>


                                </div>




                                <form method="post"  action="">

                                    <?php
                                    $pSet = 5;
                                    $xy = $page_number / $pSet;
                                    $xyFl = ($page_number % $pSet == 0) ? ($xy - 1) : floor($xy);
                                    $y2 = ((ceil($xy)) * $pSet);

                                    $x = (empty($page_number) || ($page_number > 0 && $page_number <= $pSet )) ? 1 : (($xyFl * $pSet) + 1);

                                    $y = (empty($page_number) || ($page_number > 0 && $page_number <= $pSet)) ? ( $total_pages < $pSet ? $total_pages : $pSet) : ($total_pages < $y2 ? $total_pages : $y2);
                                    ?>




                                    <?php if ($x > 1) { ?>  
                                        <a class="bg-warning text-dark" href="userlist.php?pageno=<?php echo 1; ?>&page_limit=<?php echo $limit; ?>"> |<< </a>
                                        <a class="bg-warning text-dark" href="userlist.php?pageno=<?php echo $x - 1; ?>&page_limit=<?php echo $limit; ?>"> < </a>

                                    <?php } ?>


                                    <?php for ($i = $x; $i <= $y; $i++) { ?>


                                        <a class="rounded-circle bg-dark text-warning p-1 mx-1 px-3" type="button" href='userlist.php?pageno=<?php echo $i; ?>&page_limit=<?php echo $limit; ?>'> <?php echo $i; ?></a>


                                    <?php } ?> 


                                    <?php if ($y < $total_pages) { ?>  

                                        <a class="bg-warning text-dark" href="userlist.php?pageno=<?php echo $y + 1; ?>&page_limit=<?php echo $limit; ?>"> > </a>
                                        <a class="bg-warning text-dark" href="userlist.php?pageno=<?php echo $total_pages; ?>&page_limit=<?php echo $limit; ?>"> >>| </a>

                                    <?php } ?>


                                </form>


                                <div class="page-lm">
                                    <form method="post" action="" >
                                        <select name="page_limit" class="p-2 w-25 bg-light rounded mx-1 my-1">
                                            <option   selected disabled>SELECT OPTION</option>
                                            <option   value="2" <?php if ($limit == 2) {
                                        echo 'selected';
                                    } ?> >2</option>
                                            <option  value="3" <?php if ($limit == 3) {
                                        echo 'selected';
                                    } ?>>3</option>
                                            <option  value="4" <?php if ($limit == 4) {
                                        echo 'selected';
                                    } ?>>4</option>
                                        </select>
                                        <button class="btn btn-dark text-warning text-center font-weight-bold" name="limit_submit"  type="submit">Select Limit</button>
                                    </form>
                                </div>

                            </div>
                            <div class='space-between bg-secondary'></div>
                <?php require_once 'footer.php'; ?>
                        </div>


                    </div>

                    <script type="text/javascript" src="statusChange.js"></script>
                    <script type="text/javascript" src="modal.js"></script>
                      <?php }else{
                        header("location: logout.php");
                            } ?>
                    
                </body>
                </html>


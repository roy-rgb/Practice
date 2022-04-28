<?php
require_once 'header.php';
require_once 'database.php';
?>

<?php

$del_id=$_GET['del_id'];
$query="DELETE FROM tbl_user WHERE id = $del_id";
$delData = $conn->query($query);
header("Location: userlist.php");


?>



<body>
    <div class="container">
        <?php include 'nav.php'; ?>

        <div class="mainoption">
            <div class="sideoption">

            </div>

            <div class="sideoption2">

                <div class="contact_us">
                    <h2> Delete Data<h2>
                            <?php
                            if (isset($error)) {
                                echo $error;
                            }
                            ?>
                           
                            </div>
                            </div>
                            </div>
        <?php require_once 'footer.php'; ?>
                            </div>
                            </body>
                            </html>
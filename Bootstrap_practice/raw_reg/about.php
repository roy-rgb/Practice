<?php
session_start();
include 'header.php';
?>

<body>
    <div class="container">
          <?php if (isset($_SESSION["user_mail"]) && isset($_SESSION["user_name"])) { include 'nav.php'; ?>
           
      

        <div class="mainoption">
            <div class="sideoption">

            </div>

            <div class="sideoption2">
                <h1>About Me<h1>
                        <table class="about_tbl">
                            <tr>
                                <th>Name</th>
                                <td>Sourov Roy Antu</td>
                            </tr>

                            <tr>
                                <th>Home Town</th>
                                <td>Gazipur</td>
                            </tr>

                            <tr>
                                <th>Education</th>
                                <td>East West University</td>
                            </tr>

                            <tr>
                                <th>Marital Status</th>
                                <td>Unmarried</td>
                            </tr>

                        </table>
                        </div>
                        </div>


                        <?php include 'footer.php'; ?>
                        </div>
    
       <?php }else{
         header("location: logout.php");
     } ?>
                        </body>
                        </html>

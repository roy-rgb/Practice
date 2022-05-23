<?php
session_start();
include 'header.php';
?>

<body>
    <div class="container">
       <?php if (isset($_SESSION["user_mail"]) && isset($_SESSION["user_name"])) {  include 'nav.php';  ?>
         
      

        <div class="mainoption">
            <div class="sideoption">

            </div>

            <div class="sideoption2">
                <div class="contact_us">
                    <h2> Contact us<h2>
                            <form>




                                <table class="tbl-input"> 
                                    <tr>

                                        <th><label for="fname">First Name</label></th>
                                        <td><input type="text" id="fname" name="firstname" placeholder="Your name.."></td>
                                    </tr>

                                    <tr>
                                        <th> <label >Last Name :</label> </th>
                                        <td><input type="text"  id="lastName" name="lastName" placeholder=" Enter Your Last name.."></td>
                                    </tr>

                                    <tr>

                                        <th> <label for="country">Country</label></th>
                                        <td>   <select id="country" name="country">
                                                <option value="australia">Bangladesh</option>
                                                <option value="canada">Nepal</option>
                                                <option value="usa">India</option>
                                            </select> </td>

                                    </tr>

                                    <tr>
                                        <th> <label for="email">Email</label> </th>
                                        <td>  <input type="text" id="lname" name="email" placeholder="Your mail.."> </td>
                                    </tr>
                                    <tr>
                                        <td></td>
                                        <td><input type="submit" name="submit" value="Submit"> </td>
                                    </tr>
                                </table>
                            </form>
                            </div>
                            </div>
                            </div>
                            <?php include 'footer.php'; ?>
                            </div>
    
     <?php }else{
         header("location: logout.php");
     }
        ?>
                            </body>
                            </html>
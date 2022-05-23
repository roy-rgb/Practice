<?php
session_start();
if (!isset($_SESSION["user_id"])) {
    header("Location: logout.php");
}
include 'header.php';
?>



<body>
    <div class="container ">

        <?php if (isset($_SESSION["user_mail"]) && isset($_SESSION["user_name"])) {include 'nav.php'; ?>
        

        <div class='space-between bg-dark'></div>

                          <div class="mainoption">


            <div class="sideoption2">
                <div class='banner'>
                    <div>
                        <h1 class="display-3 d-flex justify-content-start  text-info font-weight-bold"> Wellcome To <span class="text-light font-weight-bold display-1"> Swapnoloke </span> <h1>

                                <h3 class="d-flex display-4 justify-content-center font-weight-bold  text-warning">Think Digitized!!</h3>
<?php if (isset($_SESSION["user_mail"]) && isset($_SESSION["user_name"])) { ?>
                                    <h2 class="d-flex display-4 justify-content-center font-weight-bold  text-danger">Hello</h2>
                                    <h2 class="text-warning  d-flex display-2 justify-content-center font-weight-bold   "> <?php echo $_SESSION["user_name"]; ?> </h2>
<?php } ?>

                                </div>


                                </div>

                                </div>
                                </div>
                                <div class='space-between bg-dark'></div>
<?php include 'footer.php'; ?>
                                </div>
                                <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
                                <script src="https://cdn.jsdelivr.net/npm/popper.js@1.12.9/dist/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
                                <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
   <?php }else{
         header("location: logout.php");
     } ?>                          
</body>
                                </html>



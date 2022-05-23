<?php 
session_start();
unset($_SESSION["id"]);
unset($_SESSION["user_name"]);

?>

<?php
require_once 'header.php';
require_once 'database.php';
?>

<body>
    <div class="container">

        <div class="mainoption">
            <div class="sideoption">

            </div>

            <div class="sideoption2">
                <div class="user-list shadow-lg p-2 mb-1 bg-white   ">
                    <div class='space-between bg-secondary'></div>
                    <div class="p-2 d-flex justify-content-center bg-light font-weight-bold text-warning flex-fill "><h2> Login/Register </h2> </div>
                    <div class='space-between bg-secondary'></div>
                </div>

                <div class="card">
                    <div class="card-body d-flex justify-content-center">
                        
                        <a type="button" href="login.php" class="bg-primary rounded  d-flex justify-content-center p-3 text-light font-weight-bold w-25 mx-4">Login</a>
                        <a type="button" href="registration.php" class="bg-success rounded d-flex justify-content-center p-3 text-light font-weight-bold w-25">Register</a>
                    </div>
                </div>

            </div>

<?php include 'footer.php'; ?>
        </div>

        <script type="text/javascript" src="ajax.js" ></script>
</body>
</html>
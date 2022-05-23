<?php 
session_start();
include 'header.php';
?>

<body>
    <div class="container">
   <?php if (isset($_SESSION["user_mail"]) && isset($_SESSION["user_name"])) {   include 'nav.php';?>
         

        <div class="mainoption">
 
            <div class="sideoption2">
                
                <div class="row">
                    <div class="col-sm-4">
                        <ul class="nav">
                            <li class="nav-item">
                                <a><button  onclick="laptopImg()">Laptop</button></a>
                            </li>
                            <li class="nav-item">
                                <a><button  onclick="mobileImg()">Mobile</button></a>
                            </li>
                            <li class="nav-item">
                               <a><button  onclick="flowerImg()">Flower</button></a>
                            </li>
                            
                        </ul>
                        
                    </div>
                    
                    <div class="col-sm-8">
                        <div class="mx-auto d-block">
                            <img id="chng-image" src="https://images.unsplash.com/photo-1593642702821-c8da6771f0c6?ixlib=rb-1.2.1&ixid=MnwxMjA3fDB8MHxzZWFyY2h8MTh8fGxhcHRvcHxlbnwwfHwwfHw%3D&w=1000&q=80" height="300px" weidth="600px">
                        </div>
                    </div>
                </div>

                
               
            </div>
        </div>
        <?php include 'footer.php'; ?>
    </div>
    
    <script type="text/javascript" src="mobile.js"></script>
    
      <?php }else{
         header("location: logout.php");
     } ?>
</body>
</html>
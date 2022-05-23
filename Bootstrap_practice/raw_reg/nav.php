<div class="headeroption">

    <nav class="navbar font-weight-bold p-4 navbar-expand-sm bg-dark navbar-dark ">
        <ul class="navbar-nav  mr-auto ">
            <?php if (isset($_SESSION["user_id"])) { ?>
                <li class="nav-item active ">
                    <a class="nav-link text-warning font-weight-bold" href="index.php">Home</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="about.php">About</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="contact.php">Contact</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="gallery.php">Gallery</a>
                </li>

                <li class="nav-item">
                    <a class="nav-link" href="userlist.php">User List</a>
                </li>

                <!--                <li class="nav-item">
                                    <a class="nav-link" href="login.php">Login</a>
                                </li>
                
                                <li class="nav-item">
                
                                    <a class="nav-link" href="registration.php">Registration</a>
                
                                </li>-->






                <li class="nav-item">
                    <a class="nav-link" href="arrayShow.php">Array Show</a>
                </li>
            <?php }
            ?>
            <div class="modal" tabindex="-1" role="dialog">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title">Modal title</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            <p>Modal body text goes here.</p>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-primary">Save changes</button>
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        </div>
                    </div>
                </div>
            </div>





            </li>

        </ul>

        <ul class="navbar-nav">

            <?php if (isset($_SESSION["user_id"])) { ?>
                <li class="nav-item d-flex justify-content-end">
                    <a class="nav-link" href="logout.php">Logout</a>
                </li>
            <?php } ?>

        </ul>
    </nav>

</div>
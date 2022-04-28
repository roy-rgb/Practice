<?php include 'header.php'; ?>

<body>
    <div class="container">
        <?php include 'nav.php'; ?>

        <div class="mainoption">
            <div class="sideoption">

            </div>

            <div class="sideoption2">
                <div class="contact_us">
                    <h2> Contact us<h2>
                    <form>

                        <label for="fname">First Name</label>
                        <input type="text" id="fname" name="firstname" placeholder="Your name..">
                        <br>

                        <label for="lname">Last Name</label>
                        <input type="text" id="lname" name="lastname" placeholder="Your last name..">
                        <br>

                        <label for="country">Country</label>
                        <select id="country" name="country">
                            <option value="australia">Bangladesh</option>
                            <option value="canada">Nepal</option>
                            <option value="usa">India</option>
                        </select>
                        <br>
                        
                          <label for="email">Email</label>
                        <input type="text" id="lname" name="email" placeholder="Your mail..">
                        <br>


                        <label for="subject">Subject</label>
                        <textarea id="subject" name="subject" placeholder="Write something.."></textarea>
                        <br>
                        <input type="submit" value="Submit">

                    </form>
                </div>
            </div>
        </div>
        <?php include 'footer.php'; ?>
    </div>
</body>
</html>
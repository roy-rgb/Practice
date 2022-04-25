<!DOCTYPE html>
<html>
    <head>
        <title>Ajax Basics</title>
    </head>
    <?php require_once 'database.php'; ?>
    <body>
        <h1>The XMLHttpRequest Object</h1>

        <?php
        $getQuery = "SELECT * FROM tbl_division";
        $result = mysqli_query($conn, $getQuery);
        ?>
        <label for="division"> Division </label>
        <select name="division" id="division" onchange="showDistrict(this.value)">
            <option value="0">--- Select Division ---</option>

            <?php foreach ($result as $row_sl) { ?>
                <option value="<?php echo $row_sl['id']; ?>"><?php echo $row_sl['name']; ?></option>             
            <?php } ?>

        </select>

        <label for="district"> District </label>
        <select name="district" id="district" onchange="showThana(this.value)"  >
            <option value="0">--- Select District ---</option>
        </select>

        <label for="thana"> Thana </label>
        <select name="thana" id="thana">
            <option value="0">--- Select Thana ---</option>
        </select>

        <script type="text/javascript" src="ajax.js" ></script>
    </body>
</html>
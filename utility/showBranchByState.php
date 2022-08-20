<!DOCTYPE html>
<html>
    <head>

    </head>
    <body>
        <?php
            $state = $_GET['state'];
            $con = mysqli_connect("localhost","web39", "web39", "g02s39jasdb");

            $sql = "SELECT branchName FROM branch where state = '".$state."'";

            $qry = mysqli_query($con,$sql);

            echo "<label for='branchName'>Branch Name</label>";
            echo "<select name='branchName' id='branchName' required>";
            while ($row = mysqli_fetch_assoc($qry)) {
                echo "<option value='".$row['branchName']."'>".$row['branchName']."</option>";
            }
            echo "</select>";

            if (mysqli_num_rows($qry) == 0) {
                echo "<p style='color: red'>Sorry. No branch available here. Please change your state.</p>";
                echo '<input type="hidden" name="branchName" value="" required>';
            }

            mysqli_close($con);
        ?>
    </body>
</html>
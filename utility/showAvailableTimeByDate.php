<!DOCTYPE html>
<html>
    <body>
        <?php
            $date = $_GET["date"];
            $branchName = $_GET["branchName"];
            $con = mysqli_connect("localhost","web39", "web39", "g02s39jasdb");

            $sql = "SELECT appTime FROM appointment WHERE appDate= '".$date."' AND branchName= '".$branchName."'";

            // get time that is booked on date given
            $qry = mysqli_query($con,$sql);

            $timeArr = array();

            while ($row = mysqli_fetch_assoc($qry))
                array_push($timeArr,$row['appTime']);

            print_r($timeArr);

            echo "<p>Please select available time: </p>";

            if (mysqli_num_rows($qry) > 0)
                for ($time = 1000; $time <= 1800; $time += 100) {
                    if (!in_array($time, $timeArr)) {
                        echo '<input type="radio" id="'.$time.'" class="radioBtn" name="appTime" value="'.$time.'" required>
                        <label for="'.$time.'">'.$time.'</label><br>';
                    }
                }
            else {
                for ($time = 1000; $time <= 1800; $time += 100)
                    echo '<input type="radio" id="'.$time.'" class="radioBtn" name="appTime" value="'.$time.'" required>
                        <label for="'.$time.'">'.$time.'</label><br>';
            }
            
            mysqli_close($con);
        ?>
    </body>
</html>
<?php
    if (isset($_POST['adminLog'])) {
        $con = mysqli_connect("localhost", "web39", "web39", "g02s39jasdb");
        if (mysqli_connect_errno()) echo "Error connecting to database";
        $sql = "SELECT * FROM user WHERE username = '".$_POST['adminUsername']."'";
        $qry = mysqli_query($con, $sql);
        $row = mysqli_fetch_assoc($qry);

        if ($row['username'] == $_POST['adminUsername']) {
            if ($row['password'] == $_POST['adminPassword']) {
                header("Location:./admin/branchList.php");
            }
            else echo "Wrong password";
        }
        else echo "Wrong username";
    }
    else if (isset($_POST['staffLog'])) {
        session_unset();
        session_start();
        $_SESSION['name'] = $_POST['staffName'];
        $con = mysqli_connect("localhost", "web39", "web39", "g02s39jasdb");
        if (mysqli_connect_errno()) echo "Error connecting to database";
        $sql = "SELECT * FROM user WHERE username = 'staff'";
        $qry = mysqli_query($con, $sql);
        $row = mysqli_fetch_assoc($qry);

        if ($row['username'] == 'staff') {
            if ($row['password'] == $_POST['staffPassword']) {
                header("Location:./appointment/appList.php");
            }
            else echo "Wrong password";
        }
    }
?>
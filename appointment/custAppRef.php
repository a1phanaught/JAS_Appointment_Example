<!DOCTYPE html>
<html>
    <head>
        <style>
            body {
                width: 600px;
                margin: auto;
                color: white;
                background-color: black;
            }
            form {
                text-align: center;
            }
            div {
                font-family: courier, arial, helvetica;
            }
            table {
                width: 100%;
            }
            td {
                border-bottom: 1px solid white;
            }
        </style>
    </head>
    <body>
        <form method="get" action="">
            <p>
                Please enter your Appointment ID: 
                <input type="text" name="appId" required>
                <br><br>
                <input type="submit" name="submit" value="Check Status">
            </p>
        </form>
        <br><br>
        <div>
            <table>
            <?php

                if (!isset($_GET['appId'])) exit();

                error_reporting(E_ERROR | E_PARSE);
                $con = mysqli_connect("localhost","web39", "web39", "g02s39jasdb");
                if (mysqli_connect_errno()) {
                    echo "Can't connect to database";
                    exit(1);
                }
                $sql = "SELECT * FROM appointment WHERE appId = '".$_GET['appId']."'";
                $qry = mysqli_query($con, $sql);

                $status;
                $ic;

                while ($row = mysqli_fetch_assoc($qry)) {
                    $status = $row['approval'];
                    $ic = $row['custIC'];
                }

                $sql = "SELECT * FROM customer WHERE ic = '".$ic."'";
                $qry = mysqli_query($con, $sql);

                $row = mysqli_fetch_assoc($qry);

                    echo "
                        <tr>
                            <td>Name:</td>
                            <td>".$row['name']."</td>
                        <tr>
                        <tr>
                            <td>IC Number:</td>
                            <td>".$ic."</td>
                        <tr>
                        <tr>
                            <td>Email:</td>
                            <td>".$row['email']."</td>
                        <tr>
                        <tr>
                            <td>Phone Number:</td>
                            <td>".$row['phoneNum']."</td>
                        <tr>
                    ";

                    if ($status) {
                        echo "
                        <tr>
                        <td>Approval Status</td>
                        <td style='color: lightgreen'>Approved</td>
                    <tr>
                    </table>
                    <form method='post' action=''>
                    <button type='submit' name='delCust' value='".$ic."'>Cancel Appointment</button>
                    </form>";
                    }
                    else {
                        echo "
                        <tr>
                        <td>Approval Status</td>
                        <td style='color: red'>Pending</td>
                    <tr>
                    </table>
                    <br><br>
                    <form method='post' action=''>
                    <button type='submit' name='delCust' value='".$ic."'>Cancel Appointment</button>
                    </form>"; 
                    }
            ?>
        </div>
    </body>
</html>

<?php
    include "./appointment.php";
    if (isSet($_POST['delCust'])) {
        deleteAppDetails($_POST['delCust']);
        deleteCustDetails($_POST['delCust']);
        header("Location:../main.html");
    }
?>
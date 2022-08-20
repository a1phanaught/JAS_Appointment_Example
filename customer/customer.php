<?php
    function registerCustomer() {
        $name = $_POST['name'];
        $email = $_POST['email'];
        $phoneNum = $_POST['phoneNum'];
        $ic = $_POST['ic'];

        $custId = $ic.$phoneNum;

        $con = mysqli_connect("localhost","web39", "web39" , 'g02s39jasdb');

        if (mysqli_connect_errno()) {
            echo "Error connecting to database: " . mysqli_connect_error();
            exit(1);
        }

        $sql = "INSERT INTO customer(custId, name, ic, email, phoneNum)
                VALUES('$custId', '$name', '$ic', '$email', '$phoneNum')";
        
        mysqli_query($con, $sql);


    }

    function setAppointment() {

        $con = mysqli_connect('localhost', 'web39', 'web39', 'g02s39jasdb');

        if(mysqli_connect_errno()) {
            echo "Error connecting to database: ".mysqli_connect_error();
            exit(1);
        }

        $custId = $_POST['ic'].$_POST['phoneNum'];
        $sqlForBranchId = "SELECT branchId FROM branch WHERE branchName = '".$_POST['branchName']."'";
        $branchList = mysqli_query($con,$sqlForBranchId);
        while ($row = mysqli_fetch_assoc($branchList)) {
            $branchId = $row['branchId'];
        }
        $custIC = $_POST['ic'];
        $branchName = $_POST['branchName'];
        $appDate = $_POST['appDate'];
        $appTime = $_POST['appTime'];

        $appId = $custIC.$custId;

        $sql = "INSERT INTO appointment(appId, custId, branchId, custIC, branchName, appDate, appTime)
                VALUES('$appId', '$custId', '$branchId', '$custIC', '$branchName', '$appDate', '$appTime')";

        mysqli_query($con,$sql);

    }

    function showCustomerDetails() {
        $con = mysqli_connect("localhost", "web39", "web39", "g02s39jasdb");
        if (mysqli_connect_errno()) {
            echo "Error connecting to database: " . mysqli_connect_error();
            exit(1);
        }

        $sql = "SELECT * FROM `customer` WHERE ic ='".$_GET["ic"]."'";
        $qry = mysqli_query($con, $sql);

        return $qry;
    }
?>
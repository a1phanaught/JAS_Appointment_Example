<?php
    function getListOfAppointments($start, $recordPerPage) {
        $con = mysqli_connect("localhost", "web39", "web39", "g02s39jasdb");
        if (mysqli_connect_errno()) {
            echo "Error connecting to database: " . mysqli_connect_error();
            exit(1);
        }

        $sql = "SELECT * FROM appointment ORDER BY appDate ASC LIMIT $start, $recordPerPage";
        $qry = mysqli_query($con, $sql);
        return $qry;
    }

    function searchAppByIC() {
        $con = mysqli_connect("localhost", "web39", "web39", "g02s39jasdb");
        if (mysqli_connect_errno()) {
            echo "Error connecting to database: " . mysqli_connect_error();
            exit(1);
        }

        $sql = "SELECT * FROM appointment WHERE custIC='".$_POST['searchKey']."'";
        $qry = mysqli_query($con, $sql);
        return $qry;
    }

    function searchAppByBranch($start, $recordPerPage) {
        $con = mysqli_connect("localhost", "web39", "web39", "g02s39jasdb");
        if (mysqli_connect_errno()) {
            echo "Error connecting to database: " . mysqli_connect_error();
            exit(1);
        }

        $sql = "SELECT * FROM appointment WHERE branchName='".$_POST['searchKey']."' ORDER BY appId ASC LIMIT $start, $recordPerPage";
        $qry = mysqli_query($con, $sql);
        return $qry;
    }

    function searchAppByDate() {
        $con = mysqli_connect("localhost", "web39", "web39", "g02s39jasdb");
        if (mysqli_connect_errno()) {
            echo "Error connecting to database: " . mysqli_connect_error();
            exit(1);
        }

        $sql = "SELECT * FROM appointment WHERE appDate='".$_POST['searchKey']."'";
        $qry = mysqli_query($con, $sql);
        return $qry;
    }

    function updateApprovalStatus($selected, $staff) {
        $con = mysqli_connect("localhost", "web39", "web39" , "g02s39jasdb");
        if (mysqli_connect_errno()) {
            echo "Error connecting to database: " . mysqli_connect_error();
            exit(1);
        }

        $sql = "UPDATE `appointment` SET `approval` = '1' , staffName = '".$staff."' WHERE custIC ='".$selected."'";
        $qry = mysqli_query($con, $sql);
        return $qry;
    }

    function deleteAppDetails($selected) {
        $con = mysqli_connect("localhost", "web39", "web39", "g02s39jasdb");
        if (mysqli_connect_errno()) {
            echo "Error connecting to database: " . mysqli_connect_error();
            exit(1);
        }

        $sql = "DELETE FROM `appointment` WHERE custIC = '".$selected."'";
        $qry = mysqli_query($con, $sql);
        return $qry;
    }

    function deleteCustDetails($selected) {
        $con = mysqli_connect("localhost", "web39", "web39", "g02s39jasdb");
        if (mysqli_connect_errno()) {
            echo "Error connecting to database: " . mysqli_connect_error();
            exit(1);
        }

        $sql = "DELETE FROM `customer` WHERE ic ='".$selected."'";
        $qry = mysqli_query($con, $sql);
        return $qry;
    }
?>
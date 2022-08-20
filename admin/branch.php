<?php
    function addBranch() {
        $branchName = $_POST['branchName'];
        $address1 = $_POST['address1'];
        $address2 = $_POST['address2'];
        $postcode = $_POST['postcode'];
        $district = $_POST['district'];
        $state = $_POST['state'];
        $email = $_POST['email'];
        $phoneNum = $_POST['phoneNum'];

        $branchId = $postcode.$phoneNum;

        $con = mysqli_connect('localhost', 'web39', 'web39', 'g02s39jasdb');
        if (mysqli_connect_errno()) {
            echo "Error connecting to database: ".mysqli_connect_error();
            exit(1);
        }
        $sql = "INSERT INTO branch(branchId, branchName, address1, address2, postcode, district, state, email, phoneNumber)
                 VALUES('$branchId', '$branchName', '$address1', '$address2', '$postcode', '$district', '$state', '$email', '$phoneNum')";
        mysqli_query($con, $sql);
        
    }

    function getListOfBranches() {
        $con = mysqli_connect("localhost", "web39", "web39", "g02s39jasdb");
        if (mysqli_connect_errno()) {
            echo "Error connecting to database: ".mysqli_connect_error();
            exit(1);
        }
        $sql = "SELECT * FROM branch";
        $qry = mysqli_query($con, $sql);
        return $qry;
    }

    function deleteBranches($branchId) {
        $con = mysqli_connect("localhost", "web39", "web39", "g02s39jasdb");
        if (mysqli_connect_errno()) {
            echo "Error connecting to database: ".mysqli_connect_error();
            exit(1);
        }
        $sql = "DELETE FROM branch WHERE branchId = '".$branchId."'";
        mysqli_query($con, $sql);
    }

    function getBranchInfo($branchId) {
        $con = mysqli_connect("localhost", "web39", "web39", "g02s39jasdb");
        if (mysqli_connect_errno()) {
            echo "Error connecting to database: ".mysqli_connect_error();
            exit(1);
        }
        $sql = "SELECT * FROM branch WHERE branchId = '".$branchId."'";
        $qry = mysqli_query($con, $sql);
        return $qry;
    }

    function updateBranch() {
        $con = mysqli_connect("localhost", "web39", "web39", "g02s39jasdb");
        if (mysqli_connect_errno()) {
            echo "Error connecting to database: ".mysqli_connect_error();
            exit(1);
        }

        $branchName = $_POST["branchName"];
        $address1 = $_POST["address1"];
        $address2 = $_POST["address2"];
        $postcode = $_POST["postcode"];
        $district = $_POST["district"];
        $state = $_POST["state"];
        $email = $_POST["email"];
        $phoneNum = $_POST["phoneNum"];
        $branchId = $_POST["branchId"];

        //$branchIdUpdt = $postcode.$phoneNum;

        // Update the branch and appointment as well
        $sql = "UPDATE branch SET branchId = '".$branchId."' , branchName = '".$branchName."' , address1 = '".$address1."' , ";
        $sql .= " address2 = '".$address2."' , postcode = '".$postcode."' , district = '".$district."' , state = '".$state."' , ";
        $sql .= " email = '".$email."' , phoneNumber = '".$phoneNum."' WHERE branchId = '".$branchId."'";
        mysqli_query($con, $sql);

        $sql = "UPDATE appointment SET branchName = '".$branchName."' WHERE branchId = '".$branchId."'";
        mysqli_query($con, $sql);

    }
?>
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
        <table>
        <h1>Customer Details</h1>
        <?php

            include './customer.php';

            if (isset($_GET['ic'])) {
                $custDetails = showCustomerDetails();
            }
            else {
                echo "An error has occured. Can't find the customer with IC.";
                exit(1);
            }

            $row = mysqli_fetch_assoc($custDetails);

            echo "
                <tr>
                    <td>Name</td>
                    <td>".$row['name']."</td>
                <tr>
                <tr>
                    <td>IC Number</td>
                    <td>".$row['ic']."</td>
                <tr>
                <tr>
                    <td>Email</td>
                    <td>".$row['email']."</td>
                <tr>
                <tr>
                    <td>Phone Number</td>
                    <td>".$row['phoneNum']."</td>
                <tr>
            ";

        ?>
        </table>
    </body>
</html>
<!DOCTYPE html>
<html>
    <head>
        <style>
            body {
                font-family: "Helvetica Neue",Helvetica,Arial;
                width: 1100px;
                margin: auto;
                background-color: black;
                color: white;
            }
            table {
                font-size: 12px;
                width: 100%;
            }
            tr, td, th {
                border: 1px solid white;
                padding: 10px;
            }
            th {
                font-size: 14px;
            }
            .btn {
                padding: 10px;
                border: 1px solid white;
                background-color: black;
                width : 300px;
                color: white;
                display: inline;
            }
            #buttons {
                display: inline;
            }
            #delForm {
                display: inline;
            }
            #delBtn:hover {
                background-color: red !important;
            }
            #addBtn:hover {
                background-color: green !important;
            }
        </style>
    </head>
    <body>
        <h1>Branch Listing</h1>
        <?php
            include "./branch.php";

            if (false) {

            }
            else if (false) {

            }
            else {
                $branchList = getListOfBranches();
            }
            
            echo "Number of branches: " . mysqli_num_rows($branchList);
            echo 
            "<br><br><table>
            <tr>
                <th>No.</th>
                <th>Branch Name</th>
                <th>Postcode</th>
                <th>State</th>
                <th>Email</th>
                <th>Phone Number</th>
                <th>Update</th>
                <th>Select</th>
            </tr>
            ";

            $count = 1;

            while ($row = mysqli_fetch_assoc($branchList)) {
                $branchId = $row['branchId'];
                //$name = $row['branchName'];
                echo "
                <tr>
                    <td>".$count."</td>
                    <td>".strtoupper($row['branchName'])."</td>
                    <td>".$row['postcode']."</td>
                    <td>".strtoupper($row['state'])."</td>
                    <td>".$row['email']."</td>
                    <td>".$row['phoneNumber']."</td>
                    <td style='text-align: center'>
                        <form method='post' action='./updateBranchForm.php'>
                            <input type='hidden' name='branchIdToUpdate' value='$branchId'>
                            <input type='submit' name='updateBranch' value='Update'>
                        </form>
                    </td>
                    <td style='text-align: center'>
                        <input type='checkbox' form='delForm' name='branchIdToDelete[]' value='$branchId'>
                    </td>
                </tr>
                ";
                $count++;
            }

            echo "</table>";

        ?>
        <div id="buttons">
            <button onclick="location.href='./addBranchForm.html'" class="btn" id="addBtn">Add A Branch</button>
            <form method="post" action="./processBranch.php" id='delForm'>
                <button type='submit' value='Delete Selected Branch' class="btn" id="delBtn">Delete Selected Branch</button>
            </form>
        </div>
        <br><br>
        <a href="../main.html" style="color: white">Return to Main Page</a>
        <br><br>
    </body>
</html>
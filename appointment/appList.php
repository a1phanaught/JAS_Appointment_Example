<!DOCTYPE html>
<html>

<head>
    <style>
        body {
            font-family: "Helvetica Neue", Helvetica, Arial;
            width: 1100px;
            margin: auto;
            background-color: black;
            color: white;
            height: 125%;
        }

        table {
            font-size: 12px;
            width: 100%;
        }

        tr,
        td,
        th {
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
            width: 300px;
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

        #appBtn:hover {
            background-color: green !important;
        }
        .pagination {
            display: inline-block;
            border: 1px solid white;
        }

        .pagination a {
            color: white;
            float: left;
            padding: 8px 16px;
            text-decoration: none;
        }

        .pagination a.active {
            background-color: white;
            color: black;
        }

        .pagination a:hover:not(.active) {background-color: white; color: black}
    </style>
</head>

<body>
    <h1>Customer Listing</h1>
    <div>
        <?php

            include "./appointment.php";

            displaySearchOption();

            //Pagination section begins
            $recordPerPage = 10;

            if (isset($_GET["page"])) //page selected
            { 
                $page  = $_GET["page"]; 
            } 
                else //first time load
            { 
                $page=1; 
            } 
            if ($page == 0)
                $page=1;
            
            $start = ($page-1)*$recordPerPage;

            if (isset($_POST['searchByIC'])) {
                $appList = searchAppByIC();
            }
            else if (isset($_POST['searchByBranch'])) {
                $appList = searchAppByBranch($start, $recordPerPage);
            }
            else if (isset($_POST['searchByDate'])) {
                $appList = searchAppByDate();
            }
            else if (isset($_POST['reset'])) {
                $appList = getListOfAppointments($start, $recordPerPage);
            }
            else {
                $appList = getListOfAppointments($start, $recordPerPage);
            }
            
            echo "<br>Page: ".$page;
            echo "
            <br><br><table>
            <tr>
                <th>No.</th>
                <th>Branch Name</th>
                <th>Customer IC</th>
                <th>Appointment Date</th>
                <th>Appointment Time</th>
                <th>Approval Status</th>
                <th>Select</th>
            </tr>
            ";

            $count = (($page-1)*$recordPerPage)+1;

            while ($row = mysqli_fetch_assoc($appList)) {
                $appId = $row['appId'];

                echo "
                    <tr>
                        <td>".$count."</td>
                        <td>".strtoupper($row['branchName'])."</td>
                        <form method='get' action='../customer/customerDetails.php'>
                            <td><input type='submit' name='ic' value='".$row['custIC']."'/></td>
                        </form>
                        <td>".$row['appDate']."</td>
                        <td>".$row['appTime']."</td>
                        ";
                        if (!$row['approval'])
                            echo "<td style='color: red'>Pending</td>";
                        else
                            echo "<td style='color: lightgreen'>Approved</td>";

                        echo "<td>
                            <input type='checkbox' form='selForm' name='selForm[]' value='".$row['custIC']."'>
                        </td></tr>";
                        $count++;
            }
            
            echo "</div></table>";
            
            $con = mysqli_connect("localhost", "web39", "web39", "g02s39jasdb");

            $sql = "SELECT COUNT(appId) as noOfRecord FROM appointment";
            $result = mysqli_query($con,$sql);
            $row = mysqli_fetch_assoc($result);
            $totalRecords = $row['noOfRecord'];

            $totalPages = ceil($totalRecords/$recordPerPage);

            //echo "<br>";
            
            echo "<p>Page select: </p><div class='pagination' id='paging'>";

            for ($i=1; $i<=$totalPages; $i++) { 
                echo "<a href='appList.php?page=".$i."'>".$i; 
            }  

            echo "</div>";
        ?>
        <hr>
        <div id="buttons">
            <form method='post' action="processApp.php" id="selForm">
                <button type="submit" value="Approve Selected" class="btn" name="appBtn" id="appBtn">Approve
                    Selected</button>
                <button type="submit" value="Remove Selected" class="btn" name="delBtn" id="delBtn">Remove
                    Selected</button>
            </form>
        </div>
        <br>
        <a href="../main.html" style="color: white">Return to Main Page</a>
        <br><br>
</body>

</html>

<?php
    function displaySearchOption() {
        echo "
        <br>
        <form method='post' action=''>
        <div>
            <fieldset><legend>Filter by:</legend>
            Criteria
            <input type='text' name='searchKey'>
            <p>
            <input type='submit' name='searchByDate' value='By date'>
            <input type='submit' name='searchByBranch' value='By branch name'>
            <input type='submit' name='searchByIC' value='By IC number'>
            <input type='submit' name='reset' value='Reset'>
            </p>
            </fieldset>
        </div>
        </form>
        <br>
        ";
    }
?>
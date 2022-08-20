<!DOCTYPE html>
<html>

<head>
    <style>
        body {
            width: 600px;
            margin: 0 auto;
        }
        td {
            border-bottom: 1px solid white;
        }
    </style>
    <script>
        function print() {
            var divContents = document.getElementById("details").innerHTML;
            var a = window.open('', '', 'height=500, width=500');
            a.document.write('<html>');
            a.document.write('<body>');
            a.document.write(divContents);
            a.document.write('</body></html>');
            a.document.close();
            a.print();
        }
    </script>
</head>

<body>
    <h1>Appointment details</h1>
    <div id="details">
    <?php

include "./customer.php";

if (isset($_POST['regCust'])) {
    registerCustomer();
    setAppointment();

    $con = mysqli_connect("localhost", "web39", "web39", "g02s39jasdb");

    if (mysqli_connect_errno()) {
        echo "Error connecting to database ".mysqli_connect_error();
        exit(1);
    }

    $getAppIdSql = "SELECT appId FROM `appointment` WHERE custIC = '".$_POST['ic']."'";
    $qry = mysqli_query($con, $getAppIdSql);

    $row = mysqli_fetch_assoc($qry);

    echo "
        <table>
            <tr>
                <td>Name: </td>
                <td>".$_POST['name']."</td>
            </tr>
            <tr>
                <td>Email: </td>
                <td>".$_POST['email']."</td>
            </tr>
            <tr>
                <td>Phone Number: </td>
                <td>".$_POST['phoneNum']."</td>
            </tr>
            <tr>
                <td>IC Number: </td>
                <td>".$_POST['ic']."</td>
            </tr>
            <tr>
                <td>Branch State: </td>
                <td>".$_POST['state']."</td>
            </tr>
            <tr>
                <td>Branch Name: </td>
                <td>".$_POST['branchName']."</td>
            </tr>
            <tr>
                <td>Appointment Date</td>
                <td>".$_POST['appDate']."</td>
            </tr>
            <tr>
                <td>Appointment Time: </td>
                <td>".$_POST['appTime']."</td>
            </tr>
            <tr>
                <td>PLEASE KEEP THIS ID FOR APPOINTMENT REFERENCE:</td>
                <td>".$row['appId']."</td>
            </tr>
        </table>
    ";
}
?>
</div>
<br>
<p>
<button onclick="print()">Print slip</button>
<a href="../main.html" style="text-align: left">Return to homepage</a>
</p>
</body>

</html>
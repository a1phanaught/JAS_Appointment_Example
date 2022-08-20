<!DOCTYPE html>
<html>
    <head>
        <style>
            body {
                background-color: black;
            }
            form {
                color: white;
                font-family: sans-serif;
                max-width: 400px;
                margin: auto;
            }
            input {
                width: 93%;
                border: 10px solid white;
            }
            h1 {
                color: white;
            }
            select {
                width: 97%;
                height: 40px;
                border-radius: 5px;
            }
            #submit {
                transition: 0.4s;
                background-color: grey;
                height : 30px;
                color: white;
                margin-left: 10px;
                border: none !important;
            }
            #submit:hover {
                background-color: white;
                color: black;
            }
        </style>
    </head>
    <body>
        <?php
            include "./branch.php";

            $branchIdToUpdate = $_POST['branchIdToUpdate'];

            $branchInfoQry = getBranchInfo($branchIdToUpdate);
            $branchRecord = mysqli_fetch_assoc($branchInfoQry);

            $branchId = $branchRecord['branchId'];

            echo "
            <form action='processBranch.php' method='post'>
            <h1>Update Branch Information</h1>
            <fieldset>
                <p>Branch Name: </p>
                <p>
                    <input type='text' name='branchName' placeholder='Branch Name' value='".$branchRecord['branchName']."' required>
                </p>
                <p>Branch ID:</p>
                <p>
                    <input type='text' name='branchId' placeholder='ID' value='".$branchId."' readonly>
                </p>
                <p>Address 1:</p>
                <p>
                    <input type='text' name='address1' placeholder='Address' value='".$branchRecord['address1']."' required>
                </p>
                <p>Address 2:</p>
                <p>
                    <input type='text' name='address2' placeholder='Address' value='".$branchRecord['address2']."' required>
                </p>
                <p>Postcode:</p>
                <p>
                    <input type='text' name='postcode' placeholder='45000' value='".$branchRecord['postcode']."' required>
                </p>
                <p>District:</p>
                <p>
                    <input type='text' name='district' placeholder='Kota Setar' value='".$branchRecord['district']."' required>
                </p>
                <p>State:</p>
                <p>
                    <select name='state'>
                        <option>Wilayah Persekutuan</option>
                        <option>Selangor</option>
                        <option>Terengganu</option>
                        <option>Sabah</option>
                        <option>Sarawak</option>
                        <option>Johor</option>
                        <option>Kedah</option>
                        <option>Kelantan</option>
                        <option>Melaka</option>
                        <option>Negeri Sembilan</option>
                        <option>Pahang</option>
                        <option>Penang</option>
                        <option>Perak</option>
                        <option>Perlis</option>
                    </select>
                </p>
                <p>Email Address:</p>
                <p>
                    <input type='email' name='email' placeholder='alibinabu@jpn.my' value='".$branchRecord['email']."' required>
                </p>
                <p>Phone Number:</p>
                <p>
                    <input type='text' name='phoneNum' placeholder='0198765432' value='".$branchRecord['phoneNumber']."' required>
                </p>
                <p>
                    <input type='hidden' name='branchId' value='".$branchId."'>
                </p>
                <p style='padding: 20px'>
                    <input id='submit' type='submit' name='updateBranch' value='Save'>
                </p>
            </fieldset>
            </form>
            ";
        ?>
    </body>
</html>
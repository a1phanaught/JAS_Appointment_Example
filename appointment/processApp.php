<?php

    session_start();

    include "./appointment.php";

    if (isset($_POST['selForm'])) {

        if (isset($_POST['appBtn']))
            foreach ($_POST['selForm'] as $selected)
                updateApprovalStatus($selected, $_SESSION['name']);
        else if(isSet($_POST['delBtn']))
            foreach ($_POST['selForm'] as $selected) {
                deleteAppDetails($selected);
                deleteCustDetails($selected);
            }
        
        header("Location:appList.php");

    }

    header("Location:appList.php");
?>
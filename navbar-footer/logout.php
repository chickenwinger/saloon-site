<?php
session_start();

    if (isset($_SESSION['id'])) {
        echo "<script>alert('Thank you for using our services! See you again, " . $_SESSION['ln'] . " " . $_SESSION['fn'] . "')</script>";
        session_destroy();
        echo "<script>window.location.href='../homepage.php'</script>";

    } else if (isset($_SESSION['empID']) && ($_SESSION['role'] == 'stylist') && ($_SESSION['empGender'] == 'male')) {
        echo "<script>alert('Successfully logged out! See you again, Mr. " . $_SESSION['empLN'] . " " . $_SESSION['empFN'] . "')</script>";
        session_destroy();
        echo "<script>window.location.href='../homepage.php'</script>";

    } else if (isset($_SESSION['empID']) && ($_SESSION['role'] == 'stylist') && ($_SESSION['empGender'] == 'female')) {
        echo "<script>alert('Successfully logged out! See you again, Ms. " . $_SESSION['empLN'] . " " . $_SESSION['empFN'] . "')</script>";
        session_destroy();
        echo "<script>window.location.href='../homepage.php'</script>";
        
    } else if (isset($_SESSION['empID']) && ($_SESSION['role'] == 'admin')) {
        echo "<script>alert('Successfully logged out! See you again, " . $_SESSION['empLN'] . " " . $_SESSION['empFN'] . "')</script>";
        session_destroy();
        echo "<script>window.location.href='../homepage.php'</script>";
    }
?>

<?php

session_start();

$conn = mysqli_connect('localhost', 'root', '', 'sdp_assignment');

$username = mysqli_real_escape_string($conn, $_POST['loginUsername']);
$userpassword = mysqli_real_escape_string($conn, $_POST['loginPassword']);

if (isset($_POST['btnLogin'])) {
    $verify_member = "SELECT * FROM member_list WHERE memberUsername = '".$username."' AND memberPassword = '" . MD5($userpassword) . "'";
    mysqli_query($conn, $verify_member);

    if (mysqli_affected_rows($conn) <= 0) {
        $verify_emp = "SELECT * FROM employee_list WHERE empEmail = '".$username."' AND empPassword = '" . MD5($userpassword) . "'";
        mysqli_query($conn, $verify_emp);

        if (mysqli_affected_rows($conn) <= 0) {
            echo "<script>alert('Wrong username/password! Please try again.')</script>;";
            echo "<script>window.location.href='../homepage.php';</script>";
        } else {
            if ($row = mysqli_fetch_array(mysqli_query($conn, $verify_emp))) {
                $_SESSION['empID'] = $row['empID'];
                $_SESSION['empEmail'] = $row['empEmail'];
                $_SESSION['empFN'] = $row['empFN'];
                $_SESSION['empLN'] = $row['empLN'];
                $_SESSION['empGender'] = $row['empGender'];
                $_SESSION['role'] = $row['empRole'];
                $_SESSION['empPassword'] = $row['empPassword'];
                $_SESSION['login'] = "logged-in";
            }
            if ($_SESSION['role'] == "stylist") {
                echo "<script>alert('Welcome back! " . $_SESSION['empLN'] . " " . $_SESSION['empFN'] . "')</script>";
                echo "<script>window.location.href='../stylist-site/stylisthomepage.php';</script>";
            } else if ($_SESSION['role'] == "admin") {
                echo "<script>alert('Welcome back! " . $_SESSION['empLN'] . " " . $_SESSION['empFN'] . "')</script>";
                echo "<script>window.location.href='../admin-site/admin-home.php';</script>";
            }
        }
    } else {
        if ($row2 = mysqli_fetch_array(mysqli_query($conn, $verify_member))) {
            $_SESSION['id'] = $row2['memberID'];
            $_SESSION['memberUsername'] = $row2['memberUsername'];
            $_SESSION['fn'] = $row2['memberFN'];
            $_SESSION['ln'] = $row2['memberLN'];
            $_SESSION['memberPassword'] = $row2['memberPassword'];
            $_SESSION['login'] = "logged-in";
        }

        echo "<script>alert('Welcome back! " . $_SESSION['ln'] . " " . $_SESSION['fn'] . "');</script>";
        echo "<script>window.history.back();</script>";
    }
}
?>

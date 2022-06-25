<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="StylistNavbar.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <script src='https://kit.fontawesome.com/a076d05399.js'></script>
</head>

<body style="padding: 0;margin:0;">

    <?php
    session_start();
    $empID = $_SESSION['empID'];
    $email = $_SESSION['empEmail'];
    $conn = mysqli_connect('localhost', 'root', '', 'sdp_assignment');
    $nstylist = "SELECT * FROM employee_list WHERE empID = '$empID' ";
    $nstylistresult = mysqli_query($conn, $nstylist);
    ?>
    <?php $rows = mysqli_fetch_array($nstylistresult) ?>

    <div class="hearder" style="background: pink;width: 100%;position: relative;top:0%;">
        <table class="head">
            <tr>
                <td class="homeicon"><a href="stylisthomepage.php" style="color: black"><i class="fa fa-home" style="font-size: 80px"></i></a></td>
                <td class="usericon">
                    <div class="dropdown">

                        <i class='fas fa-user-tie' style='font-size:48px;cursor:pointer;'></i>

                        <div class="dropdown-content">
                            <a href="StylistProfile.php">Profile</a>
                            <a href="Stylistupcomingbooking.php">Upcoming Booking</a>
                        </div>
                    </div>
                </td>
                <td class="bellicon">
                    <a href="StylistNotificationPage.php" style="color: black">
                        <i class='fas fa-bell' style='font-size:48px;'></i>
                    </a>
                </td>
                <td class="logouttd">
                    <a aria-label='Log Out' class='h-button centered' data-text='<?php echo ($rows['empLN'] . ' ' . $rows['empFN']); ?>' href='../navbar-footer/logout.php'>
                        <span>L</span>
                        <span>o</span>
                        <span>g</span>
                        <span>O</span>
                        <span>u</span>
                        <span>t</span>
                    </a>
                </td>
            </tr>



        </table>
    </div>

    <?php
    if (isset($_SESSION['id']) || !isset($_SESSION['empID'])) {
        echo "<script>window.location.href='../homepage.php'</script>";
    } else if (isset($_SESSION['empID']) && $_SESSION['role'] === 'admin' || $_SESSION['role'] !== 'stylist') {
        echo "<script>window.location.href='../admin-site/admin-home.php'</script>";
    }
    ?>
</body>

</html>

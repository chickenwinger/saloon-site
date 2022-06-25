<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Stylist Homepage</title>
    <link rel="stylesheet" href="stylisthomepage.css">
</head>

<body style="background-image: url('../stylist-image/FASHION_STUDIO.jpg');padding:0;margin:0;">
    <?php include('StylistNavbar.php'); ?>
    <?php

    $conn = mysqli_connect('localhost', 'root', '', 'sdp_assignment');
    $stylist = "SELECT * FROM employee_list WHERE empID = '" . $_SESSION['empID'] . "' ";
    $stylistresult = mysqli_query($conn, $stylist);

    ?>
    <?php $rows = mysqli_fetch_array($stylistresult); { ?>

        <center>
            <div class="content">

                <br>
                <button class="upcoming" onclick="window.location.href='Stylistupcomingbooking.php'">
                    Upcoming Booking
                    <div class="ubutton__horizontal"></div>
                    <div class="ubutton__vertical"></div>
                </button>
                <br>
                <button class="notification" onclick="window.location.href='StylistNotificationPage.php'">
                    Notification
                    <div class="nbutton__horizontal"></div>
                    <div class="nbutton__vertical"></div>
                </button>
                <button class="view" onclick="window.location.href='StylistProfile.php'">
                    View Profile
                    <div class="vbutton__horizontal"></div>
                    <div class="vbutton__vertical"></div>
                </button>
            </div>
        </center>
</body>
<?php } ?>

</html>

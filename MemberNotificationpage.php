<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="MemberProfile/Notificationpage.css">
    <title>Notification Page</title>
</head>

<body>
    <?php
    include('navbar-footer/navbar.php'); ?>
    <div style="height: 2vw;"></div>
    <h1 class="notificationTitle">Notification</h1>
    </br>

    <div
    ><?php if (isset($_SESSION['login'])) {
                $userid = $_SESSION['id'];
            } else {
                echo "<script>window.location.href='homepage.php';</script>";
            }
            $conn = mysqli_connect('localhost', 'root', '', 'sdp_assignment');
            $notification = "Select booking_datetime.bookingID, booking_datetime.servID,booking_datetime.bookingStatus ,service_list.servTitle from booking_datetime JOIN service_list ON booking_datetime.servID = service_list.servID WHERE booking_datetime.memberID = '$userid' AND bookingStatus != 'pending'";
            $nresult = mysqli_query($conn, $notification);
            if (mysqli_num_rows($nresult) <= 0) {
            ?>
                <div style="height: 2vw;"></div>
            <h1> Unfortunately You Don't Have any Pending Service Therefore no Message will be Shown. If You Wish To Book A Service Click<a href="#"> Here</a></h1>

            <?php } else {
                $column = 0;
                $row = 1;
                while ($rows = mysqli_fetch_array($nresult)) {
                    if ($row > $column) { ?>

                    <table class="notification">
                        <tr >
                            <td style="width: 6.9vw;font-size:15px;">BOOKING ID</td>
                            <td>B<?php echo $rows['bookingID'] ?></td>
                            <td style="text-align:right;font-weight:600;" colspan="2"><?php echo $rows['bookingStatus'] ?></td>
                        </tr>
                        <tr>
                            <td colspan ="4" style="color:white;" class="whiteline"><hr style="width:100%;height:1px;background:white;"></td>
                        </tr>
                        <tr style="padding-top:10px;">
                            <td style="width: 6.9vw;font-size:15px;">SERVICE ID</td>
                            <td style="width: auto;">S<?php echo $rows['servID'] ?></td>
                            
                        </tr>
                        <tr>
                        <td >&nbsp;</td> 
                        <td colspan="3" style="padding:5px 15px 10px 2px;height:5vw;width:811px;text-align:left;"><h3><?php echo $rows['servTitle'] ?></h3></td>
                        </tr>
                        

                        <tr>
                            <td colspan="3">&nbsp;</td>
                            <td style="text-align:right"><button class="viewbutton" onclick="window.location.href='#'"><span>View Details</span></button></td>
                        </tr>

                    </table>
                    <br>
                <?php } ?>
            <?php } ?>
        <?php } ?>
    </div>
    <br>
</body>

</html>
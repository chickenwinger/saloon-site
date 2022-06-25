<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="MemberProfile/Notificationpage.css">
    <title>Notification Page</title>
</head>

<body>
    <?php include('navbar-footer/navbar.php'); ?>
    <div style="height: 2vw;"></div>
    <h1 class="notificationTitle" style="font-family: Arial; color: white;">Notification</h1>
    </br>

    <div>
        <?php if (isset($_SESSION['login'])) {
            $userid = $_SESSION['id'];
        } else {
            echo "<script>window.location.href='homepage.php';</script>";
        }
        $conn = mysqli_connect('localhost', 'root', '', 'sdp_assignment');
        $notification = "SELECT * FROM employee_list el INNER JOIN employee_service es ON el.empID = es.empID INNER JOIN booking_datetime bd ON es.emp_servID = bd.employee_serviceID INNER JOIN service_list sl ON bd.servID = sl.servID WHERE bd.bookingStatus != 'pending' AND bd.memberID = $userid AND bd.bookingDate >= CURDATE()";
        $nresult = mysqli_query($conn, $notification);
        if (mysqli_affected_rows($conn) <= 0) {
        ?>
            <div style="height: 2vw;"></div>
            <h1 style="color: white; width: 60%; margin: 0 auto"> Unfortunately You Don't Have any Pending Service Therefore no Message will be Shown. If You Wish To Book A Service Click<a href="service-all.php" style="color: cyan"> Here</a></h1>

            <?php } else {
            $column = 0;
            $row = 1;
            while ($rows = mysqli_fetch_array($nresult)) {
                if ($row > $column) { ?>

                    <table class="notification">
                        <tr>
                            <td style="width: 6.9vw;font-size:15px;">BOOKING ID</td>
                            <td>B<?php echo $rows['bookingID'] ?></td>
                            <td style="text-align:right;font-weight:600;" colspan="2"><?php echo $rows['bookingStatus'] ?></td>
                        </tr>
                        <tr>
                            <td colspan="4" style="color:white;" class="whiteline">
                                <hr style="width:100%;height:1px;background:white;">
                            </td>
                        </tr>
                        <tr style="padding-top:10px;">
                            <td style="width: 6.9vw;font-size:15px;">SERVICE ID</td>
                            <td style="width: auto;">S<?php echo $rows['servID'] ?></td>

                        </tr>
                        <tr>
                            <td>&nbsp;</td>
                            <td colspan="3" style="padding:5px 15px 10px 2px;height:5vw;width:811px;text-align:left;">
                                <h3>Your booking of <?php echo $rows['servTitle'] ?> with <?php echo ($rows['empLN'] . " " . $rows['empFN']) ?> has been <?php echo $rows['bookingStatus'] ?></h3>
                            </td>
                        </tr>
                        
                        <tr>
                            <td colspan="3">&nbsp;</td>
                            <?php if ($rows['bookingStatus'] != 'declined') { ?>
                            <td style="text-align:right"><button class="viewbutton" onclick="window.location.href='upcoming-activity.php'"><span>View Details</span></button></td>
                            
                        </tr>
                        <?php } else{ ?>

                            <tr><td colspan="3"><h3>Reason: <?php echo $rows['notesToMember'];?></h3></td></tr>

                        <?php }?>
                    </table>
                    <br>
                    <br>
                <?php } ?>
            <?php } ?>
        <?php } ?>
    </div>
    <div style="height: 120px"></div>
    <?php include('navbar-footer/footer.php'); ?>
</body>

</html>

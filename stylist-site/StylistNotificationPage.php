<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Notification</title>
    <link rel="stylesheet" href="notification.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
</head>

<body>
    <?php
    $conn = mysqli_connect('localhost', 'root', '', 'sdp_assignment');
    include('StylistNavbar.php');
    ?>

    <center>
        <h1 style="color: white">Notifications</h1>
    </center>

    <?php
    $notification = "SELECT * FROM booking_datetime JOIN member_address ON booking_datetime.memberID = member_address.memberID JOIN service_list ON booking_datetime.servID =service_list.servID JOIN member_list ON booking_datetime.memberID = member_list.memberID JOIN employee_service ON booking_datetime.employee_serviceID = employee_service.emp_servID WHERE booking_datetime.bookingStatus ='pending' AND member_address.defaultAddress ='default' AND booking_datetime.employee_serviceID = (Select emp_servID from employee_service Where empID = $empID and servID = booking_datetime.servID)";
    $nresult = mysqli_query($conn, $notification);
    if (mysqli_num_rows($nresult) <= 0) {
    ?>
        </br>
        <center>
            <div class="ifnonotification" style="background-image: url('../stylist-image/NO-Notification.jpg');">

                <div style="padding-top:10vw;width:30vw;text-align:center;">
                    <p1 style="margin-top:10vw;">Unfortunately You Don't Have Any Notification Right Now, But Don't Give UP! Maybe You Could Upload More Photo of Customers That Will Show That You Are Skilful </p1>
                </div>
            </div>
            </br>
        </center>

        <?php } else {
        while ($rows = mysqli_fetch_array($nresult)) {
            $column = 0;
            $row = 1
        ?>
            <center>
                <!-- Info Table-->
                <table class="bookings">
                    <input type="hidden" name="booingid" value="<?php echo $rows['bookingID']; ?>">
                    <tr>
                        <td style="border-bottom: 1px solid white;padding:6px 10px 6px 10px;" colspan="100"> Service booking made by <?php echo ($rows['memberFN'] . ' ' . $rows['memberLN']); ?></td>
                    </tr>
                    <tr>
                        <td class="left">Service Title: </td>
                        <td class="right"><?php echo $rows['servTitle']; ?></td>
                    </tr>
                    <tr>
                        <td class="left">Date: </td>
                        <td class="right"><?php echo $rows['bookingDate']; ?></td>
                    </tr>
                    <tr>
                        <td class="left">Time:</td>
                        <td class="right"><?php echo $rows['bookingTime']; ?></td>
                    </tr>
                    <tr>
                        <td class="left">Address:</td>
                        <td class="right"><?php echo $rows['memberAddress']; ?></td>
                    </tr>
                    <tr>
                        <td class="left">Note to Stylist:</td>
                        <td class="right"><?php echo $rows['notesToEmployee']; ?></td>
                    </tr>
                    <tr>
                        <td colspan="5"><button id="acceptbtn" onclick="acceptopen()">Accept</button></td>
                        <td><button id="declinebtn" onclick="declineopen()">Decline</button></td>
                    </tr>
                </table>
<br>
                <!-- Info Table END-->
                <div id="noteToCustomer" class="modal">
                    <form class="notesToCustomercontent" method="POST" action="StylistNotificationPage.php">
                        <span class="close" onclick="acceptclose()">&times;</span>
                        <b>
                            <h1>Notes To Customer</h1>

                            <input type="hidden" name="bookingid" value="<?php echo $rows['bookingID'] ?>"></input>
                            <textarea name="notetocustomer" placeholder="Optional" class="notetocustomer" style="resize:none;"></textarea><br /><br />
                            <button class="acceptokaybutton" name="acceptok" type="submit">OK</button>
                    </form>
                    <?php

                    if (isset($_POST['acceptok'])) {
                        $Anotes = $_POST['notetocustomer'];
                        $bid = $_POST['bookingid'];

                        $accept = "UPDATE booking_datetime SET bookingStatus = 'accepted', notesToMember = '$Anotes' WHERE bookingID = '$bid' ";

                        mysqli_query($conn, $accept);
                        if (mysqli_affected_rows($conn) <= 0) {
                            die("<script>alert('Cannot accept!');</script>");
                            echo "<script>window.location.href='StylistNotificationPage.php';</script>";
                        }

                        echo "<script>alert('Booked!');</script>";
                        echo "<script>window.location.href='Stylistupcomingbooking.php';</script>";
                    }
                    ?>
                </div>

                <div id="ReasonToDecline" class="modal2">
                    <form class="reasonToDeclinecontent" method="POST" action="StylistNotificationPage.php">
                        <input type="hidden" value="<?php echo $rows['bookingID'] ?>" name="bookingID"></input>
                        <span class="close2" onclick="declineclose()">&times;</span>
                        <b>
                            <h1>Reason To Decline</h1>
                        </b>
                        <textarea name="reasontodecline" class="reasontodecline" style="resize:none;" required></textarea><br /><br />
                        <button class="declineokaybutton" name="declineok" type="submit">OK</button>
                    </form>
                    <?php
                    if (isset($_POST['declineok'])) {

                        $reason = $_POST['reasontodecline'];
                        $id = $_POST['bookingID'];

                        $decline = "UPDATE booking_datetime SET bookingStatus = 'declined', notesToMember = '$reason' WHERE bookingID = '$id' ";

                        mysqli_query($conn, $decline);
                        if (mysqli_affected_rows($conn) <= 0) {
                            echo "<script>alert('Cannot Decline!');</script>";
                            echo "<script>window.location.href='StylistNotificationPage.php';</script>";
                        } else {

                            echo "<script>alert('Declined!');</script>";
                            echo "<script>window.location.href='StylistNotificationPage.php';</script>";
                        }
                    }
                    ?>

                </div>
            <?php } ?>
        <?php } ?>
        <script>
            function acceptopen() {
                document.querySelector('.modal').style.display = "block";
            }

            function acceptclose() {
                document.querySelector('.modal').style.display = "none";

            }

            function declineopen() {
                document.querySelector('.modal2').style.display = "block";
            }

            function declineclose() {
                document.querySelector('.modal2').style.display = "none";

            }
        </script>
            </center>
</body>

</html>

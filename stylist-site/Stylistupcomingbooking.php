<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Upcoming Booking</title>
    <link rel="stylesheet" href="upcomingbooking.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
</head>

<body>
    <?php $conn = mysqli_connect('localhost', 'root', '', 'sdp_assignment'); ?>
    <?php include('StylistNavbar.php'); ?>
    <center>
        <h1 style="color:white;">Upcoming Bookings</h1>
    </center>

    <?php

    $upcoming = "SELECT member_list.memberFN,member_list.memberLN,booking_datetime.bookingID,booking_datetime.bookingDate,booking_datetime.bookingTime,booking_datetime.notesToEmployee,booking_datetime.memberID,booking_datetime.servID,member_address.memberAddress,service_list.servTitle FROM booking_datetime JOIN member_address ON booking_datetime.memberID = member_address.memberID JOIN service_list ON booking_datetime.servID =service_list.servID JOIN member_list ON booking_datetime.memberID = member_list.memberID WHERE bookingStatus ='accepted' AND member_address.defaultAddress ='default' AND notesToMember is not NULL AND booking_datetime.employee_serviceID = (Select emp_servID from employee_service Where empID = $empID and servID = booking_datetime.servID)";
    $uresult = mysqli_query($conn, $upcoming);


    if (mysqli_num_rows($uresult) <= 0) {
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

        while ($rows = mysqli_fetch_array($uresult)) {
            $column = 0;
            $row = 1
        ?>



            <center>
                <table class="bookings">
                    <tr>
                        <td style="border-bottom: 1px solid white;padding:6px 10px 6px 10px;" colspan="100">Service booking made by <?php echo ($rows['memberFN'] . ' ' . $rows['memberLN']); ?></td>
                    </tr>
                    <tr>
                        <td class="left">Service Title:</td>
                        <td class="right"><?php echo $rows['servTitle']; ?></td>
                    </tr>
                    <tr>
                        <td class="left">Date:</td>
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
                        <td class="right"> <?php echo $rows['notesToEmployee']; ?></td>
                    </tr>
                </table>
                <br>
                <br>
            <?php } ?>
        <?php } ?>
            </center>
</body>

</html>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="upcoming-activity.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
    <title>Upcomings</title>
</head>

<body>
    <?php include('navbar-footer/navbar.php'); ?>
    <?php
    if (isset($_POST['upc-rental'])) {
    ?>
    <?php
        include('upcoming-rental.php');
    } else {
    ?> <div style="height: 60px">
        </div>
        <form action="" method="post">
            <button class="upc-rental" id="upc-rental" type="submit" name="upc-rental">
                < &nbsp;&nbsp; Upcoming Rental </button> </form> <h1 style="text-align: center">Upcoming Appointments</h1>
                    <div style="height: 60px"></div>
                    <?php
                    $select_stylist = "SELECT * FROM member_address ma INNER JOIN member_list ml ON ma.memberID = ml.memberID INNER JOIN booking_datetime bd ON ml.memberID = bd.memberID INNER JOIN employee_service es ON bd.employee_serviceID = es.emp_servID INNER JOIN employee_list el ON es.empID = el.empID INNER JOIN service_list sl ON es.servID = sl.servID WHERE bd.bookingStatus != 'declined' AND bd.memberID = '" . $_SESSION['id'] . "' AND ma.defaultAddress = 'default' AND bd.bookingDate >= CURDATE()";
                    $result_select = mysqli_query($conn, $select_stylist);
                    ?>
                    <?php while ($row_select = mysqli_fetch_array($result_select)) { ?>
                        <table class="appointment-table">
                            <tr>
                                <td rowspan="999" class="image-td">
                                    <img src="<?php echo $row_select['empPicture']; ?>" alt="" width="100%">
                                </td>
                            </tr>
                            <tr>
                                <td style="font-weight: 700;" class="appointment-content">
                                    <?php echo $row_select['servTitle']; ?>
                                </td>
                                <button disabled type="button" class="appointment-status" <?php if ($row_select['bookingStatus'] == 'accepted') {
                                                                                                echo "style='color: lime; border: 2px solid lime'";
                                                                                            } ?>>
                                    <?php echo $row_select['bookingStatus']; ?>
                                </button>
                            </tr>
                            <tr>
                                <td>
                                    <hr size="1">
                                </td>
                            </tr>
                            <tr>
                                <td class="appointment-content">
                                    Stylist: <?php echo ($row_select['empLN']." ".$row_select['empFN']); ?>
                                </td>
                            </tr>
                            <tr>
                                <td class="appointment-content">
                                    Date: <?php echo $row_select['bookingDate']; ?>
                                </td>
                            </tr>
                            <tr>
                                <td class="appointment-content">
                                    Time: <?php echo $row_select['bookingTime']; ?> (24 hours format)
                                </td>
                            </tr>
                            <tr>
                                <td class="appointment-content">
                                    Address: <?php echo $row_select['memberAddress']; ?>
                                </td>
                            </tr>
                            <?php if ($row_select['notesToEmployee'] != NULL) { ?>
                                <tr>
                                    <td class="appointment-content">
                                        Notes to stylist: <?php echo $row_select['notesToEmployee']; ?>
                                    </td>
                                </tr>
                            <?php } else if ($row_select['notesToMember'] != NULL) { ?>
                                <tr>
                                    <td class="appointment-content">
                                        Notes from stylist: <?php echo $row_select['notesToMember']; ?>
                                    </td>
                                </tr>
                            <?php } ?>
                            <tr>
                                <td class="appointment-content">
                                    RM <?php echo $row_select['servPrice']; ?>
                                </td>
                            </tr>
                        </table>
                        <div style="height: 30px"></div>
                    <?php } ?>
                <?php } ?>

                <div style="height: 180px"></div>

                <?php include('navbar-footer/footer.php'); ?>
</body>

</html>

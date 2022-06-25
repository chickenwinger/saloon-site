<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Service Page</title>
    <link href="https://fonts.googleapis.com/css?family=Titillium+Web:600&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="service/service-page.css">
</head>

<body>
    <?php include("navbar-footer/navbar.php") ?>

    <?php

    $conn = mysqli_connect('localhost', 'root', '', 'sdp_assignment');

    error_reporting(0); //not showing 'false error' to user

    $sql = "SELECT * FROM service_list WHERE servID = " . $_GET['servID'] . "";
    $result = mysqli_query($conn, $sql);

    if (!isset($_GET['servID'])) {
        echo "<script>alert('WARNING! Your attempt to change the URL will lead to error in displaying the data!');</script>";
        echo "<script>window.history.go(-1);</script>";
    }

    $output = [];
    for ($day = 1; $day < 8; $day++) {
        $output[] = date('20y/m/d', strtotime(sprintf('+%d days', $day), strtotime('tomorrow')));
    }

    $rows = mysqli_fetch_array($result);

    ?>
    <div style="position: absolute; margin-left: 20px; margin-top: 20px;">
        <p>
            <a href="service-all.php" style="color: black;">
                <i class="fa fa-arrow-circle-left" style="font-size:48px; cursor:pointer"></i>
            </a>
        </p>
    </div>

    <form action="service-formlink.php?servID=<?php echo $rows['servID']; ?>" method="POST">
        <table class="table1">
            <tr>
                <td rowspan="7" class="service-img">
                    <input type="hidden" value="<?php echo $rows['servID']; ?>" name="input_servID">
                    <img src="<?php echo $rows['servPicture'] ?>" height="100%" style="border: solid 2px black;">
                </td>
            </tr>

            <tr>
                <td class="content1"><b><?php echo $rows['servTitle']; ?></b></td>
            </tr>
            <tr>
                <td class="content2"><i><?php echo $rows['servDescription']; ?></i></td>
            </tr>
            <tr>
                <td class="content3">RM<?php echo $rows['servPrice']; ?></td>
            </tr>
            <tr>
                <td style="text-align: center">
                    <select class="select1" name="selectDate" required>
                        <option selected disabled value="">-Select Date-</option>
                        <?php foreach ($output as $day) : ?>
                            <option value="<?php echo $day; ?>"><?php echo $day; ?></option>
                        <?php endforeach; ?>
                    </select>
                </td>
            </tr>
            <tr>
                <td style="text-align: center; padding-bottom: 30px">
                    <select class="select1" name="selectTime" required>
                        <option selected disabled value="">-Select Time-</option>
                        <option value="1000">10.00 A.M.</option>
                        <option value="1300">1.00 P.M.</option>
                        <option value="1500">3.00 P.M.</option>
                    </select>
                </td>
            </tr>
            <tr>
                <td style="text-align: center; padding-bottom: 20px">
                    <b><button class="button" name="btnStylist" type="submit">RESERVE BOOKING</button></b><br>
                    <p style="color: red; font-size: 14px;">*Proceed to reserve a booking with your personal selected stylist.</p>
                </td>
            </tr>
        </table>
    </form>

    <?php include("navbar-footer/footer.php") ?>

</body>

</html>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Select a Stylist</title>
    <link href="https://fonts.googleapis.com/css?family=Titillium+Web:600&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
    <link rel="stylesheet" href="service/service-stylist.css">
</head>

<body style="background: url(homepage/home-bg.jpg) center fixed; background-size: cover;">
    <?php include('navbar-footer/navbar.php'); ?>

    <?php
    $conn = mysqli_connect('localhost', 'root', '', 'sdp_assignment');


    if (!isset($_GET['servID']) || !isset($_GET['date']) || !isset($_GET['time'])) {
        echo "<script>alert('WARNING! Your attempt to change the URL will lead to error in displaying the data!');</script>";
        echo "<script>window.history.go(-1);</script>";
    }

    $sql = "SELECT * FROM service_list WHERE servID = " . $_GET['servID'] . "";
    $rows = mysqli_fetch_array(mysqli_query($conn, $sql));
    ?>

    <div style="position: absolute; margin-left: 20px; margin-top: 20px;">
        <p>
            <a type="button" value="Back" onclick="goBack()">
                <i class="fa fa-arrow-circle-left" style="font-size:48px; cursor:pointer"></i>
            </a>
        </p>
    </div>
    <script>
        function goBack() {
            window.history.back();
        }
    </script>

    <table class="service-table">
        <tr>
            <td rowspan="999" class="img-td">
                <img src="<?php echo $rows['servPicture']; ?>" width="100%" height="100%" alt="">
            </td>
        </tr>
        <tr>
            <td style="height: 20px"></td>
        </tr>
        <tr>
            <td>
                <h3><?php echo $rows['servTitle']; ?></h3>
            </td>
        </tr>
        <tr>
            <td>Booking Date: <?php echo $_GET['date']; ?></td>
        </tr>
        <tr>
            <td>Booking Time: <?php echo $_GET['time']; ?></td>
        </tr>
        <tr>
            <td>RM <?php echo $rows['servPrice']; ?></td>
        </tr>
        <tr>
            <td style="height: 20px"></td>
        </tr>
    </table>
    <h2 style="text-align: center; font-family: 'Titillium Web'; color: black;">Select Your Stylist</h2>

    <?php
    $display_employee = "SELECT * FROM employee_list el INNER JOIN employee_service es " .
        "ON el.empID = es.empID INNER JOIN service_list sl " .
        "ON es.servID = sl.servID WHERE sl.servID = '" . $_GET['servID'] . "' AND (el.empOffDay - 1 != WEEKDAY(CURDATE()))";
    $result_employee = mysqli_query($conn, $display_employee);

    ?>
    <div style="height: 30px"></div>
    <form action="checkout.php" method="POST" name="stylist-form">
        <input type="hidden" name="total" value="<?php echo $rows['servPrice']; ?>">
        <input type="hidden" name="dates" value="<?php echo $_GET['date']; ?>">
        <input type="hidden" name="timess" value="<?php echo $_GET['time']; ?>">
        <input type="hidden" name="servID" value="<?php echo $_GET['servID']; ?>">
        <div class="slider-container">
            <div class="slider-items fade-in">
                <table class="stylist-table">
                    <tr>
                        <?php
                        $counter = 0;
                        $number = 3;
                        while ($row_employee = mysqli_fetch_array($result_employee)) {
                            $check_booking = "SELECT * FROM booking_datetime WHERE bookingDate = '" . $_GET['date'] . "' AND bookingTime = '" . $_GET['time'] . "' AND bookingStatus != 'declined' AND employee_serviceID = (SELECT emp_servID FROM employee_service WHERE servID = '" . $_GET['servID'] . "' AND empID = '" . $row_employee['empID'] . "')";
                            mysqli_query($conn, $check_booking);
                            if (mysqli_affected_rows($conn) <= 0) {
                                if ($counter % $number == 0 && $counter != 0) {
                                    echo ("</tr></table></div><div class='slider-items fade-in'><table class='stylist-table'><tr>");
                                }
                                $counter++;
                        ?>
                                <td class="emp-img">
                                    <input class="img-checkbox" id="id-img-checkbox<?php echo $row_employee['empID']; ?>" type="radio" value="<?php echo $row_employee['empID']; ?>" name="input_empID" required>
                                    <button id="btnInfo<?php echo $row_employee['empID']; ?>" class="btnInfo" type="button" onclick="detailspopup<?php echo $row_employee['empID']; ?>();"><i class="fa fa-info-circle" style="font-size:27px"></i></button>
                                    <img src="<?php echo $row_employee['empPicture']; ?>" width="100%" height="100%" alt="" id="emp-img<?php echo $row_employee['empID']; ?>">
                                    <?php
                                    $conn = mysqli_connect('localhost', 'root', '', 'sdp_assignment');
                                    $stylist = "SELECT * FROM employee_list WHERE empID = '" . $row_employee['empID'] . "'";
                                    $stylistresult = mysqli_query($conn, $stylist);
                                    $rows = mysqli_fetch_array($stylistresult); {
                                    ?>
                                        <div class="details-popup-bg" id="details-popup-bg<?php echo $row_employee['empID']; ?>">
                                            <table class="details-popup">
                                                <tr>
                                                    <td><span class="px" onclick="detailspopupClose<?php echo $row_employee['empID']; ?>()">&times;</span></td>
                                                </tr>
                                                <tr>
                                                    <td style="text-align: center;font-size:35px;font-weight:600;"><?php echo ($rows['empLN'] . ' ' . $rows['empFN']); ?></td>
                                                </tr>

                                                <tr>
                                                    <td class="qwe">
                                                        <?php echo $rows['empGender']; ?><br>
                                                        Expertise : <br>
                                                        <?php echo $rows['empSkill']; ?><br>
                                                        <?php echo $rows['empYearOfExp']; ?> Years Of Experience
                                                    </td>
                                                </tr>
                                            </table>
                                        </div>
                                        <script>
                                            function detailspopup<?php echo $row_employee['empID']; ?>() {
                                                document.querySelector('#details-popup-bg<?php echo $row_employee['empID']; ?>').style.display = "block";
                                            }

                                            function detailspopupClose<?php echo $row_employee['empID']; ?>() {
                                                document.querySelector('#details-popup-bg<?php echo $row_employee['empID']; ?>').style.display = "none";
                                            }
                                        </script>
                                    <?php }  ?>
                                </td>
                                <script>
                                    $(function() {
                                        $('#emp-img<?php echo $row_employee['empID']; ?>').mouseover(function() {
                                            $('#id-img-checkbox<?php echo $row_employee['empID']; ?>, #btnInfo<?php echo $row_employee['empID']; ?>').css({
                                                "margin-top": "-10px",
                                            });
                                        });
                                        $('#emp-img<?php echo $row_employee['empID']; ?>').mouseout(function() {
                                            $('#id-img-checkbox<?php echo $row_employee['empID']; ?>, #btnInfo<?php echo $row_employee['empID']; ?>').css({
                                                "margin-top": "10px",
                                            });
                                        });
                                        $('#id-img-checkbox<?php echo $row_employee['empID']; ?>, #emp-img<?php echo $row_employee['empID']; ?>').click(function() {
                                            $('#id-img-checkbox<?php echo $row_employee['empID']; ?>').each(function() {
                                                $('.img-checkbox').prop('checked', false);
                                            });
                                            $('.img-checkbox').removeAttr('required');
                                            $('#id-img-checkbox<?php echo $row_employee['empID']; ?>').prop('checked', true);
                                        });
                                    });
                                </script>
                        <?php }
                        } ?>
                    </tr>
                </table>
            </div>

            <a class="prev" onclick="plusSlides(-1)" style="width: 15%;">&#10094;</a>
            <a class="next" onclick="plusSlides(1)" style="width: 15%;">&#10095;</a>
        </div>
        <div style="height: 30px"></div>
        <table style="margin: 0 auto; color: white; font-family: 'Titillium Web'">
            <tr>
                <td style="padding-right: 50px; color: black">
                    <h3>Notes To Your Stylist: </h3>
                </td>
                <td><textarea name="notes_to_stylist" id="notes_to_stylist" cols="95" rows="7" placeholder="Type your message . ."></textarea></td>
            </tr>
        </table>
        <div style="height: 30px"></div>
        <button type="submit" name="btnService" class="btnBook">Confirm Booking</button>
    </form>
    <br />

    <script>
        var slideIndex = 1;
        showSlides(slideIndex);

        function plusSlides(n) {
            showSlides(slideIndex += n);
        }

        function currentSlide(n) {
            showSlides(slideIndex = n);
        }

        function showSlides(n) {
            var i;
            var slides = document.getElementsByClassName("slider-items");
            var dots = document.getElementsByClassName("dot");
            if (n > slides.length) {
                slideIndex = 1
            }
            if (n < 1) {
                slideIndex = slides.length
            }
            for (i = 0; i < slides.length; i++) {
                slides[i].style.display = "none";
            }
            for (i = 0; i < dots.length; i++) {
                dots[i].className = dots[i].className.replace(" active", "");
            }
            slides[slideIndex - 1].style.display = "block";
            dots[slideIndex - 1].className += " active";
        }
    </script>
    <div style="height: 70px"></div>
    <?php include('navbar-footer/footer.php'); ?>
</body>

</html>

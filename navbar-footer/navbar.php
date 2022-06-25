<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>navbar</title>
    <link rel="stylesheet" href="navbar-footer/navbar-footer.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
</head>

<body>
    <?php $conn = mysqli_connect('localhost', 'root', '', 'sdp_assignment'); ?>
    <div class="navbar" style="box-shadow: 0 0 10px black">
        <table style="margin: 0 auto; border-spacing: 3vw 0;">
            <tr>
                <td style="height: 1vw"></td>
            </tr>
            <tr>
                <td colspan="7" class="header">
                    &nbsp;&nbsp;
                    <!-- HOME BUTTON -->
                    <a href="homepage.php" style="color: cyan;">O N 9 &nbsp; F A S H I O N &nbsp; S T U D I O ®</a>
                    &nbsp;&nbsp;
                </td>
            </tr>
            <tr>
                <td style="height: 1vw"></td>
            </tr>
            <tr>
                <td><a href="about-us.php" class="navItem">About Us</a></td>
                <td><a href="product-all.php" class="navItem">Products</a></td>
                <td><a href="service-all.php" class="navItem">Services</a></td>
                <td><a href="outfit-all.php" class="navItem">Outfit Rentals</a></td>
                <?php
                session_start();

                $conn = mysqli_connect('localhost', 'root', '', 'sdp_assignment');

                if (isset($_SESSION['login'])) {
                ?>
                    <td onmouseover="openProfItems();" onmouseout="closeProfItems();">
                        <table>
                            <tr>
                                <td>
                                    <img src="navbar-footer/userIcon.png" alt="" width="30vw">
                                </td>
                            </tr>
                            <tr>
                                <td class="prof-items">
                                    <table>
                                        <tr class="prof-items-row">
                                            <td class="user-name">
                                                <h3>
                                                    <?php
                                                    $memberName = "SELECT * FROM member_list WHERE memberID = '" . $_SESSION['id'] . "'";
                                                    $result_member_name = mysqli_query($conn, $memberName);
                                                    $row_member_name = mysqli_fetch_array($result_member_name);
                                                    echo ("{$row_member_name['memberLN']}" . " " . "{$row_member_name['memberFN']}");
                                                    ?>
                                                </h3>
                                            </td>
                                        </tr>
                                        <tr class="prof-items-row">
                                            <td><a href="memberprofile.php">Profile</a></td>
                                        </tr>
                                        <tr class="prof-items-row">
                                            <td><a href="order-history.php">Order History</a></td>
                                        </tr>
                                        <tr class="prof-items-row">
                                            <td><a href="navbar-footer/logout.php?id=<?php echo $_SESSION['id']; ?>">Sign Out</a></td>
                                        </tr>
                                    </table>
                                </td>
                            </tr>
                        </table>
                    </td>

                <?php } else { ?>
                    <td>
                        <a href="#" onclick="loginPopup(); return false;" class="navItem">Sign In/Register</a>
                    </td>
                <?php } ?>
                <?php if (isset($_SESSION['id'])) { ?>
                <td>
                    <a href="Notificationpage.php" class="navItemIcon">
                        <img src="navbar-footer/messageIcon.png" alt="messageIcon" width="30vw">
                        <?php 
                        $count_msg = "SELECT COUNT(bookingID) AS count_msg FROM employee_list el INNER JOIN employee_service es ON el.empID = es.empID INNER JOIN booking_datetime bd ON es.emp_servID = bd.employee_serviceID INNER JOIN service_list sl ON bd.servID = sl.servID WHERE bd.bookingStatus != 'pending' AND bd.memberID = '".$_SESSION['id']."' AND bd.bookingDate >= CURDATE()";
                        $result_count = mysqli_query($conn, $count_msg);
                        $row_count_msg = mysqli_fetch_array($result_count); 
                        if ($row_count_msg['count_msg'] != 0) {
                        ?>
                        <span class="navItemNotification" style="color: white">
                            <?php echo $row_count_msg['count_msg']; ?>
                        </span>
                        <?php } ?>
                    </a>
                </td>
                <?php } ?>
                <td>
                    <?php if (!isset($_SESSION['id'])) { ?>
                        <a href="#" class="navItemIcon" onclick=" alert('Please sign in your account first!'); loginPopup(); return false;">
                            <img src="navbar-footer/cartIcon.png" alt="cartIcon" width="30vw">
                        </a>
                    <?php } else { ?>
                        <a href="cart.php" class="navItemIcon">
                            <img src="navbar-footer/cartIcon.png" alt="cartIcon" width="30vw">
                            <?php
                            $sql_cart_number = "SELECT COUNT('product_orderID') AS cart_count FROM product_order WHERE orderID = (SELECT orderID FROM order_list WHERE memberID = '" . $_SESSION['id'] . "' AND orderPrice IS NULL) AND orderPayment = 'pending'";
                            $result_cart_number = mysqli_query($conn, $sql_cart_number);
                            $row_cart_number = mysqli_fetch_array($result_cart_number);
                            if (isset($_SESSION['id']) && $row_cart_number['cart_count'] != 0) {
                            ?>
                                <span class="navItemNotification" style="color: white;">

                                    <?php echo $row_cart_number['cart_count']; ?>

                                </span>
                            <?php } ?>
                        </a>
                    <?php } ?>
                </td>
            </tr>
            <tr>
                <td style="height: 0.3vw"></td>
            </tr>
        </table>
    </div>

    <div class="mobile-navbar-bg"></div>
    <table class="mobile-navbar">
        <tr>
            <td class="mobile-header">ON9 FASHION STUDIO</td>
            <td class="hamburger" onclick="openNavFunction()"><i class="fa fa-bars"></i></td>
            <td class="nav-close" onclick="closeNavFunction()"><i class="fa fa-close"></i></td>
        </tr>
        <tr>
            <td colspan="3" class="mobile-navItem">
                <a href="homepage.php">HOME</a>
            </td>
        </tr>
        <tr>
            <td colspan="3" class="mobile-navItem">
                <a href="#">About Us</a>
            </td>
        </tr>
        <tr>
            <td colspan="3" class="mobile-navItem">
                <a href="#">Products</a>
            </td>
        </tr>
        <tr>
            <td colspan="3" class="mobile-navItem">
                <a href="#">Services</a>
            </td>
        </tr>
        <tr>
            <td colspan="3" class="mobile-navItem">
                <a href="#">Outfit Rentals</a>
            </td>
        </tr>
        <tr>
            <td colspan="3" class="mobile-navItem">
                <a href="#">Sign In/Register</a>
            </td>
        </tr>
        <tr>
            <td colspan="3" class="mobile-navItem">
                <a href="#">View Message</a>
            </td>
        </tr>
        <tr>
            <td colspan="3" class="mobile-navItem">
                <a href="#">Your Cart</a>
            </td>
        </tr>
    </table>
    <script>
        function openNavFunction() {
            var x = document.querySelectorAll('.mobile-navItem');
            for (var i = 0; i < x.length; i++) {
                x[i].style.display = "table-cell";
            }

            document.querySelector(".hamburger").style.display = "none";
            document.querySelector(".nav-close").style.display = "block";
        }

        function closeNavFunction() {
            var x = document.querySelectorAll('.mobile-navItem');
            for (var i = 0; i < x.length; i++) {
                x[i].style.display = "none";
            }

            document.querySelector(".hamburger").style.display = "block";
            document.querySelector(".nav-close").style.display = "none";
        }

        function openProfItems() {
            document.querySelector('.prof-items').style.display = "table-cell";
        }

        function closeProfItems() {
            document.querySelector('.prof-items').style.display = "none";
        }

        if (window.history.replaceState) {
            window.history.replaceState(null, null, window.location.href);
        }
    </script>
    <div class="second-mobile-navbar"></div>
    <?php include('login-form.php'); ?>

    <?php
    if (isset($_SESSION['empID']) && $_SESSION['role'] === 'stylist') {
        echo "<script>window.location.href='stylist-site/stylisthomepage.php'</script>";
    } else if (isset($_SESSION['empID']) && $_SESSION['role'] === 'admin') {
        echo "<script>window.location.href='admin-site/admin-home.php'</script>";
    }
    ?>

</body>

</html>

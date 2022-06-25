<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>footer</title>
    <link rel="stylesheet" href="navbar-footer.css">
    <link href="https://fonts.googleapis.com/css?family=Titillium+Web:600&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
</head>

<body>
    <footer>
        <div style="height:2vw"></div>
        <table class="footer-table">
            <tr>
                <td>
                    <h3 style="color: cyan">Beauty Quotes</h3>
                </td>
                <td>
                    <h3 style="color: cyan; padding-left: 6vw">Quick Links</h3>
                </td>
                <td>
                    <h3 style="color: cyan; padding-left: 5vw">What We Offer</h3>
                </td>
            </tr>
            <tr>
                <td style="height:5px"></td>
            </tr>
            <tr>
                <td rowspan="100">
                    “Fashion reflects who you are, so dress like you're already famous.” - elanstreet <br><br>
                    “It doesn't matter if your life is perfect as long as your hair color is.” - Stacy Snapp Killian aka StacyK
                </td>
                <td>
                    <a class="links" style="padding-left: 6vw" href="about-us.php">About Us</a>
                </td>
                <td>
                    <a style="padding-left: 5vw" class="links" href="service-all.php">Beauty Services</a>
                </td>
            </tr>
            <tr>
                <td>
                    <?php if (!isset($_SESSION['id'])) { ?>
                        <a style="padding-left: 6vw" class="links" href="navbar-footer/register-form.php">Register As Member</a>
                    <?php } else { ?>
                        <a style="padding-left: 6vw" class="links" href="cart.php">View Your Cart</a>
                    <?php } ?>
                </td>
                <td>
                    <a style="padding-left: 5vw" class="links" href="product-all.php">Cosmetic Products</a>
                </td>
            </tr>
            <tr>
                <td>
                    <?php if (isset($_SESSION['id'])) { ?>
                        <a style="padding-left: 6vw" class="links" href="memberprofile.php">View Profile</a>
                    <?php } ?>
                </td>
                <td>
                    <a style="padding-left: 5vw" class="links" href="outfit-all.php">Outfit Rentals</a>
                </td>
            </tr>
        </table>
        <table class="social-media-icon">
            <tr>
                <td>
                    <a href="#" class="fa fa-facebook" style="font-size: 25px; color: black;"></a>
                </td>
                <td>
                    <a href="#" class="fa fa-twitter" style="font-size: 25px; color: black;"></a>
                </td>
                <td>
                    <a href="#" class="fa fa-instagram" style="font-size: 25px; color: black;"></a>
                </td>
            </tr>
        </table>
        <hr size="1">
        <div style="text-align: center">
            <h3>© Copyright 2020 ON9 Studio Co.,Ltd. All Rights Reserved</h3>
        </div>
    </footer>
</body>

</html>

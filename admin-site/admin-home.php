<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ADMIN HOME</title>
    <link rel="stylesheet" href="admin-home.css">
</head>

<body>
    <?php include('admin-navbar.php'); ?>
    <h1 style="text-align: center">Welcome Back <?php echo ("{$_SESSION['empLN']}" . " " . "{$_SESSION['empFN']}"); ?>!</h1>
    <div style="height: 70px"></div>
    <table class="admin-home-table">
        <tr>
            <td colspan="2">
                <a href="productdata.php">
                    <table class="table-content">
                        <tr>
                            <td>Manage Product</td>
                        </tr>
                    </table>
                </a>
            </td>
            <td colspan="2">
                <a href="servicedata.php">
                    <table class="table-content">
                        <tr>
                            <td>Manage Service</td>
                        </tr>
                    </table>
                </a>
            </td>
            <td colspan="2">
                <a href="outfitdata.php">
                    <table class="table-content">
                        <tr>
                            <td>Manage Outfit</td>
                        </tr>
                    </table>
                </a>
            </td>
            <td colspan="2">
                <a href="stylistdata.php">
                    <table class="table-content">
                        <tr>
                            <td>Manage Stylist</td>
                        </tr>
                    </table>
                </a>
            </td>
        </tr>
    </table>
    <table class="admin-home-table">
        <tr>
            <td colspan="2">
                <a href="total-revenue.php">
                    <table class="table-content">
                        <tr>
                            <td>Total Revenue Reports</td>
                        </tr>
                    </table>
                </a>
            </td>
            <td colspan="2">
                <a href="product-report.php">
                    <table class="table-content">
                        <tr>
                            <td>Products Revenue Report</td>
                        </tr>
                    </table>
                </a>
            </td>
            <td colspan="2">
                <a href="outfit-report.php">
                    <table class="table-content">
                        <tr>
                            <td>Outfit Rentals Report</td>
                        </tr>
                    </table>
                </a>
            </td>
            <td colspan="2">
                <a href="service-report.php">
                    <table class="table-content">
                        <tr>
                            <td>Service Bookings Report</td>
                        </tr>
                    </table>
                </a>
            </td>
        </tr>
    </table>
</body>

</html>

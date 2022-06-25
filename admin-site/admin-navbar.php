<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="admin-navbar.css">
</head>

<body>
    <?php session_start(); ?>
    <table class="admin-nav">
        <tr>
            <td style="height: 20px"></td>
        </tr>
        <tr>
            <td style="padding-left: 40px">
                <a class="btn-home" href="admin-home.php">
                    <div><i class="fa fa-home"></i></div>
                </a>
            </td>
            <td style="width: 100%"></td>
            <td>
                <?php
                $conn = mysqli_connect('localhost', 'root', '', 'sdp_assignment');
                $employee = "SELECT * FROM employee_list WHERE empID = '" . $_SESSION['empID'] . "'";
                $result_emp = mysqli_query($conn, $employee);
                $row_emp = mysqli_fetch_array($result_emp);
                ?>
                <a aria-label='Log Out' class='h-button centered' data-text='<?php echo ($row_emp['empLN'] . ' ' . $row_emp['empFN']); ?>' href='../navbar-footer/logout.php'>
                    <span>L</span>
                    <span>O</span>
                    <span>G</span>
                    <span>O</span>
                    <span>U</span>
                    <span>T</span>
                </a>
            </td>
        </tr>
    </table>
    <div style="height: 2vw"></div>

    <?php
    if (isset($_SESSION['id']) || !isset($_SESSION['empID'])) {
        echo "<script>window.location.href='../homepage.php'</script>";
    } else if (isset($_SESSION['empID']) && $_SESSION['role'] === 'stylist') {
        echo "<script>window.location.href='../stylist-site/stylisthomepage.php'</script>";
    }
    ?>
</body>

</html>

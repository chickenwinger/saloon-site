<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Service Pop-up</title>
    <link rel="stylesheet" href="navbar-footer.css">
    <link rel="stylesheet" href="addproductpu.css">
</head>

<body>

    <?php include('navbar-footer/navbar.php'); ?>

    <?php
    $conn = mysqli_connect('localhost', 'root', '', 'sdp_assignment');
    $editservicelist = "select * from service_list where servID = '3'";
    $editserviceresult = mysqli_query($conn, $editservicelist);
    if ($row = mysqli_fetch_array($editserviceresult)) {
    ?>

        <form action="" method="post">
            <div class="addproduct-bg">
                <table class="addproduct-popup">
                    <tr> 
                        <td colspan="2"> <input type="hidden" name="inputserviceid" value="<?php echo $row['servID']; ?>">
            <button class="ptbtn" onclick="closeForm()">X</button>
            <div class="prodtitle">EDIT SERVICE</td>
                </tr>
                <tr>
                    <td class="ppop"><label for="servicepicture"><b>Service Picture:</b></label></td>
                    <td style="padding-left:1px;"><input style="width:80%; padding: 5px;" type="file" placeholder="Browse" name="servicepicture" required></td>
                </tr>
                <tr>
                    <td class="ppop"><label for="servicename"><b>Service Name:</b></label></td>
                    <td style="padding-left:1px;"><input style="width:80%; padding: 10px; border: solid 2px cyan;" type="text" value="<?php echo $row['servTitle']; ?>" placeholder="Enter Service Name" name="servicename" required></td>
                </tr>
                <tr>
                    <td class="ppop"><label for="servicedescription"><b>Service Description:</b></label></td>
                    <td style="padding-left:1px;"><input style="width:80%; padding: 10px; border: solid 2px cyan;" type="text" value="<?php echo $row['servDescription']; ?>" placeholder="Enter Service Description" name="servicedescription" required></td>
                </tr>
                <tr>
                    <td class="ppop"><label for="serviceprice"><b>Price(RM):</b></label></td>
                    <td style="padding-left:1px;"><input style="width:80%; padding: 10px; border: solid 2px cyan;" type="text" value="<?php echo $row['servPrice']; ?>" placeholder="Enter Service Price" name="serviceprice" required></td>
                </tr>
                <tr>
                    <td class="ppop"><label for="servicecategory"><b>Service Category:</b></label></td>
                    <td>
                        <select class="prodcategory" name="servicecategory">
                            <option selected disabled>-Select a Category-</option>
                            <option value="test1">Test1</option>
                            <option value="test2">Test2</option>
                        </select>
                    </td>
                </tr>
                <tr>
                    <td><button type="submit" name="pubtn" class="pubtn">Update</button></td>
                    <td><button type="reset" class="pubtn1">Reset</button></td>
                </tr>
                </table>
            </div>
        </form>
    <?php

        $conn = mysqli_connect('localhost', 'root', '', 'sdp_assignment');
        $update_product = "UPDATE service_list SET servTitle = '" . $_POST['servicename'] . "', servCategory = '" . $_POST['servicecategory'] . "', servDescription = '" . $_POST['servicedescription'] . "', servPrice = '" . $_POST['serviceprice'] . "', servPicture = '" . $_POST['servicepicture'] . "' where servID = '" . $_POST['inputserviceid'] . "'";
        if (isset($_POST['pubtn'])) {
            mysqli_query($conn, $update_product);

            echo "<script>alert('Updated Successfuly');</script>";
        }
    }
    ?>

    <script>
        function loginPopup() {
            document.querySelector('.login-bg').style.display = 'block';
        }

        function loginClose() {
            document.querySelector('.login-bg').style.display = 'none';
        }

        function closeForm() {
            document.querySelector('.addproduct-bg').style.display = 'none';
        }
    </script>
</body>

</html>
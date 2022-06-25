<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Outfit Pop-up</title>
    <link rel="stylesheet" href="navbar-footer.css">
    <link rel="stylesheet" href="addproductpu.css">
</head>

<body>

    <?php include('navbar-footer/navbar.php'); ?>

    <?php
    $conn = mysqli_connect('localhost', 'root', '', 'sdp_assignment');
    $editoutfitlist = "select * from outfit_list where outfitID = '1'";
    $editoutfitresult = mysqli_query($conn, $editoutfitlist);
    if ($row = mysqli_fetch_array($editoutfitresult)) {
    ?>

        <form action="" method="post">
            <div class="addproduct-bg">
                <table class="addproduct-popup">
                    <tr>
                        <td colspan="2"> <input type="hidden" name="inputoutid" value="<?php echo $row['outfitID']; ?>">
                            <button class="ptbtn" onclick="closeForm()">X</button>
                            <div class="prodtitle">EDIT OUTFIT
                        </td>
                    </tr>
                    <tr>
                        <td class="ppop"><label for="outpicture"><b>Outfit Picture:</b></label></td>
                        <td style="padding-left:1px;"><input style="width:80%; padding: 5px;" type="file" placeholder="Browse" name="outpicture" required></td>
                    </tr>
                    <tr>
                        <td class="ppop"><label for="outtitle"><b>Outfit Title:</b></label></td>
                        <td style="padding-left:1px;"><input style="width:80%; padding: 10px; border: solid 2px cyan;" type="text" value="<?php echo $row['outfitTitle']; ?>" placeholder="Enter Outfit Title" name="outtitle" required></td>
                    </tr>
                    <tr>
                        <td class="ppop"><label for="outgender"><b>Outfit Gender:</b></label></td>
                        <td class="genderselect" style="padding-left:1px;">Male <input type="radio" value="male" name="outgender" required>Female <input type="radio" value="male" name="outgender" required>
                        </td>
                    </tr>
                    <tr>
                        <td class="ppop"><label for="outcategory"><b>Outfit Category:</b></label></td>
                        <td>
                            <select class="prodcategory" name="outcategory">
                                <option selected disabled>-Select a Category-</option>
                                <option value="test1">Test1</option>
                                <option value="test2">Test2</option>
                            </select>
                        </td>
                    </tr>
                    <tr>
                        <td class="ppop"><label for="outdescription"><b>Outfit Description:</b></label></td>
                        <td style="padding-left:1px;"><input style="width:80%; padding: 10px; border: solid 2px cyan;" value="<?php echo $row['outfitDescription']; ?>" placeholder="Enter Outfit Description" name="outdescription" required></td>
                    </tr>
                    <tr>
                        <td class="ppop"><label for="outstock"><b>Outfit Stock:</b></label></td>
                        <td style="padding-left:1px;"><input style="width:80%; padding: 10px; border: solid 2px cyan;" type="text" value="<?php echo $row['outfitStock']; ?>" placeholder="Enter Outfit Stock" name="outstock" required></td>
                    </tr>
                    <tr>
                        <td class="ppop"><label for="outprice"><b>Outfit Price:</b></label></td>
                        <td style="padding-left:1px;"><input style="width:80%; padding: 10px; border: solid 2px cyan;" type="text" value="<?php echo $row['outfitPrice']; ?>" placeholder="Enter Outfit Price" name="outprice" required></td>
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
        $update_product = "UPDATE outfit_list SET outfitTitle = '" . $_POST['outtitle'] . "', outfitGender = '" . $_POST['outgender'] . "', outfitCategory = '" . $_POST['outcategory'] . "', outfitDescription = '" . $_POST['outdescription'] . "', outfitStock = '" . $_POST['outstock'] . "', outfitPicture = '" . $_POST['outpicture'] . "' where outfitID = '" . $_POST['inputoutid'] . "'";

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
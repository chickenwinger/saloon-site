<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Product Pop-up</title>
    <link rel="stylesheet" href="addproductpu.css">
</head>

<body>
    <div class="addproduct-bg<?php echo $row_product['productID']; ?>">
        <?php
        $conn = mysqli_connect('localhost', 'root', '', 'sdp_assignment');
        $editprodlist = "select * from product_list where productID = '".$row_product['productID']."'";
        $editresult = mysqli_query($conn, $editprodlist);
        if ($row = mysqli_fetch_array($editresult)) {
        ?>
            <form action="" method="post">
                <table class="addproduct-popup">
                    <tr>
                        <td colspan="2"> <input type="hidden" name="inputprodid" value="<?php echo $row['productID']; ?>">
                            <button class="ptbtn" type="button" onclick="closeForm()">X</button>
                            <div class="prodtitle">EDIT PRODUCT
                        </td>
                    </tr>
                    <tr>
                        <td class="ppop"><label for="prodpicture"><b>Product Picture:</b></label></td>
                        <td style="padding-left:1px;"><input style="width:80%; padding: 5px;" type="file" placeholder="Browse" name="prodpicture" required></td>
                    </tr>
                    <tr>
                        <td class="ppop"><label for="prodtitle"><b>Product Title:</b></label></td>
                        <td style="padding-left:1px;"><input style="width:80%; padding: 10px; border: solid 2px cyan;" type="text" value="<?php echo $row['productTitle']; ?>" placeholder="Enter Product Title" name="prodtitle" required></td>
                    </tr>
                    <tr>
                        <td class="ppop"><label for="prodcontent"><b>Product Content:</b></label></td>
                        <td style="padding-left:1px;"><input style="width:80%; padding: 10px; border: solid 2px cyan;" type="text" value="<?php echo $row['productContent']; ?>" placeholder="Enter Product Content" name="prodcontent" required></td>
                    </tr>
                    <tr>
                        <td class="ppop"><label for="prodstock"><b>Product Stock:</b></label></td>
                        <td style="padding-left:1px;"><input style="width:80%; padding: 10px; border: solid 2px cyan;" type="text" value="<?php echo $row['productStock']; ?>" placeholder="Enter Product Stock" name="prodstock" required></td>
                    </tr>
                    <tr>
                        <td class="ppop"><label for="prodcategory"><b>Product Category:</b></label></td>
                        <td>
                            <select class="prodcategory" name="prodcategory">
                                <option selected disabled>-Select a Category-</option>
                                <option value="test1">Test1</option>
                                <option value="test2">Test2</option>
                            </select>
                        </td>
                    </tr>
                    <tr>
                        <td class="ppop"><label for="prodprice"><b>Product Price:</b></label></td>
                        <td style="padding-left:1px;"><input style="width:80%; padding: 10px; border: solid 2px cyan;" type="text" value="<?php echo $row['productPrice']; ?>" placeholder="Enter Product Price" name="prodprice" required></td>
                    </tr>
                    <tr>
                        <td><button type="submit" name="pubtn" class="pubtn">Update</button></td>
                        <td><button type="reset" class="pubtn1">Reset</button></td>
                    </tr>
                </table>
            </form>
        <?php } ?>
    </div>
    <?php
    if (isset($_POST['pubtn'])) {
        $conn = mysqli_connect('localhost', 'root', '', 'sdp_assignment');
        $update_product = "UPDATE product_list SET productTitle = '" . $_POST['prodtitle'] . "', productContent = '" . $_POST['prodcontent'] . "', productStock = '" . $_POST['prodstock'] . "', productCategory = '" . $_POST['prodcategory'] . "', productPrice = '" . $_POST['prodprice'] . "', productPicture = '" . $_POST['prodpicture'] . "' where productID = '" . $_POST['inputprodid'] . "'";

        mysqli_query($conn, $update_product);

        echo "<script>alert('Updated Successfuly');</script>";
    }
    ?>
    <script>
        function closeForm() {
            document.querySelector('.addproduct-bg<?php echo $row_product['productID']; ?>').style.display = 'none';
        }
        function openForm() {
            document.querySelector('.addproduct-bg<?php echo $row_product['productID']; ?>').style.display = 'block';
        }
    </script>
</body>

</html>

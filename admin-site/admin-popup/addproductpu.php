<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add Product Pop-up</title>
    <style>
        .popup-table {
            margin-top: 6%;
            margin-left: -23%;
        }
    </style>
</head>

<body>
    <form action="productdata.php" method="POST">
        <div class="popup-bg" id="empty-popup-bg">
            <table class="popup-table">
                <tr>
                    <td colspan="2">
                        <button class="btn-close-popup" onclick="closeAddForm()">X</button>
                        <div class="title">ADD PRODUCT</div>
                    </td>
                </tr>
                <tr>
                    <td class="popup-labels">
                        <label for="prodpicture"><b>Product Picture: </b></label>
                    </td>
                    <td style="padding-left:1px;"><input style="border: none" type="file" placeholder="Browse" name="prodpicture" required></td>
                </tr>
                <tr>
                    <td class="popup-labels">
                        <label for="prodtitle"><b>Product Title: </b></label>
                    </td>
                    <td><input type="text" placeholder="Enter Product Title" name="prodtitle" required></td>
                </tr>
                <tr>
                    <td class="popup-labels">
                        <label for="prodcontent"><b>Product Content: </b></label>
                    </td>
                    <td><input type="text" placeholder="Enter Product Content" name="prodcontent" required></td>
                </tr>
                <tr>
                    <td class="popup-labels">
                        <label for="prodstock"><b>Product Stock: </b></label>
                    </td>
                    <td><input type="text" placeholder="Enter Product Stock" name="prodstock" required></td>
                </tr>
                <tr>
                    <td class="popup-labels"><label for="prodcategory"><b>Product Category: </b></label></td>
                    <td>
                        <select class="prodcategory" name="prodcategory">
                            <option selected disabled>-Select a Category-</option>
                            <option value="makeup">Makeup</option>
                            <option value="skincare">Skincare</option>
                            <option value="hairproduct">Hair Product</option>
                        </select>
                    </td>
                </tr>
                <tr>
                    <td class="popup-labels">
                        <label for="prodprice"><b>Product Price:</b></label>
                    </td>
                    <td><input type="text" placeholder="Enter Product Price" name="prodprice" required></td>
                </tr>
                <tr>
                    <td colspan="2" style="height: 50px">
                        <button type="submit" name="btnAdd" class="btnUpdate">Add Product</button>
                        <button type="reset" class="btnReset">Reset</button>
                    </td>
                </tr>
            </table>
        </div>
    </form>

    <script>
        function openAddForm() {
            document.querySelector('#empty-popup-bg').style.display = 'block';
        }

        function closeAddForm() {
            document.querySelector('#empty-popup-bg').style.display = 'none';
        }
    </script>

    <?php if (isset($_POST['btnAdd'])) {
        $conn = mysqli_connect('localhost', 'root', '', 'sdp_assignment');
        $addprodlist = "INSERT INTO product_list ".
        "(productTitle, productContent, productStock, productCategory, productPrice, productPicture) ".
        "VALUES('" . $_POST['prodtitle'] . "','" . $_POST['prodcontent'] . "','" . $_POST['prodstock'] . "','" . $_POST['prodcategory'] . "','" . $_POST['prodprice'] . "','product/product-image/" . $_POST['prodpicture'] . "')";

        mysqli_query($conn, $addprodlist);
        if (mysqli_affected_rows($conn) <= 0) {
            echo "<script>alert('fail');</script>";
        } else {
            echo "<script>alert('successful');</script>";
        }
    }

    ?>

</body>

</html>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Product List</title>
    <script src='https://kit.fontawesome.com/a076d05399.js'></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="datalist.css">
</head>

<body>
    <?php include('admin-navbar.php'); ?>
    <?php include('admin-popup/addproductpu.php'); ?>
    <center>
        <h1 style="z-index: 100; position: relative"><b>Products</b></h1>
        <div style="height: 50px"></div>
    </center>
    <div class="filter-bg"></div>
    <input class="searchbar" form="search-form" id="searchbar" name="search_inp" type="text" placeholder="Type here to search..">
    <form action="" method="POST" id="search-form"></form>
    <button type="button" class="btn-add-new" onclick="openAddForm()">
        <i class="fa fa-plus" style="font-size: 32px"></i>
    </button>
    <div class="btn-add-hover" onclick="openAddForm()"><b>Add New Product</b></div>
    <script>
        $(function() {
            $('.btn-add-new, .btn-add-hover').mouseover(function() {
                $('.btn-add-hover').css({
                    "width": "245px",
                    "color": "black",
                    "transition": "0.5s",
                });
                $('.fa-plus').css({
                    "transform": "rotate(90deg)",
                    "margin": "0 2px 1px 0",
                    "transition": "0.5s",
                });
            });
            $('.btn-add-new, .btn-add-hover').mouseout(function() {
                $('.btn-add-hover').css({
                    "width": "35px",
                    "color": "white",
                    "transition": "0.5s",
                });
                $('.fa-plus').css({
                    "transform": "rotate(-90deg)",
                    "margin": "2px 0 5px 3px",
                    "transition": "0.5s",
                });
            })
        });
    </script>

    <!-- PRODUCT LIST START -->
    <section>
        <?php
        $check_stock = "SELECT MIN(productStock) AS min_stock FROM product_list";
        $result_check = mysqli_query($conn, $check_stock);
        $row_check_stock = mysqli_fetch_array($result_check);

        if ($row_check_stock['min_stock'] <= 5 && !isset($_POST['search_inp'])) {
            $product = "SELECT * FROM product_list ORDER BY productStock ASC";
        } else if (isset($_POST['search_inp'])) {
            $product = "SELECT * FROM product_list WHERE " .
                "productTitle LIKE '%" . $_POST['search_inp'] . "%' OR " .
                "productDescription LIKE '%" . $_POST['search_inp'] . "%' OR " .
                "productContent LIKE '%" . $_POST['search_inp'] . "%' OR " .
                "productCategory LIKE '%" . $_POST['search_inp'] . "%'";

            $product_ref = "SELECT COUNT(productID) AS result_count FROM product_list WHERE ".
            "productTitle LIKE '%" . $_POST['search_inp'] . "%' OR ".
            "productDescription LIKE '%" . $_POST['search_inp'] . "%' OR ".
            "productContent LIKE '%" . $_POST['search_inp'] . "%' OR ".
            "productCategory LIKE '%" . $_POST['search_inp'] . "%'";
            $just_ref_query = mysqli_query($conn, $product_ref);

            if (mysqli_num_rows($just_ref_query) > 0) {
                $just_for_ref = mysqli_fetch_array($just_ref_query);
                echo ("<h3 style='position: absolute; margin-left: 24vw;'>Keyword: '{$_POST['search_inp']}' &nbsp; Result: {$just_for_ref['result_count']} </h3>");
            }
        } else if (!isset($_POST['search_inp'])) {
            $product = "SELECT * FROM product_list";
        }
        $result_product = mysqli_query($conn, $product);
        ?>

        <div style="height: 70px"></div>

        <?php while ($row_product = mysqli_fetch_array($result_product)) { ?>
            <form action="" method="POST">
                <table class="product-table">
                    <tr>
                        <input type="hidden" value="<?php echo $row_product['productID']; ?>" name="input_productID">
                        <td rowspan="999" class="img-td"><img src="../<?php echo $row_product['productPicture']; ?>" width="100%" height="100%"></td>
                    </tr>
                    <tr>
                        <td></td>
                        <td style="height: 1vw">
                            <button class="btnEditProduct" type="button" onclick="openForm<?php echo $row_product['productID']; ?>();" name="btnEditProduct">
                                <i class="fa fa-pencil" style="font-size:30px"></i>
                            </button>
                            <button class="btnDelProduct" type="button" onclick="openDel<?php echo $row_product['productID']; ?>()">
                                <i class='fas fa-trash-alt' style='font-size:30px'></i>
                            </button>
                        </td>
                    </tr>
                    <tr>
                        <td colspan="4" class="product-content">P<?php echo $row_product['productID']; ?></td>
                    </tr>
                    <tr>
                        <td colspan="4" class="product-content">Title: <?php echo $row_product['productTitle']; ?></td><br />
                    </tr>
                    <tr>
                        <td colspan="4" class="product-content">Category: <?php echo $row_product['productCategory']; ?></td>
                    </tr>
                    <tr>
                        <td colspan="4" class="product-content">
                            <div class="product-content2" id="show_content<?php echo ("content" . "{$row_product['productID']}"); ?>">
                                Content: <?php echo $row_product['productContent']; ?>
                            </div>
                            <button type="button" class="show-more" id="show_more<?php echo ("content" . "{$row_product['productID']}"); ?>" <?php if (strlen($row_product['productContent']) <= 49) {
                                                                                                                                                    echo "style= 'display: none !important;'";
                                                                                                                                                } ?>>Show More</button>
                            <button type="button" class="show-less" id="show_less<?php echo ("content" . "{$row_product['productID']}"); ?>">Show Less</button>
                        </td>
                    </tr>
                    <tr>
                        <td colspan="4" class="product-content">
                            <div class="product-content2" id="show_content<?php echo $row_product['productID']; ?>">
                                Description: <?php echo $row_product['productDescription']; ?>
                            </div>
                            <button type="button" class="show-more" id="show_more<?php echo $row_product['productID']; ?>" <?php if (strlen($row_product['productDescription']) <= 49 || strlen($row_product['productDescription']) == 0) {
                                                                                                                                echo "style= 'display: none !important;'";
                                                                                                                            } ?>>Show More</button>
                            <button type="button" class="show-less" id="show_less<?php echo $row_product['productID']; ?>">Show Less</button>
                        </td>
                    </tr>
                    <tr>
                        <td colspan="4" class="product-content" <?php if ($row_product['productStock'] <= 5) {
                                                                    echo "style = 'color: red'";
                                                                } else {
                                                                    echo "style = 'color: green'";
                                                                } ?>>
                            Stock: <?php echo $row_product['productStock']; ?> <?php if ($row_product['productStock'] <= 5) {
                                                                                    echo "(Low Stock!)";
                                                                                } ?>
                        </td>
                    </tr>
                    <tr>
                        <td colspan="4" class="product-content">Price: RM<?php echo $row_product['productPrice']; ?></td>
                    </tr>
                    <tr>
                        <td style="height: 1vw"></td>
                    </tr>
                </table>
                <div class="cfm-del-bg" id="cfm-del-bg<?php echo $row_product['productID']; ?>">
                    <div class="del-popup-close" onclick="closeDel<?php echo $row_product['productID']; ?>()"></div>
                    <div class="del-popup">
                        <h3 style="color: black">Are you sure you want to delete this product?</h3>
                        <div style="height: 10px"></div>
                        <button type="button" class="btnCancel" onclick="closeDel<?php echo $row_product['productID']; ?>()">Cancel</button>
                        <button type="submit" name="btnDelProduct" class="btnCfmDel" id="btnRemove<?php echo $row_product['productID']; ?>">Confirm</button>
                    </div>
                </div>
            </form>
    </section>
    <!-- PRODUCT LIST END -->

    <!-- HIDDEN POP-UP FORM START -->
    <section>
        <form action="productdata.php" method="POST">
            <div class="popup-bg" id="pop-up<?php echo $row_product['productID']; ?>">
                <table class="popup-table">
                    <tr>
                        <td colspan="2">
                            <input type="hidden" name="inputprodid" value="<?php echo $row_product['productID']; ?>">
                            <button class="btn-close-popup" onclick="closeForm<?php echo $row_product['productID']; ?>()" type="button">X</button>
                            <div class="title">EDIT PRODUCT</div>
                            <div class="title">ID: P<?php echo $row_product['productID']; ?></div>
                        </td>
                    </tr>
                    <tr>
                        <td class="popup-labels">
                            <label for="picture">
                                <b>Product Picture:</b>
                            </label>
                        </td>
                        <td>
                            <input style="border: none" type="file" placeholder="Browse" name="prodpicture" required>
                        </td>
                    </tr>
                    <tr>
                        <td class="popup-labels">
                            <label for="title">
                                <b>Product Title:</b>
                            </label>
                        </td>
                        <td>
                            <input type="text" value="<?php echo $row_product['productTitle']; ?>" placeholder="Enter Product Title" name="prodtitle" required>
                        </td>
                    </tr>
                    <tr>
                        <td class="popup-labels">
                            <label for="prodcontent">
                                <b>Product Content:</b>
                            </label>
                        </td>
                        <td>
                            <textarea placeholder="Enter Product Content" name="prodcontent" required><?php echo $row_product['productContent']; ?></textarea>
                        </td>
                    </tr>
                    <tr>
                        <td class="popup-labels">
                            <label for="prodcontent">
                                <b>Product Description:</b>
                            </label>
                        </td>
                        <td>
                            <textarea placeholder="Enter Product Description" name="proddescription"><?php echo $row_product['productDescription']; ?></textarea>
                        </td>
                    </tr>
                    <tr>
                        <td class="popup-labels">
                            <label for="prodstock">
                                <b>Product Stock:</b>
                            </label>
                        </td>
                        <td>
                            <input type="text" value="<?php echo $row_product['productStock']; ?>" placeholder="Enter Product Stock" name="prodstock" required>
                        </td>
                    </tr>
                    <tr>
                        <td class="popup-labels">
                            <label for="prodcategory">
                                <b>Product Category:</b>
                            </label>
                        </td>
                        <td>
                            <select class="category" name="prodcategory" required>
                                <option selected disabled value="">-Select a Category-</option>
                                <option value="makeup">Makeup</option>
                                <option value="skincare">Skincare</option>
                                <option value="hairproduct">Hair Product</option>
                            </select>
                        </td>
                    </tr>
                    <tr>
                        <td class="popup-labels">
                            <label for="prodprice">
                                <b>Product Price:</b>
                            </label>
                        </td>
                        <td>
                            <input type="text" value="<?php echo $row_product['productPrice']; ?>" placeholder="Enter Product Price" name="prodprice" required>
                        </td>
                    </tr>
                    <tr>
                        <td colspan="2" style="height: 50px">
                            <button type="submit" name="btnUpdate" class="btnUpdate">Update</button>
                            <button type="reset" class="btnReset">Reset</button>
                        </td>
                    </tr>
                </table>
            </div>
        </form>

        <script>
            ////////CANNOT BE CONTAINED IN EXTERNAL JAVASCRIPT CUZ THERE IS PHP SYNTAX THAT ONLY WORKS HERE//////
            function closeForm<?php echo $row_product['productID']; ?>() {
                document.querySelector('#pop-up<?php echo $row_product['productID']; ?>').style.display = 'none';
            }

            function openForm<?php echo $row_product['productID']; ?>() {
                document.querySelector('#pop-up<?php echo $row_product['productID']; ?>').style.display = 'block';
            }

            function closeDel<?php echo $row_product['productID']; ?>() {
                document.querySelector('#cfm-del-bg<?php echo $row_product['productID']; ?>').style.display = 'none';
            }

            function openDel<?php echo $row_product['productID']; ?>() {
                document.querySelector('#cfm-del-bg<?php echo $row_product['productID']; ?>').style.display = 'block';
            }

            $(function() {
                $("#show_more<?php echo $row_product['productID']; ?>").click(function() {
                    $("#show_content<?php echo $row_product['productID']; ?>").css({
                        "overflow": "visible",
                        "white-space": "normal",
                        "height": "auto"
                    });
                    $("#show_less<?php echo $row_product['productID']; ?>").css({
                        "display": "block"
                    });
                    $("#show_more<?php echo $row_product['productID']; ?>").css({
                        "display": "none"
                    });
                });
                $("#show_less<?php echo $row_product['productID']; ?>").click(function() {
                    $("#show_content<?php echo $row_product['productID']; ?>").css({
                        "overflow": "hidden",
                        "white-space": "nowrap",
                        "text-overflow": "ellipsis",
                    });
                    $("#show_more<?php echo $row_product['productID']; ?>").css({
                        "display": "block"
                    });
                    $("#show_less<?php echo $row_product['productID']; ?>").css({
                        "display": "none"
                    });
                });

                $("#show_more<?php echo ("content" . "{$row_product['productID']}"); ?>").click(function() {
                    $("#show_content<?php echo ("content" . "{$row_product['productID']}"); ?>").css({
                        "overflow": "visible",
                        "white-space": "normal",
                        "height": "auto",
                    });
                    $("#show_less<?php echo ("content" . "{$row_product['productID']}"); ?>").css({
                        "display": "block"
                    });
                    $("#show_more<?php echo ("content" . "{$row_product['productID']}"); ?>").css({
                        "display": "none"
                    });
                });
                $("#show_less<?php echo ("content" . "{$row_product['productID']}"); ?>").click(function() {
                    $("#show_content<?php echo ("content" . "{$row_product['productID']}"); ?>").css({
                        "overflow": "hidden",
                        "white-space": "nowrap",
                        "text-overflow": "ellipsis",
                    });
                    $("#show_more<?php echo ("content" . "{$row_product['productID']}"); ?>").css({
                        "display": "block"
                    });
                    $("#show_less<?php echo ("content" . "{$row_product['productID']}"); ?>").css({
                        "display": "none"
                    });
                });
            });
        </script>
    </section>
    <div style="height: 2vw"></div>
    <!-- HIDDEN POP-UP FORM END -->

<?php } ?>
<?php
if (isset($_POST['btnUpdate'])) {
    $update_product = "UPDATE product_list SET productTitle = '" . $_POST['prodtitle'] . "', productContent = '" . $_POST['prodcontent'] . "', productDescription = '" . $_POST['proddescription'] . "', productStock = '" . $_POST['prodstock'] . "', productCategory = '" . $_POST['prodcategory'] . "', productPrice = '" . $_POST['prodprice'] . "', productPicture = 'product/product-image/" . $_POST['prodpicture'] . "' where productID = '" . $_POST['inputprodid'] . "'";
    mysqli_query($conn, $update_product);

    if (mysqli_affected_rows($conn) > 0) {
        echo ("<script>alert('Data has been updated successfully!');</script>");
        echo ("<script>document.location.reload();</script>");
    }
} else if (isset($_POST['btnDelProduct'])) {
    $del_product = "DELETE FROM product_list WHERE productID = '" . $_POST['input_productID'] . "'";
    mysqli_query($conn, $del_product);

    if (mysqli_affected_rows($conn) > 0) {
        echo ("<script>alert('Data has been deleted successfully!');</script>");
        echo ("<script>document.location.reload();</script>");
    }
}
?>

<script>
    //PREVENT RESUBMISSION//
    if (window.history.replaceState) {
        window.history.replaceState(null, null, window.location.href);
    }
</script>
</body>

</html>

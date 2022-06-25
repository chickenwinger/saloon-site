<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Outfit List</title>
    <script src='https://kit.fontawesome.com/a076d05399.js'></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="datalist.css">
</head>

<body>
    <?php include('admin-navbar.php'); ?>
    <?php include('admin-popup/addoutfitpu.php'); ?>
    <center>
        <h1 style="z-index: 100; position: relative"><b>Outfits</b></h1>
        <div style="height: 50px"></div>
    </center>
    <div class="filter-bg"></div>
    <input class="searchbar" form="search-form" id="searchbar" name="search_inp" type="text" placeholder="Type here to search..">
    <form action="" method="POST" id="search-form"></form>
    <button type="button" class="btn-add-new" onclick="openAddForm()">
        <i class="fa fa-plus" style="font-size: 32px"></i>
    </button>
    <br>
    <div class="btn-add-hover" onclick="openAddForm()"><b>Add New Outfit</b></div>
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

    <!-- OUTFIT LIST START -->
    <section>
        <?php
        if (!isset($_POST['search_inp']) || isset($_POST['search_inp']) && $_POST['search_inp'] == "") {
            $outfit = "SELECT * FROM outfit_list ol";
        } else if (isset($_POST['search_inp'])) {
            $outfit = "SELECT * FROM outfit_list WHERE " .
                "outfitTitle LIKE '%" . $_POST['search_inp'] . "%' OR " .
                "outfitGender LIKE '%" . $_POST['search_inp'] . "%' OR " .
                "outfitDescription LIKE '%" . $_POST['search_inp'] . "%' OR " .
                "outfitCategory LIKE '%" . $_POST['search_inp'] . "%'";

            $outfit_ref = "SELECT COUNT(outfitID) AS result_count FROM outfit_list WHERE " .
                "outfitTitle LIKE '%" . $_POST['search_inp'] . "%' OR " .
                "outfitGender LIKE '%" . $_POST['search_inp'] . "%' OR " .
                "outfitDescription LIKE '%" . $_POST['search_inp'] . "%' OR " .
                "outfitCategory LIKE '%" . $_POST['search_inp'] . "%'";
            $just_ref_query = mysqli_query($conn, $outfit_ref);

            if (mysqli_num_rows($just_ref_query) > 0) {
                $just_for_ref = mysqli_fetch_array($just_ref_query);
                echo ("<h3 style='position: absolute; margin-left: 24vw;'>Keyword: '{$_POST['search_inp']}' &nbsp; Result: {$just_for_ref['result_count']} </h3>");
            }
        }
        $result_outfit = mysqli_query($conn, $outfit);
        ?>

        <div style="height: 70px"></div>

        <?php while ($row_outfit = mysqli_fetch_array($result_outfit)) { ?>
            <form action="" method="POST">
                <table class="product-table">
                    <tr>
                        <input type="hidden" value="<?php echo $row_outfit['outfitID']; ?>" name="input_outfitID">
                        <td rowspan="999" class="img-td"><img src="../<?php echo $row_outfit['outfitPicture']; ?>" width="100%" height="100%"></td>
                    </tr>
                    <tr>
                        <td></td>
                        <td style="height: 1vw">
                            <button class="btnEditProduct" type="button" onclick="openForm<?php echo $row_outfit['outfitID']; ?>();" name="btnEditProduct">
                                <i class="fa fa-pencil" style="font-size:30px"></i>
                            </button>
                            <button class="btnDelProduct" type="button" onclick="openDel<?php echo $row_outfit['outfitID']; ?>()">
                                <i class='fas fa-trash-alt' style='font-size:30px'></i>
                            </button>
                        </td>
                    </tr>
                    <tr>
                        <td colspan="4" class="product-content">S<?php echo $row_outfit['outfitID']; ?></td>
                    </tr>
                    <tr>
                        <td colspan="4" class="product-content">Title: <?php echo $row_outfit['outfitTitle']; ?></td>
                    </tr>
                    <tr>
                        <td colspan="4" class="product-content">Gender: <?php echo $row_outfit['outfitGender']; ?></td>
                    </tr>
                    <tr>
                        <td colspan="4" class="product-content">Category: <?php echo $row_outfit['outfitCategory']; ?></td>
                    </tr>
                    <tr>
                        <td colspan="4" class="product-content">
                            Outfit Stock:
                            <?php
                            $select_size = "SELECT * FROM outfit_size WHERE outfitID = '" . $row_outfit['outfitID'] . "'";
                            $result_select_size = mysqli_query($conn, $select_size);
                            while ($row_select_size = mysqli_fetch_array($result_select_size)) {
                            ?>
                                <b <?php if ($row_select_size['outfitstock'] == 0) {
                                        echo "style='color: red;'";
                                    } ?>>
                                    <?php echo ($row_select_size['outfitSize'] . "=" . $row_select_size['outfitstock'] . " &nbsp;"); ?>
                                </b>
                            <?php
                            }
                            ?>
                            <button style="margin-left: 0" class="btnEditProduct" type="button" onclick="openAddSize<?php echo $row_outfit['outfitID']; ?>()" name="btnEditProduct">
                                <i class="fa fa-pencil" style="font-size:20px"></i>
                            </button>
                        </td>
                    </tr>
                    <tr>
                        <td colspan="4" class="product-content">
                            <div class="product-content2" id="show_content<?php echo $row_outfit['outfitID']; ?>">
                                Description: <?php echo $row_outfit['outfitDescription']; ?>
                            </div>
                            <button type="button" class="show-more" id="show_more<?php echo $row_outfit['outfitID']; ?>" <?php if (strlen($row_outfit['outfitDescription']) <= 49 || strlen($row_outfit['outfitDescription']) == 0) {
                                                                                                                                echo "style= 'display: none !important;'";
                                                                                                                            } ?>>Show More</button>
                            <button type="button" class="show-less" id="show_less<?php echo $row_outfit['outfitID']; ?>">Show Less</button>
                        </td>
                    </tr>
                    <tr>
                        <td colspan="4" class="product-content">Price: RM<?php echo $row_outfit['outfitPrice']; ?></td>
                    </tr>
                    <tr>
                        <td style="height: 1vw"></td>
                    </tr>
                </table>
                <div class="cfm-del-bg" id="cfm-del-bg<?php echo $row_outfit['outfitID']; ?>">
                    <div class="del-popup-close" onclick="closeDel<?php echo $row_outfit['outfitID']; ?>()"></div>
                    <div class="del-popup">
                        <h3 style="color: black">Are you sure you want to delete this outfit?</h3>
                        <div style="height: 10px"></div>
                        <button type="button" class="btnCancel" onclick="closeDel<?php echo $row_outfit['outfitID']; ?>()">Cancel</button>
                        <form action="" method="POST">
                            <button type="submit" name="btnDelOutfit" class="btnCfmDel">Confirm</button>
                        </form>
                    </div>
                </div>
                <div class="add-size-bg" id="add-size-bg<?php echo $row_outfit['outfitID']; ?>">
                    <div class="close-add-size" onclick="closeAddSize<?php echo $row_outfit['outfitID']; ?>();"></div>
                    <table class="add-size-table">
                        <tr>
                            <td style="color: black">ID: O<?php echo $row_outfit['outfitID']; ?></td>
                        </tr>
                        <tr>
                            <td>
                                <select name="selectSize" id="" required>
                                    <option value="" selected disabled>--Select Size--</option>
                                    <option value="XS">XS</option>
                                    <option value="S">S</option>
                                    <option value="M">M</option>
                                    <option value="L">L</option>
                                    <option value="XL">XL</option>
                                    <option value="XXL">XXL</option>
                                </select>
                            </td>
                            <td>
                                <input type="number" name="outfitSizeQuantity" min="1" placeholder="New updated outfit stock">
                            </td>
                        </tr>
                        <tr>
                            <td colspan="99" style="text-align: right">
                                <button type="button" class="cancel-add-size" onclick="closeAddSize<?php echo $row_outfit['outfitID']; ?>();">Cancel</button>
                                <button type="submit" class="btn-add-size2" name="btnAddSize">Add Size</button>
                            </td>
                        </tr>
                    </table>
                </div>
            </form>
    </section>
    <!-- OUTFIT LIST END -->

    <!-- HIDDEN EDIT POP-UP FORM START -->
    <section>
        <form action="outfitdata.php" method="POST">
            <div class="popup-bg" id="pop-up<?php echo $row_outfit['outfitID']; ?>">
                <table class="popup-table">
                    <tr>
                        <td colspan="2">
                            <input type="hidden" name="input_outfitID" value="<?php echo $row_outfit['outfitID']; ?>">
                            <button class="btn-close-popup" onclick="closeForm<?php echo $row_outfit['outfitID']; ?>()" type="button">X</button>
                            <div class="title">EDIT OUTFIT</div>
                            <div class="title">ID: O<?php echo $row_outfit['outfitID']; ?></div>
                        </td>
                    </tr>
                    <tr>
                        <td class="popup-labels">
                            <label>
                                <b>Outfit Picture:</b>
                            </label>
                        </td>
                        <td>
                            <input style="border: none" type="file" placeholder="Browse" name="outfitpicture" required>
                        </td>
                    </tr>
                    <tr>
                        <td class="popup-labels">
                            <label>
                                <b>Outfit Title:</b>
                            </label>
                        </td>
                        <td>
                            <input type="text" value="<?php echo $row_outfit['outfitTitle']; ?>" placeholder="Enter Outfit Title" name="outfittitle" required>
                        </td>
                    </tr>
                    <tr>
                        <td class="popup-labels">
                            <label>
                                <b>Outfit Description:</b>
                            </label>
                        </td>
                        <td>
                            <textarea placeholder="Enter Outfit Description" name="outfitdescription"><?php echo $row_outfit['outfitDescription']; ?></textarea>
                        </td>
                    </tr>
                    <tr>
                        <td class="popup-labels">
                            <label>
                                <b>Outfit Category:</b>
                            </label>
                        </td>
                        <td>
                            <select class="category" name="outfitcategory" required>
                                <option selected disabled value="">-Select a Category-</option>
                                <option value="Wedding">Wedding</option>
                                <option value="Event">Event</option>
                            </select>
                        </td>
                    </tr>
                    <tr>
                        <td class="popup-labels">
                            <label>
                                <b>Outfit Price (RM):</b>
                            </label>
                        </td>
                        <td>
                            <input type="text" value="<?php echo $row_outfit['outfitPrice']; ?>" placeholder="Enter Outfit Price" name="outfitprice" required>
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
            function closeForm<?php echo $row_outfit['outfitID']; ?>() {
                document.querySelector('#pop-up<?php echo $row_outfit['outfitID']; ?>').style.display = 'none';
            }

            function openForm<?php echo $row_outfit['outfitID']; ?>() {
                document.querySelector('#pop-up<?php echo $row_outfit['outfitID']; ?>').style.display = 'block';
            }

            function closeDel<?php echo $row_outfit['outfitID']; ?>() {
                document.querySelector('#cfm-del-bg<?php echo $row_outfit['outfitID']; ?>').style.display = 'none';
            }

            function openDel<?php echo $row_outfit['outfitID']; ?>() {
                document.querySelector('#cfm-del-bg<?php echo $row_outfit['outfitID']; ?>').style.display = 'block';
            }

            function closeAddSize<?php echo $row_outfit['outfitID']; ?>() {
                document.querySelector('#add-size-bg<?php echo $row_outfit['outfitID']; ?>').style.display = 'none';
            }

            function openAddSize<?php echo $row_outfit['outfitID']; ?>() {
                document.querySelector('#add-size-bg<?php echo $row_outfit['outfitID']; ?>').style.display = 'block';
            }

            $(function() {
                $("#show_more<?php echo $row_outfit['outfitID']; ?>").click(function() {
                    $("#show_content<?php echo $row_outfit['outfitID']; ?>").css({
                        "overflow": "visible",
                        "white-space": "normal",
                        "height": "auto"
                    });
                    $("#show_less<?php echo $row_outfit['outfitID']; ?>").css({
                        "display": "block"
                    });
                    $("#show_more<?php echo $row_outfit['outfitID']; ?>").css({
                        "display": "none"
                    });
                });
                $("#show_less<?php echo $row_outfit['outfitID']; ?>").click(function() {
                    $("#show_content<?php echo $row_outfit['outfitID']; ?>").css({
                        "overflow": "hidden",
                        "white-space": "nowrap",
                        "text-overflow": "ellipsis",
                    });
                    $("#show_more<?php echo $row_outfit['outfitID']; ?>").css({
                        "display": "block"
                    });
                    $("#show_less<?php echo $row_outfit['outfitID']; ?>").css({
                        "display": "none"
                    });
                });

                $("#show_more<?php echo ("content" . "{$row_outfit['outfitID']}"); ?>").click(function() {
                    $("#show_content<?php echo ("content" . "{$row_outfit['outfitID']}"); ?>").css({
                        "overflow": "visible",
                        "white-space": "normal",
                        "height": "auto",
                    });
                    $("#show_less<?php echo ("content" . "{$row_outfit['outfitID']}"); ?>").css({
                        "display": "block"
                    });
                    $("#show_more<?php echo ("content" . "{$row_outfit['outfitID']}"); ?>").css({
                        "display": "none"
                    });
                });
                $("#show_less<?php echo ("content" . "{$row_outfit['outfitID']}"); ?>").click(function() {
                    $("#show_content<?php echo ("content" . "{$row_outfit['outfitID']}"); ?>").css({
                        "overflow": "hidden",
                        "white-space": "nowrap",
                        "text-overflow": "ellipsis",
                    });
                    $("#show_more<?php echo ("content" . "{$row_outfit['outfitID']}"); ?>").css({
                        "display": "block"
                    });
                    $("#show_less<?php echo ("content" . "{$row_outfit['outfitID']}"); ?>").css({
                        "display": "none"
                    });
                });
            });
        </script>
    </section>
    <div style="height: 2vw"></div>
    <!-- HIDDEN EDIT POP-UP FORM END -->

<?php } ?>

<?php

if (isset($_POST['btnUpdate'])) {
    $update_outfit = "UPDATE outfit_list SET " .
        "outfitTitle = '" . $_POST['outfittitle'] . "', " .
        "outfitDescription = '" . $_POST['outfitdescription'] . "', " .
        "outfitCategory = '" . $_POST['outfitcategory'] . "', " .
        "outfitPrice = '" . $_POST['outfitprice'] . "', " .
        "outfitPicture = 'outfit/outfit-image/" . $_POST['outfitpicture'] . "' " .
        "WHERE outfitID = '" . $_POST['input_outfitID'] . "'";
    mysqli_query($conn, $update_outfit);

    if (mysqli_affected_rows($conn) > 0) {
        echo ("<script>alert('Data has been updated successfully!');</script>");
        echo ("<script>document.location.reload();</script>");
    }
} else if (isset($_POST['btnAddSize'])) {
    $check_size = "SELECT * FROM outfit_size WHERE outfitID = '" . $_POST['input_outfitID'] . "' AND outfitSize = '" . $_POST['selectSize'] . "'";
    mysqli_query($conn, $check_size);
    if (mysqli_affected_rows($conn) <= 0) {
        $add_outfit_size = "INSERT INTO outfit_size (outfitID, outfitSize, outfitstock) VALUES ('" . $_POST['input_outfitID'] . "', '" . $_POST['selectSize'] . "', '" . $_POST['outfitSizeQuantity'] . "')";
        mysqli_query($conn, $add_outfit_size);
        echo ("<script>alert('Outfit size has been added successfully!');</script>");
        echo ("<script>window.location.href='outfitdata.php'</script>");
    } else {
        $update_outfit_size = "UPDATE outfit_size SET outfitstock = '" . $_POST['outfitSizeQuantity'] . "'  WHERE outfitID = '" . $_POST['input_outfitID'] . "' AND outfitSize = '" . $_POST['selectSize'] . "'";
        mysqli_query($conn, $update_outfit_size);
        echo ("<script>alert('Outfit size stock has been updated successfully!');</script>");
        echo ("<script>window.location.href='outfitdata.php'</script>");
    }
} else if (isset($_POST['btnDelOutfit'])) {
    $del_outfit = "DELETE FROM outfit_list WHERE outfitID = '" . $_POST['input_outfitID'] . "'";
    mysqli_query($conn, $del_outfit);

    if (mysqli_affected_rows($conn) > 0) {
        $delete_size = "DELETE FROM outfit_size WHERE outfitID = '" . $_POST['input_outfitID'] . "'";
        mysqli_query($conn, $delete_size);
        echo ("<script>alert('Outfit has been deleted successfully!');</script>");
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

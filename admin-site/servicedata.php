<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Service List</title>
    <script src='https://kit.fontawesome.com/a076d05399.js'></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="datalist.css">
</head>

<body>
    <?php include('admin-navbar.php'); ?>
    <?php include('admin-popup/addservicepu.php'); ?>
    <center>
        <h1 style="z-index: 100; position: relative"><b>Services</b></h1>
        <div style="height: 50px"></div>
    </center>
    <div class="filter-bg"></div>
    <input class="searchbar" form="search-form" id="searchbar" name="search_inp" type="text" placeholder="Type here to search..">
    <form action="" method="POST" id="search-form"></form>
    <button type="button" class="btn-add-new" onclick="openAddForm()">
        <i class="fa fa-plus" style="font-size: 32px"></i>
    </button>
    <div class="btn-add-hover" onclick="openAddForm()"><b>Add New Service</b></div>
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

    <!-- SERVICE LIST START -->
    <section>
        <?php
        if (!isset($_POST['search_inp']) || isset($_POST['search_inp']) && $_POST['search_inp'] == " ") {
            $service = "SELECT * FROM service_list";
        } else if (isset($_POST['search_inp'])) {
            $service = "SELECT * FROM service_list WHERE " .
                "servTitle LIKE '%" . $_POST['search_inp'] . "%' OR " .
                "servDescription LIKE '%" . $_POST['search_inp'] . "%' OR " .
                "servCategory LIKE '%" . $_POST['search_inp'] . "%'";

            $service_ref = "SELECT COUNT(servID) AS result_count FROM service_list WHERE " .
                "servTitle LIKE '%" . $_POST['search_inp'] . "%' OR " .
                "servDescription LIKE '%" . $_POST['search_inp'] . "%' OR " .
                "servCategory LIKE '%" . $_POST['search_inp'] . "%'";
            $just_ref_query = mysqli_query($conn, $service_ref);

            if (mysqli_num_rows($just_ref_query) > 0) {
                $just_for_ref = mysqli_fetch_array($just_ref_query);
                echo ("<h3 style='position: absolute; margin-left: 24vw;'>Keyword: '{$_POST['search_inp']}' &nbsp; Result: {$just_for_ref['result_count']} </h3>");
            }
        }
        $result_service = mysqli_query($conn, $service);
        ?>

        <div style="height: 70px"></div>

        <?php while ($row_service = mysqli_fetch_array($result_service)) { ?>
            <form action="" method="POST">
                <table class="product-table">
                    <tr>
                        <input type="hidden" value="<?php echo $row_service['servID']; ?>" name="input_servID">
                        <td rowspan="999" class="img-td"><img src="../<?php echo $row_service['servPicture']; ?>" width="100%" height="100%"></td>
                    </tr>
                    <tr>
                        <td></td>
                        <td style="height: 1vw">
                            <button class="btnEditProduct" type="button" onclick="openForm<?php echo $row_service['servID']; ?>();" name="btnEditProduct">
                                <i class="fa fa-pencil" style="font-size:30px"></i>
                            </button>
                            <button class="btnDelProduct" type="button" onclick="openDel<?php echo $row_service['servID']; ?>()">
                            <i class="fa fa-trash-o" style="font-size:30px"></i>
                            </button>
                        </td>
                    </tr>
                    <tr>
                        <td colspan="4" class="product-content">S<?php echo $row_service['servID']; ?></td>
                    </tr>
                    <tr>
                        <td colspan="4" class="product-content">Title: <?php echo $row_service['servTitle']; ?></td><br />
                    </tr>
                    <tr>
                        <td colspan="4" class="product-content">Category: <?php echo $row_service['servCategory']; ?></td>
                    </tr>
                    <tr>
                        <td colspan="4" class="product-content">
                            <div class="product-content2" id="show_content<?php echo $row_service['servID']; ?>">
                                Description: <?php echo $row_service['servDescription']; ?>
                            </div>
                            <button type="button" class="show-more" id="show_more<?php echo $row_service['servID']; ?>" <?php if (strlen($row_service['servDescription']) <= 49 || strlen($row_service['servDescription']) == 0) {
                                                                                                                            echo "style= 'display: none !important;'";
                                                                                                                        } ?>>Show More</button>
                            <button type="button" class="show-less" id="show_less<?php echo $row_service['servID']; ?>">Show Less</button>
                        </td>
                    </tr>
                    <tr>
                        <td colspan="4" class="product-content">Price: RM<?php echo $row_service['servPrice']; ?></td>
                    </tr>
                    <tr>
                        <td style="height: 1vw"></td>
                    </tr>
                </table>
                <div class="cfm-del-bg" id="cfm-del-bg<?php echo $row_service['servID']; ?>">
                    <div class="del-popup-close" onclick="closeDel<?php echo $row_service['servID']; ?>()"></div>
                    <div class="del-popup">
                        <h3 style="color: black">Are you sure you want to delete this service?</h3>
                        <div style="height: 10px"></div>
                        <button type="button" class="btnCancel" onclick="closeDel<?php echo $row_service['servID']; ?>()">Cancel</button>
                        <button type="submit" name="btnDelService" class="btnCfmDel" id="btnRemove<?php echo $row_service['servID']; ?>">Confirm</button>
                    </div>
                </div>
            </form>
    </section>
    <!-- SERVICE LIST END -->

    <!-- HIDDEN EDIT POP-UP FORM START -->
    <section>
        <form action="servicedata.php" method="POST">
            <div class="popup-bg" id="pop-up<?php echo $row_service['servID']; ?>">
                <table class="popup-table">
                    <tr>
                        <td colspan="2">
                            <input type="hidden" name="input_servID" value="<?php echo $row_service['servID']; ?>">
                            <button class="btn-close-popup" onclick="closeForm<?php echo $row_service['servID']; ?>()" type="button">X</button>
                            <div class="title">EDIT SERVICE</div>
                            <div class="title">ID: S<?php echo $row_service['servID']; ?></div>
                        </td>
                    </tr>
                    <tr>
                        <td class="popup-labels">
                            <label>
                                <b>Service Picture:</b>
                            </label>
                        </td>
                        <td>
                            <input style="border: none" type="file" placeholder="Browse" name="servpicture" required>
                        </td>
                    </tr>
                    <tr>
                        <td class="popup-labels">
                            <label>
                                <b>Service Title:</b>
                            </label>
                        </td>
                        <td>
                            <input type="text" value="<?php echo $row_service['servTitle']; ?>" placeholder="Enter Service Title" name="servtitle" required>
                        </td>
                    </tr>
                    <tr>
                        <td class="popup-labels">
                            <label>
                                <b>Service Description:</b>
                            </label>
                        </td>
                        <td>
                            <textarea placeholder="Enter Service Description" name="servdescription"><?php echo $row_service['servDescription']; ?></textarea>
                        </td>
                    </tr>
                    <tr>
                        <td class="popup-labels">
                            <label>
                                <b>Service Category:</b>
                            </label>
                        </td>
                        <td>
                            <select class="category" name="servcategory" required>
                                <option selected disabled value="">-Select a Category-</option>
                                <option value="Design">Outfit Design</option>
                                <option value="Hair Styling">Hair Styling</option>
                                <option value="Makeup">Makeup</option>
                            </select>
                        </td>
                    </tr>
                    <tr>
                        <td class="popup-labels">
                            <label>
                                <b>Service Price (RM):</b>
                            </label>
                        </td>
                        <td>
                            <input type="text" value="<?php echo $row_service['servPrice']; ?>" placeholder="Enter Service Price" name="servprice" required>
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
            function closeForm<?php echo $row_service['servID']; ?>() {
                document.querySelector('#pop-up<?php echo $row_service['servID']; ?>').style.display = 'none';
            }

            function openForm<?php echo $row_service['servID']; ?>() {
                document.querySelector('#pop-up<?php echo $row_service['servID']; ?>').style.display = 'block';
            }

            function closeDel<?php echo $row_service['servID']; ?>() {
                document.querySelector('#cfm-del-bg<?php echo $row_service['servID']; ?>').style.display = 'none';
            }

            function openDel<?php echo $row_service['servID']; ?>() {
                document.querySelector('#cfm-del-bg<?php echo $row_service['servID']; ?>').style.display = 'block';
            }

            $(function() {
                $("#show_more<?php echo $row_service['servID']; ?>").click(function() {
                    $("#show_content<?php echo $row_service['servID']; ?>").css({
                        "overflow": "visible",
                        "white-space": "normal",
                        "height": "auto"
                    });
                    $("#show_less<?php echo $row_service['servID']; ?>").css({
                        "display": "block"
                    });
                    $("#show_more<?php echo $row_service['servID']; ?>").css({
                        "display": "none"
                    });
                });
                $("#show_less<?php echo $row_service['servID']; ?>").click(function() {
                    $("#show_content<?php echo $row_service['servID']; ?>").css({
                        "overflow": "hidden",
                        "white-space": "nowrap",
                        "text-overflow": "ellipsis",
                    });
                    $("#show_more<?php echo $row_service['servID']; ?>").css({
                        "display": "block"
                    });
                    $("#show_less<?php echo $row_service['servID']; ?>").css({
                        "display": "none"
                    });
                });

                $("#show_more<?php echo ("content" . "{$row_service['servID']}"); ?>").click(function() {
                    $("#show_content<?php echo ("content" . "{$row_service['servID']}"); ?>").css({
                        "overflow": "visible",
                        "white-space": "normal",
                        "height": "auto",
                    });
                    $("#show_less<?php echo ("content" . "{$row_service['servID']}"); ?>").css({
                        "display": "block"
                    });
                    $("#show_more<?php echo ("content" . "{$row_service['servID']}"); ?>").css({
                        "display": "none"
                    });
                });
                $("#show_less<?php echo ("content" . "{$row_service['servID']}"); ?>").click(function() {
                    $("#show_content<?php echo ("content" . "{$row_service['servID']}"); ?>").css({
                        "overflow": "hidden",
                        "white-space": "nowrap",
                        "text-overflow": "ellipsis",
                    });
                    $("#show_more<?php echo ("content" . "{$row_service['servID']}"); ?>").css({
                        "display": "block"
                    });
                    $("#show_less<?php echo ("content" . "{$row_service['servID']}"); ?>").css({
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
    $update_service = "UPDATE service_list SET " .
        "servTitle = '" . $_POST['servtitle'] . "', " .
        "servDescription = '" . $_POST['servdescription'] . "', " .
        "servCategory = '" . $_POST['servcategory'] . "', " .
        "servPrice = '" . $_POST['servprice'] . "', " .
        "servPicture = 'service/service-image/" . $_POST['servpicture'] . "' " .
        "WHERE servID = '" . $_POST['input_servID'] . "'";
    mysqli_query($conn, $update_service);

    if (mysqli_affected_rows($conn) > 0) {
        echo ("<script>alert('Data has been updated successfully!');</script>");
        echo ("<script>document.location.reload();</script>");
    }
} else if (isset($_POST['btnDelService'])) {
    $del_service = "DELETE FROM service_list WHERE servID = '" . $_POST['input_servID'] . "'";
    mysqli_query($conn, $del_service);

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

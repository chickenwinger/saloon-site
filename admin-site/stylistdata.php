<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>STYLISTS</title>
    <link href='https://fonts.googleapis.com/css?family=Allan' rel='stylesheet'>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="stylistdata.css">
</head>

<body>
    <?php include('admin-navbar.php'); ?>
    <?php
    $stylist = "SELECT * FROM employee_list WHERE empRole = 'stylist'";
    $result_stylist = mysqli_query($conn, $stylist);
    $counter = 0;
    ?>
    <p class="stylist-title">S T Y L I S T</p>
    <button type="button" class="btn-add-new" id="btn-add-new">
        <i class="fa fa-plus" style="font-size: 32px"></i>
    </button>
    <div class="btn-add-hover" id="btn-add-hover"><b>Add New Stylist</b></div>
    <table style="margin: 0 auto; border-spacing: 5vw;">
        <tr>
            <?php
            while ($row_stylist = mysqli_fetch_array($result_stylist)) {
                $counter++;
            ?>
                <form action="" method="post">
                    <td>
                        <table class="stylist-container" id="stylist-container<?php echo $row_stylist['empID']; ?>">
                            <tr>
                                <td class="stylistimg-td">
                                    <!-- delete window -->
                                    <div class="remove-bg" id="remove-bg<?php echo $row_stylist['empID']; ?>">
                                        <div class="close-remove" id="close-remove<?php echo $row_stylist['empID']; ?>"></div>
                                        <table class="remove-table">
                                            <tr>
                                                <td colspan="2">Are you sure you want to remove this data?</td>
                                            </tr>
                                            <tr>
                                                <td>
                                                    <button type="button" class="btn-btn" id="btn-btn<?php echo $row_stylist['empID']; ?>">Cancel</button>
                                                </td>
                                                <td>
                                                    <button type="submit" class="btn-btn2" name="btn_btn" id="btn-btn2<?php echo $row_stylist['empID']; ?>">Remove</button>
                                                </td>
                                            </tr>
                                        </table>
                                    </div>
                                    <input type="hidden" name="emp_id" value="<?php echo $row_stylist['empID']; ?>">
                                    <!-- delete window -->
                                    <img src="../<?php echo $row_stylist['empPicture']; ?>" alt="" width="100%">
                                </td>
                            </tr>
                            <tr>
                                <td class="stylist-content">STY<?php echo $row_stylist['empID']; ?></td>
                            </tr>
                            <tr>
                                <td class="stylist-content"><b><?php echo ($row_stylist['empLN'] . " " . $row_stylist['empFN']); ?></b></td>
                            </tr>
                            <tr>
                                <td class="stylist-content" <?php if ($row_stylist['empOffDay'] == date('N')) {
                                                                echo "style='background: red; color: white'";
                                                            } else {
                                                                echo "style='background: limegreen; color: white'";
                                                            } ?>>
                                    Off Day:
                                    <?php
                                    if ($row_stylist['empOffDay'] == 1) {
                                        echo "MONDAY";
                                    } else if ($row_stylist['empOffDay'] == 2) {
                                        echo "TUESDAY";
                                    } else if ($row_stylist['empOffDay'] == 3) {
                                        echo "WEDNESDAY";
                                    } else if ($row_stylist['empOffDay'] == 4) {
                                        echo "THURSDAY";
                                    } else if ($row_stylist['empOffDay'] == 5) {
                                        echo "FRIDAY";
                                    } else if ($row_stylist['empOffDay'] == 6) {
                                        echo "SATURDAY";
                                    } else {
                                        echo "SUNDAY";
                                    }
                                    ?>
                                </td>
                            </tr>
                            <div class="hidden-content" id="hidden-content<?php echo $row_stylist['empID']; ?>">
                                <div class="stylist-hidden" id="stylist-hidden<?php echo $row_stylist['empID']; ?>"><?php echo $row_stylist['empEmail']; ?></div>
                                <div class="stylist-hidden2" id="stylist-hidden2<?php echo $row_stylist['empID']; ?>"><?php echo $row_stylist['empPhone']; ?></div>
                                <button type="button" class="btn-delete" id="btn-delete<?php echo $row_stylist['empID']; ?>"><i class="fa fa-trash-o"></i></button>
                            </div>
                            <script>
                                $('#stylist-container<?php echo $row_stylist['empID']; ?>, #hidden-content<?php echo $row_stylist['empID']; ?>').mouseover(function() {
                                    $('#hidden-content<?php echo $row_stylist['empID']; ?>').css({
                                        "height": "487px",
                                        "margin-top": "0",
                                        "opacity": "1",
                                        "transition": "0.7s"
                                    });
                                    $('#stylist-hidden<?php echo $row_stylist['empID']; ?>').css({
                                        "margin-top": "47%",
                                        "transition": "0.5s",
                                        "opacity": "1",
                                        "transition-delay": "0.3s"
                                    });
                                    $('#stylist-hidden2<?php echo $row_stylist['empID']; ?>').css({
                                        "margin-top": "57%",
                                        "transition": "0.5s",
                                        "opacity": "1",
                                        "transition-delay": "0.3s"
                                    });
                                    $('#btn-delete<?php echo $row_stylist['empID']; ?>').css({
                                        "margin-left": "260px",
                                        "transition": "0.5s",
                                        "transition-delay": "0.3s"
                                    });
                                });
                                $('#stylist-container<?php echo $row_stylist['empID']; ?>, #hidden-content<?php echo $row_stylist['empID']; ?>').mouseout(function() {
                                    $('#hidden-content<?php echo $row_stylist['empID']; ?>').css({
                                        "height": "0",
                                        "margin-top": "487px",
                                        "opacity": "0",
                                        "transition": "0.7s"
                                    });
                                    $('#stylist-hidden<?php echo $row_stylist['empID']; ?>').css({
                                        "margin-top": "100%",
                                        "transition": "0.7s",
                                        "opacity": "0"
                                    });
                                    $('#stylist-hidden2<?php echo $row_stylist['empID']; ?>').css({
                                        "margin-top": "100%",
                                        "transition": "0.7s",
                                        "opacity": "0"
                                    });
                                    $('#btn-delete<?php echo $row_stylist['empID']; ?>').css({
                                        "margin-left": "400px",
                                        "transition": "0.7s"
                                    });
                                });

                                $('#btn-delete<?php echo $row_stylist['empID']; ?>').click(function() {
                                    $('#remove-bg<?php echo $row_stylist['empID']; ?>').css({
                                        "display": "block"
                                    });
                                });
                                $('#close-remove<?php echo $row_stylist['empID']; ?>, #btn-btn<?php echo $row_stylist['empID']; ?>').click(function() {
                                    $('#remove-bg<?php echo $row_stylist['empID']; ?>').css({
                                        "display": "none"
                                    });
                                });
                            </script>
                        </table>
                    </td>
                </form>
            <?php
                if ($counter % 3 == 0) {
                    echo "</tr><tr>";
                }
            }
            ?>
        </tr>
    </table>
    <!-- ADD NEW START -->
    <form action="" method="POST">
        <div class="newstylist-bg" id="newstylist-bg">
            <div class="close-newstylist-bg" id="close-newstylist-bg"></div>
            <table class="newstylist-table">
                <tr>
                    <td colspan="999" style="text-align: center; font-size: 22px">
                        ADD NEW STYLIST
                        <i class="fa fa-close" id="close-addnew"></i>
                    </td>
                </tr>
                <tr>
                    <td style="height: 3px"></td>
                </tr>
                <tr>
                    <td>Stylist Picture: </td>
                    <td colspan="2" class="newstylist-td">
                        <input type="file" name="empPicture" required>
                    </td>
                </tr>
                <tr>
                    <td>Name: </td>
                    <td>
                        <input style="width: 250px" type="text" placeholder="Last Name" name="empLN" required>
                    </td>
                    <td>
                        <input style="width: 250px" type="text" placeholder="First Name" name="empFN" required>
                    </td>
                </tr>
                <tr>
                    <td>Gender: </td>
                    <td colspan="2">
                        Male <input type="radio" checked name="empGender" value="male" required>
                        Female <input type="radio" name="empGender" value="female" required>
                    </td>
                </tr>
                <tr>
                    <td>Email: </td>
                    <td colspan="2" class="newstylist-td">
                        <input type="email" placeholder="example@email.com" name="empEmail" required>
                    </td>
                </tr>
                <tr>
                    <td>Phone Number: </td>
                    <td colspan="2" class="newstylist-td">
                        <input type="text" placeholder="0123456879" name="empPhone" required>
                    </td>
                </tr>
                <tr>
                    <td>Skill: </td>
                    <td colspan="2" class="newstylist-td">
                        <textarea name="empSkill" id="" placeholder="Type stylist skills..." cols="10" rows="3"></textarea>
                    </td>
                </tr>
                <tr>
                    <td>Years of Experience: </td>
                    <td colspan="2">
                        <input style="width: 150px" type="number" min="1" placeholder="Type year number" name="empYearOfExp" required>
                    </td>
                </tr>
                <tr>
                    <td>Off Day: </td>
                    <td colspan="2">
                        <input style="width: 150px" type="number" min="1" max="7" placeholder="1 to 7 only" name="empOffDay" required>
                    </td>
                </tr>
                <tr>
                    <td>Password: </td>
                    <td colspan="2" class="newstylist-td">
                        <input type="password" name="empPassword" required>
                    </td>
                </tr>
                <tr>
                    <td style="height: 50px" colspan="999">
                        <button class="btnReset" type="reset">Reset</button>
                        <button class="btnAdd" name="btnAdd" type="submit">Add Stylist</button>
                    </td>
                </tr>
            </table>
        </div>
    </form>
    <!-- ADD NEW END -->
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

        $('#btn-add-new, #btn-add-hover').click(function() {
            $('#newstylist-bg').css({
                "display": "block"
            });
        });
        $('#close-newstylist-bg, #close-addnew').click(function() {
            $('#newstylist-bg').css({
                "display": "none"
            });
        });
    </script>
    <?php
    if (isset($_POST['btn_btn'])) {
        $delete_stylist = "DELETE FROM employee_list WHERE empID = '" . $_POST['emp_id'] . "' AND empRole = 'stylist'";
        mysqli_query($conn, $delete_stylist);
        echo "<script>alert('Successfully removed data!');</script>";
        echo "<script>window.location.href='stylistdata.php'</script>";
    } else if (isset($_POST['btnAdd'])) {
        $addnew_stylist = "INSERT INTO employee_list (empFN, empLN, empGender, empEmail, empPhone, empSkill, empYearOfExp, empOffDay, empPassword, empPicture) VALUES ('" . $_POST['empFN'] . "', '" . $_POST['empLN'] . "', '" . $_POST['empGender'] . "', '" . $_POST['empEmail'] . "', '" . $_POST['empPhone'] . "', '" . $_POST['empSkill'] . "', '" . $_POST['empYearOfExp'] . "', '" . $_POST['empOffDay'] . "', '" . $_POST['empPassword'] . "', 'stylist-image/" . $_POST['empPicture'] . "')";
        mysqli_query($conn, $addnew_stylist);
        echo "<script>alert('Successfully added a new stylist!');</script>";
        echo "<script>window.location.href='stylistdata.php'</script>";
    }
    ?>
</body>

</html>

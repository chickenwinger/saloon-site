<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add Service Pop-up</title>
    <style>
        .popup-table {
            margin-top: 8%;
        }
    </style>
</head>

<body>
    <form action="servicedata.php" method="POST">
        <div class="popup-bg" id="empty-popup-bg">
            <table class="popup-table">
                <tr>
                    <td colspan="2">
                        <button class="btn-close-popup" onclick="closeAddForm()" type="button">X</button>
                        <div class="title">ADD NEW SERVICE</div>
                    </td>
                </tr>
                <tr>
                    <td class="popup-labels">
                        <label for="picture">
                            <b>Service Picture:</b>
                        </label>
                    </td>
                    <td>
                        <input style="border: none" type="file" placeholder="Browse" name="servpicture" required>
                    </td>
                </tr>
                <tr>
                    <td class="popup-labels">
                        <label for="title">
                            <b>Service Title:</b>
                        </label>
                    </td>
                    <td>
                        <input type="text" placeholder="Enter Service Title" name="servtitle" required>
                    </td>
                </tr>
                <tr>
                    <td class="popup-labels">
                        <label for="prodcontent">
                            <b>Service Description:</b>
                        </label>
                    </td>
                    <td>
                        <textarea placeholder="Enter Service Description" name="servdescription"></textarea>
                    </td>
                </tr>
                <tr>
                    <td class="popup-labels">
                        <label for="servcategory">
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
                        <label for="servprice">
                            <b>Service Price (RM):</b>
                        </label>
                    </td>
                    <td>
                        <input type="text" placeholder="Enter Service Price" name="servprice" required>
                    </td>
                </tr>
                <tr>
                    <td colspan="2" style="height: 50px">
                        <button type="submit" name="btnAdd" class="btnUpdate">Add Service</button>
                        <button type="reset" class="btnReset">Reset</button>
                    </td>
                </tr>
            </table>
        </div>
    </form>
    <?php
    if (isset($_POST['btnAdd'])) {
        $addservicelist = "INSERT INTO service_list (servTitle, servCategory, servDescription, servPrice, servPicture) " .
            "VALUES('" . $_POST['servtitle'] . "', '" . $_POST['servcategory'] . "', '" . $_POST['servdescription'] . "', " .
            "'" . $_POST['servprice'] . "', 'service/service-image/" . $_POST['servpicture'] . "')";

        mysqli_query($conn, $addservicelist);
        if (mysqli_affected_rows($conn) > 0) {
            echo "<script>alert('Data has been added successfully!');</script>";
        }
    }
    ?>
    <script>
        function openAddForm() {
            document.querySelector('#empty-popup-bg').style.display = 'block';
        }

        function closeAddForm() {
            document.querySelector('#empty-popup-bg').style.display = 'none';
        }
    </script>
</body>

</html>

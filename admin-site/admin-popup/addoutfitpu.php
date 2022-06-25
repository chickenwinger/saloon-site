<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add Outfit Pop-up</title>
    <style>
        .popup-table {
            margin-top: 5%;
        }

        input[type=radio] {
            font-size: 10px !important;
            position: absolute !important;
            margin: 0 !important;
            width: 20px !important;
            height: 20px !important;
        }
    </style>
</head>

<body>
    <form action="outfitdata.php" method="POST">
        <div class="popup-bg" id="empty-popup-bg">
            <table class="popup-table">
                <tr>
                    <td colspan="2">
                        <input type="hidden" name="input_outfitID">
                        <button class="btn-close-popup" onclick="closeAddForm()" type="button">X</button>
                        <div class="title">ADD NEW OUTFIT</div>
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
                        <input type="text" placeholder="Enter Outfit Title" name="outfittitle" required>
                    </td>
                </tr>
                <tr>
                    <td class="popup-labels">
                        <label>
                            <b>Gender:</b>
                        </label>
                    </td>
                    <td>
                        Male <input type="radio" value="male" name="outfitgender"> &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                        Female &nbsp;<input type="radio" value="male" name="outfitgender" checked>
                    </td>
                </tr>
                <tr>
                    <td class="popup-labels">
                        <label>
                            <b>Outfit Description:</b>
                        </label>
                    </td>
                    <td>
                        <textarea placeholder="Enter Outfit Description" name="outfitdescription"></textarea>
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
                        <input type="text" placeholder="Enter Outfit Price" name="outfitprice" required>
                    </td>
                </tr>
                <tr>
                    <td colspan="2" style="height: 50px">
                        <button type="submit" name="btnAdd" class="btnUpdate">Add Outfit</button>
                        <button type="reset" class="btnReset">Reset</button>
                    </td>
                </tr>
            </table>
        </div>
    </form>

    <?php
    if (isset($_POST['btnAdd'])) {
        $addoutfitlist = "INSERT INTO outfit_list " .
            "(outfitTitle, outfitGender, outfitCategory, outfitDescription, outfitPrice, outfitPicture) " .
            "VALUES('" . $_POST['outfittitle'] . "', '" . $_POST['outfitgender'] . "', " .
            "'" . $_POST['outfitcategory'] . "', '" . $_POST['outfitdescription'] . "', " .
            "'" . $_POST['outfitprice'] . "', 'outfit/outfit-image/" . $_POST['outfitpicture'] . "')";

        mysqli_query($conn, $addoutfitlist);
        if (mysqli_affected_rows($conn) > 0) {
            echo "<script>alert('New outfit has been added successfully!');</script>";
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

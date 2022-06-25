<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <style>
        body {
            background: grey;
        }
    </style>
</head>

<body>
    <form name="formlink" action="service-stylist.php?servID=<?php echo $_GET['servID']; ?>&date=<?php echo $_POST['selectDate']; ?>&time=<?php echo $_POST['selectTime']; ?>" method="POST"></form>
    <script>
        window.onload = function() {
            document.forms['formlink'].submit();
        }
    </script>
</body>

</html>

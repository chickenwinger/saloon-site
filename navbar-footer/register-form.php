<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sign-up Today!</title>
    <link rel="stylesheet" href="register.css">
    <link rel="stylesheet" href="navbar-footer.css">
</head>

<body>
    <div style="height: 2vw"></div>
    <form action="" method="POST">
        <table class="reg-form">
            <tr>
                <td style="height: 1vw"></td>
            </tr>
            <tr>
                <td colspan="7" style="text-align: center">
                    <h1>Sign Up Membership<h1>
                </td>
            </tr>
            <tr>
                <td style="height: 2vw"></td>
            </tr>
            <tr>
                <td class="reg-labels">Name: </td>
                <td><input name="fn" class="small-input" type="text" required placeholder="First Name"></td>
                <td><input name="ln" class="small-input" type="text" required placeholder="Last Name"></td>
                <td class="reg-labels">Address: </td>
                <td><input name="hs-no" class="small-input" type="text" required placeholder="House/Unit No."></td>
                <td><input name="street" class="small-input" type="text" required placeholder="Street"></td>
            </tr>
            <tr>
                <td class="reg-labels">Gender: </td>
                <td colspan="2">
                    <input type="radio" name="regGender" value="male" checked>&nbsp;Male&emsp;
                    <input type="radio" name="regGender" value="female">&nbsp;Female
                </td>
                <td></td>
                <td><input name="resident" class="small-input" type="text" required placeholder="Residential Name"></td>
                <td><input name="postal" class="small-input" type="text" required placeholder="Postal Code"></td>
            </tr>
            <tr>
                <td class="reg-labels">Username: </td>
                <td colspan="2"><input name="username" class="large-input" type="text" required placeholder="example: ckw123"></td>
                <td></td>
                <td><input name="city" class="small-input" type="text" required placeholder="City"></td>
                <td>
                    <select class="small-input" name="selectState" required>
                        <option selected disabled>-Select a state-</option>
                        <option value="Kuala Lumpur">Kuala Lumpur</option>
                        <option value="Selangor">Selangor</option>
                    </select>
                </td>
            </tr>
            <tr>
                <td class="reg-labels">Email: </td>
                <td colspan="2"><input name="email" class="large-input" type="email" required placeholder="example: ckw123@hotmail.com"></td>
                <td class="reg-labels">Password: </td>
                <td colspan="2"><input name="password" class="large-input" type="password" required></td>
            </tr>
            <tr>
                <td class="reg-labels">Phone Number: </td>
                <td colspan="2"><input name="phone" class="large-input" type="text" placeholder="example: 0123456789"></td>
                <td class="reg-labels">Confirm Password: </td>
                <td colspan="2"><input name="cfm-password" class="large-input" type="password"></td>
            </tr>
            <tr>
                <td style="height: 2vw"></td>
            </tr>
            <tr>
                <td class="reg-buttons-td" colspan="3" style="text-align: right">
                    <button name="btnReg" class="reg-buttons" type="submit">Sign Up</button>
                </td>
                <td class="reg-buttons-td" colspan="3" style="text-align: left">
                    <button class="reg-buttons" type="button" onclick="window.location.href='../homepage.php'">Back To Home</button>
                </td>
            </tr>
            <tr>
                <td style="height: 1vw"></td>
            </tr>
        </table>
    </form>
    <div style="height: 90px"></div>

    <?php include('register.php'); ?>

</body>

</html>

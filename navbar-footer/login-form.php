<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login Form</title>
    <link rel="stylesheet" href="navbar-footer.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>
</head>

<body>
    <form action="navbar-footer/login.php " method="POST">
        <div class="login-bg">
            <div class="login-outclose"></div>
            <table class="login-popup">
                <tr>
                    <td colspan="3" class="login-close">
                        <i name="loginClose" onclick="loginClose()" class="fa fa-close"></i>
                    </td>
                </tr>
                <tr>
                    <td colspan="3">
                        <h2>Sign In Your Account</h2>
                    </td>
                </tr>
                <tr>
                    <td class="login-label">Email/Username: </td>
                    <td colspan="2" class="login-input">
                        <input type="text" required name="loginUsername">
                    </td>
                </tr>
                <tr>
                    <td class="login-label">Password: </td>
                    <td colspan="2" class="login-input">
                        <input type="password" required name="loginPassword">
                    </td>
                </tr>
                <tr>
                    <td colspan="3">
                        <button type="submit" name="btnLogin">Sign In</button>
                        &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                        <button type="reset">Reset</button>
                    </td>
                </tr>
                <tr>
                    <td colspan="3">Not a member? Sign up <a href="navbar-footer/register-form.php">here</a>!</td>
                </tr>
                <tr>
                    <td style="height: 30px"></td>
                </tr>
            </table>
        </div>
    </form>
    <script>
        $(function() {
            $('.login-outclose').click(function() {
                $('.login-bg').css({
                    "display" : "none"
                });
            });
        });

        function loginPopup() {
            document.querySelector('.login-bg').style.display = 'block';
        }

        function loginClose() {
            document.querySelector('.login-bg').style.display = 'none';
        }
    </script>
</body>

</html>

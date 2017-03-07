
<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <title>Login</title>
        <link rel="shortcut icon" href="favicon.ico" type="image/x-icon">
        <link rel="stylesheet" href="style/reset.css" />
        <link rel="stylesheet" href="style/form.css" />
        <link rel="stylesheet" href="style/general.css" />
        <script type="text/javascript" src="script/loginValidation.js"></script>
    </head>
    <body>
        <?php include 'header.php'; ?>
        <div id="main">

            <form id="mainform" method="POST" action="processLogin.php">
                <h2>Login</h2>

                <div class="formE">
                    <label>Email</label>
                    <input type="email" name="email" placeholder="Email"/>
                    <p id="pleasefillemail">
                    </p>
                </div>

                <div class="formE">
                    <label>Password</label>
                    <input type="password" name="password" placeholder="Password" />
                    <p id="pleasefillpass">
                    </p>
                </div>

                <br />


                <input class="button" type="submit" value="Go" />

            </form>
        </div>
        <?php include 'footer.php'; ?>
    </body>
</html>

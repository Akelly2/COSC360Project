<?php
if ( isset($_SESSION['username']) ) {
    header('Location: index.php');
}

 ?>
<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <title>Register</title>
        <link rel="shortcut icon" href="favicon.ico" type="image/x-icon">
        <link rel="stylesheet" href="style/reset.css" />
        <link rel="stylesheet" href="style/form.css" />
        <link rel="stylesheet" href="style/general.css" />
        <script type="text/javascript" src="script/registerValidation.js"></script>
    </head>
    <body>
        <?php include 'header.php'; ?>

        <div id="main">
            <form id="mainform" method="POST" action="app/registerProcess.php" enctype="multipart/form-data">
                <h2>Register</h2>
                <div class="formE">
                    <label>Username</label>
                    <input type="text" name="username" placeholder="Name"/>
                    <p id="pleasefillname"></p>
                </div>

                <div class="formE">
                    <label>Email</label>
                    <input type="email" name="email" placeholder="Email"/>
                    <p id="pleasefillemail"></p>
                </div>

                <div class="formE">
                    <label>Profile image</label>
                    <input type="file" name="userImage" id="userImage" placeholder="Image" />
                </div>

                <div class="formE">
                    <label>Password</label>
                    <input type="password" name="password" placeholder="Password" />
                    <p id="pleasefillpass"></p>
                </div>

                <div class="formE">
                    <label>Confirm Password</label>
                    <input type="password" name="confirm" placeholder="Confirm" />
                    <p id="pleaseconfirm"></p>
                </div>

                <div class="terms">
                    <label>I agree to the <a href="terms.php">Terms of Use</a></label>
                    <input type="checkbox" name="accept" />
                    <p id="pleaseaccept"></p>
                </div>

                <input type="submit" value="Register" />
            </form>
        </div>
        <?php include 'footer.php'; ?>
    </body>
</html>

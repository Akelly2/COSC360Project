<?php
include('app/errors.php');
if (isset($_GET['registererr'])){
    $err = $registererr[$_GET['registererr']];
}
session_start();
if ( !empty($_SESSION['forumuser']) ) {
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
        <link rel="stylesheet" href="style/general.css" />
        <script type="text/javascript" src="script/registerValidation.js"></script>
        <!-- <script src="https://www.google.com/recaptcha/api.js" async defer></script> -->
    </head>
    <body>
        <?php include 'header.php'; ?>

        <div>
            <form id="mainform" method="POST" action="app/registerProcess.php" enctype="multipart/form-data">
                <h2>Register</h2>
                <div class="formE">
                    <label>Username</label>
                    <input type="text" name="username" placeholder="Name"/>
                    <p id="pleasefillname"></p>
                </div>

                <div class="formE">
                    <label>Email</label>
                    <input type="text" name="email" placeholder="Email"/>
                    <p id="pleasefillemail"></p>
                </div>

                <div class="formE">
                    <label>Profile image</label>
                    <input type="file" name="userImage" id="userImage" placeholder="Image" />
                </div>

                <div class="formE">
                    <label>Password</label>
                    <input type="password" name="password" placeholder="Password" />
                    <p id="pleasefillpass"></p><br />
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

                <!-- <div class="g-recaptcha" data-sitekey="6LcXzhsUAAAAAOHOobEsqaXGmzRs7_6BOzMzT-im"></div> -->

                <input class="formsubmit" type="submit" value="Register" />
                <?php if (isset($err)) echo "<p class=\"err\">$err</p>" ; ?>
            </form>

        </div>
        <?php include 'footer.php'; ?>
    </body>
</html>

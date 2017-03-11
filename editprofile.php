<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <title>Register</title>
        <link rel="shortcut icon" href="favicon.ico" type="image/x-icon">
        <link rel="stylesheet" href="style/reset.css" />
        <link rel="stylesheet" href="style/form.css" />
        <link rel="stylesheet" href="style/general.css" />
    </head>
    <body>
        <?php include 'header.php'; ?>

        <div id="main">
            <form id="mainform" method="POST" action="app/registerProcess.php">
                <h2>Edit your profile</h2>

                <div class="formE">
                    <label>Change rofile picture</label>
                    <input type="file" name="image" placeholder="Image" />
                </div>

                <div class="formE">
                    <label>Change Password</label>
                    <input type="password" name="password" placeholder="Password" />
                    <p id="pleasefillpass"></p>
                </div>

                <div class="formE">
                    <label>Confirm Password change</label>
                    <input type="password" name="confirm" placeholder="Confirm" />
                    <p id="pleaseconfirm"></p>
                </div>

                <input type="submit" value="Register" />
            </form>
        </div>
        <?php include 'footer.php'; ?>
    </body>
</html>

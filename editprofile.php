<?php
include("app/DB.php");
if(!isset($_SESSION))
{
    session_start();
}
$conn = DB::getConnection() or
  die ("<p>Data problem. Talk to your administrator.</p>");
$sql = "SELECT userid, username, email, haspic
        FROM User
        WHERE userid = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param('i', $_SESSION['userid']);
$stmt->execute();
$row = DB::get_result($stmt);
$row = $row[0];
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
    </head>
    <body>

        <?php include 'header.php'; ?>

        <div>
            <form id="mainform" method="POST" action="app/editProfile.php">
                <?php if ($row[3] !== 0) {
                    $filename = $row[0];
                } else {
                    $filename = 'defaultuser.png';
                }
                ?>
                <img src="userimages/<?= $filename ?>" class="profilepic"/>
                <h2><?= $row[1] ?></h2>

                <div class="formE">
                    <input type="file" name="image" placeholder="Image" />
                </div>

                <?php
                // echo '
                // <div class="formE">
                //     <label>Old Password</label>
                //     <input type="password" name="oldpassword" placeholder="Password" />
                //     <p id="pleasefillpass"></p>
                // </div>
                //
                // <div class="formE">
                //     <label>Change Password</label>
                //     <input type="password" name="newpassword" placeholder="Password" />
                //     <p id="pleasefillpass"></p>
                // </div>
                //
                // <div class="formE">
                //     <label>Confirm Password change</label>
                //     <input type="password" name="confirm" placeholder="Confirm" />
                //     <p id="pleaseconfirm"></p>
                // </div>
                //
                // <input class="formsubmit" type="submit" value="Change" />  '
                    ?>
            </form>
        </div>
        <?php include 'footer.php'; ?>
    </body>
</html>

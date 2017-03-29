<?php
include("app/DB.php");
if (!isset($_SESSION)) {
    session_start();
}
if (!isset($_GET['postid'])) {
    header('Location: index.php');
}
$conn = DB::getConnection() or
  die ("<p>Data problem. Talk to your administrator.</p>");
$postid = $_GET['postid'];
$sql = "SELECT postid, title, content, ts, userid, U.username
        FROM Post as P, User as U
        WHERE postid = ? AND U.userid = P.userid";
$stmt = $conn->prepare($sql);
$stmt->bind_param('i', $postid);
$stmt->execute();
$result = $stmt->get_result();
$row = $result->fetch_array(MYSQLI_NUM);

 ?>
<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <title>Title here</title>
        <link rel="shortcut icon" href="favicon.ico" type="image/x-icon">
        <link rel="stylesheet" href="style/reset.css" />
        <link rel="stylesheet" href="style/form.css" />
        <link rel="stylesheet" href="style/general.css" />
    </head>
    <body>
        <?php include 'header.php'; ?>
        <div id="sidebar">
            <a class="speciallink" href="create.php">Create</a>
        </div>

        <div id="thepost">
            <h4><?= $row[1] ?></h4>
            <p>
                
            </p>
        </div>

        <?php // Logic is needed here to show entire comment threads ?>
        <div id="links">
            <div id="comment">
                <p>An example of a pleasent comment.</p>
                <p>Submitted 5 hours ago by Joey K.</p>
                <div id="comment">
                    <p>An example of a very condescending reply.</p>
                    <p>Submitted 5 hours ago by George P.</p>
                </div>
            </div>
        </div>
        <?php include 'footer.php' ?>
    </body>
</html>

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

// get post data
$postid = $_GET['postid'];
$sql = "SELECT postid, title, content, ts, userid
        FROM Post as P
        WHERE P.postid = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param('i', $postid);
$stmt->execute();
$result = $stmt->get_result();
$mainpost = $result->fetch_array(MYSQLI_NUM);
mysqli_free_result($result);

// get user data
$sql = "SELECT U.userid, U.username
        FROM User as U
        WHERE U.userid = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param('i', $row[4]);
$stmt->execute();
$result = $stmt->get_result();
$user = $result->fetch_array(MYSQLI_NUM);
mysqli_free_result($result);

// get the comments for this thread
$sql = "SELECT commentid, content, ts, username, threadid, isparent, userid, postid
        FROM Comment
        WHERE postid = ?
        ORDER BY threadid ASC, ts ASC
        GROUP BY threadid";
$stmt = $conn->prepare($sql);
$stmt->bind_param('i', $mainpost[0]);
$stmt->execute();
$result = $stmt->get_result();
$comments = $result->fetch_array(MYSQLI_NUM);
mysqli_free_result($result);
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

        <div id="main">
            <h3><?= $mainpost[1] ?></h3>
            <p>
                <?= $mainpost[2] ?>
            </p>
            <p>
                Date and time posted: <?= $mainpost[3] ?>
            </p>
            <p>
                Posted by: <?= $user[1] ?>
            </p>
        </div>

        <h3>Replies</h3>
        <section class="replies">

        <?php
        foreach ($comments as $comment) {
            if ($comment[5] == true) { ?>
            <div class="parent">
                <p><?= $comment[1] ?></p>
                <p>Submitted <?= $comment[2] ?> by <?= $comment[3] ?></p>
            <?php } ?>
                <div class="desc">
                    <p><?= $comment[1] ?></p>
                    <p>Submitted <?= $comment[2] ?> by <?= $comment[3] ?></p>
                </div>
            </div>

        <?php } ?>

        </section>
        <?php include 'footer.php' ?>
    </body>
</html>

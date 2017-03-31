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
$mainpost = DB::get_result($stmt);
$mainpost = $mainpost[0];

// get user data
$sql = "SELECT U.userid, U.username
        FROM User as U
        WHERE U.userid = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param('i', $mainpost[4]);
$stmt->execute();
$user = DB::get_result($stmt);
$user = $user[0];

// get the comments for this thread
$sql = "SELECT commentid, content, ts, username, threadid, isparent, userid, postid
        FROM Comment
        WHERE postid = ? and isparent = 1
        ORDER BY threadid asc";
$stmt = $conn->prepare($sql);
$stmt->bind_param('i', $postid);
$stmt->execute();
$parents = DB::get_result($stmt);
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
        <script type="text/javascript" src="script/reply.js"></script>
    </head>
    <body>
        <?php include 'header.php'; ?>
        <div id="sidebar">
            <form id="search" action="index.php" method="GET">
                <input type="text" name="searchterms" placeholder="search" />
                <input style="visibility: hidden; width:1px; height: 1px; margin:0;" type="submit" value="Go" tabindex="2" />
            </form>
            <a class="speciallink" href="create.php">Submit a new post</a>
        </div>

        <div id="main">
            <h3><?= $mainpost[1] ?></h3>
            <p class="textpost">
                <?= $mainpost[2] ?>
            </p>
            <p class="details">
                Date and time posted: <?= $mainpost[3] ?>
            </p>
            <p class="details">
                Posted by: <?= $user[1] ?>
            </p>
        </div>

        <section class="replies">
            <h4>Replies</h4>


        <?php
        // loop through each top level comment
        foreach ($parents as $parent) {
             ?>
            <div id="<?= $parent[0] ?>" class="parent">
                <p class="details"><?= $parent[1] ?></p>
                <p>Submitted <?= '' ?> by <?= $parent[3] ?></p>
                <button class="specialbutton" onclick="showreplyform(<?= $parent[0]?>)">Reply</button>
                <form class="replyformhidden" id="r<?= $parent[0] ?>" method="POST" action="app/addReply.php">
                    <input type="hidden" name="threadid" value="<?= $parent[4] ?>" />
                    <input type="hidden" name="postid" value="<?= $postid ?>" />
                    <textarea name="replytext"></textarea>
                    <input class="specialbutton" type="submit" value="Submit Reply" />
                </form>
            <?php
            // print_r($parent);
            $sql = "SELECT commentid, content, ts, username, threadid, isparent, userid, postid
                    FROM Comment
                    WHERE threadid = ? and isparent = 0
                    ORDER BY threadid";
            $stmt = $conn->prepare($sql);
            $stmt->bind_param('i', $parent[4]);
            $stmt->execute();
            $descendants = DB::get_result($stmt);

            // loop through each direct reply to each parent comment and append
            foreach ($descendants as $descendant) {
                ?>
                <div class="desc">
                    <p id="<?= $descendant[0] ?>"><?= $descendant[1] ?></p>
                    <p class="details">Submitted <?= '' ?> by <?= $descendant[3] ?></p>
                </div>

        <?php } // I don't know ?>
            </div>
        <?php } ?>

            <div>
                <button class="specialbutton" onclick="showcommentform()">Comment</button>
                <form class="replyformhidden" id="parent" method="POST" action="app/addComment.php">
                    <input type="hidden" name="postid" value="<?= $postid ?>" />
                    <textarea name="commenttext"></textarea>
                    <input  class="specialbutton" type="submit" value="Submit Comment" />
                </form>
            </div>
        </section>
        <?php include 'footer.php' ?>

    </body>
</html>

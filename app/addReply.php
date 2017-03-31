<?php
include("DB.php");
if(!isset($_SESSION))
{
    session_start();
    $user = $_SESSION["forumuser"];
}
$postid = $_POST['postid'];
$threadid = $_POST['threadid'];
$isparent = false;
$conn = DB::getConnection() or
  die ("<p>Data problem. Talk to your administrator.</p>");

$newsql = "INSERT INTO Comment(content, isparent, username, threadid, userid, postid)
           VALUES (?, ?, ?, ?, ?, ?);";
$stmt = $conn->prepare($newsql);
$stmt->bind_param('sisiii', $_POST['replytext'], $isparent, $user, $threadid,
                 $_SESSION['userid'], $postid);
if ($stmt->execute()) {
     header("Location: ../thread.php?postid=" . $postid);
}

 ?>

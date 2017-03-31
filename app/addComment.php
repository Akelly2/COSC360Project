<?php
include("DB.php");
if(!isset($_SESSION))
{
    session_start();
    $user = $_SESSION["forumuser"];
}
$postid = $_POST['postid'];
$isparent = true;
$conn = DB::getConnection() or
  die ("<p>Data problem. Talk to your administrator.</p>");

$newsql = "INSERT INTO Comment(content, isparent, username, userid, postid)
           VALUES (?, ?, ?, ?, ?);";
$stmt = $conn->prepare($newsql);
$stmt->bind_param('sisii', $_POST['commenttext'], $isparent, $user,
                 $_SESSION['userid'], $postid);
$stmt->execute();

$commentid = $conn->insert_id;

$sql = "UPDATE Comment SET threadid = ? WHERE commentid = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param('ii', $commentid, $commentid);
if ($stmt->execute()) {
    header("Location: ../thread.php?postid=" . $postid);
}

 ?>

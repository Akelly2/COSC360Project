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

$sql = "UPDATE Comment SET threadid = ?";
$stmt = $conn->prepare($newsql);
$stmt->bind_param('i', $commentid);
if ($stmt->execute()) {
    header("Location: ../thread?postid=" . $postid . "");
}

 ?>

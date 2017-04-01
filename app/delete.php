<?php
include("DB.php");
if(!isset($_SESSION))
{
    session_start();
}
if (($_SESSION['admin']) == false) {
    header("Location: ../index.php");
}
$conn = DB::getConnection() or
  die ("<p>Data problem. Talk to your administrator.</p>");

if (isset($_GET['postid'])) {
    $postid = $_GET['postid'];
    $newsql =
        "UPDATE Post
        SET content = '[deleted]'
        WHERE postid = ?";
    $stmt = $conn->prepare($newsql);
    $stmt->bind_param('i', $postid);
    $stmt->execute();
    header("Location: ../thread.php?postid=" . $postid);
}

else if (isset($_GET['commentid'])) {
    $commentid = $_GET['commentid'];
    $newsql =
        "UPDATE Comment
        SET content = '[deleted]'
        WHERE commentid = ?";
    $stmt = $conn->prepare($newsql);
    $stmt->bind_param('i', $commentid);
    $stmt->execute();
    header("Location: ../index.php");
}

else echo "There is no reason to be here.";

 ?>

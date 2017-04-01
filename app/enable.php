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

if ($_GET['enabled'] == 1) {
    $userid = $_GET['userid'];
    $newsql =
        "UPDATE User
        SET enabled = false
        WHERE userid = ?";
    $stmt = $conn->prepare($newsql);
    $stmt->bind_param('i', $userid);
    $stmt->execute();
    header("Location: ../adminuserlist.php");
} elseif($_GET['enabled'] == 0) {
    $userid = $_GET['userid'];
    $newsql =
        "UPDATE User
        SET enabled = true
        WHERE userid = ?";
    $stmt = $conn->prepare($newsql);
    $stmt->bind_param('i', $userid);
    $stmt->execute();
    header("Location: ../adminuserlist.php");
}

 ?>

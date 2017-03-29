<?php
include("DB.php");
if(!isset($_SESSION))
{
    session_start();
}

$conn = DB::getConnection() or
  die ("<p>Data problem. Talk to your administrator.</p>");

if ( isset($_POST['title']) && isset($_POST['content'])) {

    // add the post to the database
    $sql = "INSERT into Post(title, content, userid) values (?, ?, ?);";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param('ssi', $_POST['title'], $_POST['content'], $_SESSION['userid']);
    $stmt->execute();
    mysqli_stmt_close($stmt);

    // get the latest postid meaning the one just created
    $getidsql = "select max(postid) from Post;";
    $stmt = $conn->prepare($getidsql);
    $stmt->execute();
    $stmt->bind_result($id);
    $stmt->fetch();
    $postid = $id;
    header("Location: ../thread.php?postid=$postid");
}

?>

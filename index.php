<?php
include("app/DB.php");
if (!isset($_SESSION)) {
    session_start();
}
$conn = DB::getConnection() or
  die ("<p>Data problem. Talk to your administrator.</p>");
$sql = "SELECT postid, title, ts, userid
        FROM Post";
$stmt = $conn->prepare($sql);
$stmt->execute();
$result = $stmt->get_result();
$threads = $result->fetch_all(MYSQLI_NUM);
mysqli_free_result($result);
 ?>

<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <title>MyForum</title>
        <link rel="shortcut icon" href="favicon.ico" type="image/x-icon">
        <link rel="stylesheet" href="style/reset.css" />
        <link rel="stylesheet" href="style/general.css" />
        <link rel="stylesheet" href="style/form.css" />
    </head>
    <body>
        <?php include 'header.php'; ?>
        <div id="sidebar">
            <a class="speciallink" href="create.php">Create</a>
        </div>
        <section id="links">
        <?php foreach ($threads as $thread) { ?>
            <a class="clickablebox" href="thread.php?postid=<?= $thread[0]?>" ?>
                <div class="submission">
                <h4><?= $thread[1] ?></h4>
                <p>
                    Submitted <?= $thread[2] ?> by <?= $thread[3] ?>
                </p>
                </div>
            </a>
        <?php } ?>
        </section>

        <?php include 'footer.php' ?>
    </body>
</html>

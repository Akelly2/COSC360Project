<?php
include("app/DB.php");
if (!isset($_SESSION)) {
    session_start();
}
$conn = DB::getConnection() or
  die ("<p>Data problem. Talk to your administrator.</p>");
$sql = "SELECT postid, title, ts, userid
        FROM Post ";

// if there are search terms, then perform a search
// The SQL uses or so this does not actually work
if (!empty($_GET['searchterms'])){
    $searchterms = explode(' ', $_GET['searchterms']);
    $sql.= " WHERE ";
    foreach ($searchterms as $term) {
        // This is just waiting for injection
        $sql .= " title LIKE '%$term%' or ";
    }
    // You can never be too sure
    $sql .= " 1 = 1 ";
}
$sql .= "ORDER BY ts DESC";
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
            <form id="search" action="index.php" method="GET">
                <input type="text" name="searchterms" placeholder="search" />
                <input style="visibility: hidden; width:1px; height: 1px; margin:0;" type="submit" value="Go" tabindex="2" />
            </form>
            <a class="speciallink" href="create.php">Submit a new post</a>
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

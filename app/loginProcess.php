<?php
session_start();
if ( !empty($_SESSION['forumuser']) ) {
    header('Location: index.php');
}
$conn = DB::getConnection() or
  die ("<p>Data problem. Talk to your administrator.</p>");
if ( isset($_POST["username"]) && isset($_POST["password"]) ) {
    $sql = "SELECT username, password
            FROM users
            WHERE username = ?;";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param('s', $_POST["username"]);
    if ($stmt->execute()) {
        $result = $stmt->get_result();
        $row = $result->fetch_array(MYSQLI_NUM);
        // print_r($row);
        if ($row !== null) {
            if ( md5($_POST["password"]) == $row[1] && $_POST['username'] == $row[0] ) {
                $_SESSION['username'] = $_POST['username'];
                header('Location: home.php');
            } else {
                header('Location: login.php');
                // echo 2;
            }
        } else {
            header('Location: login.php');
            // echo 3;
        }
    } else {
        header('Location: login.php');
        // echo 4;
    }
}
mysqli_close($conn);
?>

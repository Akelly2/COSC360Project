<?php
include("DB.php");
if(!isset($_SESSION))
{
    session_start();
}
$conn = DB::getConnection() or
  die ("<p>Data problem. Talk to your administrator.</p>");
if ( isset($_POST["cred"]) && isset($_POST["password"]) ) {
    $sql = "SELECT email, username, password
            FROM User
            WHERE email = ? or username = ?;";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param('ss', $_POST["cred"], $_POST["cred"]);
    if ($stmt->execute()) {
        $result = $stmt->get_result();
        $row = $result->fetch_array(MYSQLI_NUM);
        // print_r($row);
        if ($row !== null) {
            if ( md5($_POST["password"]) == $row[2] && ( $_POST['cred'] == $row[1] || $_POST['cred'] == $row[0] ) ){
                $_SESSION['forumuser'] = $row[1];
                header('Location: ../index.php');

            } else {
                header('Location: ../login.php?loginerr=1');
                // echo 2;
            }
        } else {
            header('Location: ../login.php?loginerr=2');
            // echo 3;
        }
    } else {
        header('Location: ../login.php?loginerr=3');
        // echo 4;
    }
}
mysqli_close($conn);
?>

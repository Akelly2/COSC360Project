<?php
if(!isset($_SESSION))
{
    session_start();
}
if ( empty($_SESSION['forumuser']) ) {
    header('Location: ../index.php');
} else {
    unset($_SESSION['forumuser']);
    unset($_SESSION['userid']);
    unset($_SESSION['admin']);
    header('Location: ../index.php');
}
 ?>

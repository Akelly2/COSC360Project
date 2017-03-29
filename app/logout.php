<?php
if(!isset($_SESSION))
{
    session_start();
} 
if ( empty($_SESSION['forumuser']) ) {
    header('Location: ../index.php');
} else {
    unset($_SESSION['forumuser']);
    header('Location: ../index.php');
}
 ?>

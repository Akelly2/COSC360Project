<?php
// need some logic here to decide if these show up
if(!isset($_SESSION))
{
    session_start();
} 
?>
<header>
    <nav>
        <b>
            MyForum
        </b>
        <a class="HFlink" href="index.php">Home</a>
        <?php if ( empty($_SESSION['forumuser']) ) { ?>
            <a class="HFlink" href="register.php">Register</a>
            <a class="HFlink" href="login.php">Login</a>
        <?php } elseif ( !empty($_SESSION['forumuser']) ) { ?>
            <a class="HFlink" href="editprofile.php">Profile</a>
            <a class="HFlink" href="app/logout.php">Logout</a>
        <?php } ?>
    </nav>
</header>

<?php
// need some logic here to decide if these show up
session_start();
?>
<header>
    <nav>
        <a class="HFlink" href="index.php">Home</a>
        <?php if ( empty($_SESSION['username']) ) { ?>
            <a class="HFlink" href="login.php">Login</a>
            <a class="HFlink" href="register.php">Register</a>
        <?php } elseif ( !empty($_SESSION['username']) ) { ?>
            <a class="HFlink" href="editprofile.php">Register</a>
        <?php } ?>
    </nav>
</header>
<?php

?>

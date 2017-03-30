<?php
if(!isset($_SESSION))
{
    session_start();
}
if ( empty($_SESSION['forumuser']) ) {
    header('Location: login.php');
}
?>
<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <title>Create A Post</title>
        <link rel="shortcut icon" href="favicon.ico" type="image/x-icon">
        <link rel="stylesheet" href="style/reset.css" />
        <link rel="stylesheet" href="style/form.css" />
        <link rel="stylesheet" href="style/general.css" />
    </head>
    <body>
        <?php include 'header.php'; ?>
            <div>
                <form id="create" method="POST" action="app/addPost.php">
                    <h2>Create post</h2>
                    <div class="formE">
                        <label>Title</label>
                        <input type="text" name="title" placeholder="Title"/>
                    </div>
                    <div class="formE">
                        <label>Content</label>
                        <textarea name="content"></textarea>
                    </div>
                    <input class="formsubmit" type="submit" value="Submit" />
                </form>
            </div>
        <?php include 'footer.php' ?>
    </body>
</html>

<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <title>Login</title>
        <link rel="shortcut icon" href="favicon.ico" type="image/x-icon">
        <link rel="stylesheet" href="style/reset.css" />
        <link rel="stylesheet" href="style/form.css" />
        <link rel="stylesheet" href="style/general.css" />
    </head>
    <body>
        <?php include 'header.php'; ?>
            <div id="main">
                <form id="mainform" method="POST" action="app/registerProcess.php">
                    <h2>Create post</h2>
                    <div class="formE">
                        <label>Title</label>
                        <input type="text" name="name" placeholder="Name"/>
                    </div>
                    <div class="formE">
                        <label>Text</label>
                        <textarea></textarea>
                    </div>
                    <input type="submit" value="Submit" />
                </form>
            </div>
        <?php include 'footer.php' ?>
    </body>
</html>

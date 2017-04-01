<?php
include("app/DB.php");
if (!isset($_SESSION)) {
    session_start();
}
if (($_SESSION['admin']) == false){
    header('Location: index.php');
}
$conn = DB::getConnection() or
  die ("<p>Data problem. Talk to your administrator.</p>");
$sql = "SELECT userid, username, email, isadmin, haspic
        FROM User ";
$stmt = $conn->prepare($sql);
$stmt->execute();
$users = DB::get_result($stmt);
 ?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>User list</title>
    <link rel="shortcut icon" href="favicon.ico" type="image/x-icon">
    <link rel="stylesheet" href="style/reset.css" />
    <link rel="stylesheet" href="style/form.css" />
    <link rel="stylesheet" href="style/general.css" />
</head>
<body>
<?php include 'header.php'; ?>

<table>
    <thead>
        <th>User ID</th> <th>Username</th> <th>Email</th> <th>Admin</th>
    </thead>
    <tbody>
    <?php foreach ($users as $user) { ?>
        <tr>
            <td><?= $user[0] ?></td>
            <td><?= $user[1] ?></td>
            <td><?= $user[2] ?></td>
            <td><?= $user[3] ?></td>
            <td><a href="app/disable.php?userid=<?= $user[0] ?>">Disable user</a></td>
        </tr>
    <?php } ?>
    </tbody>
</table>

<?php include 'footer.php' ?>
</body>
</html>
